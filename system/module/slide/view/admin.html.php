<?php
/**
 * The admin browse view file of slide module of chanzhiEPS.
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
<div class='mainbutton' >
<?php commonModel::printLink('tree', 'browse', "type=slide", '<i class="icon-group"></i> ' . $lang->slide->createGroup, "class='btn btn-primary'");?>
</div>
  <div class='row'>
  <?php foreach($groups as $group):?>
    <div class='col-md-3 col-sm-6'>
      <div class='panel project-block'>
        <div class='panel-heading'>
          <strong><?php commonModel::printLink('slide', 'browse', "groupID=$group->id", $group->name);?></strong>
        </div>
        <div class='panel-body'>
          <?php if($slide = $this->slide->getFirstSlide($group->id)):?>
          <?php if ($slide->backgroundType == 'image'): ?>
          <div class='item active'>
            <?php print(html::image($slide->image));?>
          <?php else: ?>
          <div class='item active' style='<?php echo 'background-color: ' . $slide->backgroundColor;?>'>
          <?php endif;?>
          <?php else:?>
          <div class = 'item active'><?php echo $lang->toBeAdd;?>
          <?php endif; ?>
          </div>
        </div> 
      </div>
    </div>
   <?php endforeach;?>
  </div>
<?php include '../../common/view/footer.admin.html.php';?>
  
