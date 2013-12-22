<?php 
include '../../common/view/header.html.php';
?>
<?php $common->printPositionBar($this->app->getModuleName());?>
<div class='panel'>
  <div class='panel-heading'><strong><i class='icon-group'></i> <?php echo $lang->aboutUs; ?></strong></div>
  <div class='panel-body'>
    <div class='article-content'>
      <?php echo $company->content;?>
      <div id='contact'>
        <?php foreach($contact as $item => $value):?>
        <dl>
          <dt><?php echo $lang->company->$item;?>:</dt>
          <dd><?php echo $value;?></dd>
        </dl>
        <?php endforeach;?>
      </div>
    </div>
  </div>
</div>
<?php include '../../common/view/footer.html.php'; ?>
