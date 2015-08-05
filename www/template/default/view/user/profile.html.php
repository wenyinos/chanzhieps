<?php include TPL_ROOT . 'common/header.html.php';?>
<div class='page-user-control'>
  <div class='row'>
    <?php include TPL_ROOT . 'user/side.html.php';?>
    <div class='col-md-10'>
      <div class='panel'>
        <div class='panel-heading'><strong><i class='icon-user'></i> <?php echo $lang->user->profile;?></strong></div>
        <div class='panel-body'>
          <dl class='dl-horizontal'>
            <dt><?php echo $lang->user->realname;?></dt>
            <dd>
              <?php echo $user->realname;?>
              <?php if(isset($user->provider) and isset($user->openID)):?>
              <?php if(strpos($user->account, "{$user->provider}_") === false):?>
              <span class='label label-info'><?php echo $lang->user->oauth->typeList[$user->provider];?></span>
              <?php echo html::a(inlink('oauthUnbind', "account=$user->account&provider=$user->provider&openID=$user->openID"), "<i class='icon-unlink'></i> " . $lang->user->oauth->lblUnbind, "class='btn btn-primary jsoner'");?>
              <?php else:?>
              <?php echo html::a(inlink('oauthRegister'), "<i class='icon-link'></i> " . $lang->user->oauth->lblProfile, "class='btn btn-primary'");?>
              <?php echo html::a(inlink('oauthBind'), "<i class='icon-link'></i> " . $lang->user->oauth->lblBind, "class='btn btn-primary'");?>
              <?php endif;?>
              <?php endif;?>
            </dd>
            <dt><?php echo $lang->user->email;?></dt>
            <dd>
              <?php echo $user->email;?>&nbsp;&nbsp;&nbsp;
              <?php echo html::a(inlink('editemail'), "<i class='icon-pencil'></i> " . $lang->user->editEmail, "class='btn btn-mini btn-primary'");?>
            </dd>
            <dt><?php echo $lang->user->company;?></dt>
            <dd><?php echo $user->company;?></dd>
            <dt><?php echo $lang->user->address;?></dt>
            <dd><?php echo $user->address;?></dd>
            <dt><?php echo $lang->user->zipcode;?></dt>
            <dd><?php echo $user->zipcode;?></dd>
            <dt><?php echo $lang->user->mobile;?></dt>
            <dd><?php echo $user->mobile;?></dd>
            <dt><?php echo $lang->user->phone;?></dt>
            <dd><?php echo $user->phone;?></dd>
            <dt><?php echo $lang->user->qq;?></dt>
            <dd><?php echo $user->qq;?></dd>
            <dt><?php echo $lang->user->gtalk;?></dt>
            <dd><?php echo $user->gtalk;?></dd>
            <dt></dt>
            <dd><?php echo html::a(inlink('edit'), "<i class='icon-pencil'></i> " . $lang->user->editProfile, "class='btn btn-primary'");?></dd>
          </dl>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include TPL_ROOT . 'common/footer.html.php';?>
