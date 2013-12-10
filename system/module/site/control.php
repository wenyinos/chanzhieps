<?php
/**
 * The control file of site module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     LGPL
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
        if(!empty($_POST))
        {
            $setting = fixer::input('post')->join('moduleEnabled', ',')->get();
            $result  = $this->loadModel('setting')->setItems('system.common.site', $setting);
            $cache   = $this->loadModel('cache')->createConfigCache();

            if(!$cache) $this->send(array('result' => 'fail', 'message' => sprintf($this->lang->error->noWritable, $this->app->getTmpRoot() . 'cache')));
            if($result) $this->send(array('result' => 'success', 'message' => $this->lang->setSuccess, 'locate' => inlink('setbasic')));
            $this->send(array('result' => 'fail', 'message' => $this->lang->fail));
        }

        $this->view->title = $this->lang->site->setBasic;
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

   /**
     * Upload favicon.
     * 
     * @access public
     * @return void
     */
    public function favicon()
    {   
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {   
            if(empty($_FILES)) $this->send(array('result' => 'fail', 'message' => $this->lang->error->noSelectedFile));

            $extension = substr($_FILES['files']['name'], strrpos($_FILES['files']['name'], '.') + 1); 
            if($extension != 'ico') $this->send(array('result' => 'fail', 'message' => $this->lang->site->favicon->notice));

            $fileModel = $this->loadModel('file');

            /*upload new favicon*/
            if(!$fileModel->checkSavePath()) $this->send(array('result' => 'fail', 'message' => $this->lang->file->errorUnwritable));
            $favicon = $fileModel->saveUpload('favicon');
            if(!$favicon) $this->send(array('result'=>'fail', 'message'=>$this->lang->fail, inlink('favicon')));

            $fileID      = key($favicon);
            $faviconFile = $fileModel->getById($fileID); 

            /*delete old favicon*/
            $oldFavicons  = $fileModel->getByObject('favicon', 0); 
            foreach($oldFavicons as $oldFavicon)
            {
                if($oldFavicon->id != $faviconFile->id) $fileModel->delete($oldFavicon->id);
            }

            /* save new favicon data. */
            $setting = new stdclass();

            $setting->fileID    = $faviconFile->id;
            $setting->pathname  = $faviconFile->pathname;
            $setting->webPath   = $faviconFile->webPath;
            $setting->addedBy   = $faviconFile->addedBy;
            $setting->addedDate = $faviconFile->addedDate;

            $result = $this->loadModel('setting')->setItems('system.common.site', array('favicon' => helper::jsonEncode($setting)));
            if($result) $this->send(array('result' => 'success', 'message' => $this->lang->setSuccess, 'locate'=>inlink('favicon')));

            $this->send(array('result'=>'fail', 'message'=>$this->lang->fail, inlink('favicon')));
        }

        $this->view->title   = $this->lang->site->favicon->common;
        $this->view->favicon = isset($this->config->site->favicon) ? json_decode($this->config->site->favicon) : false;

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
        $favicon = isset($this->config->site->favicon) ? json_decode($this->config->site->favicon) : false;

        $this->loadModel('setting')->deleteItems("owner=system&module=common&section=site&key=favicon");
        if($favicon) $this->loadModel('file')->delete($favicon->fileID);

        $this->locate(inlink('favicon'));
    }
}
