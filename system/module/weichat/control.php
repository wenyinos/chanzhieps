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
        $weichat = new weichatapi($public->token, $public->appID, $public->appSecret);
    }
}
