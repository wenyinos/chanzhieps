<?php include '../../common/view/header.modal.html.php';?>
<article class='text-center'>
<h2 class='text-success'>蝉知构建于众多优秀的开源项目之上</h2>
<p>衷心感谢这些项目背后的伟大程序员们！</p>
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
