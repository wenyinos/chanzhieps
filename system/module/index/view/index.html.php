<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/treeview.html.php';?>

<?php if(isset($layouts['index_index']['header'])) echo $this->block->printRegion($layouts['index_index']['header']);?>
<div class='row'>
  <?php if(isset($layouts['index_index']['bottom'])) echo $this->block->printRegion($layouts['index_index']['bottom'], "<div class='col-md-4'>", '</div>');?>
</div>
<?php if(isset($layouts['index_index']['footer'])) echo $this->block->printRegion($layouts['index_index']['footer'], "<div class='col-md-4'>", '</div>');?>
<?php include '../../common/view/footer.html.php';?>
