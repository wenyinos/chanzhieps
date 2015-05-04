<?php include '../../common/view/header.modal.html.php';?>
<?php if($pass):?>
<form method='post' action='<?php echo inlink('changepassword');?>' id='passwordForm' class='form'>
  <table class='table table-form borderless'>
    <tr>
      <th class="w-100px"><?php echo $lang->user->account;?></th>
      <td><?php echo $this->app->user->account;?></td><td></td>
    </tr>  
    <tr>
      <th><?php echo $lang->user->password;?></th>
      <td><?php echo html::password('password', '', "class='form-control'");?></td><td></td>
    </tr>  
    <tr>
      <th><?php echo $lang->user->newPassword;?></th>
      <td><?php echo html::password('password1', '', "class='form-control'");?></td><td></td>
    </tr>  
    <tr>
      <th><?php echo $lang->user->password2;?></th>
      <td><?php echo html::password('password2', '', "class='form-control'");?></td><td></td>
    </tr>  
    <tr><td></td><td><?php echo html::submitButton();?></td></tr>
  </table>
</form>
<?php else:?>
<?php 
$type = $lang->user->changePassword;
$url  = helper::safe64Encode($this->createLink('user', 'changepassword'));
include '../../mail/view/captcha.html.php';
?>
<?php endif;?>
<?php include '../../common/view/footer.modal.html.php';?>
