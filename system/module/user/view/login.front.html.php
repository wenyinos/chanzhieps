<?php include '../../common/view/header.html.php';?>
<div class='container'>
  <section id="login">
    <div class="box-radius">
      <div class="row">
        <div class="col-md-6">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h2><?php echo $lang->user->login->openID;?></h2>
            </div>
            <div class="panel-body">
            <?php 
                foreach($config->user->openID->List as $provider => $name) 
                {
                    echo html::a(inlink('openIDLogin', "provider=$provider"), "<i class='icon-{$provider} icon-large'></i> " . $lang->user->login->sina, '', "class='btn btn-default btn-wider btn-lgx btn-block'");
                }
            ?>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h2><?php echo $lang->user->login->welcome;?></h2>
            </div>
            <div class="panel-body">
              <form method='post' id='ajaxForm' role='form'>
                <div class="form-group">
                  <label for="useraccount"><?php echo $lang->user->account;?></label>
                  <?php echo html::input('account','',"placeholder='{$lang->user->inputAccountOrEmail}'");?>
                </div>
                <div class="form-group">
                  <label for="password"><?php echo $lang->user->password;?></label>
                  <?php echo html::password('password','',"placeholder='{$lang->user->inputPassword}'");?>
                </div>
                <?php echo html::submitButton($lang->user->login->common, 'btn btn-primary btn-wider');?>
                <?php echo html::hidden('referer', $referer);?>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<?php include '../../common/view/footer.html.php';?>
