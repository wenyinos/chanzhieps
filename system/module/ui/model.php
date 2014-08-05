<?php
/**
 * The model file of ui module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     http://api.chanzhi.org/goto.php?item=license
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     ui
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php
class uiModel extends model
{
    /**
     * Get templates available.
     * 
     * @access public
     * @return void
     */
    public function getTemplates()
    {
        $this->app->loadClass('Spyc', true);
        $folders = glob($this->app->getTplRoot() . '*');
        foreach($folders as $folder)
        {
            $templateName = str_replace($this->app->getTplRoot(), '', $folder);
            $config = Spyc::YAMLLoadString(file_get_contents($folder . DS . 'doc' . DS . $this->app->getClientLang() . '.yaml'));
            $templates[$templateName] = $config;
        }
        return $templates;
    }

    /**
     * Get authorities needed when install.
     * 
     * @access public
     * @return void
     */
    public function checkAuthorities()
    {
        $authorities = array();

        $authorities['package']['path']     = $this->app->getDataRoot() . 'template' . DS;
        $authorities['package']['exists']   = is_dir($authorities['package']['path']);
        $authorities['package']['writable'] = is_writable($authorities['package']['path']);

        $authorities['template']['path']     = $this->app->getTplRoot();
        $authorities['template']['exists']   = is_dir($authorities['template']['path']);
        $authorities['template']['writable'] = is_writable($authorities['template']['path']);

        $errors = '';
        $commands = '';
        foreach($authorities as $authority)
        {
            if(!$authority['exists'])  
            {
                $errors   .= sprintf($this->lang->ui->template->error->exists, $authority['path']);
                $commands .= sprintf($this->lang->ui->template->commands->exists, $authority['path']);
            }
            if(!$authority['writable']) 
            {
                $errors   .= sprintf($this->lang->ui->template->error->writable, $authority['path']);
                $commands .= sprintf($this->lang->ui->template->commands->writable, $authority['path']);
            }
        }

        return array($errors, $commands);
    }

    /**
     * Extract template package.
     * 
     * @param  string    $package 
     * @access public
     * @return void
     */
    public function extractPackage($package)
    {
        $packageFile = $this->app->getDataRoot() . "template/{$package}.zip";

        $this->app->loadClass('pclzip', true);
        $zip = new pclzip($packageFile);
        $files = $zip->listContent();

        $tempPath = $this->app->getDataRoot() . 'template/' . $package . DS;

        if(is_dir($tempPath))
        {
            $fileClass = $this->app->loadClass('zfile');
            $fileClass->removeDir($tempPath);
        }

        $return = new stdclass();
        $removePath = $files[0]['filename'];
        if($zip->extract(PCLZIP_OPT_PATH, $tempPath, PCLZIP_OPT_REMOVE_PATH, $removePath) == 0)
        {
            $return->result = 'fail';
            $return->error  = $zip->errorInfo(true);
        }
        return true;
    }

    /**
     * Get info from template package. 
     * 
     * @param  string    $package 
     * @access public
     * @return void
     */
    public function getInfoFromPackage($package)
    {
        $this->app->loadClass('Spyc', true);
        $tempPath = $this->app->getDataRoot() . 'template/' . $package . DS;
        return Spyc::YAMLLoadString(file_get_contents($tempPath . 'doc' . DS . $this->app->getClientLang() . '.yaml'));
    }

    /**
     * Copy package files. 
     * 
     * @param  string    $package 
     * @access public
     * @return array
     */
    public function copyTemplateFiles($package)
    {
        $templateRoot = $this->app->getTplRoot();
        $packagePath  = $this->app->getDataRoot() . 'template' . DS . $package . DS;

        $pathes = scandir($packagePath);

        $fileClass   = $this->app->loadClass('zfile');
        $copiedFiles = $fileClass->copyDir($packagePath, $templateRoot . $package);

        $fileClass = $this->app->loadClass('zfile');
        $fileClass->removeDir($packagePath);

        return $copiedFiles;
    }

    /**
     * Get template option menu.   
     * 
     * @access public
     * @return void
     */
    public function getTemplateOptions()
    {
        $this->app->loadClass('Spyc', true);
        $folders = glob($this->app->getTplRoot() . '*');
        foreach($folders as $folder)
        {
            $templateName = str_replace($this->app->getTplRoot(), '', $folder);
            $config = Spyc::YAMLLoadString(file_get_contents($folder . DS . 'doc' . DS . $this->app->getClientLang() . '.yaml'));
            $templates[$templateName] = $config['name'];
        }

        return $templates;
    }

    /**
     * Set UI option with file. 
     * 
     * @param  int    $type 
     * @param  int    $htmlTagName 
     * @access public
     * @return void
     */
    public function setOptionWithFile($section, $htmlTagName, $allowedFileType = 'jpg,jpeg,png,gif,bmp')
    {
        if(empty($_FILES)) return array('result' => false, 'message' => $this->lang->ui->noSelectedFile);

        $fileType = substr($_FILES['files']['name'], strrpos($_FILES['files']['name'], '.') + 1); 
        if(strpos($allowedFileType, $fileType) === false) return array('result' => false, 'message' => sprintf($this->lang->ui->notAlloweFileType, $allowedFileType));

        $fileModel = $this->loadModel('file');

        if(!$this->file->checkSavePath()) return array('result' => false, 'message' => $this->lang->file->errorUnwritable);

        /* Delete old files. */
        $oldFiles = $this->dao->select('id')->from(TABLE_FILE)->where('objectType')->eq($section)->fetchAll('id');
        foreach($oldFiles as $file) $fileModel->delete($file->id);
        if(dao::isError()) return array('result' => false, 'message' => $this->lang->fail);

        /* Upload new logo. */
        $uploadResult = $fileModel->saveUpload($htmlTagName);
        if(!$uploadResult) return array('result' => false, 'message' => $this->lang->fail);

        $fileIdList = array_keys($uploadResult);
        $file       = $fileModel->getById($fileIdList[0]); 

        /* Save new data. */
        $setting  = new stdclass();
        $setting->fileID    = $file->id;
        $setting->pathname  = $file->pathname;
        $setting->webPath   = $file->webPath;
        $setting->addedBy   = $file->addedBy;
        $setting->addedDate = $file->addedDate;

        $result = $this->loadModel('setting')->setItems('system.common.site', array($section => helper::jsonEncode($setting)));
        if($result) return array('result' => true);

        return array('result' => false, 'message' => $this->lang->fail);
    }
}
