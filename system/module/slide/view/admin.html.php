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
    <div class='panel-actions'><?php commonModel::printLink('tree', 'browse', "type=slide", '<i class="icon-plus-sign"></i> ' . $lang->slide->createGroup, "class='btn btn-primary'");?></div>
  </div>
  <div class='panel-body'>
    <section class='row'>
      <?php foreach($groups as $group):?>
      <div class='col-lg-3 col-md-4 col-sm-6'>
        <a class='card card-slide' href='<?php echo inLink('browse', "groupID=$group->id") ?>'>
          <?php $count = min(5, count($group->slides)); ?>
            <div class='slides-holder text-center'>
            <?php if(!empty($group->slides)): ?>
            <?php $index = 0; ?>
            <?php foreach($group->slides as $slide):?>
            <?php
            $number  = $count - ($index + 1);
            $right   = $number * 50 / $count;
            $bottom  = $number * 60 / $count;
            $padding = $count * 9;
            $style   = "bottom:{$bottom}px; right:{$right}px;padding-left:{$padding}px";
            ?>
            <?php if($index > 4) break; ?>
            <div class='slide-item' style="<?php echo $style;?>">
              <?php if ($slide->backgroundType == 'image'): ?>
              <?php print(html::image($slide->image));?>
              <?php else:?>
              <div class='plain-slide' style='<?php echo 'background-color: ' . $slide->backgroundColor;?>'></div>
              <?php endif; ?>
            </div>
            <?php $index ++;?>
            <?php endforeach;?>
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
  
