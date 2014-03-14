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
        foreach($publics as $public) $public->url = getWebRoot(true) . commonModel::createFrontLink('wechat', 'response', "id=$public->id");
        return $publics;
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
     * Get response for a message.
     * 
     * @param  object    $message 
     * @access public
     * @return void
     */
    public function getResponse($message)
    {
        $response = new stdclass();
        $response->msgType = 'text';
        $response->content = '你好' . $message->event . $message->eventKey;
        return $response;
    }

    /**
     * Create response for a public.
     * 
     * @param  int     $publicID
     * @access public
     * @return void
     */
    public function createResponse($publicID)
    {
        $response = fixer::input('post')->add('public', $publicID)->get();

        if($response->type == 'link')
        { 
            $response->source = $response->linkModule == 'manual' ? 'manual' : 'system';
            if($response->linkModule != 'manual') $response->content = $response->linkModule;
        }

        if($response->type == 'text')
        { 
            $response->source = $response->textBlock == 'manual' ? 'manual' : 'system';
            if($response->textBlock != 'manual') $response->content = $response->textBlock;
        }

        if($response->type == 'news')
        { 
            $response->source = 'system';
            $content = array();
            $content['block']    = $response->newsBlock;
            $content['category'] = $response->category;
            if(isset($response->limit)) $content['limit'] = $response->limit;
            $response->content = json_encode($content);
        }

        $this->dao->insert(TABLE_WX_RESPONSE)
            ->data($response, $skip = 'linkModule, textBlock, newsBlock, category, limit')
            ->autoCheck()
            ->check('unique', '`key`, `group`')
            ->exec();

        return !dao::isError();
    }
}
