<?php
/**
 * The ui module zh-cn file of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     http://api.chanzhi.org/goto.php?item=license
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     ui
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
$lang->ui->common       = "Site";

$lang->ui->logo            = 'Logo';
$lang->ui->setLogo         = "Set Logo";
$lang->ui->setTemplate     = 'Set Template';
$lang->ui->installTemplate = 'Upload Template';
$lang->ui->setTheme        = 'Set Theme';
$lang->ui->setFavicon      = "Set favicon";
$lang->ui->setBaseStyle    = "Set base style";

$lang->ui->noStyleTag        = "Please write base CSS file code, No &lt;style&gt;&lt;/style&gt; tag.";
$lang->ui->setLogoFailed     = "Set logo failed.";
$lang->ui->noSelectedFile    = "No file selected.";
$lang->ui->notAlloweFileType = "Please select %s files.";
$lang->ui->suitableLogoSize  = 'Suitable height: 50px~80p, width: 80px~240px';

$lang->ui->favicon = new stdclass();
$lang->ui->favicon->help  = "Help";

$lang->ui->template = new stdclass();
$lang->ui->template->name            = 'Name';
$lang->ui->template->version         = 'Version';
$lang->ui->template->author          = 'Author';
$lang->ui->template->charge          = 'Charge';
$lang->ui->template->chanzhiVersion  = 'Compatible version';
$lang->ui->template->desc            = 'Desc';
$lang->ui->template->theme           = 'Theme';
$lang->ui->template->license         = 'License';
$lang->ui->template->availableThemes = 'There are <strong>%s</strong> themes available.';
$lang->ui->template->currentTheme    = '<strong>%s</strong> is using';
$lang->ui->template->changeTheme     = 'Change theme';
$lang->ui->template->apply           = 'Apply template';
$lang->ui->template->current         = 'Current template';
$lang->ui->template->conflicts       = "Warning！Tempate <strong> %s </strong> already exists.";
$lang->ui->template->override        = "Override and install";
$lang->ui->template->reupload        = 'Reupload';
$lang->ui->template->installSuccess  = 'Template successfully uploaded';
$lang->ui->template->manageTemplate  = 'Manage template';
$lang->ui->template->manageBlock     = 'Manage blocks';
$lang->ui->template->enable          = 'Enable';
$lang->ui->template->reload          = 'Reload page';
$lang->ui->template->doInstall       = 'Do install';
$lang->ui->template->info            = 'Template info';

$lang->ui->template->error = new stdclass();
$lang->ui->template->error->paths    = 'Errors';
$lang->ui->template->error->exists   = "<p>Directory %s not exists/p>";
$lang->ui->template->error->writable = "<p>Directory %s is unwritable</p>";

$lang->ui->template->commands = new stdclass();
$lang->ui->template->commands->execute  = 'Resolve with this commands in Linux OS';
$lang->ui->template->commands->exists   = "mkdir -p %s<br/>";
$lang->ui->template->commands->writable = "chmod 777 -R %s<br/>";
