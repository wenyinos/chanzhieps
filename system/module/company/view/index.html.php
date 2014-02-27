<?php 
include '../../common/view/header.html.php';
?>
<?php $common->printPositionBar($this->app->getModuleName());?>
<div class="row">
  <div class="col-md-9">
    <div class='panel'>
      <div class='panel-heading'><strong><i class='icon-group'></i> <?php echo $lang->aboutUs; ?></strong></div>
      <div class='panel-body'>
        <?php echo $company->content;?>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="panel">
      <div class="panel-heading"><strong><i class="icon-phone"></i> <?php echo $lang->company->contact;?></strong></div>
      <div class="panel-body">
        <table class='table table-data'>
        <?php foreach($contact as $item => $value):?>
          <tr>
            <th><?php echo $lang->company->$item;?>:</th>
            <td><?php echo $value;?></td>
          </tr>
        <?php endforeach;?>
        </table>
      </div>
    </div>
  </div>
</div>

<?php include '../../common/view/footer.html.php'; ?>
