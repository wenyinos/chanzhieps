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
$lang->wechat->id        = '编号';
$lang->wechat->type      = '类型';
$lang->wechat->name      = '微信名';
$lang->wechat->account   = '微信号';
$lang->wechat->appID     = 'AppID';
$lang->wechat->appSecret = 'AppSecret';
$lang->wechat->token     = 'Token';
$lang->wechat->url       = '接入地址';
$lang->wechat->users     = '微信会员';
$lang->wechat->content   = '内容';

$lang->wechat->create            = '添加公众号';
$lang->wechat->admin             = '维护公众号';
$lang->wechat->list              = '公众号列表';
$lang->wechat->setMenu           = '菜单';
$lang->wechat->adminResponse     = '响应';
$lang->wechat->setResponse       = '响应设置';
$lang->wechat->defaultResponse   = '默认响应';
$lang->wechat->subscribeResponse = '订阅响应';
$lang->wechat->access            = '接入';

$lang->wechat->typeList['subscribe'] = '订阅号';
$lang->wechat->typeList['service']   = '服务号';

$lang->wechat->response = new stdclass();

$lang->wechat->response->key    = 'Key';
$lang->wechat->response->type   = '类型';
$lang->wechat->response->source = '来源';
$lang->wechat->response->module = '模块';
$lang->wechat->response->block  = '内容';
$lang->wechat->response->link   = '链接';
$lang->wechat->response->limit  = '数量';

$lang->wechat->response->create = '添加响应';
$lang->wechat->response->list   = '响应列表';

$lang->wechat->response->typeList['link'] = '链接';
$lang->wechat->response->typeList['text'] = '文本消息';
$lang->wechat->response->typeList['news'] = '图文消息';

$lang->wechat->response->sourceList['system'] = '系统';
$lang->wechat->response->sourceList['manual'] = '输入';

$lang->wechat->response->moduleList['home']   = '首页';
$lang->wechat->response->moduleList['about']  = '关于我们';
$lang->wechat->response->moduleList['blog']   = '博客';
$lang->wechat->response->moduleList['forum']  = '论坛';
$lang->wechat->response->moduleList['manual'] = '自定义';

$lang->wechat->response->textBlockList['company'] = '公司简介';
$lang->wechat->response->textBlockList['contact'] = '联系我们';
$lang->wechat->response->textBlockList['manual']  = '自定义';

$lang->wechat->response->newsBlockList['articleTree']   = '文章分类';
$lang->wechat->response->newsBlockList['latestArticle'] = '最新文章';
$lang->wechat->response->newsBlockList['hotArticle']    = '热门文章';
$lang->wechat->response->newsBlockList['productTree']   = '产品分类';
$lang->wechat->response->newsBlockList['latestProduct'] = '最新产品';
$lang->wechat->response->newsBlockList['hotProduct']    = '热门产品';

$lang->wechat->placeholder = new stdclass();
$lang->wechat->placeholder->limit    = '请输条数，最多10条';
$lang->wechat->placeholder->category = '请选择类目，最多10个';

$lang->wechat->accessInfo = <<<EOT
<ul style="padding-left: 10px">
  <li><strong>AppSecret</strong>： %s </li>
  <li><strong>接入地址</strong>： %s </li>
  <li><strong>Token</strong>： %s </li>
</ul>
EOT;
