<?php
/**
 * The site module en file of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1 (http://www.chanzhi.org/license/)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     site
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */

$lang->visual->common  = "Visible Edit";

$lang->visual->info              = "Edit Mode";
$lang->visual->preview           = "Preview";
$lang->visual->exit              = "Exit";
$lang->visual->exitVisualEdit    = "Exit Visible Edit";
$lang->visual->customTheme       = "Custom Theme";
$lang->visual->admin             = "Admin";
$lang->visual->reload            = 'Reload';
$lang->visual->openInNewWindow   = 'Open in A New Window';

$lang->visual->jsLang = new stdclass();
$lang->visual->jsLang->saved              = $lang->saveSuccess;
$lang->visual->jsLang->deleted            = $lang->deleteSuccess;
$lang->visual->jsLang->preview            = 'Preview';
$lang->visual->jsLang->exitPreview        = 'Exit Preview';
$lang->visual->jsLang->removeBlock        = 'Remove Block';
$lang->visual->jsLang->invisible          = 'Invisible';
$lang->visual->jsLang->carousel           = 'Carousel';
$lang->visual->jsLang->operateFail        = 'Failed';
$lang->visual->jsLang->addBlock           = 'Add Block';
$lang->visual->jsLang->addSubRegion       = 'Add Region Block';
$lang->visual->jsLang->addSubBlock        = 'Add Sub Block';
$lang->visual->jsLang->subRegion          = 'Region Block';
$lang->visual->jsLang->alreadyLastSlide   = 'Already Last Slide';
$lang->visual->jsLang->alreadyFirstSlide  = 'Already First Slide';
$lang->visual->jsLang->slideOrder         = 'Playing Order';
$lang->visual->jsLang->gridWidth          = 'Grid Width';
$lang->visual->jsLang->actions            = array('edit' => 'Edit', 'delete' => 'Delete', 'move' => 'Move', 'add' => 'Add');

$lang->visual->config                   = new stdclass();
$lang->visual->config->logo             = array('name' => "Logo/Name",    'width' => 900, 'module' => 'visual', 'method' => 'editlogo');
$lang->visual->config->slogan           = array('name' => "Slogan",       'width' => 700, 'module' => 'visual', 'method' => 'editslogan');
$lang->visual->config->powerby          = array('name' => "Chanzhi Logo", 'title' => 'Remove Chanzhi Logo', 'width' => 600, 'actions' => array('edit' => array('icon' => 'info-sign', 'text' => 'Remove Chanzhi Logo', 'module' => 'visual', 'method' => 'editpowerby')));
$lang->visual->config->company        = array('name' => "Company Information", 'width' => 900, 'actions' => array('edit' => array('text'   => 'Edit Company Information', 'method' => 'setbasic', 'params' => 'display=content')));
$lang->visual->config->companyName    = array('name' => "Company Name",        'width' => 900, 'actions' => array('edit' => array('module' => 'company', 'method' => 'setbasic', 'params' => 'display=name')));
$lang->visual->config->companyDesc    = array('name' => "Company Profiles",    'width' => 900, 'actions' => array('edit' => array('module' => 'company', 'method' => 'setbasic', 'params' => 'display=desc')));
$lang->visual->config->companyContact = array('name' => "Contact Information", 'width' => 900, 'actions' => array('edit' => array('module' => 'company', 'method' => 'setcontact')));
$lang->visual->config->links    = array('name'   => "Friendship Chain",        'width' => 900, 'actions' => array('edit' => array('module' => 'links', 'method' => 'admin')));
$lang->visual->config->navbar   = array('name'   => "Navigation", 'width' => 1200, 'params' => 'type={type}', 'module' => 'nav', 'actions' => array('edit' => array('method' => 'admin')));
$lang->visual->config->carousel = array('hidden' => 'true',     'module' => 'slide', 'actions' => array('edit' => false),
                                        'groupActions' => array('add'    => array('icon' => 'plus',        'text' => 'Add One Slide', 'method' => 'create', 'params' => 'groupID={id}')),
                                        'itemActions'  => array('edit'   => array('icon' => 'pencil',      'text' => 'Edit',    'title' => 'Edit Slides', 'method' => 'edit',     'params' => 'id={id}'),
                                                                'delete' => array('icon' => 'remove',      'text' => 'Remove', 'method' => 'delete',      'params' => 'id={id}', 'confirm' => 'Are you sure to delete this slide?'),
                                                                'up'     => array('icon' => 'arrow-left',  'text' => 'Playing Order in Advance for {0}',  'method' => 'sort'),
                                                                'down'   => array('icon' => 'arrow-right', 'text' => 'Playing Order Delay to {0}',        'method' => 'sort')
                                      ));
$lang->visual->config->block    = array('name' => "Block", 'width' => 1200, 'params' => 'blockID={id}', 'module' => 'visual', 'actions' => array(
    'edit'    => array('module' => 'block'),
    'delete'  => array('method' => 'removeBlock', 'confirm' => 'Are you sure to delete {title}？', 'success' => 'Removed{title}.', 'params' => 'blockID={id}&page={page}&region={region}'),
    'move'    => array('method' => 'sortblocks',  'success' => 'Saved Order', 'params' => 'page={page}&region={region}&pagent={parent}'),
    'layout'  => array('method' => 'fixblock',      'width' => 600, 'text' => 'Change Layout', 'icon' => 'columns', 'success' => 'Saved Region', 'params' => 'page={page}&region={region}&blockID={id}'),
    'add'     => array('method' => 'appendBlock',  'params' => 'page={page}&region={region}&parent={parent}', 'hidden' => true, 'width' => 1000, 'title' => 'Add Block{title}')
));
$lang->visual->config->article  = array('params'  => 'articleID={id}', 'name' => 'Article',
                                        'actions' => array('delete' => true, 'edit' => array('params' => 'articleID={id}&type=article')));
$lang->visual->config->articles = array('name'    => 'Article List', 'module' => 'article', 'hidden' => true,
                                        'actions' => array('edit' => false, 'add' => array('text' => 'Publish New Article', 'icon' => 'plus', 'method' => 'create', "params" => 'type=article', 'onDismiss' => 'reload')));
$lang->visual->config->page  = array('params' => 'articleID={id}', 'module' => 'article', 'name' => 'Page',
    'actions' => array('delete' => true, 'edit' => array('params' => 'pageID={id}&type=page')));
$lang->visual->config->pageList = array('name' => 'Page List', 'module' => 'page', 'hidden' => true,
    'actions' => array('edit' => false, 'add' => array('text' => 'Publish New Page', 'icon' => 'plus', 'method' => 'create', "params" => 'type=page')));
$lang->visual->config->blog     = array('params' => 'articleID={id}', 'module' => 'article', 'name' => 'Blog',
    'actions' => array('delete' => true, 'edit' => array('params' => 'articleID={id}&type=blog')));
$lang->visual->config->blogList = array('name' => 'Blog List', 'module' => 'article', 'hidden' => true,
    'actions' => array('edit' => false, 'add' => array('text' => 'Publish New Blog', 'icon' => 'plus', 'method' => 'create', "params" => 'type=blog')));
$lang->visual->config->product  = array('params' => 'productID={id}', 'name' => 'Product',
    'actions' => array('delete' => true, 'edit' => 'true'));
$lang->visual->config->products = array('name' => 'Product List', 'module' => 'product', 'hidden' => true,
    'actions' => array('edit' => false, 'add' => array('text' => 'Publish New Product', 'icon' => 'plus', 'method' => 'create', "params" => 'category=0', 'onDismiss' => 'reload')));
$lang->visual->config->books    = array('name' => 'Book List', 'module' => 'book', 'hidden' => true,
    'actions' => array('edit' => false, 'add' => array('text' => 'Add Book', 'icon' => 'plus', 'method' => 'create', 'onDismiss' => 'reload')));
$lang->visual->config->bookCatalog = array('name' => "Book Catalogue", 'width' => 1200, 'params' => 'bookID={id}', 'module' => 'book',
    'actions' => array('edit' => array('method' => 'admin', 'onDismiss' => 'update')));
$lang->visual->config->book = array('name' => "Book", 'width' => 1200, 'params' => 'nodeID={id}',
    'actions' => array('edit' => true));
$lang->visual->config->boards = array('name' => 'Forum Board', 'hidden' => true,
    'actions' => array('edit' => false, 'add' => array('text' => 'Board Management', 'icon' => 'sitemap', 'module' => 'tree', 'method' => 'browse', 'params' => 'type=forum', 'onDismiss' => 'update')));
$lang->visual->config->thread = array('name' => 'Thread', 'params' => 'treadID={id}',
    'actions' => array('edit' => array('width' => 600, 'text' => 'Transfer', 'icon' => 'location-arrow',  'method' => 'transfer', 'onDismiss' => 'reload'), 'delete' => true));

$lang->visual->editpowerbycontent = "<p>ChanzhiEPS is open-source and free, but according to our <a href='http://www.chanzhi.org/book/chanzhieps/58_license.html' target='_blank'>license agreement</a>, if you want to remove chanzhi logo, you have to buy our business authorization. </p><p>Chanzhi logo will not affect site function，we suggest keeping it. </p><hr><div class='text-center'><a class='btn btn-success' href='http://www.chanzhi.org/vip/25_vip-support.html' target='_blank'> Learn more about chanzhi business services and authorization <i class='icon-arrow-right'></i></a></div>";

