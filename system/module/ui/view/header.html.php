<?php $templates       = $this->loadModel('ui')->getTemplates(); ?>
<?php $currentTemplate = $this->config->template->name; ?>
<?php $currentTheme    = $this->config->template->theme; ?>
<?php $editingTemplate = $this->ui->getEditingTemplate();?>
<?php $editingTheme    = $this->ui->getEditingTheme();?>
<nav id='menu'>
  <ul class='nav'>
    <li class='nav-item-primary'>
      <a href='javascript:;' data-toggle='dropdown'><i class="icon icon-desktop"></i> <?php echo $lang->ui->clientDesktop;?> &nbsp;<i class='icon-caret-down'></i></a>
      <ul class='dropdown-menu'>
        <li class="active"><a href='###'><i class="icon icon-desktop"></i> <?php echo $lang->ui->clientDesktop;?></a></li>
        <li><a href='###'><i class="icon icon-mobile-phone"></i> <?php echo $lang->ui->clientMobile;?></a></li>
      </ul>
    </li>
    <li class="divider angle"></li>
    <li class='menu-theme-picker'>
      <a href='javascript:;' data-toggle='dropdown'><span class='menu-template-name'><?php echo $templates[$editingTemplate]['name'];?></span><i class="icon icon-angle-right"></i><span class='menu-theme-name'><?php echo $templates[$editingTemplate]['themes'][$editingTheme]?></span> &nbsp;<i class='icon-caret-down'></i></a>
      <div class='dropdown-menu theme-picker-dropdown'>
        <div class='theme-picker' data-template='<?php echo $editingTemplate?>' data-theme='<?php echo $editingTheme?>'>
          <div class='menu-templates'>
            <ul class='nav'>
              <?php $templateThemes = ''; ?>
              <?php foreach($templates as $code => $tpl):?>
              <?php
              $isCurrent    = $currentTemplate == $code;
              $isEditing    = $editingTemplate == $code;
              $themeName    = $isEditing ? $editingTheme : 'default';
              $themesList   = '';
              ?>
              <li class='menu-template <?php if($isEditing) echo 'active';?>' data-template='<?php echo $code; ?>'>
                <?php commonModel::printLink('ui', 'settemplate', "template=&theme=&custome=false&editTemplate={$code}&editTheme={$themeName}", $tpl['name']) ?>
              </li>
              <?php
              foreach($tpl['themes'] as $theme => $name)
              {
                  $editingClass = ($isEditing and $editingTheme == $theme) ? ' active' : '';
                  $themesList .= "<li class='menu-theme {$editingClass}' data-theme='{$theme}'>" . html::a($this->createLink('ui', 'setTemplate', "template=&theme=&custome=false&editTemplate={$code}&editTheme={$theme}"), $name) . '</li>';
              }
              ?>
              <?php $templateThemes .= "<ul class='menu-themes nav" . ($isEditing ? ' show' : '') . "' data-template='{$code}'>" . $themesList . '</ul>'; ?>
              <?php endforeach;?>
            </ul>
          </div>
          <div class='menu-themes-list'>
            <?php echo $templateThemes; ?>
          </div>
          <div class='menu-theme-preview'>
            <?php echo html::image($webRoot . 'template/' . $editingTemplate . '/theme/' . $editingTheme . '/preview.png');?>
          </div>
        </div>
        <div class='theme-picker-footer'>
          <div class='pull-right'>
            <?php commonModel::printLink('ui', 'customTheme', "theme={$editingTheme}&template={$editingTemplate}", '<i class="icon-cog"></i> ' . $lang->ui->customtheme, 'class="btn btn-link"')?>
            <?php commonModel::printLink('ui', 'setTemplate', '', '<i class="icon-cogs"></i> ' . $lang->ui->setTemplate, 'class="btn btn-link"')?>
          </div>
          <?php echo $lang->ui->currentTheme ?>： <span class='menu-template-name'><?php echo $templates[$config->template->name]['name'];?></span> <i class="icon icon-angle-right"></i> <span class='menu-theme-name'><?php echo $templates[$config->template->name]['themes'][$currentTheme]?></span>
        </div>
      </div>
    </li>
    <li class="divider"></li>
  </ul>
  <?php $moduleMenu = commonModel::createModuleMenu($this->moduleName, '', false);?>
  <?php if($moduleMenu) echo $moduleMenu;?>
  <div class="pull-right">
    <ul class="nav">
      <li><?php commonModel::printLink('package', 'upload', '', '<i class="icon-download-alt"></i> ' . $lang->ui->installTemplate, "data-toggle='modal' data-width='600'")?></li>
      <li><?php commonModel::printLink('ui', 'uploadTheme', '', '<i class="icon-download-alt"></i> ' . $lang->ui->uploadTheme, "data-toggle='modal' data-width='600'")?></li>
      <li><?php commonModel::printLink('ui', 'exportTheme', '', '<i class="icon-upload-alt"></i> ' . $lang->ui->exportTheme, "data-toggle='modal' data-width='600'")?></li>
    </ul>
  </div>
</nav>
<script>
$(function()
{
    var $themePicker = $('#menu .theme-picker');
    var refreshPicker = function(template, theme)
    {
        if(!template || typeof(template) !== 'string') template = $(this).data('template') || $themePicker.attr('data-template');
        if(!theme || typeof(theme) !== 'string') theme = $(this).data('theme') || $themePicker.attr('data-theme');

        console.log('refreshPicker template', template, 'theme', theme);

        $themePicker.find('.menu-template.hover').removeClass('hover');
        $themePicker.find('.menu-template[data-template="' + template + '"]').addClass('hover');

        $themePicker.find('.menu-themes.show').removeClass('show');
        $themePicker.find('.menu-themes[data-template="' + template + '"]').addClass('show');
        $themePicker.find('.menu-theme.hover').removeClass('hover');
        $themePicker.find('.menu-theme[data-theme="' + theme + '"]').addClass('hover');
        $themePicker.find('.menu-theme-preview img').attr('src', '<?php echo $webRoot;?>template/' + template + '/theme/' + theme + '/preview.png');
    };

    $themePicker.on('mouseenter', '.menu-template', refreshPicker)
    .on('mouseenter', '.menu-theme', function()
    {
        var $this = $(this);
        refreshPicker($this.closest('.menu-themes').data('template'), $this.data('theme'));
    })
    .on('click', '.menu-template > a, .menu-theme > a', function(e)
    {
        $.getJSON($(this).attr('href'), function(response)
        {
            if(response.result == 'success')
            {
                messager.success(response.message);
                window.location.reload();
            }
            else
            {
                bootbox.alert(data.message);
            }
        });
        return false;
    });

    $('.menu-theme-picker').on('show.bs.dropdown show.zui.dropdown', refreshPicker);

    refreshPicker();

    window.refreshThemePicker = function(template, theme)
    {
        $themePicker.find('.menu-template.active').removeClass('active');
        $themePicker.find('.menu-template[data-template="' + template + '"]').addClass('active');
        $themePicker.find('.menu-theme.active').removeClass('active');
        $themePicker.find('.menu-theme[data-theme="' + theme + '"]').addClass('active');
        $themePicker.attr('data-template', template).attr('data-theme', theme);
        refreshPicker(template, theme);
    };
});
</script>
