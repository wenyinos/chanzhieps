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
      <?php echo html::a($this->inlink('create'), '<i class="icon-plus"></i> ' . $lang->slide->create, "class='btn btn-primary'");?>
    </div>
  </div>
  <form id='sortForm' action='<?php echo inLink('sort')?>' method='post'>
    <table class='table table-hover table-bordered'>
      <thead>
        <tr class='text-center'>
          <th class='w-80px'><?php echo $lang->slide->sort;?></th>
          <th><?php echo $lang->slide->background->type;?></th>
          <th class='w-80px'><?php echo $lang->actions;?></th>
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
          <td>
            <div class='carousel slide mg-0'>
              <div class='carousel-inner'>
                <?php if ($slide->backgroundType == 'image'): ?>
                <div class='item active'>
                  <?php print(html::image($slide->image));?>
                <?php else: ?>
                <div class='item active' style='<?php echo 'background-color: ' . $slide->backgroundColor . '; height: ' . $slide->height . 'px';?>'>
                <?php endif ?>
                  <div class='carousel-caption'>
                    <h2 style='color:<?php echo $slide->titleColor;?>'><?php echo $slide->title;?></h2>
                    <div><?php echo $slide->summary;?></div>
                    <?php
                    foreach($slide->label as $key => $label):
                    if(trim($label) != '') echo html::a($slide->buttonUrl[$key], $label, "class='btn btn-lg btn-" . $slide->buttonClass[$key] . "'");
                    endforeach;
                    ?>
                  </div>
                </div>
              </div>
            </div>
          </td>

          <td class='text-center'><?php echo html::a($slide->image, html::image($slide->image, "class='image-small'"), "target='_blank'");?></td>
          <td><?php echo $slide->title;?></td>
          <td><?php echo $slide->summary;?></td>
          <td><?php foreach($slide->label as $label) echo $label . ' ';?></td> -->
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
