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

$lang->guarder->action       = 'Action';
$lang->guarder->then         = 'Then';
$lang->guarder->setWhitelist = 'Whitelist';

$lang->guarder->captcha        = 'Captcha';
$lang->guarder->numbers        = array('Zero', 'I', 'II', 'III', 'Four', 'Five', '6', '7', '8', '9', '10');
$lang->guarder->operators      = array('*' => 'x', '-' => '-', '+' => '+');
$lang->guarder->equal          = '=';
$lang->guarder->placeholder    = 'Nubmer';
$lang->guarder->password       = 'Admin Password';
$lang->guarder->passwordHolder = 'Please enter password of current account';

$lang->guarder->blacklistModes['ip']       = 'ip';
$lang->guarder->blacklistModes['account']  = 'Account';
$lang->guarder->blacklistModes['keywords'] = 'Keywords';
$lang->guarder->blacklistModes['guard']    = 'Site';
$lang->guarder->blacklistModes['email']    = 'Email';

$lang->guarder->whitelist = new stdclass();
$lang->guarder->whitelist->ip            = 'IP Whitelist';
$lang->guarder->whitelist->account       = 'Account Whitelist';
$lang->guarder->whitelist->accountHolder = 'Multiple users separated by commas, like zhangsan,lisi';
$lang->guarder->whitelist->ipHolder      = 'Multiple IP separated by commas , like 202.194.133.1,202.194.132.0/28';
$lang->guarder->whitelist->wrongIP       = 'IP Malformed';

$lang->guarder->permanent = 'Permanent';
$lang->guarder->interval  = 'Minutes';
$lang->guarder->perDay    = 'A Day More Than';
$lang->guarder->exceed    = 'Exceed';
$lang->guarder->times     = 'Times';
$lang->guarder->disable   = 'Disabled';

$lang->guarder->operationList = new stdclass;
$lang->guarder->operationList->ip = new stdclass;
$lang->guarder->operationList->ip->logonFailure    = 'Login Failed';
$lang->guarder->operationList->ip->register        = 'Registration Number';
$lang->guarder->operationList->ip->resetPassword   = 'Reset Password';
$lang->guarder->operationList->ip->resetPWDFailure = 'Reset Password Failure';
$lang->guarder->operationList->ip->postThread      = 'Post Topic';
$lang->guarder->operationList->ip->postComment     = 'Post Comment';
$lang->guarder->operationList->ip->postReply       = 'Reply To Post';
$lang->guarder->operationList->ip->search          = 'Searches';
$lang->guarder->operationList->ip->threadFail      = 'Post Banned';
$lang->guarder->operationList->ip->commentFail     = 'Comment Banned';
$lang->guarder->operationList->ip->error404        = '404 Times';
$lang->guarder->operationList->ip->captchaFail     = 'Validation Error';

$lang->guarder->punishOptions = array();
$lang->guarder->punishOptions[1]    = '1h'; 
$lang->guarder->punishOptions[3]    = '3h'; 
$lang->guarder->punishOptions[12]   = '12h'; 
$lang->guarder->punishOptions[24]   = '24h'; 
$lang->guarder->punishOptions[168]  = '1 Week'; 
$lang->guarder->punishOptions[720]  = '1 Month'; 
$lang->guarder->punishOptions[2160] = '3 Months'; 
$lang->guarder->punishOptions[0]    = 'Permanent'; 

$lang->blacklist = new stdclass();
$lang->blacklist->type        = 'Type';
$lang->blacklist->identity    = 'Value';
$lang->blacklist->reason      = 'Reason';
$lang->blacklist->expiredDate = 'Expiration';
$lang->blacklist->ip          = 'IP';
$lang->blacklist->keywords    = 'keywords';
$lang->blacklist->account     = 'Account';
$lang->blacklist->email       = 'Email';
$lang->blacklist->other       = 'Other';
