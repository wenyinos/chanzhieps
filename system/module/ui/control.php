<?php
/**
 * The control file of ui module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     LGPL
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     ui
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class ui extends control
{
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
            if(empty($_FILES)) $this->send(array('result' => 'fail', 'message' => $this->lang->site->noSelectedFile));

            $fileModel =  $this->loadModel('file');

            if(!$this->file->checkSavePath()) $this->send(array('error' => 1, 'message' => $this->lang->file->errorUnwritable));
            /*upload new logo*/
            $logo = $fileModel->saveUpload('logo');
            if(!$logo) $this->send(array('result'=>'fail', 'message'=>$this->lang->fail, inlink('setLogo')));

            $fileID   = array_keys($logo);
            $logoFile = $fileModel->getById($fileID[0]); 

            /*delete old logo*/
            $oldLogos  = $fileModel->getByObject('logo', 0);
            foreach($oldLogos as $oldLogo)
            {
                if($oldLogo->id != $logoFile->id) $fileModel->delete($oldLogo->id);
            }
            
            /* save new logo data. */
            $setting  = new stdclass();

            $setting->fileID    = $logoFile->id;
            $setting->pathname  = $logoFile->pathname;
            $setting->webPath   = $logoFile->webPath;
            $setting->addedBy   = $logoFile->addedBy;
            $setting->addedDate = $logoFile->addedDate;

            $result = $this->loadModel('setting')->setItems('system.common.site', array('logo' => helper::jsonEncode($setting)));
            if($result)
            {
                $this->send(array('result' => 'success', 'message' => $this->lang->setSuccess, 'locate'=>inlink('setLogo')));
            }
            else
            {
                $this->send(array('result'=>'fail', 'message'=>$this->lang->fail, inlink('setLogo')));
            }
        }

        $this->view->title = $this->lang->site->setLogo;
        $this->view->logo = isset($this->config->site->logo) ? json_decode($this->config->site->logo) : false;

        $this->display();
    }

    /**
     * Set theme
     *
     * @param $theme
     * @access public
     * return void
     **/
     public function setTheme($theme = '')
     {
         if($theme and isset($this->lang->site->themes[$theme]))
         {  
            $result = $this->loadModel('setting')->setItems('system.common.site', array('theme' => $theme ));
            if($result) $this->send(array('result' => 'success', 'message' => $this->lang->setSuccess));
            $this->send(array('result' => 'fail', 'message' => $this->lang->fail));
         }

         $this->view->title = $this->lang->site->setTheme;
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
            if(empty($_FILES)) $this->send(array('result' => 'fail', 'message' => $this->lang->site->noSelectedFile));

            $extension = substr($_FILES['files']['name'], strrpos($_FILES['files']['name'], '.') + 1); 
            if($extension != 'ico') $this->send(array('result' => 'fail', 'message' => $this->lang->site->favicon->notice));

            $fileModel = $this->loadModel('file');

            /* upload new favicon. */
            if(!$fileModel->checkSavePath()) $this->send(array('result' => 'fail', 'message' => $this->lang->file->errorUnwritable));
            $favicon = $fileModel->saveUpload('favicon');
            if(!$favicon) $this->send(array('result'=>'fail', 'message'=>$this->lang->fail, inlink('favicon')));

            $fileID      = key($favicon);
            $faviconFile = $fileModel->getById($fileID); 

            /* delete old favicon. */
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
