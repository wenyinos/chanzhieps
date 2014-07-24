<?php if(helper::isAjaxRequest()):?>
<?php
$webRoot   = $config->webRoot;
$jsRoot    = $webRoot . "js/";
$themeRoot = $webRoot . "theme/";
if(isset($pageCSS)) css::internal($pageCSS);
?>
<div class="modal-dialog" style="width:<?php echo empty($modalWidth) ? 700 : $modalWidth;?>px;">
  <div class="modal-content">
    <div class="modal-header">
      <?php echo html::closeButton();?>
      <h4 class="modal-title"><?php if(!empty($title)) echo $title; ?></h4>
    </div>
    <div class="modal-body">
<?php else:?>
<?php include 'header.html.php';?>
<?php endif;?>
