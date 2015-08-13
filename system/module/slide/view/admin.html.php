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
    <i class='icon-th'></i> <?php echo $lang->slide->group;?>
    <div class='panel-actions'><?php commonModel::printLink('tree', 'browse', "type=slide", '<i class="icon-plus-sign"></i> ' . $lang->slide->createGroup, "class='btn btn-primary'");?></div>
  </div>
  <div class='panel-body'>
    <section class='row cards-borderless'>
      <?php foreach($groups as $group):?>
      <div class='col-lg-3 col-md-4 col-sm-6'>
        <a class='card card-slide' href='<?php echo inLink('browse', "groupID=$group->id") ?>'>
          <?php $count = count($group->slides); ?>
          <div class='slides-holder slides-holder-<?php echo min(5, $count);?>'>
            <?php if(!empty($group->slides)): ?>
            <?php $index = 1; ?>
            <?php foreach($group->slides as $slide):?>
            <?php if($index > 5) break; ?>
            <div class='slide-item slide-item-<?php echo $index++ ?>'>
              <?php if ($slide->backgroundType == 'image'): ?>
              <?php print(html::image($slide->middleImage));?>
              <?php else: ?>
              <div class='plain-slide' style='<?php echo 'background-color: ' . $slide->backgroundColor;?>'></div>
              <?php endif; ?>
            </div>
            <?php endforeach;?>
            <div class='slides-count'><i class='icon-picture'></i> <?php echo $count; ?></div>
            <?php else: ?>
            <div class='empty-holder'>
              <i class='icon-pencil icon-3x icon'></i>
            </div>
            <?php endif; ?>
          </div>
          <div class='card-heading text-center'><strong><?php echo $group->name ?></strong></div>
        </a>
      </div>
      <?php endforeach;?>
      <div class='col-lg-3 col-md-4 col-sm-6'>
        <?php commonModel::printLink('tree', 'browse', "type=slide", '<div class="slides-holder create-btn"><div class="empty-holder"><i class="icon-plus-sign icon icon-3x"></i> ' . $lang->slide->createGroup . '</div></div>', "class='card card-slide'");?>
      </div>
    </section>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
  
