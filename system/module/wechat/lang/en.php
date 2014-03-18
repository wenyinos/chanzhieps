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
$lang->wechat->users     = 'Users';
$lang->wechat->content   = 'Content';

$lang->wechat->create            = 'Create';
$lang->wechat->edit              = 'Edit';
$lang->wechat->admin             = 'Admin';
$lang->wechat->list              = 'List';
$lang->wechat->setMenu           = 'Set Menu';
$lang->wechat->adminResponse     = 'Admin Response';
$lang->wechat->setResponse       = 'Set Response';
$lang->wechat->defaultResponse   = 'Default Response';
$lang->wechat->subscribeResponse = 'Subscribe Response';
$lang->wechat->access            = 'Access';

$lang->wechat->typeList['subscribe'] = 'Subscribe';
$lang->wechat->typeList['service']   = 'Service';

$lang->wechat->response = new stdclass();

$lang->wechat->response->key    = 'Key';
$lang->wechat->response->type   = 'Type';
$lang->wechat->response->source = 'Source';
$lang->wechat->response->module = 'Module';
$lang->wechat->response->block  = 'Block';
$lang->wechat->response->link   = 'Link';
$lang->wechat->response->limit  = 'Limit';

$lang->wechat->response->create = 'Create Response';
$lang->wechat->response->list   = 'Response List';

$lang->wechat->response->typeList['link'] = 'Link';
$lang->wechat->response->typeList['text'] = 'Text';
$lang->wechat->response->typeList['rich'] = 'Html';

$lang->wechat->response->sourceList['system'] = 'System';
$lang->wechat->response->sourceList['manual'] = 'Manual';

$lang->wechat->response->moduleList['home']    = 'Home';
$lang->wechat->response->moduleList['company'] = 'About Us';
$lang->wechat->response->moduleList['blog']    = 'Blog';
$lang->wechat->response->moduleList['forum']   = 'Forum';
$lang->wechat->response->moduleList['book']    = 'Book';
$lang->wechat->response->moduleList['manual']  = 'Manual';

$lang->wechat->response->textBlockList['company'] = 'Company';
$lang->wechat->response->textBlockList['contact'] = 'Contact';
$lang->wechat->response->textBlockList['manual']  = 'Manual';

$lang->wechat->response->newsBlockList['articleTree']   = 'Article Tree';
$lang->wechat->response->newsBlockList['latestArticle'] = 'Latest Article';
$lang->wechat->response->newsBlockList['hotArticle']    = 'Hot Article';
$lang->wechat->response->newsBlockList['productTree']   = 'Product Tree';
$lang->wechat->response->newsBlockList['latestProduct'] = 'Latest Product';
$lang->wechat->response->newsBlockList['hotProduct']    = 'Hot Product';

$lang->wechat->placeholder = new stdclass();
$lang->wechat->placeholder->limit    = 'Please input the number, no more than 10';
$lang->wechat->placeholder->category = 'Please select the category ,no more than 10';

$lang->wechat->accessInfo = <<<EOT
<ul style="padding-left: 10px">
  <li><strong>AppSecret</strong>： %s </li>
  <li><strong>URL</strong>： %s </li>
  <li><strong>Token</strong>： %s </li>
</ul>
EOT;
