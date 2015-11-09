<?php
/**
 * The comment module zh-cn file of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     comment
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
$lang->guarder = new stdclass();

$lang->guarder->action       = '操作';
$lang->guarder->addBlacklist = '添加黑名单';
$lang->guarder->setWhitelist = '白名单管理';

$lang->guarder->captcha        = '验证码';
$lang->guarder->numbers        = array('零', '壹', '贰', '叁', '肆', '伍', '陆', '柒', '捌', '玖', '拾');
$lang->guarder->operators      = array('*' => '乘', '-' => '减', '+' => '加');
$lang->guarder->equal          = '=';
$lang->guarder->placeholder    = '数字';
$lang->guarder->password       = '管理密码';
$lang->guarder->passwordHolder = '请输入当前帐号的密码';

$lang->guarder->blacklistModes['ip']       = 'ip地址';
$lang->guarder->blacklistModes['account']  = '帐号';
$lang->guarder->blacklistModes['keywords'] = '关键词';
$lang->guarder->blacklistModes['guard']    = '网址';
$lang->guarder->blacklistModes['email']    = '邮箱地址';

$lang->guarder->whitelist = new stdclass();
$lang->guarder->whitelist->ip            = 'IP白名单';
$lang->guarder->whitelist->account       = '账号白名单';
$lang->guarder->whitelist->accountHolder = '多个账户使用 , 隔开如zhangsan,lisi';
$lang->guarder->whitelist->ipHolder      = '多个IP使用 , 隔开如202.194.133.1,202.194.132.0/28';
$lang->guarder->whitelist->wrongIP       = 'IP 格式错误';

$lang->guarder->permanent = '永久';
$lang->guarder->interval  = '分钟内';
$lang->guarder->perDay    = '每天超过';
$lang->guarder->exceed    = '超过';
$lang->guarder->disable   = '禁用';
$lang->guarder->hours     = '小时';

$lang->guarder->operationList = new stdclass;
$lang->guarder->operationList->logonFailure    = '登录失败';
$lang->guarder->operationList->register        = '注册数量';
$lang->guarder->operationList->resetPassword   = '找回密码';
$lang->guarder->operationList->resetPWDFailure = '重置密码失败';
$lang->guarder->operationList->postThread      = '发表主题';
$lang->guarder->operationList->postComment     = '发表评论';
$lang->guarder->operationList->postReply       = '回复帖子';
$lang->guarder->operationList->search          = '搜索次数';
$lang->guarder->operationList->threadFail      = '帖子被禁';
$lang->guarder->operationList->commentFail     = '评论被禁';
$lang->guarder->operationList->error404        = '404次数';
$lang->guarder->operationList->captchaFail     = '验证码错误';

$lang->guarder->punishOptions = array();
$lang->guarder->punishOptions[1]    = '一小时'; 
$lang->guarder->punishOptions[3]    = '三小时'; 
$lang->guarder->punishOptions[12]   = '12小时'; 
$lang->guarder->punishOptions[24]   = '24小时'; 
$lang->guarder->punishOptions[168]  = '一周'; 
$lang->guarder->punishOptions[720]  = '一个月'; 
$lang->guarder->punishOptions[2160] = '三个月'; 
$lang->guarder->punishOptions[0]    = '永久'; 

$lang->blacklist = new stdclass();
$lang->blacklist->type        = '类型';
$lang->blacklist->identity    = '值';
$lang->blacklist->reason      = '原因';
$lang->blacklist->expiredDate = '禁用时间';
$lang->blacklist->hour        = '小时';
$lang->blacklist->ip          = 'IP';
$lang->blacklist->keywords    = '关键词';
$lang->blacklist->account     = '账户';
$lang->blacklist->email       = '邮箱';
$lang->blacklist->other       = '其他';
