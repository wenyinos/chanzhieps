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
        $this->app->loadConfig('product');
        $messages = new stdclass();
        if(commonModel::isAvailable('forum'))
        {
            $this->view->threads      = $this->loadModel('thread')->getThreads();
            $this->view->threadReply  = $this->loadModel('reply')->getReplies();
        }
        if(commonModel::isAvailable('message'))
        {
            $messages->comment = $this->loadModel('message')->getMessages('comment');
            $messages->message = $this->loadModel('message')->getMessages('message');
            $messages->reply   = $this->loadModel('message')->getMessages('reply');
        }
        if(commonModel::isAvailable('order')) $this->view->orders = $this->loadModel('order')->getOrders();
        if(commonModel::isAvailable('contribution')) $this->view->contributions = $this->loadModel('article')->getContributions();
        $this->view->articleCategories = $this->loadModel('tree')->getOptionMenu('article', 0, $removeRoot = true);
        $this->view->todayReport       = $this->loadModel('stat')->getTodayReport();
        $this->view->yestodayReport    = $this->loadModel('stat')->getYestodayReport();
        $this->view->ignoreUpgrade     = isset($this->config->global->ignoreUpgrade) and $this->config->global->ignoreUpgrade;
        $this->view->checkLocation     = $this->loadModel('user')->checkAllowedLocation();
        $this->view->currencySymbol    = $this->config->product->currencySymbol;
        $this->view->messages          = $messages;
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
