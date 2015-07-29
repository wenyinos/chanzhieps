<footer  class="appbar fix-bottom">
  <ul class="nav">
    <li><?php echo html::a($this->createLink('company', 'contact'), "<i class='icon icon-comments-alt'></i> {$lang->company->contactUs}", "class='text-primary' data-toggle='modal'");?></li>
    <li><?php echo html::a($this->createLink('company', 'index'), "<i class='icon icon-group'></i> {$lang->aboutUs}", "class='text-important' data-toggle='modal'");?></li>
  </ul>
</footer>
<?php
if(isset($pageJS)) js::execute($pageJS);
?>
</body>
</html>
