<?php
/**
 * The settheme view file of ui module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv11.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     ui
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<?php include '../../common/view/codeeditor.html.php';?>
<?php js::import($jsRoot . 'less/min.js'); ?>
<div class='panel panel-templates'>
<div class='cards cards-templates' data-template='<?php echo $this->config->template->name?>' data-theme='<?php echo $this->config->template->theme?>'>
  <?php $customThemePriv = commonModel::hasPriv('ui', 'customTheme');?>
  <?php foreach($templates as $code => $template):?>
  <?php
  $desc  = $template['desc'];
  $count = count($template['themes']);
  $isCurrent = $this->config->template->name == $code;
  $themeName = $isCurrent ? $this->config->template->theme : 'default';
  $templateRoot = $webRoot . 'template/' . $code . '/'
  ?>
  <div class='col-card'>
    <div class="card-template card<?php if($isCurrent) echo ' current';?>" data-template='<?php echo $code;?>'data-theme='<?php echo $themeName;?>' data-url='<?php inlink('settheme', "template={$code}&theme={$themeName}") ?>'>
      <i class='icon-ok teamplate-choosed'></i>
      <div class='template-img'><?php echo html::image($templateRoot . 'theme/' . $themeName . '/preview.png');?></div>
      <div class='card-heading'>
        <h4 class='template-name'><?php echo $template['name']?></h4>
        <small class='text-muted'><?php echo $lang->ui->template->author . $lang->colon . $template['author'];?></small>
      </div>
      <div class='card-actions'>
        <button class='btn btn-apply-template<?php if($isCurrent) echo ' btn-success disabled';?>' type='button' data-url='<?php inlink('settemplate', "template={$code}&theme={$themeName}")?>' data-current='<i class="icon-ok"></i> <?php echo $lang->ui->template->current;?>' data-default='<?php echo $lang->ui->template->apply?>'><?php echo $isCurrent ? "<i class='icon-ok'></i> {$lang->ui->template->current}" : $lang->ui->template->apply?></button>
      </div>
      <?php if(!empty($desc)):?>
      <div class="card-content"><div class="template-desc"><?php echo $desc;?></div></div>
      <?php endif;?>
      <div class='themes-list'>
        <div class='clearfix'>
        <?php foreach($template['themes'] as $theme => $name):?>
          <?php
          $custom = true;
          $currentClass = ($isCurrent and $config->template->theme == $theme) ? ' current' : '';
          if($custom) $currentClass .= ' custom';

          $url = $this->createLink('ui', 'setTemplate', "template={$code}&theme={$theme}&custom={$custom}");
          ?>
          <div class='theme<?php echo $currentClass;?>' data-url='<?php echo $url;?>' data-theme='<?php echo $theme;?>'>
            <div class='theme-card'>
              <i class='icon-ok icon'></i>
              <?php if($custom and $customThemePriv):?>
              <?php commonModel::printLink('ui', 'customTheme', "theme={$theme}&template={$code}", "<span class='icon-cog'></span> {$lang->ui->custom}", "class='btn btn-primary btn-custom' data-toggle='modal' data-type='ajax' data-backdrop='true'") ?>
              <?php endif;?>
              <div class='theme-img'><?php echo html::image($templateRoot . 'theme/' . $theme . '/preview.png');?></div>
              <div class='theme-name text-center'><strong><?php echo $name;?></strong></div>
            </div>
          </div>
        <?php endforeach;?>
        </div>
      </div>
    </div>
  </div>
  <?php endforeach;?>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
