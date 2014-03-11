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
     * The weichat api interface.
     * 
     * @param  int    $id 
     * @access public
     * @return void
     */
    public function api($id)
    {
        $public = $this->weichat->getByID($id);
        $this->app->loadClass('weichatapi', true);
        $api = new weichatapi($public->token, $public->appID, $public->appSecret, $this->config->debug);

        $message  = $api->getMessage();
        $response = $this->weichat->getResponse($message);
        $api->response($response);
    }

    /**
     * Get the qrcode from weixin server.
     * 
     * @param  int    $id 
     * @access public
     * @return void
     */
    public function qrcode($id)
    {
        $public = $this->weichat->getByID($id);
        $this->app->loadClass('weichatapi', true);
        $api = new weichatapi($public->token, $public->appID, $public->appSecret, $this->config->debug);

        $qrcodeFile = $this->app->getDataRoot() . 'weichat' . DS . $public->appID . '.jpg';
        if(!is_dir(dirname($qrcodeFile))) @mkdir(dirname($qrcodeFile));
        $data = $api->getQRCode($qrcodeFile); 
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
            if(dao::isError())  $this->send(array('result' => 'fail', 'message' => dao::geterror()));
            $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate'=>inlink('admin')));
        }

        $this->view->title = $this->lang->weichat->create;
        $this->display();
    }
}
