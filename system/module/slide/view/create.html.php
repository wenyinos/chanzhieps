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
          <th class='w-100px'><?php echo $lang->slide->title;?></th>
          <td class='w-p40'><?php echo html::input('title', '', "class='form-control'");?></td>
          <td>
            <div class='colorplate clearfix'>
              <div class='input-group color active' data='#fff'>
                <span class='input-group-addon'> <i class='icon icon-question'></i><i class='icon-ok'></i> </span>
                <?php echo html::input('titleColor', '#fff', "class='form-control input-color text-latin' placeholder='" . $lang->slide->colorTip . "'");?>
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <th><?php echo $lang->slide->imageUrl;?></th>
          <td><?php echo html::input('imageUrl', '', "class='form-control'");?></td><td colspan='2'></td>
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
          <td colspan='2'><label class='text-info'><?php echo $lang->slide->suitableSize;?></label></td>
        </tr>
        <tr>
          <th><?php echo $lang->slide->button;?></th>
          <td>
            <div class='input-group'>
              <div class='input-group-btn'>
                <button type='button' class='btn btn-default dropdown-toggle' title='<?php echo $lang->slide->btn->type;?>' data-toggle='dropdown'><?php echo $lang->slide->btn->default;?> <span class='caret'></span></button>
                <?php echo html::hidden('button[]');?>
                <div class='dropdown-menu buttons'>
                  <button type='button' data-id='default' class='btn btn-lg'><?php echo $lang->slide->btn->default;?></button>
                  <button type='button' data-id='primary' class='btn btn-lg btn-primary'><?php echo $lang->slide->btn->primary;?></button>
                  <button type='button' data-id='warning' class='btn btn-lg btn-warning'><?php echo $lang->slide->btn->warning;?></button>
                  <button type='button' data-id='danger' class='btn btn-lg btn-danger'><?php echo $lang->slide->btn->danger;?></button>
                  <button type='button' data-id='success' class='btn btn-lg btn-success'><?php echo $lang->slide->btn->success;?></button>
                  <button type='button' data-id='info' class='btn btn-lg btn-info'><?php echo $lang->slide->btn->info;?></button>
                </div>
              </div>
              <?php echo html::input('label[]', '', "class='form-control' placeholder='{$lang->slide->label}'");?>
            </div>
          </td>
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
        <td>
          <div class='input-group'>
            <div class='input-group-btn'>
              <button type='button' class='btn btn-default dropdown-toggle' title='<?php echo $lang->slide->btn->type;?>' data-toggle='dropdown'><?php echo $lang->slide->btn->default;?> <span class='caret'></span></button>
              <?php echo html::hidden('button[]');?>
              <div class='dropdown-menu buttons'>
                <button type='button' data-id='default' class='btn btn-lg'><?php echo $lang->slide->btn->default;?></button>
                <button type='button' data-id='primary' class='btn btn-lg btn-primary'><?php echo $lang->slide->btn->primary;?></button>
                <button type='button' data-id='warning' class='btn btn-lg btn-warning'><?php echo $lang->slide->btn->warning;?></button>
                <button type='button' data-id='danger' class='btn btn-lg btn-danger'><?php echo $lang->slide->btn->danger;?></button>
                <button type='button' data-id='success' class='btn btn-lg btn-success'><?php echo $lang->slide->btn->success;?></button>
                <button type='button' data-id='info' class='btn btn-lg btn-info'><?php echo $lang->slide->btn->info;?></button>
              </div>
            </div>
            <?php echo html::input('label[]', '', "class='form-control' placeholder='{$lang->slide->label}'");?>
          </div>
        </td>
        <td><?php echo html::input('buttonUrl[]', '', "class='form-control' placeholder='{$lang->slide->buttonUrl}'");?></td>
        <td><?php echo html::a('javascript:;', "<i class='icon-plus'></i>", "class='plus'") . html::a('javascript:;', "<i class='icon-minus'></i>", "class='delete'");?></td>
      </tr>
    </tbody>
  </table>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
