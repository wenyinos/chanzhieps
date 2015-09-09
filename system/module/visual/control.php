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
     * Visual index
     *
     * @access public
     * @return void
     */
    public function index($referer = '/')
    {
        $this->view->referer = $referer;
        $this->view->title = $this->lang->visual->common;
        $this->display();
    }

    /**
     * Eidt logo
     *
     * @access public
     * @return void
     */
    public function editlogo()
    {
        $this->app->loadLang('ui');
        $template = $this->config->template->{$this->device}->name;
        $theme    = $this->config->template->{$this->device}->theme;
        $logoSetting = isset($this->config->site->logo) ? json_decode($this->config->site->logo) : new stdclass();;

        $logo = isset($logoSetting->$template->themes->$theme) ? $logoSetting->$template->themes->$theme : (isset($logoSetting->$template->themes->all) ? $logoSetting->$template->themes->all : false);

        $this->view->title = $this->lang->ui->setLogo;
        $this->view->logo  = $logo;
        $this->display();
    }

    /**
     * Eidt slogan
     *
     * @access public
     * @return void
     */
    public function editslogan()
    {
        $this->display();
    }

    /**
     * Eidt powerby
     *
     * @access public
     * @return void
     */
    public function editpowerby()
    {
        $this->display();
    }

    /**
     * Eidt navbar
     *
     * @access public
     * @return void
     */
    public function editnavbar()
    {
        $this->display();
    }

    /**
     * Eidt block
     *
     * @access public
     * @return void
     */
    public function editblock($blockID, $type = '')
    {
        $blockModel = $this->loadModel('block');
        $this->app->loadLang('ui');

        $template = $this->config->template->{$this->device}->name;
        $theme    = $this->config->template->{$this->device}->theme;
        $blockModel->loadTemplateLang($template);

        if(!$blockID) $this->locate($this->inlink('admin'));

        if($type == 'phpcode')
        {
            $return = $this->loadModel('common')->verfyAdmin();
            if($return['result'] == 'fail') $this->view->okFile = $return['okFile'];
            $canCreatePHP = $this->loadModel('mail')->checkVerify('okFile');

            $this->view->canCreatePHP = $canCreatePHP;
        }

        if($_POST)
        {
            if($type == 'phpcode' and !$canCreatePHP) $this->send(array('result' => 'fail', 'reason' => 'captcha', 'message' => dao::getError()));
            $blockModel->update($template, $theme);
            if(!dao::isError()) $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess));
            $this->send(array('result' => 'fail', 'message' => dao::getError()));
        }

        $this->view->template = $template;
        $this->view->theme    = $theme;
        $this->view->block    = $blockModel->getByID($blockID);
        $this->view->type     = $this->get->type ? $this->get->type : $this->view->block->type;
        $this->display();
    }

    /**
     * Add block
     *
     * @access public
     * @return void
     */
    public function addBlock($region)
    {
        $blockModel = $this->loadModel('block');

        $template = $this->config->template->{$this->device}->name;
        $blockModel->loadTemplateLang($template);

        $this->view->blocks   = $blockModel->getList($template);
        $this->view->region   = $region;
        $this->display();
    }

    /**
     * Delete block
     *
     * @access public
     * @return void
     */
    public function deleteBlock($blockID)
    {
        // TODO: remove block region from database
        $this->send(array('result' => 'success'));
        // $this->send(array('result' => 'fail', 'message' => 'Fail message.'));
    }

    /**
     * Delete block
     *
     * @access public
     * @return void
     */
    public function moveBlock($region)
    {
        // TODO: sort block in region from database
        $this->send(array('result' => 'success'));
        // $this->send(array('result' => 'fail', 'message' => 'Fail message.'));
    }
}
