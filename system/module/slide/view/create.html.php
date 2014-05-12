<?php
/**
 * The create view file of slide of chanzhiEPS.
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
<?php include '../../common/view/kindeditor.html.php';?>
<div class='panel'>
  <div class='panel-heading'><strong><i class='icon-plus'></i> <?php echo $lang->slide->create;?></strong></div>
  <div class='panel-body'>
    <form id='ajaxForm' method='post' enctype='multipart/form-data'>
      <table class='table table-form'>
        <tr>
          <th class='w-100px'><?php echo $lang->slide->title;?></th>
          <td class='w-p40'><?php echo html::input('title', '', "class='form-control'");?></td><td class='w-p40'></td><td></td>
        </tr>
        <tr>
          <th><?php echo $lang->slide->imageUrl;?></th>
          <td><?php echo html::input('imageUrl', '', "class='form-control'");?></td><td colspan='2'></td>
        </tr>
        <tr>
          <th><?php echo $lang->slide->image;?></th>
          <td><?php echo html::file('files[]', "tabindex='-1' class='form-control'");?></td>
          <td colspan='2'><label class='text-info'><?php echo $lang->slide->suitableSize;?></label></td>
        </tr>
        <tr>
          <th><?php echo $lang->slide->button;?></th>
          <td><?php echo html::input('label[]', '', "class='form-control' placeholder='{$lang->slide->label}'");?></td>
          <td><?php echo html::input('buttonUrl[]', '', "class='form-control' placeholder='{$lang->slide->buttonUrl}'");?></td>
          <td><?php echo html::a('javascript:;', "<i class='icon-plus'></i>", "class='plus'") . html::a('javascript:;', "<i class='icon-minus'></i>", "class='delete'");?></td>
        </tr>
        <tr>
          <th><?php echo $lang->slide->summary;?></th>
          <td colspan='2'><?php echo html::textarea('summary', '', "class='form-control' rows='6'");?></td>
          <td><label class='text-info'><?php echo $lang->slide->suitableDesc;?></label></td>
        </tr>
        <tr>
          <td></td>
          <td colspan='3'>
            <?php echo html::submitButton();?>
          </td>
        </tr>
      </table>
    </form>
  </div>
  <table class='hide'>
    <tbody id='button'>
      <tr>
        <th><?php echo $lang->slide->button;?></th>
        <td><?php echo html::input('label[]', '', "class='form-control' placeholder='{$lang->slide->label}'");?></td>
        <td><?php echo html::input('buttonUrl[]', '', "class='form-control' placeholder='{$lang->slide->buttonUrl}'");?></td>
        <td><?php echo html::a('javascript:;', "<i class='icon-plus'></i>", "class='plus'") . html::a('javascript:;', "<i class='icon-minus'></i>", "class='delete'");?></td>
      </tr>
    </tbody>
  </table>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
