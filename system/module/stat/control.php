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
     * @param  string $begin 
     * @param  string $end 
     * @access public
     * @return void
     */
    public function traffic($mode = 'today')
    {
        $this->view->todayStat    = $this->dao->select('*')->from(TABLE_STATREPORT)->where('timeType')->eq('day')->andWhere('timeValue')->eq(date('Ymd'))->fetch(); 
        $this->view->yestodayStat = $this->dao->select('*')->from(TABLE_STATREPORT)->where('timeType')->eq('day')->andWhere('timeValue')->eq(date('Ymd', strtotime("-1 day")))->fetch();
        $this->view->labels       = $this->config->stat->hourLabels;   
        $this->view->title        = $this->lang->stat->traffic;
        $this->view->mode         = $mode;

        if($mode == 'today') $this->view->chart = $this->stat->getTrafficPerHour(date('Ymd'));

        if($mode == 'yestoday') $this->view->chart = $this->stat->getTrafficPerHour(date('Ymd', strtotime("-1 day")));

        if($mode == 'weekly' or $mode == 'monthly') 
        {
            $result = $this->stat->getTrafficPerDay($mode);
            $this->view->labels = $result['labels'];
            $this->view->chart  = $result['chartData'];
        }

        $this->display();
    }
}
