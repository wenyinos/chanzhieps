<?php include "header.html.php"; ?>
<?php
js::set('visuals', $lang->visual->config);
js::set('visualLang', $lang->visual->jsLang);
js::set('visualStyle', $themeRoot . 'common/visual.css');
js::set('visualBlocks', $blocks);
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
      <li><a href='###' id='visualReloadBtn'><i class='icon-refresh'></i> <?php echo $lang->visual->reload?></a></li>
      <li><a href='###' id='visualPreviewBtn'><i class='icon-eye-open'></i> <?php echo $lang->visual->preview?></a></li>
      <li>
        <?php commonModel::printLink('admin', 'index', '', '<i class="icon-cogs"></i> ' . $lang->visual->admin, "target='_blank'") ?>
      </li>
    </ul>
  </div>
  <a href='<?php echo $referer;?>' class='close' id='visualExitBtn' data-toggle='tooltip' data-placement='left' title='<?php echo $lang->visual->exitVisualEdit;?>'>&times;</a>
</div>
<div id='visualPageWrapper'>
  <iframe id='visualPage' name='visualPage' src='<?php echo $referer;?>' frameborder='no' allowtransparency='true' scrolling='auto' hidefocus='' style='width: 100%; height: 100%; left: 0; top: 0'></iframe>
</div>
<?php include "footer.html.php"; ?>
