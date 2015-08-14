<?php
/**
 * The control file of nav module of XiRangEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1 (http://www.chanzhi.org/license/)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     nav
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class nav extends control
{
    /**
     * Nav admin function
     *
     * @param string   $top
     * @access public
     * @return void
     */
    public function admin($type = 'top')
    {   
        $navs = $this->nav->getNavs($type);

        foreach($this->lang->nav->system as $module => $name)
        {
            if(!commonModel::isAvailable($module)) unset($this->lang->nav->system->$module);
        }

        if($_POST)
        {
            $navList = $_POST['nav'];
            foreach($navList as $key => $nav)
            {
                $navList[$key] = $this->nav->organizeNav($nav);
            }

            if(isset($navList[2]))
            {
                $navList[2] = $this->nav->group($navList[2]);
                if(isset($navList[3])) $navList[3] = $this->nav->group($navList[3]);

                foreach($navList[2] as &$navList)
                {
                    foreach($navList as &$nav)
                    $nav['children'] = isset($navList[3][$nav['key']]) ?  $navList[3][$nav['key']] : array();
                }
            }

            foreach($navList[1] as &$nav)
            {
                $nav['children'] = isset($navList[2][$nav['key']]) ?  $navList[2][$nav['key']] : array();
            }

            $settings = array();
            $settings[$this->device] = $navList[1];
            foreach($navs as $device => $list)
            {
                if($device != $this->device) $settings[$device] = $list;
            }

            $settings   =  array($type => helper::jsonEncode($settings));
            $clientLang = $this->app->getClientLang();
            $result     = $this->loadModel('setting')->setItems('system.common.nav', $settings, $clientLang);
            if($result) $this->send(array('result' => 'success', 'message' => $this->lang->setSuccess));
            $this->send(array('result' => 'fail', 'message' => $this->lang->failed));
        }
        $this->view->title        = $this->lang->nav->setNav;
        $this->view->navs         = $navs->{$this->device};
        $this->view->types        = $this->lang->nav->types; 
        $this->view->articleTree  = $this->loadModel('tree')->getOptionMenu('article');

        $this->display();
    }
}
