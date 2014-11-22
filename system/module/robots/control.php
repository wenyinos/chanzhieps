<?php
/**
 * The control file of robots module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     http://api.chanzhi.org/goto.php?item=license
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     robots
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class robots extends control
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Robots page.
     * 
     * @access public
     * @return void
     */
    public function index()
    {
        echo $this->config->site->robots;
        exit;
    }
}
