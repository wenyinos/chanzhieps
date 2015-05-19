<?php include TPL_ROOT . 'common/header.html.php';?>
<div class='panel panel-body'>
  <div class='panel panel-pure' id='checkEmail'>
    <div class='panel-heading'><strong><?php echo $lang->user->checkEmail;?></strong></div>
    <div class='panel-body'>
      <form method='post' action='<?php echo inlink('checkEmail', "account=$user->account");?>' id='ajaxForm'>
        <div class='alert alert-danger'><?php echo $lang->user->emailNoCertified;?></div>
        <div class='form-group'>
          <?php echo html::input('email', $user->email, "class='form-control'");?>
        </div>
        <?php echo html::submitButton('', 'btn btn-primary btn-block') . html::hidden('referer', $referer);?>
      </form>
    </div>
  </div>
</div>
<?php include TPL_ROOT . 'common/footer.html.php';?>
