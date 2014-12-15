<?php
/**
 * The ranzhi module en file of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     http://api.chanzhi.org/goto.php?item=license
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     ranzhi
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
$lang->ranzhi->common    = 'Ranzhi';

$lang->ranzhi->id          = 'ID';
$lang->ranzhi->code        = 'Code';
$lang->ranzhi->key         = 'Key';
$lang->ranzhi->ranzhiURL   = 'Ranzhi url';
$lang->ranzhi->requestType = 'Request type';

$lang->ranzhi->registerSuccess = "Account: %s successfuly created with same password of your ranzhi account. <br/>You can manage this chanzhi site after granted by the manager of this site.";

$lang->ranzhi->requestTypeList = new stdclass();
$lang->ranzhi->requestTypeList->get       = 'Common mode';
$lang->ranzhi->requestTypeList->path_info = 'Rewrite mode';

$lang->ranzhi->placeholder = new stdclass();
$lang->ranzhi->placeholder->code = 'Code of your ranzhi entry for this site.';
$lang->ranzhi->placeholder->key  = 'Key of your ranzhi entry for this site.';
$lang->ranzhi->availableBlocks = new stdclass();
$lang->ranzhi->availableBlocks->feedback = 'Feedback from chanzhi';

$lang->ranzhi->messageWating      = "New message<span class='label label-badge label-success pull-right'>%s</span>";
$lang->ranzhi->commentWating      = "New Comments<span class='label label-badge label-success pull-right'>%s</span>";
$lang->ranzhi->messageReplyWating = "Replies of message<span class='label label-badge label-success pull-right'>%s</span>";
$lang->ranzhi->newThreads         = "New Threads<span class='label label-badge label-success pull-right'>%s</span>";
$lang->ranzhi->newReplies         = "Replies of thread<span class='label label-badge label-success pull-right'>%s</span>";
