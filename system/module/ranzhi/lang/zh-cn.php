<?php
/**
 * The ranzhi module zh-cn file of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     http://api.chanzhi.org/goto.php?item=license
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     ranzhi
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
$lang->ranzhi->common    = '然之协同';

$lang->ranzhi->id          = '编号';
$lang->ranzhi->code        = '应用代号';
$lang->ranzhi->key         = '密钥';
$lang->ranzhi->ranzhiURL   = '然之地址';
$lang->ranzhi->requestType = '请求方式';

$lang->ranzhi->registerSuccess = "恭喜<br/>创建账号: %s 成功，可以使用您的然之密码登录蝉知。<br/>在蝉知后台设置此账号的管理员权限后，可以直接登录蝉知后台。";

$lang->ranzhi->requestTypeList = new stdclass();
$lang->ranzhi->requestTypeList->get       = '普通方式';
$lang->ranzhi->requestTypeList->path_info = '重写方式';

$lang->ranzhi->placeholder = new stdclass();
$lang->ranzhi->placeholder->code = '添加然之应用时输入的应用代号。';
$lang->ranzhi->placeholder->key  = '添加然之应用时保存的密钥。';

$lang->ranzhi->availableBlocks = new stdclass();
$lang->ranzhi->availableBlocks->feedback = '蝉知网站反馈';

$lang->ranzhi->messageWating      = "未处理留言<span class='label label-badge label-success pull-right'>%s</span>";
$lang->ranzhi->commentWating      = "未处理评论<span class='label label-badge label-success pull-right'>%s</span>";
$lang->ranzhi->messageReplyWating = "未处理回复<span class='label label-badge label-success pull-right'>%s</span>";
$lang->ranzhi->newThreads         = "新主题<span class='label label-badge label-success pull-right'>%s</span>";
$lang->ranzhi->newReplies         = "新回帖<span class='label label-badge label-success pull-right'>%s</span>";
