<?php
/**
 * The admin view file of slide module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1 (http://www.chanzhi.org/license/)
 * @author      Xiying Guan<guanxiying@xirangit.com>
 * @package     slide
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<div class='panel'>
  <div class='panel-heading'>
    <i class='icon-th'></i> <strong><?php echo $lang->slide->group;?></strong>
    <div class='panel-actions'><?php commonModel::printLink('slide', 'createGroup', '', '<i class="icon-plus-sign"></i> ' . $lang->slide->createGroup, "class='btn btn-primary' data-toggle='modal'");?></div>
  </div>
  <div class='panel-body'>
    <section class='row cards-borderless'>
      <?php foreach($groups as $group):?>
      <div class='col-lg-3 col-md-4 col-sm-6'>
        <a class='card card-slide' href='<?php echo inLink('browse', "groupID=$group->id") ?>'>
          <?php $count = count($group->slides); ?>
          <div class='slides-holder slides-holder-<?php echo min(5, $count);?>'>
            <?php if(!empty($group->slides)): ?>
            <?php $index = 0; ?>
            <?php foreach($group->slides as $slide):?>
            <?php if($index > 4) break; ?>
            <div class='slide-item slide-item-<?php echo ++$index ?>'>
              <?php if ($slide->backgroundType == 'image'): ?>
              <?php print(html::image($slide->image));?>
              <?php else: ?>
              <div class='plain-slide' style='<?php echo 'background-color: ' . $slide->backgroundColor;?>'></div>
              <?php endif; ?>
              <?php if($count > 5 && $index === 1): ?>
              <div class='slides-count'><i class='icon-picture'></i><?php echo $count; ?></div>
              <?php endif; ?>
            </div>
            <?php endforeach;?>
            <?php else: ?>
            <div class='empty-holder'>
              <i class='icon-pencil icon-3x icon'></i>
              <div id='toBeAdded'>
                <?php echo $lang->toBeAdded;?>
              </div>
            </div>
            <?php endif; ?>
          </div>
        </a>
        <div class='card-heading text-center'>
          <span id='name'><?php echo $group->name;?></span>
          <i class="icon icon-edit"></i>
          <?php echo html::a(inlink('removeGroup', "groupID=$group->id"), '<i class="icon icon-remove"> </i>', "class='deleter'");?>
          <form id="editGroupForm<?php echo $group->id;?>" class='hide' action="<?php echo inlink('editGroup', "groupID=$group->id");?>" method='post' >
            <div class='editGroup'>
              <input type='text' name='groupName' id='input' value=<?php echo $group->name;?>>
              <?php echo html::submitButton('', 'submit btn btn-primary btn-xs') . html::commonButton($lang->cancel, 'cancelButton btn btn-xs');?>
              <?php echo html::hidden('groupID', $group->id, "class='groupID'");?>
            </div>
          </form>
        </div>
      </div>
      <?php endforeach;?>
      <div class='col-lg-3 col-md-4 col-sm-6'>
        <?php commonModel::printLink('slide', 'createGroup', "", '<div class="slides-holder create-btn"><div class="empty-holder"><i class="icon-plus-sign icon icon-3x"></i> ' . $lang->slide->createGroup . '</div></div>', "class='card card-slide' data-toggle='modal'");?>
      </div>
    </section>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
  
