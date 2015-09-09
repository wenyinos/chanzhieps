<?php include '../../common/view/header.modal.html.php';?>
<?php include '../../common/view/datepicker.html.php';?>
<?php include '../../common/view/chosen.html.php';?>
<form method='post' id='forwardForm' action='<?php echo inlink("forward2blog", "articleID={$articleID}");?>'>
  <table class='table table-form'>
    <tr>
      <th class='w-100px'><?php echo $lang->article->selectCategories;?></th>
      <td class='w-p40'><?php echo html::select("categories[]", $categories, '', "multiple='multiple' class='form-control chosen'");?></td><td></td>
    </tr>
    <tr>
      <th><?php echo $lang->article->addedDate;?></th>
      <td><?php echo html::input('addedDate', date('Y-m-d H:i'), "class='form-control form-datetime'");?></td>
      <td><span class="help-inline"><?php echo $lang->article->placeholder->addedDate;?></span></td>
    </tr>
    <tr>
      <td></td>
      <td colspan='2'><?php echo html::submitButton();?></td>
    </tr>
  </table>
</form>
<?php include '../../common/view/footer.modal.html.php';?>
