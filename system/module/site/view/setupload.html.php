<?php
/**
 * The setupload  view file of site module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv11.html)
 * @author      xiying Guang <guanxiying@xirangit.com>
 * @package     site
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<?php include '../../common/view/kindeditor.html.php';?>
<div class='panel'>
  <div class='panel-heading'><strong><i class='icon-globe'></i> <?php echo $lang->site->setUpload;?></strong></div>
  <div class='panel-body'>
    <form method='post' id='ajaxForm' class='form-inline'>
      <table class='table table-form'>
        <tr>
          <th class='w-120px'><?php echo $lang->site->allowUpload;?></th>
          <td class='w-p40'><input type='checkbox' name='allowUpload' value='1' <?php if(isset($this->config->site->allowUpload) and $this->config->site->allowUpload) echo 'checked'?>/></td><td></td>
        </tr>
        <tr>
          <th><?php echo $lang->site->allowedFiles;?></th>
          <td colspan='2'>
            <?php echo html::textarea('allowedFiles', $this->config->file->allowed, "rows='4' class='form-control'");?>
            <span class='text-important'><?php echo $lang->site->fileAllowedRole;?></span>
          </td>
        </tr>
        <tr>
          <th><?php echo $lang->site->setImageSize;?></th>
          <td>
            <?php foreach($this->config->file->thumbs as $key => $thumb):?> 
            <div class='input-group' style='margin-bottom: 10px'>
              <span class='input-group-addon'><?php echo $lang->site->imageSize[$key];?></span>
              <span class='input-group-addon'><?php echo $lang->site->image['width'];?></span>
              <?php echo html::input("thumbs[$key][width]", $thumb['width'], "class='form-control' placeholder='{$thumb['width']}'");?>
              <span class="input-group-addon">px</span>
              <span class='input-group-addon fix-border'><?php echo $lang->site->image['height'];?></span>
              <?php echo html::input("thumbs[$key][height]", $thumb['height'], "class='form-control' placeholder='{$thumb['height']}'");?>
              <span class="input-group-addon">px</span>
            </div>
            <?php endforeach;?>
          </td>
          <td></td>
        </tr>
        <tr>
          <th></th>
          <td colspan='2'>
            <?php echo html::submitButton();?>
          </td>
        </tr>
      </table>
    </form>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
