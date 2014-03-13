<?php
/**
 * The control file of weichat module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     LGPL
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     index
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class weichat extends control
{
    /**
     * The public account.
     * 
     * @var object   
     * @access public
     */
    public $public;

    /**
     * The weichat api object.
     * 
     * @var object   
     * @access public
     */
    public $api;

    /**
     * Set the weichat api.
     * 
     * @param  int    $public 
     * @access public
     * @return void
     */
    public function setAPI($public)
    {
        $this->public = $this->weichat->getByID($public);
        $this->app->loadClass('weichatapi', true);
        $this->api = new weichatapi($this->public->token, $this->public->appID, $this->public->appSecret, $this->config->debug);
    }

    /**
     * The weichat auto response api.
     * 
     * @param  int    $public 
     * @access public
     * @return void
     */
    public function response($public)
    {
        $this->setAPI($public);
        $message  = $this->api->getMessage();
        $response = $this->weichat->getResponse($message);

        if(isset($message->eventKey) and $message->eventKey == 'menu_image')
        {
            $response = new stdclass();
            $response->msgType = 'image';
            $response->mediaId = $this->api->uploadMedia('image', '/home/wwccss/chanzhi/www/data/test.jpg');
        }

        if(isset($message->eventKey) and $message->eventKey == 'menu_news')
        {
            $response = new stdclass();
            $response->msgType = 'news';
            $article = new stdclass();
            $article->title = '禅道';
            $article->description = '禅道项目管理软件';
            $article->picUrl = 'http://www.zentao.net/data/site/18/Logo.png';
            $article->url    = 'http://www.zentao.net';
            $response->articles[] = $article;

            $article = new stdclass();
            $article->title = '蝉知';
            $article->description = '蝉知企业门户';
            $article->picUrl = 'http://www.chanzhi.org/data/upload/201309/fdfb6e9cb6103298f5497760962ebbf7.png';
            $article->url    = 'http://www.chanzhi.org';
            $response->articles[] = $article;
        }

        $this->api->response($response);
    }

    /**
     * Reply a message.
     * 
     * @param  int    $public 
     * @param  int    $to 
     * @access public
     * @return void
     */
    public function reply($public, $to)
    {
        $this->setAPI($public);
        $message = new stdclass();
        $message->content = '你好';
        $this->api->reply('o-nXYt1LrugCK0oqZcrxyMidiJSg', 'text', $message);
    }

    /**
     * Add menu.
     * 
     * @param  int    $public 
     * @access public
     * @return void
     */
    public function addMenu($public)
    {
        $this->setAPI($public);

        $button = new stdclass();
        $button->type = 'click';
        $button->name = '图片';
        $button->key  = 'menu_image';
        $menu['button'][] = $button;

        $button = new stdclass();
        $button->type = 'click';
        $button->name = '图文';
        $button->key  = 'menu_news';
        $menu['button'][] = $button;

        $button = new stdclass();
        $button->name = '功能介绍';

        $subButton = new stdclass();
        $subButton->type = 'view';
        $subButton->name = '论坛';
        $subButton->url  = 'http://www.chanzhi.org/forum/';
        $button->sub_button[] = $subButton;
        $subButton = new stdclass();
        $subButton->type = 'view';
        $subButton->name = '博客';
        $subButton->url  = 'http://www.chanzhi.org/blog/';

        $button->sub_button[] = $subButton;
        $menu['button'][] = $button;
        $this->api->addMenu($menu);
    }

    /**
     * Delete menu of a public.
     * 
     * @param  int    $public 
     * @access public
     * @return void
     */
    public function deleteMenu($public)
    {
        $this->setAPI($public);
        $this->api->deleteMenu();
    }

    /**
     * Upload a media file.
     * 
     * @param  int    $public 
     * @access public
     * @return void
     */
    public function uploadMedia($public)
    {
        $this->setAPI($public);
        $media = $this->api->uploadMedia('image', '/home/wwccss/chanzhi/www/data/test.jpg');
        echo $this->api->getMedia($media);
    }

    /**
     * Get the qrcode from weixin server.
     * 
     * @param  int    $public 
     * @access public
     * @return void
     */
    public function qrcode($public)
    {
        $this->setAPI($public);
        $qrcodeFile = $this->app->getDataRoot() . 'weichat' . DS . $public->appID . '.jpg';
        if(!is_dir(dirname($qrcodeFile))) @mkdir(dirname($qrcodeFile));
        $data = $this->api->getQRCode($qrcodeFile); 
    }

    /**
     * Browse public in admin.
     * 
     * @access public
     * @return void
     */
    public function admin()
    {
        $publics = $this->weichat->getList();
        if(empty($publics)) $this->locate(inlink('create'));

        $this->view->title   = $this->lang->weichat->admin;
        $this->view->publics = $publics;
        $this->display();
    }

    /**
     * Create a public.
     * 
     * @access public
     * @return void
     */
    public function create()
    {
        if($_POST) 
        {
            $this->weichat->create();       
            if(dao::isError())  $this->send(array('result' => 'fail', 'message' => dao::getError()));
            $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate'=>inlink('admin')));
        }

        $this->view->title = $this->lang->weichat->create;
        $this->display();
    }

    /**
     * Set response for a public.
     * 
     * @param  int     $publicID 
     * @param  string  $type 
     * @access public
     * @return void
     */
    public function setResponse($publicID, $type)
    {
        if($_POST) 
        {
            $this->weichat->setResponse($publicID, $type);
            if(dao::isError())  $this->send(array('result' => 'fail', 'message' => dao::getError()));
            $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate'=>inlink('admin')));
        }

        $this->view->title = $this->lang->weichat->setResponse;
        $this->view->type  = $type;
        $this->display();
    }
}
