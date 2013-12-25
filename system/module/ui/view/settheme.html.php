<?php
/**
 * The settheme view file of ui module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     LGPL
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     ui
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<div class='panel'>
  <div class='panel-heading'>
    <strong><i class='icon-lemon'></i> <?php echo $lang->ui->setTheme?></strong>
  </div>
  <div class='panel-body'>
    <div class='cards' id='themes'>
    <?php foreach($lang->ui->themes as $theme => $name):?>
    <?php $current = $theme == $config->site->theme ? 'current' : ''; ?>
      <div class='col-lg-4 col-md-6 col-sm-6'>
        <a class='card ajax-theme <?php echo $current; ?>' href='<?php echo inlink('settheme', "theme={$theme}"); ?>' title='<?php echo $lang->ui->changetheme; ?>'>
          <?php echo html::image($themeRoot . $theme . DS . 'preview.png'); ?>
          <i class='icon-large icon-ok pull-right'></i>
          <div class='msg'></div>
        </a>
        <div class='name'><?php echo $name;?></div>
      </div>
    <?php endforeach;?>
    </div>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
