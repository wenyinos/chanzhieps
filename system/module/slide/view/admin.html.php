<?php
/**
 * The admin browse view file of slide module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     LGPL
 * @author      Xiying Guan<guanxiying@xirangit.com>
 * @package     slide
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<div class='panel'>
  <div class='panel-heading'>
    <strong><i class='icon-picture'></i> <?php echo $lang->slide->admin;?></strong>
    <div class='panel-actions'>
      <?php echo html::a($this->inlink('create'), '<i class="icon-plus"></i> ' . $lang->slide->create, "class='btn btn-info'");?>
    </div>
  </div>
  <form id='sortForm' action='<?php echo inLink('sort')?>' method='post'>
    <table class='table table-hover table-bordered'>
      <thead>
        <tr class='text-center'>
          <th><?php echo $lang->slide->sort;?></th>
          <th><?php echo $lang->slide->image;?></th>
          <th><?php echo $lang->slide->title;?></th>
          <th><?php echo $lang->slide->summary;?></th>
          <th><?php echo $lang->slide->label;?></th>
          <th><?php echo $lang->actions;?></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($slides as  $key => $slide):?>
        <tr class='text-middle'>
          <td class='text-center'>
            <i class='icon-arrow-up'></i>
            <i class='icon-arrow-down'></i>            
            <?php echo html::hidden("order[{$slide->id}]", $key);?>
          </td>
          <td class='text-center'><?php echo html::a($slide->image, html::image($slide->image, "class='image-small'"), "target='_blank'");?></td>
          <td><?php echo $slide->title;?></td>
          <td><?php echo $slide->summary;?></td>
          <td><?php echo $slide->label;?></td>
          <td class='text-center'>
            <?php
            echo html::a($this->createLink('slide', 'edit', "id=$slide->id"), $lang->edit);
            echo html::a($this->createLink('slide', 'delete', "id=$slide->id"), $lang->delete, "class='deleter'");
            ?>
          </td>
        </tr>
        <?php endforeach;?>
      </tbody>
      <tfoot>
      <tr><td colspan='6'>&nbsp;<?php echo html::submitButton($this->lang->slide->saveSort);?></td></tr> 
      </tfoot>
    </table>
  </form>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
