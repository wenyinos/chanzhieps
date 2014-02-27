<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/treeview.html.php';?>

<?php $this->block->printRegion($layouts, 'index_index', 'header');?>
<div class='row' id='focus'><?php $this->block->printRegion($layouts, 'index_index', 'middle');?></div>
<?php $this->block->printRegion($layouts, 'index_index', 'footer');?>
<?php include '../../common/view/footer.html.php';?>
