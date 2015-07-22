<?php
/**
 * The control file of site module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1 (http://www.chanzhi.org/license/)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     site
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class site extends control
{
    /**
     * set site basic info.
     * 
     * @access public
     * @return void
     */
    public function setBasic()
    {
        $allowedTags = $this->app->user->admin == 'super' ? $this->config->allowedTags->admin : $this->config->allowedTags->front;

        if(!empty($_POST))
        {
            $setting = fixer::input('post')
                ->stripTags('meta', $allowedTags)
                ->join('modules', ',')
                ->remove('allowedFiles')
                ->setDefault('modules', '')
                ->stripTags('pauseTip', $allowedTags)
                ->remove('uid')
                ->remove('lang,cn2tw,defaultLang')
                ->get();

            $result = $this->loadModel('setting')->setItems('system.common.site', $setting);
            if(!$result) $this->send(array('result' => 'fail', 'message' => $this->lang->fail));

            $setting = fixer::input('post')
                ->setDefault('cn2tw', 0)
                ->join('lang', ',')
                ->join('cn2tw', '')
                ->get('lang,cn2tw,defaultLang');

            if(empty($setting->lang) or empty($setting->defaultLang)) $this->send(array('result' => 'fail', 'message' => $this->lang->fail));
            if(strpos($setting->lang, $setting->defaultLang) === false) $this->send(array('result' => 'fail', 'message' => $this->lang->fail));

            $result = $this->loadModel('setting')->setItems('system.common.site', $setting, $lang = 'all');
            $this->dao->delete()->from(TABLE_CONFIG)->where("`key`")->eq('defaultLang')->andWhere('lang')->ne('all')->exec();
            if(!$result) $this->send(array('result' => 'fail', 'message' => $this->lang->fail));

            $this->send(array('result' => 'success', 'message' => $this->lang->setSuccess, 'locate' => inlink('setbasic')));
        }

        $this->view->title = $this->lang->site->setBasic;
        $this->display();
    }

    /**
     * set sensitive.
     * 
     * @access public
     * @return void
     */
    public function setSensitive()
    {
        $this->lang->site->menu = $this->lang->security->menu;
        $this->lang->menuGroups->site = 'security';

        if(!empty($_POST))
        {
            $setting = fixer::input('post')->get();

            $result = $this->loadModel('setting')->setItems('system.common.site', $setting);

            if($result) $this->send(array('result' => 'success', 'message' => $this->lang->setSuccess, 'locate' => inlink('setsensitive')));
            $this->send(array('result' => 'fail', 'message' => $this->lang->fail));
        }

        $this->view->title = $this->lang->site->setsensitive;
        $this->display();
    }

    /**
     * Set robots.
     * 
     * @access public
     * @return void
     */
    public function setRobots()
    {
        $robotsFile = $this->app->getWwwRoot() . 'robots.txt'; 
        $writeable  = ((file_exists($robotsFile) and is_writeable($robotsFile)) or is_writeable(dirname($robotsFile)));

        if(!empty($_POST))
        {
            if(!$writeable) $this->send(array('result' => 'fail', 'message' => sprintf($this->lang->site->robotsUnwriteable, $robotsFile)) );
            if(!$this->post->robots) $this->send(array('result' => 'fail', 'message' => array('robots' => sprintf($this->lang->error->notempty, $this->lang->site->robots) )) );
            
            $result = file_put_contents($robotsFile, $this->post->robots);
            if(!$result) $this->send(array('result' => 'fail', 'message' => $this->lang->fail));
            $this->send(array('result' => 'success', 'message' => $this->lang->setSuccess, 'locate' => inlink('setrobots')));
        }

        $this->view->robots = '';
        if(file_exists($robotsFile)) $this->view->robots = file_get_contents($robotsFile);

        $this->view->robotsFile = $robotsFile;
        $this->view->writeable  = $writeable; 
        $this->view->title      = $this->lang->site->setBasic;
        $this->display();
    }

    /**
     * set site security info.
     * 
     * @access public
     * @return void
     */
    public function setSecurity()
    {
        $this->lang->site->menu = $this->lang->security->menu;
        $this->lang->menuGroups->site = 'security';

        $captcha           = (isset($this->config->site->captcha) and ($this->config->site->captcha == 'open' and ($this->post->captcha == 'close' or $this->post->captcha == 'auto')) or ((!isset($this->config->site->captcha) or $this->config->site->captcha == 'auto') and $this->post->captcha == 'close'));
        $checkEmail        = (isset($this->config->site->checkEmail) and $this->config->site->checkEmail == 'open' and $this->post->checkEmail == 'close');
        $front             = (isset($this->config->site->front) and $this->config->site->front == 'login' and $this->post->front == 'guest');
        $checkLocation     = (isset($this->config->site->checkLocation) and $this->config->site->checkLocation == 'open' and $this->post->checkLocation == 'close');
        $checkSessionIP    = (isset($this->config->site->checkSessionIP) and $this->config->site->checkSessionIP == 1 and $this->post->checkSessionIP == 0);
        $allowedIP         = (isset($this->config->site->allowedIP) and ($this->config->site->allowedIP != $this->post->allowedIP));

        $newImportantValidate = $this->post->importantValidate ? implode(',', $this->post->importantValidate) : '';
        $oldImportantValidate = $this->config->site->importantValidate;
        $importantValidate    = (($oldImportantValidate == 'okFile,email' and (!$newImportantValidate or $newImportantValidate == 'okFile' or $newImportantValidate == 'email'))
                                or ($oldImportantValidate == 'okFile' and (!$newImportantValidate or $newImportantValidate == 'email'))
                                or ($oldImportantValidate == 'email' and (!$newImportantValidate or $newImportantValidate == 'okFile')));

        if($captcha or $checkEmail or $front or $checkLocation or $checkSessionIP or $allowedIP or $importantValidate)
        {
            $okFile = $this->loadModel('common')->verfyAdmin();
            $pass   = $this->loadModel('mail')->checkVerify('okFile');
            $this->view->pass   = $pass;
            $this->view->okFile = $okFile;
            if(!empty($_POST) && !$pass) $this->send(array('result' => 'fail', 'reason' => 'captcha'));
        }

        if(!empty($_POST))
        {
            $setting = fixer::input('post')
                ->setDefault('captcha', 'auto')
                ->setDefault('filterSensitive', 'close')
                ->setDefault('checkIP', 'close')
                ->setDefault('checkSessionIP', '0')
                ->setDefault('checkLocation', 'close')
                ->setDefault('checkEmail', 'close')
                ->setDefault('allowedIP', '')
                ->setDefault('importantValidate', '')
                ->join('importantValidate', ',')
                ->setForce('sensitive', seo::unify($this->post->sensitive, ','))
                ->get();

            /* check IP. */
            $ips = empty($_POST['allowedIP']) ? array() : explode(',', $this->post->allowedIP);
            foreach($ips as $ip)
            {
                if(!empty($ip) and !helper::checkIP($ip)) 
                {
                    dao::$errors['allowedIP'][] = $this->lang->site->wrongAllowedIP;
                    break;
                }
            }

            $result = $this->loadModel('setting')->setItems('system.common.site', $setting, 'all');

            if($result) $this->send(array('result' => 'success', 'message' => $this->lang->setSuccess, 'locate' => inlink('setsecurity')));
            $this->send(array('result' => 'fail', 'message' => dao::getError()));
        }

        $location = $this->app->loadClass('IP')->find(helper::getRemoteIp());
        if(is_array($location))
        {
            $locations = $location;
            $location  = join(' ', $locations);
            if(count($location) > 3) $location = $locations[0] . ' ' . $locations[1] . ' ' . $locations[2];
        }

        $this->view->title    = $this->lang->site->setBasic;
        $this->view->location = $location;
        $this->display();
    }

    /**
     * Set upload configures.
     * 
     * @access public
     * @return void
     */
    public function setUpload()
    {
        $this->lang->site->menu = $this->lang->security->menu;
        $this->lang->menuGroups->site = 'security';

        $this->loadModel('file');

        if(!empty($_POST))
        {
            $setting = fixer::input('post')->remove('allowedFiles,thumbs')->setDefault('allowUpload', '0')->get();

            $dangers = explode(',', $this->config->file->dangers);
            $allowedFiles = trim(strtolower($this->post->allowedFiles), ',');
            $allowedFiles = str_replace($dangers, '', $allowedFiles);
            $allowedFiles = seo::unify($allowedFiles, ',');
            if(!preg_match('/^[a-z0-9,]+$/', $allowedFiles)) $this->send(array('result' => 'fail', 'message' => $this->lang->fail));

            $allowedFiles = explode(',', $allowedFiles);

            foreach ($allowedFiles as $extension)
            {  
                if(strlen($extension) > 5) $this->send(array('result' => 'fail', 'message' => $this->lang->fail));
            }

            $allowedFiles = implode(',', $allowedFiles);

            foreach ($dangers as $danger)
            {  
                if(strpos($allowedFiles, $danger) !== false) $this->send(array('result' => 'fail', 'message' => $this->lang->fail));
            }

            $allowedFiles = ',' . $allowedFiles . ','; 
            $result = $this->loadModel('setting')->setItem('system.common.file.allowed', $allowedFiles);
            if(!$result) $this->send(array('result' => 'fail', 'message' => $this->lang->fail));

            $result  = $this->loadModel('setting')->setItems('system.common.site', $setting);
            if($result) $this->send(array('result' => 'success', 'message' => $this->lang->setSuccess, 'locate' => inlink('setupload')));
            $this->send(array('result' => 'fail', 'message' => $this->lang->fail));
        }

        $this->view->title = $this->lang->site->setUpload;
        $this->display();
    }

    /**
     * set oauth login configure.
     * 
     * @access public
     * return void
     */
    public function setOauth()
    {
        if(!empty($_POST))
        {
            $provider = $this->post->provider;
            $oauth    = array($provider => helper::jsonEncode($_POST));
            $result   = $this->loadModel('setting')->setItems('system.common.oauth', $oauth);
            if($result) $this->send(array('result' => 'success', 'message' => $this->lang->setSuccess));
            $this->send(array('result' => 'fail', 'message' => $this->lang->fail));
        }
        $this->view->title = $this->lang->site->setOauth;
        $this->display();
    }
}
