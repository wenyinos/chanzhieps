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
$lang->wechat->admin             = 'Admin';
$lang->wechat->list              = 'List';
$lang->wechat->setMenu           = 'Set Menu';
$lang->wechat->setResponse       = 'Set Response';
$lang->wechat->defaultResponse   = 'Default Response';
$lang->wechat->subscribeResponse = 'Subscribe Response';
$lang->wechat->access            = 'Access';

$lang->wechat->typeList['subscribe'] = 'Subscribe';
$lang->wechat->typeList['service']   = 'Service';

$lang->wechat->response = new stdclass();

$lang->wechat->response->type   = 'Type';
$lang->wechat->response->source = 'Source';
$lang->wechat->response->module = 'Module';
$lang->wechat->response->block  = 'Block';
$lang->wechat->response->link   = 'Link';

$lang->wechat->response->typeList['link'] = 'Link';
$lang->wechat->response->typeList['text'] = 'Text';
$lang->wechat->response->typeList['rich'] = 'Html';

$lang->wechat->response->sourceList['system'] = 'System';
$lang->wechat->response->sourceList['manual'] = 'Manual';

$lang->wechat->response->moduleList['home']  = 'Home';
$lang->wechat->response->moduleList['about'] = 'About Us';
$lang->wechat->response->moduleList['blog']  = 'Blog';
$lang->wechat->response->moduleList['forum'] = 'Forum';

$lang->wechat->accessInfo = <<<EOT
<ul style="padding-left: 10px">
  <li><strong>AppSecret</strong>： %s </li>
  <li><strong>URL</strong>： %s </li>
  <li><strong>Token</strong>： %s </li>
</ul>
EOT;
