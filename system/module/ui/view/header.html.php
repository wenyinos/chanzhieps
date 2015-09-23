<?php $templates       = $this->loadModel('ui')->getTemplates(); ?>
<?php $currentTemplate = $this->config->template->{$this->device}->name; ?>
<?php $currentTheme    = $this->config->template->{$this->device}->theme; ?>
<?php $currentDevice   = $this->session->device ? $this->session->device : 'desktop';?>
<nav id='menu'>
  <ul class='nav'>
    <li class='nav-item-primary'>
      <?php $mobileTemplate = isset($this->config->site->mobileTemplate) ? $this->config->site->mobileTemplate : 'close';?>
      <?php if($mobileTemplate == 'close'):?>
      <?php echo html::a('javascript:;', $lang->ui->deviceList->desktop);?>
      <?php else:?>
      <a href='javascript:;' data-toggle='dropdown'>
        <?php echo $lang->ui->deviceList->{$currentDevice};?> <i class='icon-caret-down'></i>
      </a>
      <ul id='deviceMenu' class='dropdown-menu'>
        <?php foreach($lang->ui->deviceList as $device => $name):?>
        <?php $class = $device == $currentDevice ? "class='active'" : '';?>
        <li <?php echo $class;?>><a href='<?php echo helper::createLink('ui', 'setdevice', "device={$device}")?>'><?php echo $name;?><i class='icon-ok'></i></a></li>
        <?php endforeach;?>
      </ul>
      <?php endif;?>
    </li>
    <li class="divider angle"></li>
    <li class='menu-theme-picker'>
      <a href='javascript:;' data-toggle='dropdown'><span class='menu-template-name'><?php echo $templates[$currentTemplate]['name'];?></span><i class="icon icon-angle-right"></i><span class='menu-theme-name'><?php echo $templates[$currentTemplate]['themes'][$currentTheme]?></span> &nbsp;<i class='icon-caret-down'></i></a>
      <div class='dropdown-menu theme-picker-dropdown'>
        <div class='theme-picker' data-template='<?php echo $currentTemplate?>' data-theme='<?php echo $currentTheme?>'>
          <div class='menu-templates'>
            <ul class='nav'>
              <?php $templateThemes = ''; ?>
              <?php foreach($templates as $code => $tpl):?>
              <?php
              $isCurrent    = $currentTemplate == $code;
              $themeName    = $isCurrent ? $currentTheme : 'default';
              $themesList   = '';
              ?>
              <li class='menu-template <?php if($isCurrent) echo 'active';?>' data-template='<?php echo $code; ?>'>
                <?php commonModel::printLink('ui', 'settemplate', "template={$code}&theme={$themeName}", $tpl['name']) ?>
              </li>
              <?php
              foreach($tpl['themes'] as $theTheme => $name)
              {
                  $selectThemeUrl = $this->createLink('ui', 'setTemplate', "template={$code}&theme={$theTheme}");
                  $themeClass = $isCurrent && $currentTheme == $theTheme ? 'current' : '';
                  $themesList .= "<div class='theme menu-theme {$themeClass}' data-url='{$selectThemeUrl}' data-theme='{$theTheme}'><div class='theme-card'><i class='icon-ok icon'></i>";
                  $themesList .= "<div class='theme-img'>" . html::image($webRoot . "template/{$code}/theme/{$theTheme}/preview.png", "alt={$theTheme}") . '</div>';
                  $themesList .= "<div class='theme-name'>{$name}</div>";
                  $themesList .= '</div></div>';
              }
              ?>
              <?php $templateThemes .= "<div class='menu-themes clearfix" . ($isCurrent ? ' show' : '') . "' data-template='{$code}'>" . $themesList . '</div>'; ?>
              <?php endforeach;?>
            </ul>
            <div class='actions'>
              <?php commonModel::printLink('ui', 'setTemplate', '', '<i class="icon-cog"></i> ' . $lang->ui->manageTemplate)?>
            </div>
          </div>
          <div class='menu-themes-list'>
            <?php echo $templateThemes; ?>
          </div>
        </div>
      </div>
    </li>
    <li class="divider angle"></li>
  </ul>
  <?php $moduleMenu = commonModel::createModuleMenu($this->moduleName, '', false);?>
  <?php if($moduleMenu) echo $moduleMenu;?>
  <div class="pull-right">
    <ul class="nav">
      <li><?php echo html::a(helper::createLink('visual', 'index'), '<i class="icon-magic"></i> ' . $lang->visualEdit, "target='_blank' class='navbar-link'");?></li>
      <li><?php commonModel::printLink('package', 'upload', '', '<i class="icon-download-alt"></i> ' . $lang->ui->installTemplate, "data-toggle='modal' data-width='600'")?></li>
      <li><?php commonModel::printLink('ui', 'uploadTheme', '', '<i class="icon-download-alt"></i> ' . $lang->ui->uploadTheme, "data-toggle='modal' data-width='600'")?></li>
      <li><?php commonModel::printLink('ui', 'exportTheme', '', '<i class="icon-upload-alt"></i> ' . $lang->ui->exportTheme, "data-toggle='modal' data-width='600'")?></li>
    </ul>
  </div>
</nav>
