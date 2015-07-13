<?php
/**
 * The control file of ui module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv11.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     ui
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class ui extends control
{
    /**
     * Set template.
     *
     * @param  string   $template 
     * @param  string   $theme 
     * @param  bool     $custom 
     * @access public
     * @return void
     */
    public function setTemplate($template = '', $theme = '', $custom = false)
    {
        $templates = $this->ui->getTemplates();
        if($template and isset($templates[$template]))
        {  
            $setting = array();
            $setting['name']   = $template;
            $setting['theme']  = $theme;
            $setting['parser'] = isset($templates[$template]['parser']) ? $templates[$template]['parser'] : 'default';
            $setting['customTheme'] =  $custom ? $theme : '';

            $result = $this->loadModel('setting')->setItems('system.common.template', $setting);
            if($result) $this->send(array('result' => 'success', 'message' => $this->lang->setSuccess));
            $this->send(array('result' => 'fail', 'message' => $this->lang->fail));
        }

        $this->view->title     = $this->lang->ui->setTemplate;
        $this->view->templates = $templates;
        $this->display();
    }

    /**
     * Custom theme.
     * 
     * @param  string $theme 
     * @param  string $template 
     * @access public
     * @return void
     */
    public function customTheme($theme = '', $template = '')
    {
        if(empty($theme))    $theme    = $this->config->template->theme;
        if(empty($template)) $template = $this->config->template->name;

        $templates = $this->ui->getTemplates();
        if(!isset($templates[$template]['themes'][$theme])) die();

        $cssFile  = sprintf($this->config->site->ui->customCssFile, $template, $theme);
        $savePath = dirname($cssFile);
        if(!file_exists($savePath)) mkdir($savePath, 0777, true);

        if($_POST)
        {
            $params = $_POST;

            $errors = $this->ui->createCustomerCss($template, $theme, $params);
            if(!empty($errors)) $this->send(array('result' => 'fail', 'message' => $errors));
            $setting       = isset($this->config->template->custom) ? json_decode($this->config->template->custom, true): array();
            $postedSetting = fixer::input('post')->remove('template,theme')->get();

            $setting[$template][$theme] = $postedSetting;

            $result = $this->loadModel('setting')->setItems('system.common.template', array('custom' => helper::jsonEncode($setting)));
            $this->loadModel('setting')->setItems('system.common.template', array('customVersion' => time()));
            $this->send(array('result' => 'success', 'message' => $this->lang->ui->themeSaved));
        }

        $setting = isset($this->config->template->custom) ? json_decode($this->config->template->custom, true) : array();

        $this->view->setting = !empty($setting[$template][$theme]) ? $setting[$template][$theme] : array();

        $this->view->title      = "<i class='icon-cog'></i> " . $this->lang->ui->customtheme;
        $this->view->modalWidth = 1000;
        $this->view->theme      = $theme;
        $this->view->template   = $template;
        $this->view->hasPriv    = true;

        if(!is_writable($savePath))
        {
            $this->view->hasPriv = false;
            $this->view->errors  = sprintf($this->lang->ui->unWritable, str_replace(dirname($this->app->getWwwRoot()), '', $savePath));
        }

        $this->display();
     }

    /**
     * set logo.
     * 
     * @access public
     * @return void
     */
    public function setLogo()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $return = $this->ui->setOptionWithFile($section = 'logo', $htmlTagName = 'logo');
            
            if($return['result']) $this->send(array('result' => 'success', 'message' => $this->lang->setSuccess, 'locate'=>inlink('setLogo')));
            if(!$return['result']) $this->send(array('result' => 'fail', 'message' => $return['message']));
        }

        $this->view->title = $this->lang->ui->setLogo;
        $this->view->logo  = isset($this->config->site->logo) ? json_decode($this->config->site->logo) : false;

        $this->display();
    }

    /**
     * Set base style.
     * 
     * @access public
     * @return void
     */
    public function setBaseStyle()
    {
        if($_POST)
        {
            $style  = fixer::input('post')->stripTags('content', $this->config->allowedTags->admin, false)->get();
            $return = $this->loadModel('setting')->setItems('system.common.site', array('basestyle' => $style->content));

            if($return) $this->send(array('result' => 'success', 'message' => $this->lang->setSuccess, 'locate'=>inlink('setBaseStyle')));
            if(!$return) $this->send(array('result' => 'fail', 'message' => $this->lang->fail));
        }

        $this->view->title   = $this->lang->ui->setBaseStyle;
        $this->view->content = isset($this->config->site->basestyle) ? $this->config->site->basestyle : '';

        $this->display();
    }

    /**
     * Set base js.
     * 
     * @access public
     * @return void
     */
    public function setBaseJs()
    {
        if($_POST)
        {
            $js = fixer::input('post')->stripTags('content', $this->config->allowedTags->admin, false)->get();
            $return = $this->loadModel('setting')->setItems('system.common.site', array('basejs' => $js->content));

            if($return) $this->send(array('result' => 'success', 'message' => $this->lang->setSuccess, 'locate'=>inlink('setBaseJs')));
            if(!$return) $this->send(array('result' => 'fail', 'message' => $this->lang->fail));
        }

        $this->view->title   = $this->lang->ui->setBaseJs;
        $this->view->content = isset($this->config->site->basejs) ? $this->config->site->basejs : '';
        $this->display();
    }

    /**
     * Upload favicon.
     * 
     * @access public
     * @return void
     */
    public function setFavicon()
    {   
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {   
            $return = $this->ui->setOptionWithFile($section = 'favicon', $htmlTagName = 'favicon', $allowedFileType = 'ico');
            
            if($return['result']) $this->send(array('result' => 'success', 'message' => $this->lang->setSuccess, 'locate'=>inlink('setFavicon')));
            if(!$return['result']) $this->send(array('result' => 'fail', 'message' => $return['message']));
         }

        $this->view->title          = $this->lang->ui->setFavicon;
        $this->view->favicon        = isset($this->config->site->favicon) ? json_decode($this->config->site->favicon) : false;
        $this->view->defaultFavicon = file_exists($this->app->getWwwRoot() . 'favicon.ico');

        $this->display();
    }

    /**
     * Delete favicon 
     * 
     * @access public          
     * @return void            
     */ 
    public function deleteFavicon() 
    {
        $defaultFavicon = $this->app->getWwwRoot() . 'favicon.ico';
        if(file_exists($defaultFavicon)) unlink($defaultFavicon);

        $favicon = isset($this->config->site->favicon) ? json_decode($this->config->site->favicon) : false;
        $this->loadModel('setting')->deleteItems("owner=system&module=common&section=site&key=favicon");
        if($favicon) $this->loadModel('file')->delete($favicon->fileID);

        $this->locate(inlink('setFavicon'));
    }

    /**
     * Delete logo. 
     * 
     * @access public          
     * @return void            
     */ 
    public function deleteLogo() 
    {
        $logo = isset($this->config->site->logo) ? json_decode($this->config->site->logo) : false;

        $this->loadModel('setting')->deleteItems("owner=system&module=common&section=site&key=logo");
        if($logo) $this->loadModel('file')->delete($logo->fileID);

        $this->locate(inlink('setLogo'));
    }

    /**
     * Set others for ui.
     * 
     * @access public
     * @return void
     */
    public function others()
    {
        /* Get configs of list number. */
        $this->app->loadConfig('article');
        $this->app->loadConfig('product');
        if(strpos($this->config->site->modules, 'blog') !== false) $this->app->loadConfig('blog');
        if(strpos($this->config->site->modules, 'message') !== false) $this->app->loadConfig('message');
        if(strpos($this->config->site->modules, 'forum') !== false) 
        {
            $this->app->loadConfig('forum');
            $this->app->loadConfig('reply');
        }

        if(!empty($_POST))
        {

            $setting = fixer::input('post')->get('productView,QRCode');
            $result  = $this->loadModel('setting')->setItems('system.common.ui', $setting);
            if(!$result) $this->send(array('result' => 'fail', 'message' => $this->lang->fail));

            $setting = fixer::input('post')->remove('productView,QRCode')->get();
            $result  = $this->loadModel('setting')->setItems('system.common.site', $setting, 'all');
            if($result) $this->send(array('result' => 'success', 'message' => $this->lang->setSuccess));
            $this->send(array('result' => 'fail', 'message' => $this->lang->fail));
        }

        $this->view->title = $this->lang->ui->others;
        $this->display();
    }

    /**
     * Export theme function.
     * 
     * @access public
     * @return void
     */
    public function exportTheme()
    {
        if($_POST)
        {
            $initResult = $this->ui->initExportPath($this->post->template, $this->post->theme, $this->post->code);
            if(!$initResult) $this->send(array('result' => 'fail', 'message' => 'failed to init export paths'));

            if(!$this->ui->checkExportParams()) $this->send(array('result' => 'fail', 'message' => dao::getError()));
            $exportedFile = $this->ui->exportTheme($this->post->template, $this->post->theme, $this->post->code);
            $exportedFile = urlencode($exportedFile);
            $this->send(array('result' => 'success', 'message' => $this->lang->ui->exportedSuccess, 'locate' => inlink('downloadtheme', "theme={$exportedFile}")));
        }

        $templateList = $this->ui->getTemplates();

        foreach($templateList as $code => $template)
        {
            $templates[$code] = $template['name'];
            $themes[$code]    = $template['themes'];
        }

        $this->view->templates = $templates;
        $this->view->themes    = $themes;
        $this->view->title     = $this->lang->ui->exportTheme;
        $this->display();
    }

    /**
     * Download theme.
     * 
     * @param  string    $exportedFile 
     * @access public
     * @return void
     */
    public function downloadtheme($exportedFile)
    {
        $fileData = file_get_contents($exportedFile);
        $pathInfo = pathinfo($exportedFile);
        $this->loadModel('file')->sendDownHeader($pathInfo['basename'], 'zip', $fileData, filesize($exportedFile));
    }
}
