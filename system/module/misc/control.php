<?php
/**
 * The control file of misc of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1 (http://www.chanzhi.org/license/)
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
     * Show about info of zentao.
     *
     * @access public
     * @return void
     */
    public function about()
    {
        $this->view->title = $this->lang->about;
        $this->display();
    }

    /**
     * Express thanks.
     *
     * @access public
     * @return void
     */
    public function thanks()
    {
        $this->view->title      = $this->lang->thanks;
        $this->view->modalWidth = 700;
        $this->display();
    }

}
