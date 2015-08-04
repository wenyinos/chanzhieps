<?php include '../../common/view/header.modal.html.php';?>
<article class='text-center'>
  <h2 class='text-success'><?php echo $lang->misc->thanksTitle;?> </h2>
  <p><?php echo $lang->misc->thanksSubtitle?></p>
<div class='row'>
  <?php foreach($this->config->thanksList as $item => $link):?>
  <div class='col-md-3'>
    <a target='_blank' href="<?php echo $link;?>" class='card'>
      <strong class='card-heading'><?php echo $item;?></strong>
    </a>
  </div>
  <?php endforeach;?>
</div>
  
<?php include '../../common/view/footer.modal.html.php';?>
