<?php
/**
 * The control file of admin module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     admin
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class admin extends control
{
    /**
     * The index page of admin panel, print the sites.
     * 
     * @access public
     * @return void
     */
    public function index()
    {
        $summary = new stdclass();
        if(commonModel::isAvailable('message'))
        {
           $summary->comments = $this->loadModel('message')->getMessages('comment');
           $summary->messages = $this->loadModel('message')->getMessages('message');
           $summary->replies  = $this->loadModel('message')->getMessages('reply');
        }
        if(commonModel::isAvailable('forum'))
        {
            $summary->newthreads = $this->loadModel('thread')->getNewThreads();
            $summary->newReplies = $this->loadModel('reply')->getNewReplies();
        }
        if(commonModel::isAvailable('order')) $summary->newOrders = $this->loadModel('order')->getNewOrders();
        if(commonModel::isAvailable('contribution')) $summary->contribution = $this->loadModel('article')->getContribution();

        $this->view->ignoreUpgrade = isset($this->config->global->ignoreUpgrade) and $this->config->global->ignoreUpgrade;
        $this->view->checkLocation = $this->loadModel('user')->checkLocation();
        $this->view->summary       = $summary;
        $this->display();
    }

    /**
     * Ignore the upgrade notice.
     *
     * @access public
     * return void
     **/
    public function ignoreUpgrade()
    {
        $result = $this->loadModel('setting')->setItems('system.common.global', array('ignoreUpgrade' => true), 'all');
        if($result) $this->send(array('result' => 'success', 'locate' => inlink('index')));
        $this->send(array('result' => 'fail', 'message' => $this->lang->fail));
    }

    /**
     * Ignore the admin entry warning.
     *
     * @access public
     * return void
     **/
    public function ignore()
    {
        $result = $this->loadModel('setting')->setItems('system.common.global', array('ignoreAdminEntry' => true));
        if($result) $this->send(array('result' => 'success', 'locate' => inlink('index')));
        $this->send(array('result' => 'fail', 'message' => $this->lang->fail));
    }
}
