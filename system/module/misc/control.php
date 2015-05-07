<?php
/**
 * The control file of misc of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv11.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     misc
 * @version     $Id$
 * @link        http://www.zentao.net
 */
class misc extends control
{
    public function ping()
    {
        die();
    }

    /** 
     * Create qrcode for mobile visit.
     * 
     * @access public
     * @return void
     */
    public function qrcode()
    {   
        if(!extension_loaded('gd'))
        {   
            $this->view->noGDLib = sprintf($this->lang->misc->noGDLib, $loginAPI);
            $this->display();
        }   

        $this->app->loadClass('qrcode');
        QRcode::png($this->server->http_referer, false, 4, 6); 
    }   

    /**
     * Create a fingerprint.
     * 
     * @param  int    $clientFinger 
     * @access public
     * @return void
     */
    public function ajaxGetFingerprint($clientFinger)
    {
        if($this->session->fingerprint and $this->session->fingerprint['createdTime'] > (time() - 360 ))
        {
            $fingerprint = $this->session->fingerprint;
        }
        else
        {
            $fingerprint = array();
            $fingerprint['fingerprint'] = md5(uniqid($clientFinger . '_'));
            $fingerprint['createdTime'] = time();
            $this->session->set('fingerprint', $fingerprint);
        }
        $this->send(array('result' => 'success', 'fingerprint' => $fingerprint['fingerprint']));
    }
}
