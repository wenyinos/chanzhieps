<?php include '../../common/view/header.html.php';?>
<section id="login">
  <div class="box-radius">
    <div class="row">
      <?php if(!empty($this->config->site->akey) && !empty($this->config->site->skey)):?>
      <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading"><h4><strong><?php echo $lang->user->login->openID;?></strong></h4></div>
          <div class="panel-body">
            <?php 
            foreach($config->user->openID->List as $provider => $name) 
            {
                $backUrl = isset($referer) ? helper::safe64Encode($referer) : '';
                echo html::a(inlink('openIDLogin', "provider=$provider&referer=$backUrl"), "<i class='icon-{$provider} icon-large'></i> " . $lang->user->login->sina, '', "class='btn btn-default btn-wider btn-lgx btn-block'");
            }
            ?>
          </div>
        </div>
      </div>
      <div class="col-md-6">
      <?php else:?>
      <div class="col-md-12">
      <?php endif;?>
        <div class="panel panel-default">
          <div class="panel-heading"><h4><strong><?php echo $lang->user->login->welcome;?></strong></h4></div>
          <div class="panel-body">
            <form method='post' id='ajaxForm' role='form'>
              <div class="form-group">
                <label for="useraccount"><?php echo $lang->user->account;?></label>
                <?php echo html::input('account','',"placeholder='{$lang->user->inputAccountOrEmail}' class='input-lg'");?>
              </div>
              <div class="form-group">
                <label for="password"><?php echo $lang->user->password;?></label>
                <?php echo html::password('password','',"placeholder='{$lang->user->inputPassword}' class='input-lg'");?>
              </div>
              <?php echo html::submitButton($lang->user->login->common, 'btn btn-primary btn-wider btn-lg');?>
              <?php echo html::hidden('referer', $referer);?>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php include '../../common/view/footer.html.php';?>
