<?php
/**
 * The control file of stat of ChanzhiEPS.
 *
 * @copyright   Copyright 2009-2010 QingDao Nature Easy Soft Network Technology Co,LTD (www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv11.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     stat
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class stat extends control
{
    /**
     * Traffic statistics.
     * 
     * @param  string $mode 
     * @access public
     * @return void
     */
    public function traffic($mode = 'today')
    {
        $this->view->todayReport    = $this->dao->select('*')->from(TABLE_STATREPORT)->where('timeType')->eq('day')->andWhere('timeValue')->eq(date('Ymd'))->fetch(); 
        $this->view->yestodayReport = $this->dao->select('*')->from(TABLE_STATREPORT)->where('timeType')->eq('day')->andWhere('timeValue')->eq(date('Ymd', strtotime("-1 day")))->fetch();

        $this->view->labels = $this->config->stat->hourLabels;   
        $this->view->title      = $this->lang->stat->traffic;
        $this->view->mode       = $mode;

        if($mode == 'today') $this->view->lineChart = $this->stat->getBasicLine('total', 'hour', $this->stat->getHourLabels(date('Ymd')));
        if($mode == 'yestoday') $this->view->lineChart = $this->stat->getBasicLine('total', 'hour', $this->stat->getHourLabels(date('Ymd', strtotime('-1 day'))));

        if($mode != 'today' and $mode != 'yestoday') 
        {
            if($mode == 'weekly') $days  = 7;
            if($mode == 'monthly') $days = 30;
            if($mode != 'fixed')
            {
                $begin = date('Ymd', strtotime("-{$days} day"));
                $end   = date('Ymd');
            }
            $labels = $this->stat->getDayLabels($begin, $end);
            $this->view->labels = $labels;
            $this->view->lineChart = $this->stat->getBasicLine('total', 'day', $labels);
        }

        $this->display();
    }

    /**
     * From statistics report page.
     * 
     * @param  string $begin 
     * @param  string $end 
     * @access public
     * @return void
     */
    public function report($type, $mode = 'weekly', $begin = '', $end = '')
    {
        if($begin) $begin = date('Ymd', strtotime($begin));
        if($end)   $end   = date('Ymd', strtotime($end));

        if($mode == 'today')
        {
            $begin = $end = date("Ymd");
        }
        elseif($mode == 'yestoday')
        {
            $begin = $end = date("Ymd", strtotime("-1 day"));
        }
        elseif($mode != 'fixed')
        {
            if($mode == 'weekly') $days  = 7;
            if($mode == 'monthly') $days = 30;

            $begin = date('Ymd', strtotime("-{$days} day"));
            $end   = date('Ymd');
        }

        if($begin > $end) 
        {
            $this->view->error = $this->lang->stat->dateError;
            $this->display();
            exit;
        }

        $this->view->pieCharts  = $this->stat->getPieByType($type, $begin, $end);

        $this->view->lineLabels = $this->stat->getDayLabels($begin, $end);
        if(empty($this->view->lineLabels)) 
        {
            $this->view->error = $this->lang->stat->dateError;
            $this->display();
            exit;
        }

        $this->view->lineCharts = $this->stat->getItemLine($type, 'day', $this->view->lineLabels);

        $this->view->title = $this->lang->stat->{$type}; 
        $this->view->mode  = $mode; 
        $this->view->type  = $type; 
        $this->display();
    }

    /**
     * keywords 
     * 
     * @param  string $orderBy 
     * @param  int    $recTotal 
     * @param  int    $recPerPage 
     * @param  int    $pageID 
     * @access public
     * @return void
     */
    public function keywords($mode = 'today', $begin = '', $end = '', $orderBy = 'pv_desc',  $recTotal = 0, $recPerPage = 10, $pageID = 1)
    {   
        
        $this->app->loadClass('pager', $static = true);
        $pager = new pager($recTotal, $recPerPage, $pageID);

        if($mode == 'today')
        {
            $begin = $end = date("Ymd");
        }
        elseif($mode == 'yestoday')
        {
            $begin = $end = date("Ymd", strtotime("-1 day"));
        }
        elseif($mode == 'weekly')
        {
            $begin =  date("Ymd", strtotime("-7 day"));
            $end   = date('Ymd');
        }
        elseif($mode == 'monthly')
        {
            $begin =  date("Ymd", strtotime("-30 day"));
            $end   = date('Ymd');
        }
        else
        {
            $begin = date('Ymd', strtotime($begin));
            $end   = date('Ymd', strtotime($end));
        }

        $this->view->totalInfo   = $this->stat->getSearchTraffic($begin, $end);
        $this->view->keywordList = $this->stat->getKeywordsList($begin, $end, $orderBy, $pager);
        $this->view->title       = $this->lang->stat->keywords;
        $this->view->mode        = $mode;
        $this->view->begin       = $begin;
        $this->view->end         = $end;
        $this->view->orderBy     = $orderBy;
        $this->view->pager       = $pager;
        $this->display();
    }

    public function keywordReport($keyword, $mode = 'weekly', $begin = '', $end = '')
    {
        if($mode == 'today')
        {
            $begin = $end = date("Ymd");
        }
        elseif($mode == 'yestoday')
        {
            $begin = $end = date("Ymd", strtotime("-1 day"));
        }
        elseif($mode == 'weekly')
        {
            $begin =  date("Ymd", strtotime("-7 day"));
            $end   = date('Ymd');
        }
        elseif($mode == 'monthly')
        {
            $begin =  date("Ymd", strtotime("-30 day"));
            $end   = date('Ymd');
        }
        else
        {
            $begin = date('Ymd', strtotime($begin));
            $end   = date('Ymd', strtotime($end));
        }

        $this->view->keyword     = $keyword;
        $this->view->labels      = $this->stat->getDayLabels($begin, $end);
        $this->view->totalInfo   = $this->stat->getTrafficByKeyword($keyword, $begin, $end);
        $this->view->keywordLine = $this->stat->getKeywordLine($keyword, $begin, $end);
        $this->view->pieCharts   = $this->stat->getKeywordSearchPie($keyword, $begin, $end);
        $this->display();
    }

    /**
     * Page ranking.
     * 
     * @access public
     * @return void
     */
    public function page()
    {
        $pages = $this->dao->select('*')->from(TABLE_STATREPORT)
            ->where('type')->eq('url')
            ->andWhere('timeType')->eq('year')
            ->orderBy('pv')->limit(100)->fetchAll();

        $this->view->title = $this->lang->stat->page->common;
        $this->view->pages = $pages;
        $this->display();
    }
}
