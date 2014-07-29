<?php
/**
 * The uninstall view file of extension module of ChanZhiEPS.
 *
 * @copyright   Copyright 2009-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     http://api.chanzhi.org/goto.php?item=license
 * @author      Chunsheng Wang <chunsheng@xirangit.com>
 * @package     extension
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.modal.html.php';?>
<?php if(isset($confirm) and $confirm == 'no'):?>
<div class='alert alert-warning'>
  <i class='icon-info-sign'></i>
  <div class='content'>
  <?php
    echo "<p class='waring'>{$lang->extension->confirmUninstall}";
    echo html::a(inlink('uninstall', "extension=$code&confirm=yes"), $lang->extension->uninstall, "class='btn loadInModal'");
    echo "</p>";
    echo "<p>{$lang->extension->noticeBackupDB}</p>"
  ?>
  </div>
</div>
<?php elseif(!empty($error)):?>
<div class='alert alert-danger'>
  <i class='icon-info-sign'></i>
  <div class='content'>
  <?php
    echo "<h3 class='error'>" . $lang->extension->uninstallFailed . "</h3>"; 
    echo "<p>$error</p>";
  ?>
  </div>
</div>
<?php else:?>
<div class='alert alert-success'>
  <i class='icon-ok-sign'></i>
  <div class='content'>
    <?php
    echo "<h3>{$title}</h3>";
    if(!empty($backupFile)) echo '<p>' . sprintf($lang->extension->backDBFile, $backupFile) . '</p>';
    if($removeCommands)
    {
        echo "<p class='strong'>{$lang->extension->unremovedFiles}</p>";
        echo join($removeCommands, '<br />');
    }
    echo "<p class='text-center'>" . html::a(inlink('browse', 'type=available'), $lang->extension->viewAvailable, "class='btn'") . '</p>';
    ?>
  </div>
</div>
<?php endif;?>
<?php include '../../common/view/footer.modal.html.php';?>