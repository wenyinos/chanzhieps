<?php
/**
 * The browse view file of block module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1 (http://www.chanzhi.org/license/)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<div class='panel'>
  <div class='panel-heading'>
    <strong><i class='icon-th'></i> <?php echo $lang->block->browseBlocks;?></strong>
    <div class='panel-actions'>
      <?php commonModel::printLink('block', 'create', '', '<i class="icon-plus"></i> ' . $lang->block->create, 'class="btn btn-primary"');?>
    </div>
  </div>

  <div class='panel-body'>
  <div class='row'>
    <?php foreach($config->block->categoryList as $category => $blockList):?>
    <div class='col-md-3'>
      <div class='panel'>
      <div class='panel-heading'><strong><?php echo $lang->block->categoryList[$category];?></strong></div>
        <div class='panel-body'>
          <ul class='ul-list'>
          <?php foreach($blocks as $block):?>
          <?php if(strpos($blockList, ",$block->type,") !== false):?>
          <li>
            <span class='pull-left'><span ><?php echo '[' . $lang->block->{$template}->typeList[$block->type] . ']';?></span><?php echo ' ' . $block->title;?></span>
            <span class='pull-right'>
              <?php echo html::a(helper::createLink('block', 'edit', "blockID=$block->id&type=$block->type"), $lang->edit);?>
              <?php echo html::a(helper::createLink('block', 'delete', "blockID=$block->id"), $lang->delete, "class='deleter'");?>
            </span>
          </li>
          <?php endif;?>
          <?php endforeach;?>
          </ul>
        </div>
      </div>
    </div>
    <?php endforeach;?>
  </div>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
