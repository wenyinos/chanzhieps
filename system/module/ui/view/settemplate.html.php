<?php
/**
 * The settheme view file of ui module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     http://api.chanzhi.org/goto.php?item=license
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     ui
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<?php $templateRoot = $webRoot . 'template/' . $config->site->template . '/';?>
<div class='panel'>
  <div class='panel-heading'><strong><?php echo $lang->ui->setTemplate;?></strong></div>
  <div class='panel-body'>
    <div class='cards cards-templates'>
      <?php foreach($templates as $template):?>
      <?php
      $desc  = $template['desc'];
      $count = count($template['themes']);
      $isCurrent = $config->site->template == $template['code'];
      $themeName = $isCurrent ? $this->config->site->theme : 'default';
      ?>
      <div class='col-card'>
        <div class="card-template card<?php if($isCurrent) echo ' current';?>" data-template='<?php echo $template['code']?>' data-url='<?php echo inlink('settheme', "template={$template['code']}&theme={$themeName}") ?>' data-theme='<?php echo $themeName;?>'>
          <i class='icon-ok teamplate-choosed'></i>
          <?php echo html::image($templateRoot . 'theme/' . $themeName . '/preview.png');?>
          <div class='card-caption'>
            <?php if($count > 1):?>
              <div class='themes-actions text-center'><span class='themes-tip'><?php printf($lang->ui->template->availableThemes, $count);?> &nbsp; <span class='theme-name'><?php if($isCurrent) printf($lang->ui->template->currentTheme, $template['themes'][$this->config->site->theme]) ?></span></span> &nbsp; <button type='button' data-toggle='modal' data-target='#chooseThemes' class='btn btn-success btn-change-theme'><?php echo $lang->ui->template->changeTheme;?></button></div>
            <?php endif;?>
            <?php if(!empty($desc)):?>
            <div class="template-desc text-center"><?php echo $desc;?></div>
            <?php endif;?>
          </div>
          <?php if($count > 1):?>
          <ul class='themes-list hide'>
            <?php foreach($template['themes'] as $theme => $name):?>
              <li>
              <?php
                $url = inlink('settheme', "template={$template['code']}&theme={$theme}");
                $previewImage = html::image($templateRoot . 'theme/' . $theme . '/preview.png');
                $currentClass = ($config->site->theme == $theme) ? 'btn-success' : '';
                echo html::a($url, $previewImage, "class='theme-preview btn btn-lg {$currentClass}' title='{$name}' data-theme='{$theme}'");
              ?>
              </li>
            <?php endforeach;?>
          </ul>
          <?php endif;?>
          <div class="card-foot"><strong><?php echo $template['name']?></strong> &nbsp; <span class='text-muted'><?php echo $lang->ui->template->author . $lang->colon . $template['author'];?></span></div>
        </div>
      </div>
      <?php endforeach;?>
    </div>
  </div>
</div>
<div class='modal fade' id='chooseThemes'>
  <div class='modal-dialog' style='width: 950px;'>
    <div class='modal-content'>
      <div class='modal-header'><i class='icon-cog'></i> <strong><?php echo $lang->ui->template->changeTheme;?></strong></div>
      <div class='modal-body'>
        <div class='cards cards-themes'>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
