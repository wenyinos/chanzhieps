<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/treeview.html.php';?>

<?php echo $this->loadModel('block')->printRegion('index_index', 'header');?>
<div class='row'>
  <?php echo $this->loadModel('block')->printRegion('index_index', 'bottom');?>
</div>
<?php echo $this->loadModel('block')->printRegion('index_index', 'footer');?>
<?php include '../../common/view/footer.html.php';?>
