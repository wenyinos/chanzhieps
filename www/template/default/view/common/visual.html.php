<?php
js::import($jsRoot . 'visual.js');
css::import($themeRoot . 'common/visual.css');
js::set('visuals', $lang->visual->code);
js::set('visualEdit', $lang->edit);
?>
<div id='visualPanel'>
  <button type='button' id='visualPreviewBtn' class='btn btn-primary'><i class='icon-eye-open'></i> <?php echo $lang->visual->preview?></button>
  <button type='button' id='visualExitBtn' class='btn btn-danger'><i class='icon-signout'></i> <?php echo $lang->visual->exit?></button>
</div>
