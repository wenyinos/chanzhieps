<?php
/**
 * The html template file of index method of upgrade module of ZenTaoPMS.
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
  <div class='modal-dialog'>
    <div class='modal-header'>
      <h3><?php echo $lang->upgrade->backup;?></h3>
    </div>
    <div class='modal-body'>
      <?php if($createSlidePath):?>
      <?php printf($lang->upgrade->createSlidePath, $slidePath);?>
      <?php else:?>
      <?php printf($lang->upgrade->backupData, $db->user, $db->password, $db->name, inlink('selectVersion'));?>
      <?php endif;?>
      <?php if(version_compare($this->loadModel('setting')->getVersion(), 2.3) < 0):?>
      <div class='text-left'>
        <label class='checkbox'><input type='checkbox' id='agree' checked /><?php echo $lang->agreement;?></label>
      </div>
      <?php endif;?>
    </div>
    <div class='modal-footer'>
      <?php if(!$createSlidePath):?>
      <?php echo html::a(inlink('selectVersion'), $lang->upgrade->next, "class='btn btn-primary'");?>
      <?php else:?>
      <?php echo html::a('', $lang->upgrade->next, "class='btn btn-primary'");?>
      <?php endif;?>
    </div>
  </div>
</div>
<?php include '../../install/view/footer.html.php';?>
