<?php
/**
 * The post view file of thread for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1 (http://www.chanzhi.org/license/)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     thread
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<div class='modal-dialog'>
  <div class='modal-content'>
    <div class='modal-header'>
      <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>×</span></button>
      <h5 class='modal-title'><i class='icon-pencil'></i> <?php echo $lang->thread->postTo . ' [ ' . $board->name . ' ]'; ?></h5>
    </div>
    <div class='modal-body'>
      <form id='postThreadForm' method='post' action='<?php echo $this->createLink('thread', 'post', "boardID=$board->id");?>'>
        <div class='form-group'>
          <?php echo html::input('title', '', "class='form-control' placeholder='{$lang->thread->title}'");?>
        </div>
        <div class='form-group'>
          <?php echo html::textarea('content', '', "class='form-control' rows='15' placeholder='{$lang->thread->content}'");?>
        </div>
        <?php if($this->loadModel('file')->canUpload()):?>
        <?php // TODO: support upload files ?>
        <?php endif;?>
        <?php if($canManage):?>
        <div class='form-group'>
          <div class="checkbox">
            <label>
              <?php echo "<input type='checkbox' name='readonly' value='1'/><span>{$lang->thread->readonly}</span>" ?>
            </label>
          </div>
        </div>
        <?php endif;?>
        <table style='width: 100%'>
          <tr class='hide captcha-box'></tr>
        </table>
        <div class='form-group'>
          <?php echo html::submitButton('', 'btn primary block');?>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
$(function()
{
    var $postThreadForm = $('#postThreadForm');
    $postThreadForm.ajaxform({onSuccess: function(response)
    {
        if(response.result == 'success')
        {
            $.closeModal();
        }
        if(response.reason == 'needChecking')
        {
            $postThreadForm.find('.captcha-box').html(response.captcha).removeClass('hide');
        }
    }});
});
</script>
