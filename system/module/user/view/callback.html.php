<?php include '../../common/view/header.html.php';?>
<div class='row'>
  <div class='col-md-6'>
    <div class='panel panel-default'>
      <div class='panel-heading'>
        <h3>完善帐号信息</h3>
        <p class='muted'>设置您的帐号用户名及电子邮件</p>
      </div>
      <div class='panel-body'>
        <form method='post' target='hiddenwin' action='<?php echo $this->createLink('user', 'addAccount');?>' role='form'>
          <div class='form-group'>
            <label for='username'><?php echo $lang->user->account;?></label>
            <?php echo html::input('account', '', "id='username'") . '<font color="red">*</font>' . $lang->user->register->lblAccount;?>
          </div>
          <div class='form-group'>
            <label for='email'><?php echo $lang->user->email;?></label>
            <?php echo html::input('email', '', "id='email'") . '<font color="red">*</font>';?>
          </div>
          <?php 
          echo html::hidden('openID', $user['id']);
          echo html::submitButton('', 'btn btn-success btn-wider') . html::resetButton();
          ?>
        </form>
      </div>
    </div>
  </div>
  <div class='col-md-6'>
    <div class='panel panel-default'>
      <div class='panel-heading'>
        <h3>绑定云蝉知帐号</h3>
        <p class='muted'>如果您已注册过云蝉知帐号，请在此绑定</p>
      </div>
      <div class='panel-body'>
        <form method='post' target='hiddenwin' action='<?php echo $this->createLink('user', 'bind');?>' role='form'>
          <div class='form-group'>
            <label for='useraccount'><?php echo $lang->account;?></label>
            <?php echo html::input('account', '', "id='useraccount'" )?>
          </div>
          <div class='form-group'>
            <label for='password'>
              <?php 
              echo $lang->password;
              echo html::a($this->createLink('user', 'resetpassword'), $lang->forgotPassword, '');
              ?>
            </label>
            <?php echo html::input('password', '', "id='password'")?>
          </div>
          <?php 
          echo html::submitButton($lang->login, 'btn btn-success btn-wider') . html::resetButton();
          echo html::hidden('openID', $user['id']);
          ?>
        </form>
      </div>
    </div>
  </div>
</div>
<?php include '../../common/view/footer.html.php';?>
