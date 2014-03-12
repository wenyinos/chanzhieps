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
        $api->reply('o-nXYt1LrugCK0oqZcrxyMidiJSg', 'text', $message);
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
}
