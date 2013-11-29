<?php
/**
 * The model file of reply module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     LGPL
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     reply
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class replyModel extends model
{
    /**
     * Get a reply by it's id.
     * 
     * @param  int    $replyID 
     * @access public
     * @return object
     */
    public function getByID($replyID)
    {
        $reply = $this->dao->findById($replyID)->from(TABLE_REPLY)->fetch();
        if(!$reply) return false;

        $reply->files = $this->loadModel('file')->getByObject('reply', $replyID);
        return $reply;
    }

    /**
     * Get replies of a thread.
     * 
     * @param  int    $thread 
     * @param  object $pager 
     * @access public
     * @return array
     */
    public function getByThread($thread, $pager = null)
    {
        $replies = $this->dao->select('*')->from(TABLE_REPLY)
            ->where('thread')->eq($thread)
            ->orderBy('id')
            ->page($pager)
            ->fetchAll('id');

        if(!$replies) return array();

        /* Get files for these replies. */
        $files = $this->loadModel('file')->getByObject('reply', array_keys($replies));
        
        foreach($files as $replyID => $file) $replies[$replyID]->files = $file;

        return $replies;
    }

    /**
     * Get replies of a user.
     * 
     * @param string $account       the account
     * @param string $pager         the pager object
     * @access public
     * @return array
     */
    public function getByUser($account, $pager)
    {
        $replies = $this->dao->select('t1.*, t2.title')->from(TABLE_REPLY)->alias('t1')
            ->leftJoin(TABLE_THREAD)->alias('t2')->on('t1.thread = t2.id')
            ->where('t1.author')->eq($account)
            ->orderBy('t1.id desc')
            ->page($pager)
            ->fetchAll('id');
        return $replies;
    }

    /**
     * Reply a thread.
     * 
     * @param  int      $threadID 
     * @access public
     * @return void
     */
    public function post($threadID)
    {
        $this->app->loadConfig('thread');
        $reply = fixer::input('post')
            ->setForce('author', $this->app->user->account)
            ->setForce('addedDate', helper::now())
            ->setForce('thread', $threadID)
            ->stripTags('content', $this->config->thread->editor->allowTags)
            ->remove('recTotal, recPerPage, pageID, files, labels, hidden')
            ->get();

        $this->dao->insert(TABLE_REPLY)
            ->data($reply, $skip = 'captcha, uid')
            ->autoCheck()
            ->batchCheck('content', 'notempty')
            ->check('captcha', 'captcha')
            ->exec();

        $replyID = $this->dao->lastInsertID();                     // Get reply id.

        if($_SESSION['album'][$this->post->uid])
        {
            $this->loadModel('file')->updateObjectID($this->post->uid, $replyID, 'reply');
        }

        if(!dao::isError())
        {
            $this->saveCookie($replyID);                               // Save reply id to cookie.
            $this->loadModel('file')->saveUpload('reply', $replyID);   // Save file.

            /* Update thread stats. */
            $this->loadModel('thread')->updateStats($threadID);

            /* Update board stats. */
            $this->loadModel('forum')->updateBoardStats($thread->board);

            return $replyID;
        }
        return false;
    }

    /**
     * Update a reply.
     * 
     * @param  int      $replyID 
     * @access public
     * @return void
     */
    public function update($replyID)
    {
        $reply = fixer::input('post')
            ->setForce('editor', $this->session->user->account)
            ->setForce('editedDate', helper::now())
            ->stripTags('content', $this->config->thread->editor->allowTags)
            ->remove('files,labels,hidden')
            ->get();

        $this->dao->update(TABLE_REPLY)
            ->data($reply, $skip = 'captcha, uid')
            ->autoCheck()
            ->check('content', 'notempty')
            ->check('captcha', 'captcha')
            ->where('id')->eq($replyID)
            ->exec();

        if($_SESSION['album'][$this->post->uid])
        {
            $this->loadModel('file')->updateObjectID($this->post->uid, $replyID, 'reply');
        }

        if(!dao::isError())
        {
            $this->loadModel('file')->saveUpload('reply', $replyID);
            return true;
        }

        return false;
    }

    /**
     * Hide a reply. 
     * 
     * @param  int      $replyID 
     * @access public
     * @return void
     */
    public function hide($replyID)
    {
        $this->dao->update(TABLE_REPLY)->set('hidden')->eq(1)->where('id')->eq($replyID)->exec();
    }

    /**
     * Delete a reply.
     * 
     * @param string $replyID 
     * @access public
     * @return void
     */
    public function delete($replyID, $null = null)
    {
        $this->dao->delete()->from(TABLE_REPLY)->where('id')->eq($replyID)->exec(false);
        return !dao::isError();
    }

    /**
     * Print files of for a reply.
     * 
     * @param  object $thread 
     * @param  bool   $canManage 
     * @access public
     * @return void
     */
    public function printFiles($reply, $canManage)
    {
        if(empty($reply->files)) return false;

        echo $this->lang->reply->files; 
        foreach($reply->files as $file)
        {
            $file->title = $file->title . ".$file->extension";
            echo html::a(helper::createLink('file', 'download', "fileID=$file->id&mouse=left"), $file->title, "target='_blank'"); 
            if($canManage) echo '<sub>' . html::a(helper::createLink('thread', 'deleteFile', "threadID=$reply->thread&fileID=$file->id"), '[x]', "class='deleter'") . '</sub>';
            echo ' ';
        }
    }

    /**
     * Save the reply id to cookie.
     * 
     * @param  int     $replyID 
     * @access public
     * @return void
     */
    public function saveCookie($reply)
    {
        $reply = "$reply,";
        $cookie = $this->cookie->r != false ? $this->cookie->r : ',';
        if(strpos($cookie, $reply) === false) $cookie .= $reply;
        setcookie('r', $cookie , time() + 60 * 60 * 24 * 30);
    }
}
