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

$lang->ui->customtheme                     = 'Custom theme';
$lang->ui->custom                          = 'Custom...';
$lang->ui->themeSaved                      = 'Theme settings saved.';
$lang->ui->theme = new stdclass();
$lang->ui->theme->ajustColor                           = 'Adjust Color';
$lang->ui->theme->light                                = 'Light';
$lang->ui->theme->lightAjustList['-25%']               = '-25%';
$lang->ui->theme->lightAjustList['-20%']               = '-20%';
$lang->ui->theme->lightAjustList['-15%']               = '-15%';
$lang->ui->theme->lightAjustList['-12%']               = '-12%';
$lang->ui->theme->lightAjustList['-10%']               = '-10%';
$lang->ui->theme->lightAjustList['-8%']                = '-8%';
$lang->ui->theme->lightAjustList['-5%']                = '-5%';
$lang->ui->theme->lightAjustList['-2%']                = '-2%';
$lang->ui->theme->lightAjustList['0%']                 = '0%';
$lang->ui->theme->lightAjustList['2%']                 = '+2%';
$lang->ui->theme->lightAjustList['5%']                 = '+5%';
$lang->ui->theme->lightAjustList['8%']                 = '+8%';
$lang->ui->theme->lightAjustList['10%']                = '+10%';
$lang->ui->theme->lightAjustList['12%']                = '+12%';
$lang->ui->theme->lightAjustList['15%']                = '+15%';
$lang->ui->theme->lightAjustList['20%']                = '+20%';
$lang->ui->theme->lightAjustList['25%']                = '+25%';
$lang->ui->theme->colorset                             = 'Set Color';
$lang->ui->theme->primaryColor                         = 'Color';
$lang->ui->theme->backColor                            = 'Background';
$lang->ui->theme->foreColor                            = 'Foreground';
$lang->ui->theme->secondaryColor                       = 'Secondary';
$lang->ui->theme->basicStyle                           = 'Basic Style';
$lang->ui->theme->layout                               = 'Layout';
$lang->ui->theme->head                                 = 'Head';
$lang->ui->theme->body                                 = 'Body';
$lang->ui->theme->padding                              = 'Padding';
$lang->ui->theme->size                                 = 'Size';
$lang->ui->theme->sizeTip                              = 'The default unit is pixels, such as 1px';
$lang->ui->theme->horizontal                           = 'Horizontal';
$lang->ui->theme->vertical                             = 'Vertical';
$lang->ui->theme->content                              = 'Content';
$lang->ui->theme->foot                                 = 'Foot';
$lang->ui->theme->none                                 = 'None';
$lang->ui->theme->colorTip                             = 'Such as: red or #FFF';
$lang->ui->theme->color                                = 'Color';
$lang->ui->theme->transparent                          = 'Transparent';
$lang->ui->theme->width                                = 'Width';
$lang->ui->theme->radius                               = 'Radius';
$lang->ui->theme->border                               = 'Border';
$lang->ui->theme->borderStyle                          = 'Border Style';
$lang->ui->theme->borderStyleList['none']              = 'No Border';
$lang->ui->theme->borderStyleList['solid']             = 'Solid';
$lang->ui->theme->borderStyleList['dashed']            = 'Dashed';
$lang->ui->theme->borderStyleList['dotted']            = 'Dotted';
$lang->ui->theme->borderStyleList['double']            = 'Double';
$lang->ui->theme->image                                = 'Image';
$lang->ui->theme->imageRepeat                          = 'Image Repeat';
$lang->ui->theme->imageRepeatList['repeat']            = 'Default';
$lang->ui->theme->imageRepeatList['repeat']            = 'Repeat';
$lang->ui->theme->imageRepeatList['repeat-x']          = 'Repeat-X';
$lang->ui->theme->imageRepeatList['repeat-y']          = 'Repeat-Y';
$lang->ui->theme->imageRepeatList['no-repeat']         = 'No Repeat';
$lang->ui->theme->position                             = 'Positon';
$lang->ui->theme->positionTip                          = 'Such as: 100px, 50%, left, top, center';
$lang->ui->theme->positionX                            = 'Position-X';
$lang->ui->theme->positionY                            = 'Position-Y';
$lang->ui->theme->background                           = 'Background';
$lang->ui->theme->pageBackground                       = 'Page Background';
$lang->ui->theme->backImage                            = 'Background Image';
$lang->ui->theme->backImageTip                         = 'Image URL: image.jpg';
$lang->ui->theme->text                                 = 'Text';
$lang->ui->theme->textStyle                            = 'Text Style';
$lang->ui->theme->pageText                             = 'Page Text';
$lang->ui->theme->font                                 = 'Font';
$lang->ui->theme->fontWeight                           = 'Font Weight';
$lang->ui->theme->fontWeightList['inherit']            = 'Default';
$lang->ui->theme->fontWeightList['normal']             = 'Normal';
$lang->ui->theme->fontWeightList['bold']               = 'Bold';
$lang->ui->theme->fontSize                             = 'Font Size';
$lang->ui->theme->fontList['inherit']                  = 'Default';
$lang->ui->theme->fontList['"宋体"']                   = '宋体';
$lang->ui->theme->fontList['"仿宋"']                   = '仿宋';
$lang->ui->theme->fontList['"黑体"']                   = '黑体';
$lang->ui->theme->fontList['"微软雅黑"']               = '微软雅黑';
$lang->ui->theme->fontList['Arial']                    = 'Arial';
$lang->ui->theme->fontList['"Times New Roman"']        = 'Times New Roman';
$lang->ui->theme->fontList['Courier']                  = 'Courier';
$lang->ui->theme->fontList['Console']                  = 'Console';
$lang->ui->theme->fontList['Tahoma']                   = 'Tahoma';
$lang->ui->theme->fontList['Verdana']                  = 'Verdana';
$lang->ui->theme->fontList['ZenIcon']                  = '图标字体 ZenIcon';
$lang->ui->theme->borderRadius                         = 'Radius';
$lang->ui->theme->colorPlates                          = '#333333|#000000|#CA1407|#45872B|#148D00|#F25D03|#2286D2|#D92958|#A63268|#04BFAD|#D1270A|#FF9400|#299182|#63731A|#3D4DBE|#7382D9|#754FB9|#F2E205|#B1C502|#364245|#C05036|#8A342A|#E0DDA2|#B3D465|#EEEEEE|#FFD0E5|#D0FFFD|#FFFF84|#F4E6AE|#E5E5E5|#F1F1F1|#FFFFFF|transparent';

$lang->ui->theme->fontSizeList['inherit'] = 'Default';
$lang->ui->theme->fontSizeList['12px']    = '12px';
$lang->ui->theme->fontSizeList['13px']    = '13px';
$lang->ui->theme->fontSizeList['14px']    = '14px';
$lang->ui->theme->fontSizeList['15px']    = '15px';
$lang->ui->theme->fontSizeList['16px']    = '16px';
$lang->ui->theme->fontSizeList['18px']    = '18px';
$lang->ui->theme->fontSizeList['20px']    = '20px';
$lang->ui->theme->fontSizeList['24px']    = '24px';

$lang->ui->theme->hover                                = 'Hover';
$lang->ui->theme->active                               = 'Active';
$lang->ui->theme->normal                               = 'Normal';

$lang->ui->theme->linkStyle                            = 'Link Style';

$lang->ui->theme->navbarStyle                          = 'Navbar Style';
$lang->ui->theme->navbar                               = 'Navbar';
$lang->ui->theme->navbarLayoutTip                      = '自适应宽度类型中导航项目将自动改变宽度填充整个导航';
$lang->ui->theme->navbarLayoutList['false']            = 'Normal';
$lang->ui->theme->navbarLayoutList['true']             = 'Adaptive Width';
$lang->ui->theme->navbarBackground                     = 'Navbar Backgound';
$lang->ui->theme->navbarBorder                         = 'Navbar Border';
$lang->ui->theme->navbarText                           = 'Navbar Text';
$lang->ui->theme->navbarItem                           = 'Navbar Item';
$lang->ui->theme->navbarItemText                       = 'Navbar Item Text';
$lang->ui->theme->navbarItemBackground                 = 'Navbar Item Background';
$lang->ui->theme->navbarItemBorder                     = 'Navbar Item Border';

$lang->ui->theme->panelStyle                           = 'Block Style';
$lang->ui->theme->panelBackground                      = 'Block Background';
$lang->ui->theme->panelHeadBackground                  = 'Block Head Background';
$lang->ui->theme->panelHeadText                        = 'Block Head Text';
$lang->ui->theme->panelHeadIcon                        = 'Block Head Icon';
$lang->ui->theme->panelLink                            = 'Block Link';

$lang->ui->theme->buttonStyle                          = 'Button Style';
$lang->ui->theme->buttonNormal                         = 'Normal';
$lang->ui->theme->buttonPrimary                        = 'Primary';
$lang->ui->theme->buttonInfo                           = 'Info';
$lang->ui->theme->buttonDanger                         = 'Danger';
$lang->ui->theme->buttonWarning                        = 'Warning';
$lang->ui->theme->buttonSuccess                        = 'Success';

$lang->ui->theme->columnStyle                          = 'Column Style';
$lang->ui->theme->sidebar                              = 'Sidebar';
$lang->ui->theme->maincol                              = 'Main Column';
$lang->ui->theme->sidebarPositionInverse               = 'Sidebar Position Inverse';
$lang->ui->theme->sidebarPullLeftList['false']         = 'Right';
$lang->ui->theme->sidebarPullLeftList['true']          = 'Left';
$lang->ui->theme->sidebarWidth                         = 'Sidebar Width';
$lang->ui->theme->sidebarWidthList["16.666666666667%"] = "1/6";
$lang->ui->theme->sidebarWidthList["25%"]              = "1/4";
$lang->ui->theme->sidebarWidthList["33.333333333333%"] = "1/3";
$lang->ui->theme->sidebarWidthList["50%"]              = "1/2";
$lang->ui->theme->sidebarPosition                      = 'Sidebar Position';
$lang->ui->theme->maincolText                          = 'Main Column Text';
$lang->ui->theme->maincolBorder                        = 'Main Column Border';
$lang->ui->theme->maincolHeadBackground                = 'Main Column Head Background';
$lang->ui->theme->maincolHeadText                      = 'Main Column Head Text';
$lang->ui->theme->maincolBackground                    = 'Main Column Background';
$lang->ui->theme->maincolHeadIcon                      = 'Main Column Head Icon';
$lang->ui->theme->sidebarText                          = 'Sidebar Text';
$lang->ui->theme->sidebarBorder                        = 'Sidebar Border';
$lang->ui->theme->sidebarHeadBackground                = 'Sidebar Head Background';
$lang->ui->theme->sidebarHeadText                      = 'Sidebar Head Text';
$lang->ui->theme->sidebarBackground                    = 'Sidebar Background';
$lang->ui->theme->sidebarHeadIcon                      = 'Sidebar Head Icon';

$lang->ui->theme->formStyle                            = 'Form Style';

$lang->ui->theme->customStyle                          = 'Custom Style';
$lang->ui->theme->customStylesheet                     = 'Custom Stylesheet';
$lang->ui->theme->customStylesheetTip                  = 'Support Less and CSS';
$lang->ui->theme->lessVariables                        = 'Less Variables';
$lang->ui->theme->lessVariablesUnuseable               = 'Less variable is not available.';
$lang->ui->theme->lessVariablesName                    = 'Name';
$lang->ui->theme->lessVariablesValue                   = 'Value';
$lang->ui->theme->lessVariablesDesc                    = 'Description';

$lang->ui->theme->tableStyle                           = 'Table Style';
$lang->ui->theme->statusColor                          = 'Status Color';
$lang->ui->theme->tableHoverColor                      = 'Table Hover Color';
$lang->ui->theme->tableStripedColor                    = 'Table Striped Color';

$lang->ui->theme->components                           = 'Components';
$lang->ui->theme->breadcrumb                           = 'Breadcrumb';
$lang->ui->theme->footer                               = 'Footer';

$lang->ui->theme->underlineList['none']                = 'None';
$lang->ui->theme->underlineList['underline']           = 'Underline';

$lang->ui->groups = new stdclass();
$lang->ui->groups->basic  = 'Basic Style';
$lang->ui->groups->navbar = 'Navbar';
$lang->ui->groups->block  = 'Block';
$lang->ui->groups->button = 'Button';
$lang->ui->groups->footer = 'Footer';

$lang->ui->color          = 'Color';
$lang->ui->colorset       = 'Set Color';
$lang->ui->pageBackground = 'Page Background';
$lang->ui->pageText       = 'Page Text';
$lang->ui->aLink          = 'Normal Link';
$lang->ui->aVisited       = 'Visited Link';
$lang->ui->aHover         = 'Hover Link';
$lang->ui->underline      = 'Underline';

$lang->ui->layout        = 'Layout';
$lang->ui->navbar        = 'Navbar';
$lang->ui->panel         = 'Panel';
$lang->ui->menuBorder    = 'Menu Border';
$lang->ui->submenuBorder = 'Submenu Border';
$lang->ui->menuNormal    = 'Normal menu';
$lang->ui->menuHover     = 'Hover menu';
$lang->ui->menuActive    = 'Active menu';
$lang->ui->submenuNormal = 'Normal submenu';
$lang->ui->submenuHover  = 'Hover submenu';
$lang->ui->submenuActive = 'Active submenu';
$lang->ui->heading       = 'Heading';
$lang->ui->body          = 'Body';
$lang->ui->background    = 'Background';
$lang->ui->button        = 'Button';
$lang->ui->text          = 'Text';
$lang->ui->column        = 'Column';
$lang->ui->sidebarLayout = 'Sidebar Layout';
$lang->ui->sidebarWidth  = 'Sidebar Width';

$lang->ui->primaryColor    = 'Color';
$lang->ui->backcolor       = 'Background';
$lang->ui->forecolor       = 'Foreground';
$lang->ui->backgroundImage = 'Background Image';
$lang->ui->repeat          = 'Repeat';
$lang->ui->position        = 'Position';
$lang->ui->style           = 'Style';
$lang->ui->fontSize        = 'Font Size';
$lang->ui->fontFamily      = 'Font Family';
$lang->ui->fontWeight      = 'Font Weight';
$lang->ui->layout          = 'Layout';
$lang->ui->border          = 'Border';
$lang->ui->borderColor     = 'Border Color';
$lang->ui->borderWidth     = 'Border Width';
$lang->ui->width           = 'width';
$lang->ui->radius          = 'Radius';
$lang->ui->linkColor       = 'Link Color';
$lang->ui->default         = 'Default';
$lang->ui->primary         = 'Primary';
$lang->ui->info            = 'Info';
$lang->ui->danger          = 'Danger';
$lang->ui->warning         = 'Warning';
$lang->ui->success         = 'Success';
