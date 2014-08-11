<?php include '../../common/view/header.modal.html.php';?>
<form method='post' action='<?php echo inlink('customtheme', "theme={$theme}&template={$template}");?>' id='customThemeForm' class='form'>
  <?php
  $colorPlates = '';
  foreach (explode('|', $lang->ui->theme->colorPlates) as $value)
  {
      $colorPlates .= "<div class='color color-tile' data='#" . $value . "'><i class='icon-ok'></i></div>";
  }
  ?>
  <table class='table table-form borderless'>
    <tr>
      <th><?php echo $lang->ui->theme->fontSize; ?></th>
      <td>
        <?php echo html::select('fontSize', $lang->ui->theme->fontSizeList, $config->themeSetting->fontSize, "class='form-control w-200px'");?>
      </td>
    </tr>
    <tr>
      <th><?php echo $lang->ui->theme->borderRadius; ?></th>
      <td>
        <?php echo html::select('borderRadius', $lang->ui->theme->borderRadiusList, $config->themeSetting->borderRadius, "class='form-control w-200px'");?>
      </td>
    </tr>
    <tr>
      <th class='w-100px'><?php echo $lang->ui->theme->primaryColor; ?></th>
      <td>
        <div class='colorplate clearfix'>
          <div class='input-group color active' data='<?php echo $config->themeSetting->primaryColor;?>'>
            <span class='input-group-addon'> <i class='icon icon-question'></i><i class='icon-ok'></i> </span>
            <?php echo html::input('primaryColor', $config->themeSetting->primaryColor, "class='form-control input-color text-latin' placeholder='" . $lang->ui->custom . "'");?>
          </div>
          <?php echo $colorPlates; ?>
        </div>
      </td>
    </tr>
    <tr>
      <th><?php echo $lang->ui->theme->backColor; ?></th>
      <td>
        <div class='colorplate clearfix'>
          <div class='input-group color active' data='<?php echo $config->themeSetting->backColor;?>'>
            <span class='input-group-addon'> <i class='icon icon-question'></i><i class='icon-ok'></i> </span>
            <?php echo html::input('backColor', $config->themeSetting->backColor, "class='form-control input-color text-latin' placeholder='" . $lang->ui->custom . "'");?>
          </div>
          <?php echo $colorPlates; ?>
        </div>
      </td>
    </tr>
    <tr><td></td><td><?php echo html::hidden('theme', $theme) . html::hidden('template', $template) . html::hidden('css') . html::submitButton();?></td></tr>
  </table>
</form>
<?php include '../../common/view/footer.modal.html.php';?>
