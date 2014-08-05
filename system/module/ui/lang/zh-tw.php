<?php
/**
 * The ui module zh-tw file of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青島息壤網絡信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     http://api.chanzhi.org/goto.php?item=license
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     ui
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
$lang->ui->common       = "站點";

$lang->ui->logo            = 'Logo';
$lang->ui->setLogo         = "Logo設置";
$lang->ui->setTemplate     = '模板設置';
$lang->ui->installTemplate = '上傳模板';
$lang->ui->setTheme        = '主題設置';
$lang->ui->setFavicon      = "Favicon設置";
$lang->ui->setBaseStyle    = "全局樣式設置";

$lang->ui->noStyleTag        = "請填寫全局CSS樣式代碼，不需要&lt;style&gt;&lt;/style&gt;標籤";
$lang->ui->setLogoFailed     = "設置Logo失敗";
$lang->ui->noSelectedFile    = "沒有選擇圖片";
$lang->ui->notAlloweFileType = "請選擇正確的%s檔案.";
$lang->ui->suitableLogoSize  = '最佳高度範圍：50px~80px，最佳寬度範圍：80px~240px';

$lang->ui->favicon = new stdclass();
$lang->ui->favicon->help  = "幫助";

$lang->ui->template = new stdclass();
$lang->ui->template->name            = '名稱';
$lang->ui->template->version         = '版本';
$lang->ui->template->author          = '作者';
$lang->ui->template->charge          = '費用';
$lang->ui->template->chanzhiVersion  = '兼容版本';
$lang->ui->template->desc            = '簡介';
$lang->ui->template->theme           = '主題';
$lang->ui->template->license         = '版權';
$lang->ui->template->availableThemes = '<strong>%s</strong> 款可用主題';
$lang->ui->template->currentTheme    = '正在使用 <strong>%s</strong>';
$lang->ui->template->changeTheme     = '切換主題';
$lang->ui->template->apply           = '應用模板';
$lang->ui->template->current         = '當前模板';
$lang->ui->template->conflicts       = "警告！已有名為<strong> %s </strong> 的模板。";
$lang->ui->template->override        = "覆蓋並安裝";
$lang->ui->template->reupload        = "重新上傳";
$lang->ui->template->installSuccess  = '恭喜，模板上傳成功';
$lang->ui->template->manageTemplate  = '設置模板';
$lang->ui->template->manageBlock     = '設置區塊';
$lang->ui->template->enable          = '啟用';
$lang->ui->template->reload          = '刷新頁面';
$lang->ui->template->doInstall       = '確認安裝';
$lang->ui->template->info            = '模板信息';

$lang->ui->template->error = new stdclass();
$lang->ui->template->error->paths    = '目錄權限錯誤';
$lang->ui->template->error->exists   = "<p>目錄%s不存在</p>";
$lang->ui->template->error->writable = "<p>目錄%s不可寫</p>";

$lang->ui->template->commands = new stdclass();
$lang->ui->template->commands->execute  = '如果是Linux系統，請執行以下命令繼續';
$lang->ui->template->commands->exists   = "mkdir -p %s<br/>";
$lang->ui->template->commands->writable = "chmod 777 -R %s<br/>";
