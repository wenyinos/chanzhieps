<?php
/**
 * The all avaliabe actions in ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1 (http://www.chanzhi.org/license/)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     group
 * @version     $Id$
 * @link        http://www.zentao.net
 */

/* Module order. */
$lang->moduleOrder[0]   = 'admin';

$lang->moduleOrder[5]   = 'article';

$lang->moduleOrder[10]  = 'product';

$lang->moduleOrder[15]  = 'book';

$lang->moduleOrder[20]  = 'forum';
$lang->moduleOrder[25]  = 'reply';
$lang->moduleOrder[30]  = 'thread';

$lang->moduleOrder[35]  = 'site';
$lang->moduleOrder[40]  = 'nav';
$lang->moduleOrder[45]  = 'tag';
$lang->moduleOrder[50]  = 'links';
$lang->moduleOrder[55]  = 'mail';
$lang->moduleOrder[60]  = 'wechat';
$lang->moduleOrder[65]  = 'group';

$lang->moduleOrder[70]  = 'ui';
$lang->moduleOrder[75]  = 'slide';
$lang->moduleOrder[80]  = 'block';

$lang->moduleOrder[85]  = 'company';

$lang->moduleOrder[90]  = 'user';

$lang->moduleOrder[95]  = 'message';

$lang->moduleOrder[100] = 'package';

$lang->moduleOrder[105] = 'tree';
$lang->moduleOrder[110] = 'file';

$lang->moduleOrder[115] = 'search';

$lang->moduleOrder[120] = 'order';

$lang->resource = new stdclass();

/* Admin module. */
$lang->resource->admin = new stdclass();
$lang->resource->admin->ignore        = 'ignore';
$lang->resource->admin->ignoreupgrade = 'ignoreupgrade';

/* Article module. */
$lang->resource->article = new stdclass();
$lang->resource->article->admin  = 'admin';
$lang->resource->article->create = 'create';
$lang->resource->article->edit   = 'edit';
$lang->resource->article->delete = 'delete';
$lang->resource->article->setcss = 'setcss';
$lang->resource->article->setjs  = 'setjs';
$lang->resource->article->stick  = 'stick';

/* Block module. */
$lang->resource->block = new stdclass();
$lang->resource->block->admin     = 'admin';
$lang->resource->block->pages     = 'pages';
$lang->resource->block->setregion = 'setregion';
$lang->resource->block->create    = 'create';
$lang->resource->block->edit      = 'edit';
$lang->resource->block->delete    = 'delete';

/* Book module. */
$lang->resource->book = new stdclass();
$lang->resource->book->admin     = 'admin';
$lang->resource->book->catalog   = 'catalog';
$lang->resource->book->create    = 'create';
$lang->resource->book->edit      = 'edit';
$lang->resource->book->sort      = 'sort';
$lang->resource->book->delete    = 'delete';

/* Company module. */
$lang->resource->company = new stdclass();
$lang->resource->company->setbasic   = 'setBasic';
$lang->resource->company->setcontact = 'setContact';

/* File module. */
$lang->resource->file = new stdclass();
$lang->resource->file->browse       = 'browse';
$lang->resource->file->setPrimary   = 'setPrimary';
$lang->resource->file->upload       = 'upload';
$lang->resource->file->download     = 'download';
$lang->resource->file->edit         = 'edit';
$lang->resource->file->sort         = 'sort';
$lang->resource->file->fileManager  = 'fileManager';
$lang->resource->file->delete       = 'delete';
$lang->resource->file->sourceBrowse = 'sourceList';
$lang->resource->file->sourceDelete = 'sourceDelete';
$lang->resource->file->sourceEdit   = 'sourceEdit';
$lang->resource->file->selectImage  = 'selectImage';

/* Forum module. */
$lang->resource->forum = new stdclass();
$lang->resource->forum->admin  = 'admin';
$lang->resource->forum->update = 'update';

/* Group module. */
$lang->resource->group = new stdclass();
$lang->resource->group->browse       = 'browse';
$lang->resource->group->create       = 'create';
$lang->resource->group->edit         = 'edit';
$lang->resource->group->copy         = 'copy';
$lang->resource->group->delete       = 'delete';
$lang->resource->group->managePriv   = 'managePrivByGroup';
$lang->resource->group->manageMember = 'manageMember';

/* Link module. */
$lang->resource->links = new stdclass();
$lang->resource->links->admin  = 'admin';

/* Mail module. */
$lang->resource->mail = new stdclass();
$lang->resource->mail->admin  = 'index';
$lang->resource->mail->detect = 'detect';
$lang->resource->mail->edit   = 'edit';
$lang->resource->mail->save   = 'save';
$lang->resource->mail->test   = 'test';
$lang->resource->mail->reset  = 'reset';

/* Message module. */
$lang->resource->message = new stdclass();
$lang->resource->message->admin  = 'admin';
$lang->resource->message->reply  = 'reply';
$lang->resource->message->pass   = 'pass';
$lang->resource->message->delete = 'delete';

/* Nav module. */
$lang->resource->nav = new stdclass();
$lang->resource->nav->admin  = 'common';

/* Package module. */
$lang->resource->package = new stdclass();
$lang->resource->package->browse     = 'browse';
$lang->resource->package->obtain     = 'obtain';
$lang->resource->package->install    = 'install';
$lang->resource->package->uninstall  = 'uninstall';
$lang->resource->package->activate   = 'activate';
$lang->resource->package->deactivate = 'deactivate';
$lang->resource->package->upload     = 'upload';
$lang->resource->package->erase      = 'erase';
$lang->resource->package->upgrade    = 'upgrade';
$lang->resource->package->structure  = 'structure';

/* Product module. */
$lang->resource->product = new stdclass();
$lang->resource->product->admin        = 'admin';
$lang->resource->product->create       = 'create';
$lang->resource->product->edit         = 'edit';
$lang->resource->product->changeStatus = 'changeStatus';
$lang->resource->product->setting      = 'setting';
$lang->resource->product->delete       = 'delete';
$lang->resource->product->setcss       = 'setcss';
$lang->resource->product->setjs        = 'setjs';

/* Reply module. */
$lang->resource->reply = new stdclass();
$lang->resource->reply->admin      = 'admin';
$lang->resource->reply->edit       = 'edit';
$lang->resource->reply->delete     = 'delete';
$lang->resource->reply->deleteFile = 'deleteFile';

/* Site module. */
$lang->resource->site = new stdclass();
$lang->resource->site->setBasic     = 'setBasic';
$lang->resource->site->setRobots    = 'setRobots';
$lang->resource->site->setUpload    = 'setUpload';
$lang->resource->site->setOauth     = 'setOauth';
$lang->resource->site->setsecurity  = 'setsecurity';
$lang->resource->site->setsensitive = 'setsensitive';

/* Slide module. */
$lang->resource->slide = new stdclass();
$lang->resource->slide->admin  = 'admin';
$lang->resource->slide->create = 'create';
$lang->resource->slide->edit   = 'edit';
$lang->resource->slide->delete = 'delete';
$lang->resource->slide->sort   = 'sort';

/* Tag module. */
$lang->resource->tag = new stdclass();
$lang->resource->tag->admin = 'admin';
$lang->resource->tag->link  = 'link';

/* Thread module. */
$lang->resource->thread = new stdclass();
$lang->resource->thread->transfer     = 'transfer';
$lang->resource->thread->switchStatus = 'switchStatus';
$lang->resource->thread->delete       = 'delete';
$lang->resource->thread->deleteFile   = 'deleteFile';

/* Tree module. */
$lang->resource->tree = new stdclass();
$lang->resource->tree->browse   = 'browse';
$lang->resource->tree->edit     = 'edit';
$lang->resource->tree->children = 'children';
$lang->resource->tree->delete   = 'delete';
$lang->resource->tree->redirect = 'redirect';

/* Ui module. */
$lang->resource->ui = new stdclass();
$lang->resource->ui->setTemplate   = 'setTemplate';
$lang->resource->ui->customTheme   = 'customTheme';
$lang->resource->ui->setLogo       = 'setLogo';
$lang->resource->ui->setFavicon    = 'setFavicon';
$lang->resource->ui->deleteFavicon = 'deleteFavicon';
$lang->resource->ui->deleteLogo    = 'deleteLogo';
$lang->resource->ui->others        = 'others';

/* User module. */
$lang->resource->user = new stdclass();
$lang->resource->user->admin    = 'list';
$lang->resource->user->edit     = 'edit';
$lang->resource->user->forbid   = 'forbid';
$lang->resource->user->adminlog = 'adminlog';

/* Wechat module. */
$lang->resource->wechat = new stdclass();
$lang->resource->wechat->admin          = 'admin';
$lang->resource->wechat->create         = 'create';
$lang->resource->wechat->integrate      = 'integrate';
$lang->resource->wechat->edit           = 'edit';
$lang->resource->wechat->delete         = 'delete';
$lang->resource->wechat->adminResponse  = 'adminResponse';
$lang->resource->wechat->setResponse    = 'setResponse';
$lang->resource->wechat->deleteResponse = 'deleteResponse';
$lang->resource->wechat->reply          = 'reply';
$lang->resource->wechat->commitMenu     = 'commitMenu';
$lang->resource->wechat->deleteMenu     = 'deleteMenu';
$lang->resource->wechat->message        = 'messageList';
$lang->resource->wechat->qrcode         = 'qrcode';

/* Order module. */
if(!isset($lang->resource->order))$lang->resource->order = new stdclass();
$lang->resource->order->admin    = 'admin';
$lang->resource->order->delivery = 'delivery';
$lang->resource->order->finish   = 'finish';
$lang->resource->order->pay      = 'pay';
$lang->resource->order->setting  = 'setting';

/* Search module. */
if(!isset($lang->resource->search))$lang->resource->search = new stdclass();
$lang->resource->search->buildIndex   = 'buildIndex';
