<?php
/**
 * The model file of forum category of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     LGPL
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     forum
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class forumModel extends model
{
    /**
     * Get boards.
     * 
     * @access public
     * @return array
     */
    public function getBoards()
    {
        $boards = array();
        $rawBoards = $this->dao->select('*')
            ->from(TABLE_CATEGORY)
            ->where('type')->eq('forum')
            ->orderBy('grade, `order`')
            ->fetchGroup('parent');
        if(!isset($rawBoards[0])) return $boards;

        /* Get lastReplies of all thread, for jump lastReply. */
        $lastReplies = $this->dao->select('thread, COUNT(id) as id')->from(TABLE_REPLY)->fetchPairs('thread');

        foreach($rawBoards[0] as $parentBoard)
        {
            if(isset($rawBoards[$parentBoard->id]))
            {
                $parentBoard->children = $rawBoards[$parentBoard->id];
                foreach($parentBoard->children as $childBoard) 
                {
                    $childBoard->lastPostReplies = isset($replies[$childBoard->postID]) ? $replies[$childBoard->postID] : 0;
                }
                $boards[] = $parentBoard;
            }
        }

        return $boards;
    }

    /**
     * Update status of boards.
     * 
     * @param  int    $boardID 
     * @param  object $post 
     * @access public
     * @return void
     */
    public function updateBoardStats($boardID, $post)
    {
        $board = $this->dao->select('*')->from(TABLE_CATEGORY)->where('id')->eq($boardID)->fetch();
        if($post->replyID)
        {
            $board->replyID = $post->replyID;
        }
        else
        {
            $board->threads ++;
        }

        $this->dao->update(TABLE_CATEGORY)
            ->set('threads = ' . $board->threads)
            ->set('posts = posts + 1')
            ->set('postedBy')->eq($post->author)
            ->set('postedDate')->eq($post->addedDate)
            ->set('postID')->eq($post->threadID)
            ->set('replyID')->eq($board->replyID)
            ->where('id')->eq($boardID)
            ->exec();
    }

    /**
     * Judge a board is new or not.
     * 
     * @param string $board 
     * @access public
     * @return void
     */
    public function isNew($board)
    {
         return (time() - strtotime($board->postedDate)) < 24 * 60 * 60 * $this->config->forum->newDays;
    }

    /**
     * Judge a user can post thread to a board or not.
     * 
     * @param  object    $board 
     * @access public
     * @return void
     */
    public function canPost($board)
    {
        /* If the board is an open one, return true. */
        if($board->readonly == false) return true;

        /* Then check the user is admin or not. */
        if($this->app->user->admin == 'super') return true; 

        /* Then check the user is a moderator or not. */
        $user = ",{$this->app->user->account},";
        $moderators = ',' . str_replace(' ', '', $board->moderators) . ',';
        if(strpos($moderators, $user) !== false) return true;

        return false;
    }
}
