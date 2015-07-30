<?php
/**
 * The html template file of execute method of upgrade module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1 (http://www.chanzhi.org/license/)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     upgrade
 * @version     $Id$
 */
?>
<?php include '../../common/view/header.lite.html.php';?>
<div class='container'>
  <div class='modal-dialog w-450px'>
    <?php if($result == 'fail'):?>
    <div class='modal-header'><h3><?php echo $lang->upgrade->fail;?></h3></div>
    <div class='modal-body'><?php echo nl2br(join('\n', $errors)); ?></div>
    <?php else:?>
    <div class='modal-body'><div class='alert alert-success text-center'><h4><?php echo $lang->upgrade->success;?></h4></div></div>
    <div class='modal-footer'><?php echo html::a('index.php', $lang->home, "class='btn btn-success'");?></div>
    <?php endif;?>
  </div>
</div>
<?php if($this->config->version == '4.2'):?>
<script> $().ready(function(){ $.getJSON(createLink('search', 'buildIndex'), function(){return false;});}); </script>
<?php endif;?>
<?php include '../../install/view/footer.html.php';?>
