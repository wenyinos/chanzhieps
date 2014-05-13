<?php
/**
 * The edit view file of slide of chanzhiEPS.
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
  <div class='panel-heading'><strong><i class='icon-edit'></i> <?php echo $lang->slide->edit;?></strong></div>
  <div class='panel-body'>
    <form id='ajaxForm' method='post' enctype='multipart/form-data'>
      <table class='table table-form'>
        <tr>
          <th class='w-100px'><?php echo $lang->slide->title;?></th>
          <td class='w-p40'><?php echo html::input('title', $slide->title, 'class="form-control"');?></td><td class='w-p30'></td><td></td>
        </tr>
        <tr>
          <th><?php echo $lang->slide->imageUrl;?></th>
          <td><?php echo html::input('imageUrl', $slide->imageUrl, "class='form-control'");?></td><td colspan='2'></td>
        </tr>
        <tr>
          <th rowspan='2'><?php echo $lang->slide->image;?></th>
          <td><?php echo html::image($slide->image, "class='image'");?></td><td colspan='2'></td>
        </tr>
        <tr>
          <td><?php echo html::file('files[]', "tabindex='-1' class='form-control'");?></td>
          <td colspan='2'><label class='text-info'><?php echo $lang->slide->suitableSize;?></label></td>
        </tr>
        <?php foreach($slide->label as $key => $label):?>
        <tr>
          <th><?php echo $lang->slide->button;?></th>
          <td><?php echo html::input('label[]', $label, "class='form-control' placeholder='{$lang->slide->label}'");?></td>
          <td><?php echo html::input('buttonUrl[]', $slide->buttonUrl[$key], "class='form-control' placeholder='{$lang->slide->buttonUrl}'");?></td>
          <td><?php echo html::a('javascript:;', "<i class='icon-plus'></i>", "class='plus'") . html::a('javascript:;', "<i class='icon-minus'></i>", "class='delete'");?></td>
        </tr>
        <?php endforeach;?>
        <tr>
          <th><?php echo $lang->slide->summary;?></th>
          <td colspan='2'><?php echo html::textarea('summary', $slide->summary, 'class="form-control"');?></td>
          <td><label class='text-info'><?php echo $lang->slide->suitableDesc;?></label></td>
        </tr>
        <tr>
          <td></td>
          <td colspan='3'>
            <?php echo html::hidden('id', $id);?>
            <?php echo html::hidden('image', $slide->image);?>
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
