<footer  class="appbar fix-bottom">
  <ul class="nav">
    <li><?php echo html::a('#contactUsDialog', "<i class='icon icon-comments-alt'></i> {$lang->company->contactUs}", "class='text-primary' data-toggle='modal'");?></li>
    <li><?php echo html::a($this->createLink('company', 'index'), "<i class='icon icon-group'></i> {$lang->aboutUs}", "class='text-important'");?></li>
  </ul>
</footer>
<div class='modal fade' id='contactUsDialog'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'><button type='button' class='close' data-dismiss='modal'><span aria-hidden="true">×</span></button><strong><?php echo $lang->company->contactUs;?></strong></div>
    </div>
  </div>
</div>
<?php
if(isset($pageJS)) js::execute($pageJS);
?>
</body>
</html>
