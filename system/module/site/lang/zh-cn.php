<?php
/**
 * The site module zh-cn file of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv11.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     site
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
$lang->site->common        = "站点";

$lang->site->type            = '站点类型';
$lang->site->status          = '站点状态';
$lang->site->pauseTip        = '暂停提示';
$lang->site->name            = '网站名称';
$lang->site->module          = '功能模块';
$lang->site->lang            = '站点语言';
$lang->site->defaultLang     = '默认语言';
$lang->site->domain          = '主域名';
$lang->site->allowedDomain   = '可访问域名';
$lang->site->keywords        = '关键词';
$lang->site->indexKeywords   = '首页关键词';
$lang->site->meta            = 'Meta信息';
$lang->site->desc            = '站点描述';
$lang->site->icpSN           = '备案编号';
$lang->site->icpLink         = '备案链接';
$lang->site->slogan          = '站点口号';
$lang->site->mission         = '站点使命';
$lang->site->copyright       = '创建年份';
$lang->site->allowUpload     = '允许上传附件';
$lang->site->allowedFiles    = '允许附件类型';
$lang->site->captcha         = '验证码';
$lang->site->mailCaptcha     = '邮箱验证码';
$lang->site->twContent       = '繁体内容';
$lang->site->cn2tw           = '自动从简体版复制';
$lang->site->cdn             = 'CDN地址';
$lang->site->checkIP         = '检查登录IP';
$lang->site->checkPosition   = '校验登录地区';
$lang->site->allowedIP       = '允许登录IP';
$lang->site->allowedPosition = '允许登录地区';

$lang->site->setBasic      = "基本信息设置";
$lang->site->setLang       = "语言设置";
$lang->site->setSecurity   = "安全设置";
$lang->site->setUpload     = "文件上传设置";
$lang->site->setRobots     = "Robots 设置";
$lang->site->setOauth      = "开放登录设置";
$lang->site->setSinaOauth  = "新浪微博接入";
$lang->site->setQQOauth    = "QQ接入";
$lang->site->oauthHelp     = "使用帮助";
$lang->site->setRecPerPage = "列表数量设置";
$lang->site->usePosition   = "使用当前登录地址";

$lang->site->typeList = new stdclass();
$lang->site->typeList->portal = '企业门户';
$lang->site->typeList->blog   = '个人博客';

$lang->site->statusList = new stdclass();
$lang->site->statusList->normal = '正常';
$lang->site->statusList->pause  = '暂停';

$lang->site->checkIPList = array();
$lang->site->checkIPList['open']  = '打开';
$lang->site->checkIPList['close'] = '关闭';

$lang->site->checkPositionList = array();
$lang->site->checkPositionList['open']  = '打开';
$lang->site->checkPositionList['close'] = '关闭';

$lang->site->captchaList = array();
$lang->site->captchaList['open']  = '打开';
$lang->site->captchaList['close'] = '关闭';
$lang->site->captchaList['auto']  = '自动';

$lang->site->moduleAvailable = array();
$lang->site->moduleAvailable['user']    = '会员';
$lang->site->moduleAvailable['forum']   = '论坛';
$lang->site->moduleAvailable['blog']    = '博客';
$lang->site->moduleAvailable['book']    = '手册';
$lang->site->moduleAvailable['message'] = '评论留言';
$lang->site->moduleAvailable['search']  = '搜索';
$lang->site->moduleAvailable['shop']    = '商城';

$lang->site->metaHolder       = '可放置<meta><script><style>和<link>标签。';
$lang->site->fileAllowedRole  = '多个后缀名之间请用 "," 隔开';
$lang->site->domainTip        = '设置主域名可使所有网站访问跳转到该域名，设置前请确保主域名解析正确。该值为空时不进行跳转。';
$lang->site->allowedDomainTip = '多个域名使用 , 隔开，如www.chanzhi.org,www.chanzhi.com。该值为空时允许所有域名访问。';
$lang->site->allowedIPTip     = '多个IP使用 , 隔开，如202.194.133.1,202.194.132.0/28。该值为空时允许所有IP访问。';
$lang->site->wrongAllowedIP   = 'IP 格式错误';
$lang->site->changePosition   = '您当前的登录地区与允许登录地区不一致。';

$lang->site->robots            = 'Robots';
$lang->site->robotsUnwriteable = 'Robots文件%s 不可写，请修改权限后设置。';
$lang->site->reloadForRobots   = '刷新页面';
$lang->site->defaultTip        = '站点维护中……';
$lang->site->icpTip            = '';

$lang->site->setPage = new stdclass();
$lang->site->setPage->article = '文章列表';
$lang->site->setPage->product = '产品列表';
$lang->site->setPage->blog    = '博客列表';
$lang->site->setPage->forum   = '论坛列表';
$lang->site->setPage->reply   = '回帖列表';
$lang->site->setPage->message = '留言列表';
$lang->site->setPage->comment = '评论列表';
