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
          <th class='col-md-1 col-sm-2'><?php echo $lang->slide->title;?></th>
          <td class='col-md-5 col-sm-7'><?php echo html::input('title', $slide->title, 'class="form-control"');?></td><td></td>
        </tr>
        <tr>
          <th><?php echo $lang->slide->url;?></th>
          <td><?php echo html::input('url', $slide->url, 'class="form-control"');?></td><td></td>
        </tr>
        <tr>
          <th rowspan="2"><?php echo $lang->slide->image;?></th>
          <td>
            <?php echo html::image($slide->image, "class='image'");?>
          </td><td></td>
        </tr>
        <tr>
          <td><?php echo html::file('files[]', "tabindex='-1' class='form-control'");?></td>
          <td><label class='text-info'><?php echo $lang->slide->suitableSize;?></label></td>
        </tr>
        <tr>
          <th><?php echo $lang->slide->label;?></th>
          <td><?php echo html::input('label', $slide->label, 'class="form-control"');?></td><td></td>
        </tr>
        <tr>
          <th><?php echo $lang->slide->summary;?></th>
          <td colspan="2"><?php echo html::textarea('summary', $slide->summary, 'class="form-control"');?></td>
        </tr>
        <tr>
          <td></td>
          <td colspan='2'>
            <?php echo html::hidden('id', $id);?>
            <?php echo html::hidden('image', $slide->image);?>
            <?php echo html::submitButton();?>
          </td>
        </tr>
      </table>
    </form>
  </div>

</div>

<?php include '../../common/view/footer.admin.html.php';?>
