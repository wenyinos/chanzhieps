<?php
include '../../common/view/header.lite.html.php';
?> 
<div class='container'>
  <div id='adminLogin'>
    <div id='formError' class='alert alert-danger hiding'></div>
    <div class='row'>
      <div class='col-xs-6' id='createBox'>
        <h5><?php echo $lang->user->oauth->lblProfile;?></h5>
        <form method='post' id='registerForm' action='<?php echo inlink('register');?>' role='form'>
          <table class="table table-form">
            <tr>
              <th class='w-60px'><?php echo $lang->user->account;?></th>
              <td><?php echo html::input('account', $ranzhiUser->account, "class='form-control' placeholder='{$lang->user->register->lblAccount}'");?></td>
            </tr>
            <tr>
              <th><?php echo $lang->user->email;?></th>
              <td><?php echo html::input('email', $ranzhiUser->email,  "class='form-control'");?></td>
            </tr>
            <tr>
              <th></th>
              <td><?php echo html::submitButton('', 'btn btn-success btn-wider'); ?></td>
            </tr>
          </table>
       </form>
      </div>
      <div class='col-xs-6'>
        <h5><?php echo $lang->user->oauth->lblBind;?></h5>
        <form method='post' id='bindForm' action='<?php echo inlink('bind');?>' role='form'>
          <table class="table table-form">
            <tr>
              <th class='w-60px'><?php echo $lang->user->account?></th>
              <td><?php echo html::input('account','',"class='form-control' placeholder='{$lang->user->inputAccountOrEmail}'");?></td>
            </tr>
            <tr>
              <th><?php echo $lang->user->password?></th>
              <td><?php echo html::password('password','',"class='form-control' placeholder='{$lang->user->inputPassword}'");?></td>
            </tr>
            <tr>
              <th></th>
              <td><?php echo html::submitButton($lang->user->login->common, 'btn btn-primary btn');?></td>
            </tr>
          </table>
        </form>
      </div>
    </div>
  </div>
</div>
<?php
if($config->debug) js::import($jsRoot . 'jquery/form/min.js');
if(isset($pageJS)) js::execute($pageJS);
?>
</body>
</html>
