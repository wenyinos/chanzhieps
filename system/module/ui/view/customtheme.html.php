<?php include '../../common/view/header.modal.html.php';?>
<form method='post' action='<?php echo inlink('customtheme', "theme={$theme}&template={$template}");?>' id='customThemeForm' class='form' data-theme='<?php echo $theme?>' data-template='<?php echo $template?>'>
  <div class='row'>
    <div class='col-sm-9'>
      <ul class='nav nav-tabs'>
        <li class='active'><a href='#basicStyle' data-toggle='tab'><?php echo $lang->ui->theme->basicStyle;?></a></li>
        <li><a href='#linkStyle' data-toggle='tab'><?php echo $lang->ui->theme->linkStyle;?></a></li>
        <li><a href='#navbarStyle' data-toggle='tab'><?php echo $lang->ui->theme->navbarStyle;?></a></li>
        <li><a href='#panelStyle' data-toggle='tab'><?php echo $lang->ui->theme->panelStyle;?></a></li>
        <li><a href='#tableStyle' data-toggle='tab'><?php echo $lang->ui->theme->tableStyle;?></a></li>
        <li><a href='#columnStyle' data-toggle='tab'><?php echo $lang->ui->theme->columnStyle;?></a></li>
        <li><a href='#buttonStyle' data-toggle='tab'><?php echo $lang->ui->theme->buttonStyle;?></a></li>
        <li><a href='#formStyle' data-toggle='tab'><?php echo $lang->ui->theme->formStyle;?></a></li>
        <li><a href='#components' data-toggle='tab'><?php echo $lang->ui->theme->components;?></a></li>
        <li><a href='#customStyle' data-toggle='tab'><?php echo $lang->ui->theme->customStyle;?></a></li>
      </ul>
      <div class='tab-content'>
        <div class='tab-pane active' id='basicStyle'>
          <table class='table table-form borderless'>
            <tr>
              <th><?php echo $lang->ui->theme->colorset;?></th>
              <td>
                <?php $this->ui->printColorInput('primaryColor', $themeSetting->primaryColor, $lang->ui->theme->primaryColor, '#3280FC', '', "data-refresh='#navbarBackColor'");?>
              </td>
              <td>
                <?php $this->ui->printColorInput('backgroundColor', $themeSetting->backgroundColor, $lang->ui->theme->backColor, '#FFF', '', "data-refresh='#backColor'");?>
              </td>
              <td>
                <?php $this->ui->printColorInput('foreColor', $themeSetting->foreColor, $lang->ui->theme->foreColor, '#333', '', "data-refresh='#textColor'");?>
              </td>
              <td>
                <?php $this->ui->printColorInput('secondaryColor', $themeSetting->secondaryColor, $lang->ui->theme->secondaryColor, '#145CCD', '', "data-refresh='#textColor'");?>
              </td>
            </tr>
            <!-- Page background -->
            <tr><?php $this->ui->printBackgroundInputs($lang->ui->theme->pageBackground, $themeSetting);?></tr>
            <!-- Page font -->
            <tr><?php $this->ui->printTextStyleInputs($lang->ui->theme->pageText, $themeSetting);?></tr>
            <!-- Page border setting -->
            <tr><?php $this->ui->printBorderInputs($lang->ui->theme->border, $themeSetting)?></tr>
          </table>
        </div>
        <div class='tab-pane' id='linkStyle'>
          <table class='table table-form borderless'>
            <tr><?php $this->ui->printTextStyleInputs($lang->ui->theme->textStyle, $themeSetting, 'link', '#0D3D88');?></tr>
            <tr><?php $this->ui->printBackgroundInputs($lang->ui->theme->background, $themeSetting, 'link');?></tr>
            <tr><?php $this->ui->printBorderInputs($lang->ui->theme->border, $themeSetting, 'link');?></tr>
            <tr><?php $this->ui->printTextStyleInputs("{$lang->ui->theme->textStyle}:{$lang->ui->theme->hover}", $themeSetting, 'linkHover', '#347AEB');?></tr>
            <tr><?php $this->ui->printBackgroundInputs("{$lang->ui->theme->background}:{$lang->ui->theme->hover}", $themeSetting, 'linkHover');?></tr>
            <tr><?php $this->ui->printBorderInputs("{$lang->ui->theme->border}:{$lang->ui->theme->hover}", $themeSetting, 'linkHover');?></tr>
            <tr><?php $this->ui->printTextStyleInputs("{$lang->ui->theme->textStyle}:{$lang->ui->theme->active}", $themeSetting, 'linkActive', '#347AEB');?></tr>
            <tr><?php $this->ui->printBackgroundInputs("{$lang->ui->theme->background}:{$lang->ui->theme->active}", $themeSetting, 'linkActive');?></tr>
            <tr><?php $this->ui->printBorderInputs("{$lang->ui->theme->border}:{$lang->ui->theme->active}", $themeSetting, 'linkActive');?></tr>
          </table>
        </div>
        <div class='tab-pane' id='navbarStyle'>
          <table class='table table-form borderless'>
            <tr>
              <th><?php echo $lang->ui->theme->basicStyle?></th>
              <td>
                <?php $this->ui->printSelectList($lang->ui->theme->navbarLayoutList, 'navbarTable', $themeSetting->navbarTable, $lang->ui->theme->layout, '', '', $lang->ui->theme->navbarLayoutTip);?>
              </td>
            </tr>
            <!-- Navbar background -->
            <tr><?php $this->ui->printBackgroundInputs($lang->ui->theme->navbarBackground, $themeSetting, 'navbar');?></tr>
            <!-- Navbar border -->
            <tr><?php $this->ui->printBorderInputs($lang->ui->theme->navbarBorder, $themeSetting, 'navbar')?></tr>
            <!-- Navbar text -->
            <tr><?php $this->ui->printTextStyleInputs($lang->ui->theme->navbarItemText, $themeSetting, 'navbar')?></tr>
            <tr><?php $this->ui->printBackgroundInputs($lang->ui->theme->navbarItemBackground, $themeSetting, 'navbarItem');?></tr>
            <tr><?php $this->ui->printBorderInputs($lang->ui->theme->navbarItemBorder, $themeSetting, 'navbarItem')?></tr>
            <tr><?php $this->ui->printBackgroundInputs("{$lang->ui->theme->navbarItemBackground}:{$lang->ui->theme->hover}", $themeSetting, 'navbarItemHover');?></tr>
            <tr><?php $this->ui->printBorderInputs("{$lang->ui->theme->navbarItemBorder}:{$lang->ui->theme->hover}", $themeSetting, 'navbarItemHover');?></tr>
            <tr><?php $this->ui->printTextStyleInputs("{$lang->ui->theme->navbarItemText}:{$lang->ui->theme->hover}", $themeSetting, 'navbarItemHover');?></tr>
            <tr><?php $this->ui->printBackgroundInputs("{$lang->ui->theme->navbarItemBackground}:{$lang->ui->theme->active}", $themeSetting, 'navbarItemActive');?></tr>
            <tr><?php $this->ui->printBorderInputs("{$lang->ui->theme->navbarItemBorder}:{$lang->ui->theme->active}", $themeSetting, 'navbarItemActive');?></tr>
            <tr><?php $this->ui->printTextStyleInputs("{$lang->ui->theme->navbarItemText}:{$lang->ui->theme->active}", $themeSetting, 'navbarItemActive');?></tr>
          </table>
        </div>
        <div class='tab-pane' id='panelStyle'>
          <table class='table table-form borderless'>
            <tr><?php $this->ui->printBackgroundInputs($lang->ui->theme->background, $themeSetting, 'panel', '#FFF');?></tr>
            <tr><?php $this->ui->printTextStyleInputs($lang->ui->theme->textStyle, $themeSetting, 'panel');?></tr>
            <tr><?php $this->ui->printBorderInputs($lang->ui->theme->border, $themeSetting, 'panel', 'solid', '#DDD', '1px', '3px');?></tr>
            <tr><?php $this->ui->printBackgroundInputs($lang->ui->theme->panelHeadBackground, $themeSetting, 'panelHead', '#F5F5F5');?></tr>
            <tr><?php $this->ui->printTextStyleInputs($lang->ui->theme->panelHeadText, $themeSetting, 'panelHead');?></tr>
            <tr><?php $this->ui->printTextStyleInputs($lang->ui->theme->panelHeadIcon, $themeSetting, 'panelIcon', '#808080', 'ZenIcon', '14px');?></tr>
            <tr><?php $this->ui->printTextStyleInputs($lang->ui->theme->panelLink, $themeSetting, 'panelLink', '#0D3D88');?></tr>
          </table>
        </div>
        <div class='tab-pane' id='tableStyle'>
          <table class='table table-form borderless'>
            <tr><?php $this->ui->printBackgroundInputs($lang->ui->theme->background, $themeSetting, 'table', '#FFF');?></tr>
            <tr><?php $this->ui->printTextStyleInputs($lang->ui->theme->textStyle, $themeSetting, 'table');?></tr>
            <tr><?php $this->ui->printBorderInputs($lang->ui->theme->border, $themeSetting, 'table', 'solid', '#ddd', '1px', '3px');?></tr>
            <tr><?php $this->ui->printBackgroundInputs($lang->ui->theme->background, $themeSetting, 'tableHead', '#F1F1F1');?></tr>
            <tr><?php $this->ui->printTextStyleInputs($lang->ui->theme->textStyle, $themeSetting, 'tableHead');?></tr>
            <tr>
              <th><?php echo $lang->ui->theme->statusColor?></th>
              <td><?php $this->ui->printColorInput('tableHoverColor', $themeSetting->tableHoverColor, $lang->ui->theme->tableHoverColor, '#EBF2F9');?></td>
              <td><?php $this->ui->printColorInput('tableStripedColor', $themeSetting->tableStripedColor, $lang->ui->theme->tableStripedColor, '#F9F9F9');?></td>
            </tr>
          </table>
        </div>
        <div class='tab-pane' id='columnStyle'>
          <table class='table table-form borderless'>
            <tr>
              <th><?php echo $lang->ui->theme->layout;?></th>
              <td><?php $this->ui->printSelectList($lang->ui->theme->sidebarWidthList, "sidebarWidth", $valueSetting["sidebarWidth"], $this->lang->ui->theme->sidebarWidth, '', "data-default='25%'", '', '25%')?></td>
              <td><?php $this->ui->printSelectList($lang->ui->theme->sidebarPositionInverseList, "sidebarPositionInverse", $valueSetting["sidebarPositionInverse"], $this->lang->ui->theme->sidebarPositionInverse, '', "data-default='false'", '', 'false')?></td>
            </tr>
            <tr><?php $this->ui->printBackgroundInputs($lang->ui->theme->maincolBackground, $themeSetting, 'maincol', '#FFF');?></tr>
            <tr><?php $this->ui->printTextStyleInputs($lang->ui->theme->maincolText, $themeSetting, 'maincol');?></tr>
            <tr><?php $this->ui->printBorderInputs($lang->ui->theme->maincolBorder, $themeSetting, 'maincol', 'solid', '#DDD', '1px', '3px');?></tr>
            <tr><?php $this->ui->printBackgroundInputs($lang->ui->theme->maincolHeadBackground, $themeSetting, 'maincolHead', '#F5F5F5');?></tr>
            <tr><?php $this->ui->printTextStyleInputs($lang->ui->theme->maincolHeadText, $themeSetting, 'maincolHead');?></tr>
            <tr><?php $this->ui->printTextStyleInputs($lang->ui->theme->maincolHeadIcon, $themeSetting, 'maincolIcon', '#808080', 'ZenIcon', '14px');?></tr>
            <tr><?php $this->ui->printBackgroundInputs($lang->ui->theme->sidebarBackground, $themeSetting, 'sidebar', '#FFF');?></tr>
            <tr><?php $this->ui->printTextStyleInputs($lang->ui->theme->sidebarText, $themeSetting, 'sidebar');?></tr>
            <tr><?php $this->ui->printBorderInputs($lang->ui->theme->sidebarBorder, $themeSetting, 'sidebar', 'solid', '#DDD', '1px', '3px');?></tr>
            <tr><?php $this->ui->printBackgroundInputs($lang->ui->theme->sidebarHeadBackground, $themeSetting, 'sidebarHead', '#F5F5F5');?></tr>
            <tr><?php $this->ui->printTextStyleInputs($lang->ui->theme->sidebarHeadText, $themeSetting, 'sidebarHead');?></tr>
            <tr><?php $this->ui->printTextStyleInputs($lang->ui->theme->sidebarHeadIcon, $themeSetting, 'sidebarIcon', '#808080', 'ZenIcon', '14px');?></tr>
          </table>
        </div>
        <div class='tab-pane' id='buttonStyle'>
          <table class='table table-form borderless'>
            <tr><?php $this->ui->printTextStyleInputs($lang->ui->theme->textStyle, $themeSetting, 'button', '#FFF', 'inherit', 'inherit', 'color');?></tr>
            <tr><?php $this->ui->printBorderInputs($lang->ui->theme->border, $themeSetting, 'button', 'solid', '', '1px', '2px', 'color');?></tr>
            <tr>
              <th><?php echo $lang->ui->theme->color?></th>
              <td>
                <?php $this->ui->printColorInput('buttonNormalColor', $themeSetting->buttonNormalColor, $lang->ui->theme->buttonNormal, '#F2F2F2');?>
              </td>
              <td>
                <?php $this->ui->printColorInput('buttonPrimaryColor', $themeSetting->buttonPrimaryColor, $lang->ui->theme->buttonPrimary, '#3280FC');?>
              </td>
              <td>
                <?php $this->ui->printColorInput('buttonInfoColor', $themeSetting->buttonInfoColor, $lang->ui->theme->buttonInfo, '#39B3D7');?>
              </td>
            </tr>
            <tr>
              <th></th>
              <td>
                <?php $this->ui->printColorInput('buttonSuccessColor', $themeSetting->buttonSuccessColor, $lang->ui->theme->buttonSuccess, '#229F24');?>
              </td>
              <td>
                <?php $this->ui->printColorInput('buttonWarningColor', $themeSetting->buttonWarningColor, $lang->ui->theme->buttonWarning, '#E48600');?>
              </td>
              <td>
                <?php $this->ui->printColorInput('buttonDangerColor', $themeSetting->buttonDangerColor, $lang->ui->theme->buttonDanger, '#D2322D');?>
              </td>
            </tr>
            <tr>
              <th><?php echo $lang->ui->theme->ajustColor;?></th>
              <td>
                <?php $this->ui->printSelectList($lang->ui->theme->lightAjustList, "buttonHoverLight", $valueSetting["buttonHoverLight"], $this->lang->ui->theme->light . ':' . $this->lang->ui->theme->hover, '', "data-default='-5%'", '', '-5%')?>
              </td>
              <td>
                <?php $this->ui->printSelectList($lang->ui->theme->lightAjustList, "buttonActiveLight", $valueSetting["buttonActiveLight"], $this->lang->ui->theme->light . ':' . $this->lang->ui->theme->active, '', "data-default='-8%'", '', '-8%')?>
              </td>
            </tr>
          </table>
        </div>
        <div class='tab-pane' id='formStyle'>
          <table class='table table-form borderless'>
            <tr><?php $this->ui->printBackgroundInputs($lang->ui->theme->background, $themeSetting, 'formControl', '#FFF');?></tr>
            <tr><?php $this->ui->printTextStyleInputs($lang->ui->theme->textStyle, $themeSetting, 'formControl');?></tr>
            <tr><?php $this->ui->printBorderInputs($lang->ui->theme->border, $themeSetting, 'formControl', 'solid', '#CCC', '1px', '3px');?></tr>
            <tr><?php $this->ui->printBackgroundInputs($lang->ui->theme->background . ':' . $lang->ui->theme->active, $themeSetting, 'formControlActive', '#FFF');?></tr>
            <tr><?php $this->ui->printTextStyleInputs($lang->ui->theme->textStyle . ':' . $lang->ui->theme->active, $themeSetting, 'formControlActive');?></tr>
            <tr><?php $this->ui->printBorderInputs($lang->ui->theme->border . ':' . $lang->ui->theme->active, $themeSetting, 'formControlActive', 'solid', '#347AEB', '1px', '3px');?></tr>
          </table>
        </div>
        <div class='tab-pane' id='components'>
          <table class='table table-form borderless'>
            <caption><strong class='text-special'><?php echo $lang->ui->theme->breadcrumb?></strong></caption>
            <tr>
              <th><?php echo $lang->ui->theme->padding;?></th>
              <td><?php $this->ui->printTextboxCouple('', 'breadcrumbPaddingHr', $themeSetting['breadcrumbPaddingHr'], $lang->ui->theme->horizontal, 'breadcrumbPaddingVt', $themeSetting['breadcrumbPaddingHr'], $lang->ui->theme->vertical, '', $placeholder1 = '0', $placeholder2 = '0');?></td>
            </tr>
            <tr><?php $this->ui->printBackgroundInputs($lang->ui->theme->background, $themeSetting, 'breadcrumb');?></tr>
            <tr><?php $this->ui->printTextStyleInputs($lang->ui->theme->textStyle, $themeSetting, 'breadcrumb', '#808080');?></tr>
            <tr><?php $this->ui->printBorderInputs($lang->ui->theme->border, $themeSetting, 'breadcrumb');?></tr>
          </table>
          <table class='table table-form borderless'>
            <caption><strong class='text-special'><?php echo $lang->ui->theme->footer?></strong></caption>
            <tr><?php $this->ui->printBackgroundInputs($lang->ui->theme->background, $themeSetting, 'footer', '#F7F7F7');?></tr>
            <tr><?php $this->ui->printBorderInputs($lang->ui->theme->border, $themeSetting, 'footer', 'solid', '#DDD', '1px', '4px');?></tr>
          </table>
        </div>
        <div class='tab-pane' id='customStyle'>
          <div class='row'>
            <div class='col-sm-8'>
              <h5><?php echo $lang->ui->theme->customStylesheet?> <small><?php echo $lang->ui->theme->customStylesheetTip?></small></h5>
              <textarea name='customLess' id='customLess' cols='30' rows='20' class='form-control small codeeditor' data-mode='css'></textarea>
            </div>
            <div class='col-sm-4'>
              <h5><?php echo $lang->ui->theme->lessVariables?></h5>
              <div id='lessVarTableWrapper' style="overflow-y: auto">
                <div id='lessVarTableHead'>
                  <table class='table table-fixed table-condensed table-bordered' style='table-layout: fixed; margin-bottom: 0'>
                    <thead>
                      <tr>
                        <th class='w-p40'><?php echo $lang->ui->theme->lessVariablesName?></th>
                        <th class='w-p20'><?php echo $lang->ui->theme->lessVariablesValue?></th>
                        <th><?php echo $lang->ui->theme->lessVariablesDesc?></th>
                      </tr>
                    </thead>
                  </table>
                </div>
                <table class='table table-fixed table-condensed table-hover table-bordered' id='lessVarTable' style='table-layout: fixed'>
                  <tbody>
                    <tr><td colspan='3'><small><?php echo $lang->ui->theme->lessVariablesUnuseable?></small></td></tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
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
