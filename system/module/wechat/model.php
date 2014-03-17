<?php
/**
 * The model file of wechat module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     LGPL
 * @author      Tingting Dai <daitingting@cxirangit.com>
 * @package     wechat
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class wechatModel extends model
{
    /**
     * Get a public account by id.
     * 
     * @param  int    $id 
     * @access public
     * @return object
     */
    public function getByID($id)
    {
        return $this->dao->findByID($id)->from(TABLE_WX_PUBLIC)->fetch();
    }

    /** 
     * Get public list.
     * 
     * @access public
     * @return array
     */
    public function getList()
    {
        $publics = $this->dao->select('*')->from(TABLE_WX_PUBLIC)->orderBy('addedDate_desc')->fetchAll('id');
        if(!$publics) return array();
        foreach($publics as $public) $public->url = rtrim(getWebRoot(true), '/') . commonModel::createFrontLink('wechat', 'response', "id=$public->id");
        return $publics;
    }

    /** 
     * Get response list.
     * 
     * @param  int    $publicID 
     * @access public
     * @return array
     */
    public function getResponseList($publicID)
    {
        $responses = $this->dao->select('*')->from(TABLE_WX_RESPONSE)->where('public')->eq($publicID)->fetchAll('id');

        foreach($responses as $response) $this->processResponse($response);

        return $responses;
    }

    /**
     * Create a public.
     * 
     * @access public
     * @return int|bool
     */
    public function create()
    {
        $public = fixer::input('post')->add('addedDate', helper::now())->get();
        $this->dao->insert(TABLE_WX_PUBLIC)->data($public)->autoCheck()->exec();
        return !dao::isError();
    }

    /**
     * Update a public.
     * 
     * @param  int $publicID 
     * @access public
     * @return void
     */
    public function update($publicID)
    {
        $public = fixer::input('post')->get();
        $this->dao->update(TABLE_WX_PUBLIC)->data($public)->autoCheck()->exec();
        return !dao::isError();
    }

    /**
     * Delete a public.
     * 
     * @param  int      $publicID 
     * @access public
     * @return void
     */
    public function delete($publicID, $null = null)
    {
        $this->dao->delete()->from(TABLE_WX_PUBLIC)->where('id')->eq($publicID)->exec();
        return !dao::isError();
    }

        
    /**
     * Compute response for a message.
     * 
     * @param  object    $message 
     * @access public
     * @return void
     */
    public function computeResponse($message)
    {
        $response = new stdclass();
        $response->msgType = 'text';
        $response->content = '你好' . $message->event . $message->eventKey;
        return $response;
    }

    /**
     * Get response by key.
     * 
     * @param  int    $public 
     * @param  int    $key 
     * @access public
     * @return void
     */
    public function getResponseByKey($public, $key)
    {
        $response =  $this->dao->select('*')->from(TABLE_WX_RESPONSE)
            ->where('public')->eq($public)
            ->andWhere('`key`')->eq($key)
            ->fetch();
        return $this->processResponse($response);
    }

    /**
     * Process a response. 
     * 
     * @param  object    $response 
     * @access public
     * @return void
     */
    public function processResponse($response)
    {
        if(empty($response)) return $response;
        if($response->type == 'news')
        {
            $response->content = json_decode($response->content);
        }
        return $response;
    }

    /**
     * Create response for a public.
     * 
     * @param  int     $publicID
     * @access public
     * @return void
     */
    public function setResponse($publicID)
    {
        $response = fixer::input('post')->add('public', $publicID)->get();
        if($response->type == 'news') $response->source = 'system';
        $response->source = $response->source == 'manual' ? 'manual' : 'system';

        if($response->type == 'link' or $response->type == 'text')
        { 
            if($response->source == 'system') $response->content = $response->source;
        }

        if($response->type == 'news')
        { 
            $response->source = 'system';
            $content = array();
            $content['block']    = $response->block;
            $content['category'] = $response->category;
            if(isset($response->limit)) $content['limit'] = $response->limit;
            $response->content = json_encode($content);
        }

        $this->dao->replace(TABLE_WX_RESPONSE)
            ->data($response, $skip = 'linkModule, textBlock, block, category, limit')
            ->autoCheck()
            ->exec();

        return !dao::isError();
    }
}
