<?php
/**
 * The model file of log module of ZenTaoCMS.
 *
 * @copyright   Copyright 2009-2010 QingDao Nature Easy Soft Network Technology Co,LTD (www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv11.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     log
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class logModel extends model
{
    /**
     * Save visitor info.
     * 
     * @access public
     * @return object
     */
    public function saveVisitor()
    {
        if(!empty($_COOKIE['vid']))
        {           
            $visitor = $this->getVisitorByID($this->cookie->vid); 
            if(!empty($visitor))
            {
                $visitor->new = false;
                return $visitor;
            }
        }

        $visitor = fixer::input('post')
            ->add('device', $this->app->device)
            ->add('osName', helper::getOS())
            ->add('browserName', helper::getBrowser())
            ->add('browserVersion', helper::getBrowserVersion())
            ->add('createdTime', helper::now())
            ->get();

        $this->dao->insert(TABLE_STATVISITOR)->data($visitor, 'referer')->autocheck()->exec();
        $visitor->new = true;
        $vid = $this->dao->lastInsertId();

        setcookie('vid', $vid, strtotime('+5 year'));
        $visitor->id = $vid;
        return $visitor;
    }

    /**
     * Get a visitor by ID.
     * 
     * @param  int    $vid 
     * @access public
     * @return void
     */
    public function getVisitorByID($vid)
    {
        return $this->dao->select('*')->from(TABLE_STATVISITOR)->where('id')->eq($vid)->fetch();
    }

    /**
     * Save referer info.
     * 
     * @access public
     * @return array
     */
    public function saveReferer()
    {
        if(!$this->post->referer)
        {
            if($this->session->referer)
            {
                $referer = $this->getRefererByID($this->session->referer);
                if(!empty($referer)) return $referer;
            }
            return null;
        }

        $url = urldecode($this->post->referer);
        $refererInDB = $this->dao->select("*")->from(TABLE_STATREFERER)->where('url')->eq($url)->fetch();

        if(!empty($refererInDB))
        {
            $this->session->set('referer', $refererInDB->id);
            return $refererInDB;
        }

        $referer = parse_url($url);
        if(isset($this->config->searchEngine->domains[$referer['host']]))
        {
            $searchEngine = $this->config->searchEngine->domains[$referer['host']];
            $param        = $this->config->searchEngine->params[$searchEngine];
            parse_str($referer['query'], $queryInfo);
            if(is_array($param))
            {
                foreach($param as $paramName) 
                {
                    if(isset($queryInfo[$paramName])) $keywords = $queryInfo[$paramName];
                }
            }
            else
            {
                $keywods = $queryInfo[$param];
            }
            $referer['searchEngine'] = $searchEngine;
            $referer['keywords']     = $keywords;
        }
        $referer['domain'] = $referer['host'];
        $referer['url']    = $url;

        $this->dao->replace(TABLE_STATREFERER)->data($referer, "host,query,path,scheme")->autoCheck()->exec();
        $referer['id'] = $this->dao->lastInsertId();

        $this->session->set('referer', $referer['id']);
        return (object)$referer;
    }

    /**
     * Get a referer by id. 
     * 
     * @param  int    $refererID 
     * @access public
     * @return object
     */
    public function getRefererByID($refererID)
    {
        return $this->dao->select('*')->from(TABLE_STATREFERER)->where('id')->eq($refererID)->fetch();
    }

    /**
     * Save report data.
     * 
     * @param  int    $visitor 
     * @param  int    $referer 
     * @access public
     * @return void
     */
    public function saveReport($visitor, $referer)
    {
        $year  = date('Y');
        $month = date('Ym');
        $day   = date('Ymd');
        $hour  = date('YmdH');

        $time = new stdclass();
        $time->year  = $year;
        $time->month = $month;
        $time->day   = $day;
        $time->hour  = $hour;

        /* Save data to eps_statlog. */
        $log = new stdclass();

        $log->visitor        = $visitor->id;
        $log->osName         = $visitor->osName;
        $log->browserName    = $visitor->browserName;
        $log->browserVersion = $visitor->browserVersion;

        $log->referer      = !empty($referer) ? $referer->id : 0;
        $log->searchEngine = isset($referer->searchEngine) ? $referer->searchEngine : '';
        $log->keywords     = isset($referer->keywords) ? $referer->keywords : '';
        $log->ip           = helper::getRemoteIp();

        $location = $this->app->loadClass('IP')->find($log->ip);
        $log->country  = $location[0];
        $log->province = $location[1];
        $log->city     = $location[2];
        $log->account  = $this->app->user->account;
        $log->year     = $year;
        $log->month    = $month;
        $log->day      = $day;
        $log->hour     = $hour;
        $log->new      = $visitor->new ? 1 : 0;
        $log->mobile   = $this->app->device == 'mobile' ? 1 : 0;
        $log->lang     = 'all';
        $this->dao->insert(TABLE_STATLOG)->data($log)->exec();

        /* Save basic report data. */
        $this->saveReportItem($type = 'basic', $item = 'total', $time, $log);
        if(!$visitor->new and time() - strtotime($visitor->createdTime) > 60 * 60 * 24) $this->saveReportItem($type = 'basic', $item = 'return', $time, $log);
        if($log->mobile) $this->saveReportItem($type = 'basic', $item = 'mobile', $time, $log);

        /* Save serachengine data. */
        if(isset($referer->searchEngine) and $referer->searchEngine != '') $this->saveReportItem($type = 'search', $item = $referer->searchEngine, $time, $log);
        if(isset($referer->keywords) and $referer->keywords != '') $this->saveReportItem($type = 'search', $item = $referer->keywords, $time, $log);
        
        /* Save referer data. */
        if(!empty($referer)) $this->saveReportItem($type = 'referer', $item = $referer->id, $time, $log);
        if(!empty($referer)) $this->saveReportItem($type = 'domain', $item = $referer->domain, $time, $log);

        /* Save os data. */
        $this->saveReportItem($type = 'os', $item = $visitor->osName, $time, $log);
        /* Save browser data. */
        $this->saveReportItem($type = 'browser', $item = $visitor->browserName, $time, $log);

        /* Save from data. */
        if($log->referer != 0 and $log->searchEngine == '') $this->saveReportItem($type = 'from', $item = 'out', $time, $log);
        if($log->referer == 0) $this->saveReportItem($type = 'from', $item = 'self', $time, $log);
        if(!empty($log->referer) and $log->searchEngine != '') $this->saveReportItem($type = 'from', $item = 'search', $time, $log);
    }

    /**
     * Get ip and uv.
     * 
     * @param  string    $type 
     * @param  string    $item 
     * @param  string    $timeType 
     * @param  string    $timeValue
     * @param  object    $log 
     * @access public
     * @return object
     */
    public function getIpAndUv($type, $item, $timeType, $timeValue, $log)
    {
        if($type != 'year')
        {
            $ipAndUv = $this->dao->select('count(distinct(ip)) as ip, count(distinct(visitor)) as uv')
                ->from(TABLE_STATLOG)
                ->where($timeType)->eq($timeValue)

                ->beginIF($type == 'basic' and $item == 'return')
                ->andWhere('new')->eq(0)
                ->fi()

                ->beginIF($type == 'basic' and $item == 'mobile')
                ->andWhere('mobile')->eq(1)
                ->fi()

                ->beginIF($type == 'searchEngine')
                ->andWhere('searchEngine')->eq($log->searchEngine)
                ->fi()

                ->beginIF($type == 'keywords')
                ->andWhere('keywords')->eq($log->keywords)
                ->fi()

                ->beginIF($type == 'os')
                ->andWhere('osName')->eq($log->osName)
                ->fi()

                ->beginIF($type == 'browser')
                ->andWhere('browserName')->eq($log->browserName)
                ->fi()

                ->beginIF($type == 'from' and $item == 'out')
                ->andWhere('referer')->ne(0)->andWhere('searchEngine')->eq('')
                ->fi()

                ->beginIF($type == 'from' and $item == 'self')
                ->andWhere('referer')->eq(0)
                ->fi()

                ->beginIF($type == 'from' and $item == 'search')
                ->andWhere('searchEngine')->ne('')
                ->fi()

                ->fetch();
        }
        else
        {
            $ipAndUv = new stdclass();
            $ipAndUv->ip = 0;
            $ipAndUv->uv = 0;
        }
        return $ipAndUv;
    }

    /**
     * Save a report item of all timeType (year, month, day, hour)
     * 
     * @param  string    $type 
     * @param  string    $item 
     * @param  object    $time 
     * @param  object    $log 
     * @access public
     * @return void
     */
    public function saveReportItem($type, $item, $time, $log)
    {
        foreach($time as $timeType => $timeValue)
        {
            $oldReport = $this->dao->select('*')->from(TABLE_STATREPORT)
                ->where('type')->eq($type)->andWhere('item')->eq($item)
                ->andWhere('timeType')->eq($timeType)
                ->andWhere('timeValue')->eq($timeValue)
                ->fetch();

            if(!empty($oldReport))
            {
                $ipAndUv = $this->getIpAndUv($type, $item, $timeType, $timeValue, $log);

                $this->dao->update(TABLE_STATREPORT)
                    ->set('pv = pv + 1')
                    ->set('ip')->eq($ipAndUv->ip)
                    ->set('uv')->eq($ipAndUv->uv)
                    ->where('id')->eq($oldReport->id)
                    ->exec();
            }
            else
            {
                $report = new stdclass();
                $report->type      = $type;
                $report->item      = $item;
                $report->timeType  = $timeType;
                $report->timeValue = $timeValue;
                $report->pv        = 1;
                $report->uv        = 1;
                $report->ip        = 1;
                $report->lang      = 'all';
                if($type == 'keyword') $report->extral = $log->searchEngine;
                $this->dao->insert(TABLE_STATREPORT)->data($report)->exec();
            }
        }
    }

    public function saveRegion()
    {

    }

    /**
     * Clear report.
     * 
     * @access public
     * @return void
     */
    public function clearLog()
    { 
        $saveDays = !empty($this->config->site->saveDays) ? $this->config->site->saveDays : 30;
        $date = date('Ymd', strtotime("-{$saveDays} day"));
        $this->dao->delete()->from(TABLE_STATLOG)->where('day')->lt($date)->exec();
        return !dao::isError();
    }
}
