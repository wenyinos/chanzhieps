<?php
/**
 * The control file of site module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv11.html)
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
                ->get();

            $result = $this->loadModel('setting')->setItems('system.common.site', $setting);

            if($result) $this->send(array('result' => 'success', 'message' => $this->lang->setSuccess, 'locate' => inlink('setbasic')));
            $this->send(array('result' => 'fail', 'message' => $this->lang->fail));
        }

        $this->view->title = $this->lang->site->setBasic;
        $this->display();
    }

    /**
     * Set language items. 
     * 
     * @access public
     * @return void
     */
    public function setLang()
    {
        if(!empty($_POST))
        {
            $setting = fixer::input('post')
                ->setDefault('cn2tw', 0)
                ->join('lang', ',')
                ->join('cn2tw', '')
                ->get();

            if(empty($setting->lang) or empty($setting->defaultLang)) $this->send(array('result' => 'fail', 'message' => $this->lang->fail));
            if(strpos($setting->lang, $setting->defaultLang) === false) $this->send(array('result' => 'fail', 'message' => $this->lang->fail));

            $result = $this->loadModel('setting')->setItems('system.common.site', $setting, $lang = 'all');
            $this->dao->delete()->from(TABLE_CONFIG)->where("`key`")->eq('defaultLang')->andWhere('lang')->ne('all')->exec();
            if($result) $this->send(array('result' => 'success', 'message' => $this->lang->setSuccess, 'locate' => inlink('setLang')));
            $this->send(array('result' => 'fail', 'message' => $this->lang->fail));
        }

        $this->view->title = $this->lang->site->setLang;
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
        $okFile = $this->loadModel('common')->verfyAdmin();
        $pass   = $this->loadModel('mail')->checkVerify();
        $this->view->pass   = $pass;
        $this->view->okFile = $okFile;
        if(!empty($_POST) && !$pass) $this->send(array('result' => 'fail', 'reason' => 'captcha'));

        if(!empty($_POST))
        {
            $setting = fixer::input('post')
                ->setDefault('captcha', 'auto')
                ->setDefault('checkIP', 'close')
                ->setDefault('checkSessionIP', '0')
                ->setDefault('checkPosition', 'close')
                ->setDefault('checkEmail', 'close')
                ->setDefault('allowedIP', '')
                ->setDefault('importantValidate', '')
                ->join('importantValidate', ',')
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
        $position = $this->app->loadClass('IP')->find(helper::getRemoteIp());
        if(isset($position[3])) unset($position[3]);

        $this->view->title    = $this->lang->site->setBasic;
        $this->view->position = join(' ', $position);
        $this->display();
    }

    /**
     * Set record count of perPage for article/product/blog/thread.
     * 
     * @access public
     * @return void
     */
    public function setRecPerPage()
    {
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
            $setting = fixer::input('post')->get();

            $result = $this->loadModel('setting')->setItems('system.common.site', $setting, 'all');

            if($result) $this->send(array('result' => 'success', 'message' => $this->lang->setSuccess));
            $this->send(array('result' => 'fail', 'message' => $this->lang->fail));
        }

        $this->view->title = $this->lang->site->setRecPerPage;
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
        if(!empty($_POST))
        {
            $setting = fixer::input('post')->remove('allowedFiles')->setDefault('allowUpload', '0')->get();

            $dangers = explode(',', $this->config->file->dangers);
            $allowedFiles = trim(strtolower($this->post->allowedFiles), ',');
            $allowedFiles = str_replace($dangers, '', $allowedFiles);
            $allowedFiles = seo::unify($allowedFiles, ',');
            if(!preg_match('/^[a-z0-9,]+$/', $allowedFiles)) $this->send(array('result' => 'fail', 'message' => $this->lang->fail));

            foreach ($allowedFiles as $extension)
            {  
                if(strlen($extension) > 5) $this->send(array('result' => 'fail', 'message' => $this->lang->fail));
            }

            foreach ($dangers as $danger)
            {  
                if(strpos($allowedFiles, $danger) !== false) $this->send(array('result' => 'fail', 'message' => $this->lang->fail));
            }

            $allowedFiles = ',' . $allowedFiles . ','; 
            $fileConfig   = array('allowed' => $allowedFiles);
            $this->loadModel('setting')->setItems('system.common.file', $fileConfig);

            $result  = $this->loadModel('setting')->setItems('system.common.site', $setting);

            if($result) $this->send(array('result' => 'success', 'message' => $this->lang->setSuccess, 'locate' => inlink('setupload')));
            $this->send(array('result' => 'fail', 'message' => $this->lang->fail));
        }

        $this->view->title = $this->lang->site->setUpload;
        $this->display();
    }

    /**
     * set site basic info.
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
