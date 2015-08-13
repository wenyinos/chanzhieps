<?php include '../../common/view/header.modal.html.php';?>
<article class='text-center'>
  <h2 class='text-success'><strong><?php echo $lang->misc->thanksTitle;?></strong></h2>
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
<div>
  <?php printf($lang->misc->thanksFooter, '<a href="http://www.zzsec.com/" style="color: green"><strong>' . $lang->misc->thanksObjectName . '</strong></a>');?>
</div>
  
<?php include '../../common/view/footer.modal.html.php';?>
