<?php
include TPL_ROOT . 'common/header.html.php';
js::import($jsRoot . 'md5.js');
js::import($jsRoot . 'fingerprint/fingerprint.js');
js::import($templateCommonRoot . 'js/mzui.form.min.js');
js::set('random', $this->session->random);
?>

<div class="panel-section">
  <div class="panel-heading">
    <div class="title"><strong><?php echo $lang->user->login->welcome;?></strong></div>
  </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-6"><a href="###" class="btn danger block"><i class="icon-weibo"></i> 新浪微博</a></div>
      <div class="col-6"><a href="###" class="btn info block"><i class="icon-qq"></i> QQ</a></div>
    </div>
  </div>
  <hr>
  <div class="panel-heading">
    <div class="title"><strong><?php echo $lang->user->login->welcome;?></strong></div>
  </div>
  <div class="panel-body">
  <form method='post' id='loginForm' role='form' data-checkfingerprint='1'>
    <div class='form-group hide form-message alert text-danger bg-danger-pale'>
      <i class="icon icon-info-sign icon-s1"></i>
      <div class="content"></div>
    </div>
    <div class='form-group'><?php echo html::input('account','',"placeholder='{$lang->user->inputAccountOrEmail}' class='form-control'");?></div>
    <div class='form-group'><?php echo html::password('password','',"placeholder='{$lang->user->inputPassword}' class='form-control'");?></div>
    <div class='form-group'><?php echo html::submitButton($lang->user->login->common, 'btn primary block');?></div>
    <div class='form-group'>
      <?php if($config->mail->turnon) echo html::a(inlink('resetpassword'), $lang->user->recoverPassword, "class='btn btn-link'") . ' ';?>
      <?php echo html::a(inlink('register'), $lang->user->register->common, "class='btn btn-link'");?>
      <?php echo html::hidden('referer', $referer);?>
    </div>
  </form>
  </div>
</div>

<?php include TPL_ROOT . 'common/footer.html.php';?>
