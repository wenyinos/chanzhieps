<?php include '../../common/view/header.modal.html.php';?>
<?php js::import($jsRoot . 'fingerprint/fingerprint.js');?>
<form method='post' action='<?php echo inlink('changeEmail');?>' id='emailForm' class='form' data-checkfingerprint='1'>
  <table class='table table-form borderless'>
    <tr>
      <th class='w-100px'><?php echo $lang->user->password;?></th>
      <td colspan='2'><?php echo html::password('password','', "class='form-control'");?></td>
    </tr>
    <tr>
      <th><?php echo $lang->user->email;?></th>
      <td colspan='2'><?php echo html::input('email', '', "class='form-control'");?></td>
    </tr>
    <tr>
      <th><?php echo $lang->mail->email;?></th>
      <td class='w-250px'><?php echo html::input('captcha', '', "class='form-control' placeholder={$lang->mail->captcha}");?></td>
      <td><?php echo html::a($this->createLink('mail', 'sendmailcode', "account=$account"), $lang->mail->getEmailCode, "id='mailSender' class='btn btn-success'");?></td>
    </tr>
    <tr>
      <th></th><td><?php echo html::submitButton();?></td>
    </tr>
  </table>
</form>
<?php include '../../common/view/footer.modal.html.php';?>
