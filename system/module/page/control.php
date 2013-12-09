<?php
/**
 * The control file of page category of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     LGPL
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     page
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class page extends control
{
    /**
     * View an page.
     * 
     * @param int $articleID 
     * @access public
     * @return void
     */
    public function view($pageID)
    {
        $page = $this->loadModel('article')->getByID($pageID);

        $title    = $page->title;
        $keywords = $page->keywords . ' ' . $this->config->site->keywords;
        $desc     = $page->summary;
        
        $this->view->title    = $title;
        $this->view->keywords = $keywords;
        $this->view->desc     = $desc;
        $this->view->page     = $page;

        $this->display();
    }
}
