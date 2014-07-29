<?php
/**
 * The control file of extension module of ChanZhiEPS.
 *
 * @copyright   Copyright 2009-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     http://api.chanzhi.org/goto.php?item=license
 * @author      Chunsheng Wang <chunsheng@xirangit.com>
 * @package     extension
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class extension extends control
{
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Browse extensions.
     *
     * @param  string   $status
     * @access public
     * @return void
     */
    public function browse($status = 'installed')
    {
        $extensions = $this->extension->getLocalExtensions($status);
        $versions   = array();
        if($extensions and $status == 'installed')
        {
            /* Get latest release from remote. */
            $extCodes = helper::safe64Encode(join(',', array_keys($extensions)));
            $results = $this->extension->getExtensionsByAPI('bycode', $extCodes, $recTotal = 0, $recPerPage = 1000, $pageID = 1);
            if(isset($results->extensions))
            {
                $remoteReleases = $results->extensions;
                foreach($remoteReleases as $release)
                {
                    if(!isset($extensions[$release->code])) continue;

                    $extension = $extensions[$release->code];
                    $extension->viewLink = $release->viewLink;
                    if(isset($release->latestRelease) and $extension->version != $release->latestRelease->releaseVersion and $this->extension->checkVersion($release->latestRelease->chanzhiCompatible))
                    {
                        $upgradeLink = inlink('upgrade', "extension=$release->code&downLink=" . helper::safe64Encode($release->latestRelease->downLink) . "&md5={$release->latestRelease->md5}&type=$release->type");
                        $upgradeLink = ($release->latestRelease->charge or !$release->latestRelease->public) ? $release->latestRelease->downLink : $upgradeLink;
                        $extension->upgradeLink = $upgradeLink;
                    }
                }
            }
        }

        $this->view->title      = $this->lang->extension->browse;
        $this->view->position[] = $this->lang->extension->browse;
        $this->view->tab        = $status;
        $this->view->extensions = $extensions;
        $this->view->versions   = $versions;
        $this->view->status     = $status;
        $this->display();
    }

    /**
     * Obtain extensions from the community.
     * 
     * @param  string $type 
     * @param  string $param 
     * @access public
     * @return void
     */
    public function obtain($type = 'byUpdatedTime', $param = '', $recTotal = 0, $recPerPage = 10, $pageID = 1)
    {
        /* Init vars. */
        $type       = strtolower($type);
        $moduleID   = $type == 'bymodule' ? (int)$param : 0;
        $extensions = array();
        $pager      = null;

        /* Set the key. */
        if($type == 'bysearch') $param = helper::safe64Encode($this->post->key);

        /* Get results from the api. */
        $results = $this->extension->getExtensionsByAPI($type, $param, $recTotal, $recPerPage, $pageID);
        if($results)
        {
            $this->app->loadClass('pager', $static = true);
            $pager      = new pager($results->dbPager->recTotal, $results->dbPager->recPerPage, $results->dbPager->pageID);
            $extensions = $results->extensions;
        }

        $this->view->title      = $this->lang->extension->obtain;
        $this->view->position[] = $this->lang->extension->obtain;
        $this->view->moduleTree = $this->extension->getModulesByAPI();
        $this->view->extensions = $extensions;
        $this->view->installeds = $this->extension->getLocalExtensions('installed');
        $this->view->pager      = $pager;
        $this->view->tab        = 'obtain';
        $this->view->type       = $type;
        $this->view->moduleID   = $moduleID;
        $this->display();
    }
    
    /**
     * Install a extension
     * 
     * @param  string $extension 
     * @param  string $type 
     * @param  string $overridePackage 
     * @param  string $ignoreCompatible 
     * @param  string $overrideFile 
     * @param  string $agreeLicense 
     * @param  string $upgrade 
     * @access public
     * @return void
     */
    public function install($extension, $downLink = '', $md5 = '', $type = '', $overridePackage = 'no', $ignoreCompatible = 'no', $overrideFile = 'no', $agreeLicense = 'no', $upgrade = 'no')
    {
        set_time_limit(0);
        unset($this->lang->extension->menu);

        $this->view->error = '';
        $installTitle      = $upgrade == 'no' ? $this->lang->extension->install : $this->lang->extension->upgrade;
        $installType       = $upgrade == 'no' ? $this->lang->extension->installExt : $this->lang->extension->upgradeExt; 
        $this->view->installType = $installType;
        $this->view->upgrade     = $upgrade;
        $this->view->title       = $installTitle . $this->lang->colon . $extension;
        $this->view->subtitle    = $this->lang->extension->install;

        /* Get the package file name. */
        $packageFile = $this->extension->getPackageFile($extension);

        /* Check the package file exists or not. */
        if(!file_exists($packageFile)) 
        {
            $this->view->error = sprintf($this->lang->extension->errorPackageNotFound, $packageFile);
            die($this->display());
        }

        /* Checking the extension pathes. */
        $return = $this->extension->checkExtensionPathes($extension);
        if($this->session->dirs2Created == false) $this->session->set('dirs2Created', $return->dirs2Created);    // Save the dirs to be created.
        if($return->result != 'ok')
        {
            $this->view->error = $return->errors;
            die($this->display());
        }

        /* Extract the package. */
        $return = $this->extension->extractPackage($extension);
        if($return->result != 'ok')
        {
            $this->view->error = sprintf($this->lang->extension->errorExtracted, $packageFile, $return->error);
            die($this->display());
        }

        /* Get condition. e.g. chanzhi|depends|conflicts. */
        $condition = $this->extension->getCondition($extension);
        $installedExts = $this->extension->getLocalExtensions('installed');

        /* Check version incompatible */
        $incompatible = $condition->chanzhi['incompatible'];
        if($this->extension->checkVersion($incompatible))
        {
            $this->view->error = sprintf($this->lang->extension->errorIncompatible);
            die($this->display());
        }

        /* Check conflicts. */
        $conflictsResult = $this->extension->checkConflicts($condition, $installedExts);
        if($conflictsResult['result'] == 'fail') 
        {
            $this->view->error = $conflictsResult['error'];
            $this->display();
        }

        /* Check Depends. */
        $depentsResult = $this->extension->checkExtRequired($condition->depends, $installedExts);
        if($depentsResult['result'] == 'fail') 
        {
            $this->view->error = $rdepentsResult['error'];
            $this->display();
        }

        /* Check version compatible. */
        $chanzhiCompatible = $condition->chanzhi['compatible'];
        if(!$this->extension->checkVersion($chanzhiCompatible) and $ignoreCompatible == 'no')
        {
            $ignoreLink = inlink('install', "extension=$extension&downLink=$downLink&md5=$md5&type=$type&overridePackage=$overridePackage&ignoreCompatible=yes&overrideFile=$overrideFile&agreeLicense=$agreeLicense&upgrade=$upgrade");
            $returnLink = inlink('obtain');
            $this->view->error = sprintf($this->lang->extension->errorCheckIncompatible, $installType, $ignoreLink, $installType, $returnLink);
            die($this->display());
        }

        /* Check files in the package conflicts with exists files or not. */
        if($overrideFile == 'no')
        {
            $return = $this->extension->checkFile($extension);
            if($return->result != 'ok')
            {
                $overrideLink = inlink('install', "extension=$extension&downLink=$downLink&md5=$md5&type=$type&overridePackage=$overridePackage&ignoreCompatible=$ignoreCompatible&overrideFile=yes&agreeLicense=$agreeLicense&upgrade=$upgrade");
                $returnLink   = inlink('obtain');
                $this->view->error = sprintf($this->lang->extension->errorFileConflicted, $return->error, $overrideLink, $returnLink);
                die($this->display());
            }
        }

        /* Print the license form. */
        if($agreeLicense == 'no')
        {
            $extensionInfo = $this->extension->getInfoFromPackage($extension);
            $license       = $this->extension->processLicense($extensionInfo->license);
            $agreeLink     = inlink('install', "extension=$extension&downLink=$downLink&md5=$md5&type=$type&overridePackage=$overridePackage&ignoreCompatible=$ignoreCompatible&overrideFile=$overrideFile&agreeLicense=yes&upgrade=$upgrade");

            $this->view->license   = $license;
            $this->view->author    = $extensionInfo->author;
            $this->view->agreeLink = $agreeLink;
            if(isset($license) and $upgrade == 'yes') 
            {
                $this->view->subtitle = sprintf($this->lang->extension->upgradeVersion, $this->post->installedVersion, $this->post->upgradeVersion);
            }

            die($this->display());
        }

        /* The preInstall hook file. */
        $hook = $upgrade == 'yes' ? 'preupgrade' : 'preinstall';
        if($preHookFile = $this->extension->getHookFile($extension, $hook)) include $preHookFile;

        /* Save to database. */
        $this->extension->saveExtension($extension, $type);

        /* Copy files to target directory. */
        $this->view->files = $this->extension->copyPackageFiles($extension);

        /* Judge need execute db install or not. */
        $data = new stdclass();
        $data->status = 'installed';
        $data->dirs   = $this->session->dirs2Created;
        $data->files  = $this->view->files;
        $data->installedTime = helper::now();
        $this->session->set('dirs2Created', array());   // clean the session.

        /* Execute the install.sql. */
        if($upgrade == 'no' and $this->extension->needExecuteDB($extension, 'install'))
        {
            $return = $this->extension->executeDB($extension, 'install');
            if($return->result != 'ok')
            {
                $this->view->error = sprintf($this->lang->extension->errorInstallDB, $return->error);
                die($this->display());
            }
        }

        /* Update status, dirs, files and installed time. */
        $this->extension->updateExtension($extension, $data);
        $this->view->downloadedPackage = !empty($downLink);

        /* The postInstall hook file. */
        $hook = $upgrade == 'yes' ? 'postupgrade' : 'postinstall';
        if($postHookFile = $this->extension->getHookFile($extension, $hook)) include $postHookFile;

        $this->display();
    }

    /**
     * Download from chanzhi plat.
     * 
     * @param  string    $extension 
     * @param  string    $downLink 
     * @access public
     * @return void
     */
    public function download($extension, $downLink, $overridePackage = 'no')
    {
        /* Get the package file name. */
        $packageFile = $this->extension->getPackageFile($extension);

        /* Checking download path. */
        $return = $this->extension->checkDownloadPath();
        if($return->result != 'ok')
        {
            $this->view->error = $return->error;
            die($this->display());
        }

        /* Check file exists or not. */
        if(file_exists($packageFile) and $overridePackage == 'no')
        {
            $overrideLink = inlink('install', "extension=$extension&downLink=$downLink&md5=$md5&type=$type&overridePackage=yes&ignoreCompatible=$ignoreCompatible&overrideFile=$overrideFile&agreeLicense=$agreeLicense&upgrade=$upgrade");
            $this->view->error = sprintf($this->lang->extension->errorPackageFileExists, $packageFile, $installType, $overrideLink);
            die($this->display());
        }

        /* Download the package file. */
        $this->extension->downloadPackage($extension, helper::safe64Decode($downLink));
        if(!file_exists($packageFile))
        {
            $this->view->error = sprintf($this->lang->extension->errorDownloadFailed, $packageFile);
            die($this->display());
        }
        elseif($md5 != '' and md5_file($packageFile) != $md5)
        {
            unlink($packageFile);
            $this->view->error = sprintf($this->lang->extension->errorMd5Checking, $packageFile);
            die($this->display());
        }
    }

    /**
     * Uninstall an extension.
     * 
     * @param  string    $extension 
     * @access public
     * @return void
     */
    public function uninstall($extension, $confirm = 'no')
    {
        /* Determine whether need to back up. */
        $dbFile = $this->extension->getDBFile($extension, 'uninstall');
        if($confirm == 'no' and file_exists($dbFile))
        {
            $this->view->title   = $this->lang->extension->waring;
            $this->view->confirm = 'no';
            $this->view->code    = $extension;
            die($this->display());
        }

        $dependsExts = $this->extension->checkDepends($extension);
        if($dependsExts)
        {
            $this->view->error = sprintf($this->lang->extension->errorUninstallDepends, join(' ', $dependsExts));
            die($this->display());
        }

        if($preUninstallHook = $this->extension->getHookFile($extension, 'preuninstall')) include $preUninstallHook;

        if(file_exists($dbFile)) $this->view->backupFile = $this->extension->backupDB($extension);

        $this->extension->executeDB($extension, 'uninstall');
        $this->extension->updateExtension($extension, array('status' => 'available'));
        $this->view->removeCommands = $this->extension->removePackage($extension);
        $this->view->title = $this->lang->extension->uninstallFinished;

        if($postUninstallHook = $this->extension->getHookFile($extension, 'postuninstall')) include $postUninstallHook;
        $this->display();
    }

    /**
     * Activate an extension;
     * 
     * @param  string    $extension 
     * @access public
     * @return void
     */
    public function activate($extension, $ignore = 'no')
    {
        if($ignore == 'no')
        {
            $return = $this->extension->checkFile($extension);
            if($return->result != 'ok')
            {
                $ignoreLink = inlink('activate', "extension=$extension&downLink=$downLink&md5=$md5&type=$type&ignore=yes");
                $resetLink  = inlink('browse', 'type=deactivated');
                $this->view->error = sprintf($this->lang->extension->errorFileConflicted, $return->error, $ignoreLink, $resetLink);
                die($this->display());
            }
        }

        $this->extension->copyPackageFiles($extension);
        $this->extension->updateExtension($extension, array('status' => 'installed'));
        $this->view->title      = $this->lang->extension->activateFinished;
        $this->view->position[] = $this->lang->extension->activateFinished;
        $this->display();
    }

    /**
     * Deactivate an extension
     * 
     * @param  string    $extension 
     * @access public
     * @return void
     */
    public function deactivate($extension)
    {
        $this->extension->updateExtension($extension, array('status' => 'deactivated'));
        $this->view->removeCommands = $this->extension->removePackage($extension);
        $this->view->title      = $this->lang->extension->deactivateFinished;
        $this->view->position[] = $this->lang->extension->deactivateFinished;
        $this->display();
    }

    /**
     * Upload an extension
     * 
     * @access public
     * @return void
     */
    public function upload()
    {
        if($_FILES)
        {
            $tmpName   = $_FILES['file']['tmp_name'];
            $fileName  = $_FILES['file']['name'];
            $extension = basename($fileName, '.zip');
            move_uploaded_file($tmpName, $this->app->getTmpRoot() . "/extension/$fileName");

            $info = $this->extension->getInfoFromDB($extension);
            $type = (!empty($info) and $info->status == 'installed') ? 'upgrade' : 'install';
            $link = $type == 'install' ? inlink('install', "extension=$extension") : inlink('upgrade', "extension=$extension");
            $this->send(array('result' => 'success', 'message' => $this->lang->extension->successUploadedPackage, 'locate' => $link));
        }

        $this->view->title = $this->lang->extension->upload;
        $this->display();
    }

    /**
     * Erase an extension.
     * 
     * @param  string    $extension 
     * @access public
     * @return void
     */
    public function erase($extension)
    {
        $this->view->removeCommands = $this->extension->erasePackage($extension);
        $this->view->title      = $this->lang->extension->eraseFinished;
        $this->view->position[] = $this->lang->extension->eraseFinished;
        $this->display();
    }

    /**
     * Update extension.
     * 
     * @param  string $extension 
     * @param  string $downLink 
     * @param  string $md5 
     * @param  string $type 
     * @access public
     * @return void
     */
    public function upgrade($extension, $downLink = '', $md5 = '', $type = '')
    {
        $this->extension->removePackage($extension);
        $this->locate(inlink('install', "extension=$extension&downLink=$downLink&md5=$md5&type=$type&overridePackage=no&ignoreCompatible=yes&overrideFile=no&agreeLicense=no&upgrade=yes"));
    }

    /**
     * Browse the structure of extension.
     * 
     * @param  int    $extension 
     * @access public
     * @return void
     */
    public function structure($extension)
    {
        $extension = $this->extension->getInfoFromDB($extension);
        $this->view->title = $extension->name . '[' . $extension->code . '] ' . $this->lang->extension->structure;
        $this->view->extension = $extension;
        $this->display();
    }
}
