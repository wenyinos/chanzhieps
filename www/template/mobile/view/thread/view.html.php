<?php
/**
 * The index view file of forum for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1 (http://www.chanzhi.org/license/)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     forum
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php
include TPL_ROOT . 'common/header.html.php';
$common->printPositionBar($board, $thread);
?>

<div class="panel panel-section panel-body cards cards-list">
<?php
if($pager->pageID == 1) include TPL_ROOT . 'thread/thread.html.php';
include TPL_ROOT . 'thread/reply.html.php';
?>
</div>

<?php include TPL_ROOT . 'common/footer.html.php';?>
