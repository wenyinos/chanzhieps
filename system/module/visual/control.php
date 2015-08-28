<?php
/**
 * The control file of visual module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1 (http://www.chanzhi.org/license/)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     visual
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class visual extends control
{
    /**
     * Eidt logo
     *
     * @access public
     * @return void
     */
    public function logo()
    {
        if(!empty($_POST))
        {
            $return = $this->loadModel('ui')->setOptionWithFile($section = 'logo', $htmlTagName = 'logo');
            if($return['result']) $this->send(array('result' => 'success', 'message' => $this->lang->setSuccess));
            if(!$return['result']) $this->send(array('result' => 'fail', 'message' => $return['message']));
        }
        $this->app->loadLang('ui');
        $template = $this->config->template->{$this->device}->name;
        $theme    = $this->config->template->{$this->device}->theme;
        $logoSetting = isset($this->config->site->logo) ? json_decode($this->config->site->logo) : new stdclass();;

        $logo = isset($logoSetting->$template->themes->$theme) ? $logoSetting->$template->themes->$theme : (isset($logoSetting->$template->themes->all) ? $logoSetting->$template->themes->all : false);

        $this->view->title = $this->lang->ui->setLogo;
        $this->view->logo  = $logo;

        $this->view->title = $this->lang->edit . ' ' . $this->lang->visual->code->logo;
        $this->display();
    }
}
