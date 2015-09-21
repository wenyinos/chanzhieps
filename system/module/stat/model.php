<?php
/**
 * The model file of stat module of ChanzhiEPS.
 *
 * @copyright   Copyright 2009-2010 QingDao Nature Easy Soft Network Technology Co,LTD (www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv11.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     stat
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class statModel extends model
{
    /**
     * Get basic line.
     * 
     * @param  string    $type 
     * @param  string    $timeType 
     * @param  array    $labels 
     * @access public
     * @return array
     */
    public function getBasicLine($type, $timeType, $labels)
    {
        $traffic = $this->dao->select('*')->from(TABLE_STATREPORT)
            ->where('type')->eq('basic')->andWhere('item')->eq($type)
            ->andWhere('timeValue')->in($labels)
            ->andWhere('timeType')->eq($timeType)
            ->fetchAll('timeValue');

        foreach($labels as $time)
        {
            $pv[] = isset($traffic[$time]) ? $traffic[$time]->pv : 0;
            $uv[] = isset($traffic[$time]) ? $traffic[$time]->uv : 0;
            $ip[] = isset($traffic[$time]) ? $traffic[$time]->ip : 0;
        }

        $chartData = array();

        $pvChart = new stdclass(); 
        $pvChart->label = $this->lang->stat->pv;
        $pvChart->color = 'green';
        $pvChart->data  = $pv;

        $uvChart = new stdclass(); 
        $uvChart->label = $this->lang->stat->uv;
        $uvChart->color = 'blue';
        $uvChart->data  = $uv;

        $ipChart = new stdclass(); 
        $ipChart->label = $this->lang->stat->ipCount;
        $ipChart->color = 'red';
        $ipChart->data  = $ip;

        $chartData[] = $pvChart;
        $chartData[] = $uvChart;
        $chartData[] = $ipChart;
        return $chartData;
    }

    /**
     * Get item lines of a type.
     * 
     * @param  string    $type 
     * @param  string    $timeType 
     * @param  array     $labels 
     * @access public
     * @return array
     */
    public function getItemLine($type = '', $timeType, $labels)
    {
        $traffic = $this->dao->select('*')->from(TABLE_STATREPORT)
            ->where('type')->eq($type)
            ->andWhere('timeType')->eq('day')
            ->andWhere('timeValue')->in($labels)
            ->fetchGroup('item', 'timeValue');

        if(empty($traffic)) return array();

        $colors = $this->config->stat->chartColors;

        $i = 0;
        foreach($traffic as $item => $reports)
        {
            $i ++;
            $colors[$item] = isset($colors[$item]) ? $colors[$item] : $colors[$i];

            $pvChart = new stdclass;
            $pvChart->data  = array();
            $pvChart->label = zget($this->lang->stat->itemList, $item);
            $pvChart->color = $colors[$item];

            $uvChart = new stdclass;
            $uvChart->data  = array();
            $uvChart->label = zget($this->lang->stat->itemList, $item);
            $uvChart->color = $colors[$item];

            $ipChart = new stdclass;
            $ipChart->data  = array();
            $ipChart->label = zget($this->lang->stat->itemList, $item);
            $ipChart->color = $colors[$item];

            foreach($labels as $day)
            {
                $pvChart->data[] = isset($reports[$day]) ? $reports[$day]->pv : 0;
                $uvChart->data[] = isset($reports[$day]) ? $reports[$day]->uv : 0;
                $ipChart->data[] = isset($reports[$day]) ? $reports[$day]->ip : 0;
            }

            $pvCharts[] = $pvChart;
            $uvCharts[] = $uvChart;
            $ipCharts[] = $ipChart;
        }
        return array('pvChart' => $pvCharts, 'uvChart' => $uvCharts, 'ipChart' => $ipCharts);
    }

    /**
     * Get pie chart data of one type.
     * 
     * @param  string  $type
     * @param  int     $begin 
     * @param  int     $end 
     * @access public
     * @return array
     */
    public function getPieByType($type, $begin, $end)
    {
        $charts    = array();
        $reports = $this->dao->select('*, sum(ip) as ip, sum(pv) as pv, sum(uv) as uv')->from(TABLE_STATREPORT)
            ->where('type')->eq($type)
            ->andWhere('timeType')->eq('day')
            ->beginIf($begin != '')->andWhere('timeValue')->ge($begin)->fi()
            ->beginIf($end != '')->andWhere('timeValue')->le($end)->fi()
            ->groupBy('item')
            ->fetchAll('item');

        $colors = $this->config->stat->chartColors;
        $this->loadModel('log');
        
        $i = 0;       
        foreach($reports as $item => $report)
        {
            $color[$item] = isset($color[$item]) ? $color[$item] : $colors[$i];
            $i ++;
            
            $pv = new stdclass();
            $pv->value = $report->pv;
            $pv->color = $color[$item];
            $pv->label = zget($this->lang->stat->itemList, $item);

            $uv = new stdclass();
            $uv->value = $report->uv;
            $uv->color = $color[$item];
            $uv->label = zget($this->lang->stat->itemList, $item);

            $ip = new stdclass();
            $ip->value = $report->ip;
            $ip->color = $color[$item];
            $ip->label = zget($this->lang->stat->itemList, $item);

            $charts['pv'][] = $pv;
            $charts['uv'][] = $uv;
            $charts['ip'][] = $ip;
        }

        return $charts;
    }

    /**
     * Get searchengine pie chart data.
     * 
     * @param  int    $begin 
     * @param  int    $end 
     * @access public
     * @return void
     */
    public function getsearchPie($begin, $end)
    {
        $charts    = array();
        $reports = $this->dao->select('*, sum(ip) as ip, sum(pv) as pv, sum(uv) as uv')->from(TABLE_STATREPORT)
            ->where('type')->eq('search')
            ->andWhere('timeType')->eq('day')
            ->beginIf($begin != '')->andWhere('timeValue')->ge($begin)->fi()
            ->beginIf($end != '')->andWhere('timeValue')->le($end)->fi()
            ->groupBy('item')
            ->fetchAll('item');

        $colors = $this->config->stat->chartColors;
        $this->loadModel('log');
        
        $i = 0;       
        foreach($reports as $searchEngine => $report)
        {
            $color[$searchEngine] = isset($color[$searchEngine]) ? $color[$searchEngine] : $colors[$i];
            $i ++;

            if(!isset($this->config->searchEngine->params[$searchEngine])) continue;

            $pv = new stdclass();
            $pv->value = $report->pv;
            $pv->color = $color[$searchEngine];
            $pv->label = $report->item;

            $uv = new stdclass();
            $uv->value = $report->uv;
            $uv->color = $color[$searchEngine];
            $uv->label = $report->item;

            $ip = new stdclass();
            $ip->value = $report->ip;
            $ip->color = $color[$searchEngine];
            $ip->label = $report->item;

            $charts['pv'][] = $pv;
            $charts['uv'][] = $uv;
            $charts['ip'][] = $ip;
        }

        return $charts;
    }

    /**
     * Get day labels between begin and end date.
     * 
     * @param  int    $begin 
     * @param  int    $end 
     * @access public
     * @return void
     */
    public function getDayLabels($begin, $end)
    {
        $days = (strtotime($end) - strtotime($begin)) / (24 * 60 * 60);
        for($i = $days; $i >= 0;  $i--) $dayLabels[] = date('Ymd', strtotime("-{$i} day", strtotime($end)));
        return $dayLabels;
    }

    /**
     * Get hour labels of one date.
     * 
     * @param  int    $day 
     * @access public
     * @return void
     */
    public function getHourLabels($day)
    {
        foreach($this->config->stat->hourLabels as $hour) $labels[] = $day . $hour;
        return $labels;
    }
    
    public function getKeywordsList($orderBy, $pager)
    {
        return $this->dao->select('*, sum(pv) as pv, sum(uv) as uv, sum(ip) as ip')->from(TABLE_STATREPORT)
            ->where('type')->eq('keywords')
            ->andWhere('timeType')->eq('day')
            ->groupBy('item')
            ->orderBy($orderBy)
            ->page($pager)
            ->fetchAll('item');
    }
}
