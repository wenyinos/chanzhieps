<?php
/**
 * The html template file of step4 method of install module of chanzhiEPS.
 *
 * @copyright Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     LGPL
 * @author	  Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package	  chanzhiEPS
 * @version	  $Id: step4.html.php 867 2010-06-17 09:32:58Z wwccss $
 */
?>
<?php include '../../common/view/header.lite.html.php';?>
<div class='container'>
  <div class='center-focus' style='max-width:500px'>
    <?php if(isset($error)):?>
    <div class='panel panel-pure'>
      <div class='panel-heading'><strong><?php echo $lang->install->error;?></strong></div>
      <table class='table table-form' align='center'>
      <tr><td class='text-danger'><?php echo $error;?></td></tr>
      <tr><td><?php echo html::backButton($lang->install->pre, 'btn btn-primary');?></td></tr>
      </table>
    </div>
    <?php else:?>
    <div class='panel panel-pure'>
      <div class='panel-heading'><strong><i class='icon-key'></i> <?php echo $lang->install->setAdmin;?></strong></div>
      <div class='panel-body'>
        <form method='post' class='form-horizontal'>
        <div class='form-group'>
          <label for='account' class='col-xs-2 control-label'><?php echo $lang->install->account;?></label>
          <div class='col-xs-8'><?php echo html::input('account', '', 'class='form-control'');?></div>
        </div>
        <div class='form-group'>
          <label for='password' class='col-xs-2 control-label'><?php echo $lang->install->password;?></label>
          <div class='col-xs-8'><?php echo html::input('password', '', 'class='form-control'');?></div>
        </div>
        <div class='form-group'>
          <div class='col-xs-2'></div>
          <div class='col-xs-10'>
            <?php echo html::submitButton();?>
          </div>
        </div>
        </form>
      </div>

    </div>

    <?php endif;?>
  </div>

</div>
<?php include './footer.html.php';?>
