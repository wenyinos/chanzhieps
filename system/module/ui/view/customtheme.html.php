<?php include '../../common/view/header.modal.html.php';?>
<form method='post' action='<?php echo inlink('customtheme', "theme={$theme}&template={$template}");?>' id='customThemeForm' class='form' data-theme='<?php echo $theme?>' data-template='<?php echo $template?>'>
  <div class='row'>
    <div class='col-sm-9'>
      <ul class='nav nav-tabs'>
        <?php foreach($lang->ui->groups as $group => $name):?>
        <li><?php echo html::a('#' . $group . 'Tab', $name, "data-toggle='tab'");?></li>
        <?php endforeach;?>
      </ul>
      <div class='tab-content'>
        <?php foreach($lang->ui->groups as $group => $name):?>
        <div class='tab-pane' id='<?php echo $group?>Tab'>
          <table class='table table-form borderless'>
            <?php
            $options = $config->ui->selectorOptions[$group];
            foreach($options as $selector => $attributes):
            ?>
            <tr>
              <th><?php echo $lang->ui->{$selector};?></th>
              <td>
                <div class='row'>
                  <?php foreach($attributes as $label => $params):?>
                  <div class='col-sm-3' data-id='<?php echo $id?>'><?php $this->ui->printFormControl($label, $params);?></div>
                  <?php endforeach;?>
                </div>
              </td>
            </tr>
            <?php endforeach;?>
          </table>
        </div>
        <?php endforeach;?>
      </div>
      <div class="form-footer">
        <?php echo html::hidden('theme', $theme) . html::hidden('template', $template) . html::submitButton();?>
      </div>
    </div>
    <div class='col-sm-3'>
      <textarea name='css' id='css' cols='30' rows='20' class='form-control small codeeditor' data-mode='css'></textarea>
    </div>
  </div>
</form>
<?php include '../../common/view/footer.modal.html.php';?>
