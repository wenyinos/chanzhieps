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
     * @access public
     * @return void
     */
    public function api()
    {
        $this->app->loadClass('weichatapi', true);
        $weichat = new weichatapi($this->config->weichat->token, $this->config->weichat->appID, $this->config->weichat->secret );
    }
}
