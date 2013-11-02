<?php 
include '../../common/view/header.html.php';
?>
<?php $common->printPositionBar($this->app->getModuleName());?>
<div class='box radius'>
  <h4 class='title'><?php echo $lang->links->common;?></h4>
  <div class='content'>
    <p><?php echo $links->all;?></p>
  </div>
</div>
<?php include '../../common/view/footer.html.php'; ?>
