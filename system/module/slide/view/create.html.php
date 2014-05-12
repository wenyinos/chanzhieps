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
<?php
$colorPlates = '';
foreach (explode('|', $lang->slide->colorPlates) as $value)
{
    $colorPlates .= "<div class='color color-tile' data='#" . $value . "'><i class='icon-ok'></i></div>";
}
?>
<div class='panel'>
  <div class='panel-heading'><strong><i class='icon-plus'></i> <?php echo $lang->slide->create;?></strong></div>
  <div class='panel-body'>
    <form id='ajaxForm' method='post' enctype='multipart/form-data'>
      <table class='table table-form'>
        <tr>
          <th class='col-md-1 col-xs-2'><?php echo $lang->slide->title;?></th>
          <td class='col-md-5 col-xs-7'><?php echo html::input('title', '', "class='form-control'");?></td><td></td>
        </tr>
        <tr>
          <th><?php echo $lang->slide->url;?></th>
          <td><?php echo html::input('url', '', "class='form-control'");?></td>
        </tr>
        <tr>
          <th><?php echo $lang->slide->background;?></th>
          <td><?php echo html::radio('bg', $lang->slide->bg, 'image', "class='radio'");?></td>
        </tr>
        <tr class='bg-section' data-id='color'>
          <th><?php echo $lang->slide->bg->color;?></th>
          <td colspan='2'>
            <div class='colorplate clearfix'>
              <div class='input-group color active' data='<?php echo $config->themeSetting->primaryColor;?>'>
                <span class='input-group-addon'> <i class='icon icon-question'></i><i class='icon-ok'></i> </span>
                <?php echo html::input('color', $config->themeSetting->primaryColor, "class='form-control input-color text-latin' placeholder='" . $lang->slide->colorTip . "'");?>
              </div>
              <?php echo $colorPlates; ?>
            </div>
          </td>
        </tr>
        <tr class='bg-section' data-id='color'>
          <th><?php echo $lang->slide->height;?></th>
          <td>
            <div class='input-group'>
              <?php echo html::input('height', '', "class='form-control'");?>
              <span class='input-group-addon'>px</span>
            </div>
          </td>
        </tr>
        <tr class='bg-section' data-id='image'>
          <th><?php echo $lang->slide->bg->image;?></th>
          <td><?php echo html::file('files[]', "tabindex='-1' class='form-control'");?></td>
          <td><label class='text-info'><?php echo $lang->slide->suitableSize;?></label></td>
        </tr>
        <tr>
          <th><?php echo $lang->slide->label;?></th>
          <td><?php echo html::input('label', '', "class='form-control'");?></td>
        </tr>
        <tr>
          <th><?php echo $lang->slide->summary;?></th>
          <td colspan="2"><?php echo html::textarea('summary', '', "class='form-control' rows='6'");?></td>
        </tr>
        <tr>
          <td></td>
          <td colspan='2'>
            <?php echo html::submitButton();?>
          </td>
        </tr>
      </table>
    </form>
  </div>

</div>
<?php include '../../common/view/footer.admin.html.php';?>
