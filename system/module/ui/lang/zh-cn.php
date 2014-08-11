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
$lang->ui->common       = "站点";

$lang->ui->logo            = 'Logo';
$lang->ui->setLogo         = "Logo设置";
$lang->ui->setTemplate     = '模板设置';
$lang->ui->installTemplate = '上传模板';
$lang->ui->setTheme        = '主题设置';
$lang->ui->setFavicon      = "Favicon设置";
$lang->ui->setBaseStyle    = "全局样式设置";

$lang->ui->noStyleTag        = "请填写全局CSS样式代码，不需要&lt;style&gt;&lt;/style&gt;标签";
$lang->ui->setLogoFailed     = "设置Logo失败";
$lang->ui->noSelectedFile    = "没有选择图片";
$lang->ui->notAlloweFileType = "请选择正确的%s文件.";
$lang->ui->suitableLogoSize  = '最佳高度范围：50px~80px，最佳宽度范围：80px~240px';

$lang->ui->favicon = new stdclass();
$lang->ui->favicon->help  = "帮助";

$lang->ui->template = new stdclass();
$lang->ui->template->name            = '名称';
$lang->ui->template->version         = '版本';
$lang->ui->template->author          = '作者';
$lang->ui->template->charge          = '费用';
$lang->ui->template->chanzhiVersion  = '兼容版本';
$lang->ui->template->desc            = '简介';
$lang->ui->template->theme           = '主题';
$lang->ui->template->license         = '版权';
$lang->ui->template->availableThemes = '<strong>%s</strong> 款可用主题';
$lang->ui->template->currentTheme    = '正在使用 <strong>%s</strong>';
$lang->ui->template->changeTheme     = '切换主题';
$lang->ui->template->apply           = '应用模板';
$lang->ui->template->current         = '当前模板';
$lang->ui->template->conflicts       = "警告！已有名为<strong> %s </strong> 的模板。";
$lang->ui->template->override        = "覆盖并安装";
$lang->ui->template->reupload        = "重新上传";
$lang->ui->template->installSuccess  = '恭喜，模板上传成功';
$lang->ui->template->manageTemplate  = '设置模板';
$lang->ui->template->manageBlock     = '设置区块';
$lang->ui->template->enable          = '启用';
$lang->ui->template->reload          = '刷新页面';
$lang->ui->template->doInstall       = '确认安装';
$lang->ui->template->info            = '模板信息';

$lang->ui->template->error = new stdclass();
$lang->ui->template->error->paths    = '目录权限错误';
$lang->ui->template->error->exists   = "<p>目录%s不存在</p>";
$lang->ui->template->error->writable = "<p>目录%s不可写</p>";

$lang->ui->template->commands = new stdclass();
$lang->ui->template->commands->execute  = '如果是Linux系统，请执行以下命令继续';
$lang->ui->template->commands->exists   = "mkdir -p %s<br/>";
$lang->ui->template->commands->writable = "chmod 777 -R %s<br/>"; 

$lang->ui->customtheme                     = '自定义主题';
$lang->ui->custom                          = '自定义…';
$lang->ui->themeSaved                      = '主题配置已保存';
$lang->ui->theme = new stdclass();
$lang->ui->theme->primaryColor             = '基色';
$lang->ui->theme->backColor                = '背景';
$lang->ui->theme->fontSize                 = '字体';
$lang->ui->theme->borderRadius             = '圆角';
$lang->ui->theme->colorPlates              = '333333|000000|CA1407|45872B|148D00|F25D03|2286D2|D92958|A63268|04BFAD|D1270A|FF9400|299182|63731A|3D4DBE|7382D9|754FB9|F2E205|B1C502|364245|C05036|8A342A|E0DDA2|B3D465|EEEEEE|FFD0E5|D0FFFD|FFFF84|F4E6AE|E5E5E5|F1F1F1|FFFFFF';
$lang->ui->theme->fontSizeList['12px']     = '12px';
$lang->ui->theme->fontSizeList['13px']     = '13px';
$lang->ui->theme->fontSizeList['14px']     = '14px (默认)';
$lang->ui->theme->fontSizeList['15px']     = '15px';
$lang->ui->theme->fontSizeList['16px']     = '16px';
$lang->ui->theme->borderRadiusList['0']    = '0px';
$lang->ui->theme->borderRadiusList['2px']  = '2px';
$lang->ui->theme->borderRadiusList['4px']  = '4px (默认)';
$lang->ui->theme->borderRadiusList['5px']  = '5px';
$lang->ui->theme->borderRadiusList['6px']  = '6px';
$lang->ui->theme->borderRadiusList['8px']  = '8px';
$lang->ui->theme->borderRadiusList['12px'] = '12px';
$lang->ui->theme->borderRadiusList['16px'] = '16px';
$lang->ui->theme->borderRadiusList['20px'] = '20px';
