<?php
/**
 * The wechat module zh-cn file of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     LGPL
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     wechat
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
$lang->wechat->id        = 'ID';
$lang->wechat->type      = 'Type';
$lang->wechat->name      = 'Name';
$lang->wechat->account   = 'Account';
$lang->wechat->appID     = 'AppID';
$lang->wechat->appSecret = 'AppSecret';
$lang->wechat->token     = 'Token';
$lang->wechat->url       = 'URL';
$lang->wechat->certified = 'Certified';
$lang->wechat->users     = 'Users';
$lang->wechat->content   = 'Content';

$lang->wechat->create            = 'Create';
$lang->wechat->edit              = 'Edit';
$lang->wechat->admin             = 'Admin';
$lang->wechat->list              = 'List';
$lang->wechat->setMenu           = 'Menu';
$lang->wechat->access            = 'Integrate';

$lang->wechat->typeList['subscribe'] = 'Subscribe';
$lang->wechat->typeList['service']   = 'Service';

$lang->wechat->certifiedList[1] = 'Yes';
$lang->wechat->certifiedList[0] = 'No';

$lang->wechat->response = new stdclass();

$lang->wechat->response->keywords  = 'Key';
$lang->wechat->response->set       = 'Response';
$lang->wechat->response->create    = 'Add';
$lang->wechat->response->default   = 'Default';
$lang->wechat->response->subscribe = 'Subscribe';

$lang->wechat->response->type     = 'Type';
$lang->wechat->response->source   = 'Source';
$lang->wechat->response->module   = 'Module';
$lang->wechat->response->block    = 'Content';
$lang->wechat->response->link     = 'Link';
$lang->wechat->response->category = 'Category';
$lang->wechat->response->limit    = 'Limit';

$lang->wechat->response->list   = 'Response List';

$lang->wechat->response->typeList['link'] = 'Link';
$lang->wechat->response->typeList['text'] = 'Text';
$lang->wechat->response->typeList['news'] = 'News';

$lang->wechat->response->sourceList['system'] = 'System';
$lang->wechat->response->sourceList['manual'] = 'Manual';

$lang->wechat->response->moduleList['index']   = 'Home';
$lang->wechat->response->moduleList['company'] = 'About Us';
$lang->wechat->response->moduleList['blog']    = 'Blog';
$lang->wechat->response->moduleList['forum']   = 'Forum';
$lang->wechat->response->moduleList['book']    = 'Book';
$lang->wechat->response->moduleList['manual']  = 'Manual';

$lang->wechat->response->textBlockList['company'] = 'Company';
$lang->wechat->response->textBlockList['contact'] = 'Contact';
$lang->wechat->response->textBlockList['manual']  = 'Manual';

$lang->wechat->response->newsBlockList['articleTree']   = 'Article catories';
$lang->wechat->response->newsBlockList['latestArticle'] = 'Latest Article';
$lang->wechat->response->newsBlockList['hotArticle']    = 'Hot Article';
$lang->wechat->response->newsBlockList['productTree']   = 'Product catories';
$lang->wechat->response->newsBlockList['latestProduct'] = 'Latest Product';
$lang->wechat->response->newsBlockList['hotProduct']    = 'Hot Product';

$lang->wechat->message = new stdclass();
$lang->wechat->message->from     = 'From';
$lang->wechat->message->type     = 'Type';
$lang->wechat->message->status   = 'Status';
$lang->wechat->message->content  = 'Content';
$lang->wechat->message->response = 'Response';
$lang->wechat->message->menu     = 'Menu';
$lang->wechat->message->time     = 'Time';
$lang->wechat->message->reply    = 'Reply';
$lang->wechat->message->record   = 'Records';
$lang->wechat->message->list     = 'List';

$lang->wechat->message->typeList['text']        = 'Text';
$lang->wechat->message->typeList['image']       = 'Image';
$lang->wechat->message->typeList['voice']       = 'Voice';
$lang->wechat->message->typeList['location']    = 'Location';
$lang->wechat->message->typeList['link']        = 'Link';
$lang->wechat->message->typeList['subscribe']   = 'Subscribe';
$lang->wechat->message->typeList['unsubscribe'] = 'Unsubscribe';
$lang->wechat->message->typeList['scan']        = 'Scan';
$lang->wechat->message->typeList['click']       = 'Click';
$lang->wechat->message->typeList['view']        = 'View';

$lang->wechat->message->tabList[] = 'replied=0|Unreplied';
$lang->wechat->message->tabList[] = 'type=text|Message';
$lang->wechat->message->tabList[] = 'type=subscribe|Subscribe';
$lang->wechat->message->tabList[] = 'type=unsubscribe|Unsubscribe';
$lang->wechat->message->tabList[] = 'replied=1|Replied';

$lang->wechat->placeholder = new stdclass();
$lang->wechat->placeholder->limit    = '<=10';
$lang->wechat->placeholder->category = 'Max 10 categories';

$lang->wechat->needCertified  = "This feature needs the account to be certified.";
$lang->wechat->accessInfo = <<<EOT
<ul style="padding-left: 10px">
  <li><strong>AppSecret</strong>： %s </li>
  <li><strong>URL</strong>： %s </li>
  <li><strong>Token</strong>： %s </li>
</ul>
EOT;
