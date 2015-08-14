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
<div class='card heading-card'>
  <div class='card-heading'><i class='icon-th'></i> <strong><?php echo $lang->block->admin ?></strong></div>
  <div class='card-actions'>
    <div class="btn-group">
      <?php commonModel::printLink('block', 'create', '', '<i class="icon-plus"></i> ' . $lang->block->create, 'class="btn btn-primary"');?>
      <div class='btn-group'>
        <button type='button' class='btn btn-primary dropdown-toggle' data-toggle='dropdown'>
          <span class="caret"></span>
        </button>
        <?php echo $this->block->createTypeMenu($template, '', 0, 'create', 'pull-right'); ?>
      </div>
    </div>
  </div>
</div>
<div class='row'>
  <?php foreach($config->block->categoryList as $category => $blockList):?>
  <div class='col-sm-3'>
    <div class='panel panel-pure'>
      <div class='panel-heading'>
        <strong><?php echo $lang->block->categoryList[$category];?></strong>
      </div>
      <div class='panel-body'>
        <div class='blocks-list'>
        <?php foreach($blocks as $block):?>
        <?php if(strpos($blockList, ",$block->type,") !== false):?>
        <?php if(strpos($block->type, 'code') === false) $block->content = json_decode($block->content); ?>
        <div class='card block'>
          <div class='card-heading'>
            <?php if(isset($block->content->icon)): ?><i class='icon panel-icon <?php echo $block->content->icon; ?>'></i>&nbsp;<?php endif; ?>
            <strong><?php echo $block->title;?></strong>
          </div>
          <div class='card-content'>
            <span class='text-muted'><i class='icon icon-folder-close-alt'></i> <small><?php echo $lang->block->$template->typeList[$block->type]; ?></small></span>
            <div class='pull-right'>
              <?php echo html::a(helper::createLink('block', 'edit', "blockID=$block->id&type=$block->type"), $lang->edit);?>&nbsp;
              <?php echo html::a(helper::createLink('block', 'delete', "blockID=$block->id"), $lang->delete, "class='deleter'");?>
            </div>
          </div>
        </div>
        <?php endif;?>
        <?php endforeach;?>
        </div>
      </div>
    </div>
  </div>
  <?php endforeach;?>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
