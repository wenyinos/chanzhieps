<?php
/**
 * The control file of message module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     LGPL
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     message
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class message extends control
{
    /**
     * Show the comment of one object, and print the comment form.
     * 
     * @param string $objectType 
     * @param string $objectID 
     * @access public
     * @return void
     */
    public function comment($objectType, $objectID, $recTotal = 0, $recPerPage = 10, $pageID = 1)
    {
        $this->app->loadClass('pager', $static = true);
        $pager = new pager($recTotal, $recPerPage, $pageID);

        $this->view->objectType = $objectType;
        $this->view->objectID   = $objectID;
        $this->view->comments   = $this->message->getByObject($type = 'comment', $objectType, $objectID, $pager);
        $this->view->pager      = $pager;
        $this->display();
    }

    /**
     * Post a message.
     * 
     * @param  string  $type
     * @access public
     * @return void
     */
    public function post($type)
    {
        if($_POST)
        {
            /* If no captcha but is garbage, return the error info. */
            if($this->post->captcha == false and $this->loadModel('captcha')->isEvil($_POST['content']))
            {
                $this->send(array('result' => 'fail', 'reason' => 'needChecking', 'captcha' => $this->captcha->create4Comment()));
            }

            /* Try to save to database. */
            $messageID = $this->message->post($type);

            /* If save fail, return the error info. */
            if(!$messageID)
            {
                $this->send(array('result' => 'fail', 'reason' => 'error', 'message' => dao::getError()));
            }

            /* If save successfully, save the cookie and send success info. */
            $this->message->setCookie($messageID);
            $this->send(array('result' => 'success', 'message' => $this->lang->message->thanks->$type));
        }
    }

    /**
     * Get the latest approvaled messages.
     * 
     * @param int    $status 
     * @param int    $recTotal 
     * @param int    $recPerPage 
     * @param int    $pageID 
     * @access public
     * @return void
     */
    public function admin($type = 'message', $status = '0', $recTotal = 0, $recPerPage = 5, $pageID = 1)
    {
        $this->app->loadClass('pager', $static = true);
        $pager = new pager($recTotal, $recPerPage, $pageID);

        $this->view->title       = $this->lang->message->common;
        $this->view->messages    = $this->message->getList($type, $status, $pager);
        $this->view->pager       = $pager;
        $this->view->type        = $type;
        $this->view->status      = $status;
        $this->view->currentMenu = $status == 0 ? 0 : 1;
        $this->display();
    }

    /** 
     * Delete messages.
     *
     * @param int    $messageID 
     * @param string $type          single|pre
     * @access public
     * @return void
     */
    public function delete($messageID, $type, $status = 0)
    {
        $this->message->delete($messageID, $type);
        if(!dao::isError()) $this->send(array('result' => 'success'));
        $this->send(array('result' => 'fail', 'message' => dao::getError()));
    }

    /**
     * Pass messages.
     * 
     * @param  int    $messageID 
     * @param  string $type 
     * @access public
     * @return void
     */
    public function pass($messageID, $type)
    {
        $this->message->pass($messageID, $type);
        if(!dao::isError()) $this->send(array('result' => 'success'));
        $this->send(array('result' => 'fail', 'message' => dao::getError()));
    }
}
