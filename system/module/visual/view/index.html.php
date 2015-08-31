<?php include "header.html.php"; ?>
<?php
js::set('visuals', $lang->visual->config);
js::set('visualActions', $lang->visual->actionsName);
js::set('visualSaved', $lang->saveSuccess);
js::set('visualDeleted', $lang->deleteSuccess);
js::set('visualStyle', $themeRoot . 'common/visual.css');
?>
<div class='navbar navbar-fixed-top' id='visualPanel'>
  <div class='container'>
    <div class="navbar-header">
      <?php commonModel::printLink('visual', 'index', '', '<i class="icon-pencil"></i> ' . $lang->visual->info . ' <i class="icon-angle-right"></i>', "class='navbar-brand'") ?>
    </div>
    <ul class='nav navbar-nav'>
      <li><a href='###' id='visualPageName' target='_blank'><i class='icon icon-spinner icon-spin'></i></a></li>
    </ul>
    <ul class="nav navbar-nav pull-right">
      <li><a href='###' id='visualPreviewBtn'><i class='icon-eye-open'></i> <?php echo $lang->visual->preview?></a></li>
      <li><a href='<?php echo $referer;?>' id='visualExitBtn'><i class='icon-signout'></i> <?php echo $lang->visual->exit?></a></li>
    </ul>
  </div>
</div>
<div id='visualPageWrapper'>
  <iframe id='visualPage' name='visualPage' src='<?php echo $referer;?>' frameborder='no' allowtransparency='true' scrolling='auto' hidefocus='' style='width: 100%; height: 100%; left: 0; top: 0'></iframe>
</div>
<?php include "footer.html.php"; ?>
