<?php include "header.html.php"; ?>
<form method='post' class='ve-form mw-800px center-block' enctype='multipart/form-data'>
  <table class='table table-form'>
    <tr>
      <th class='w-100px'><?php echo $lang->block->grid;?></th>
      <td><?php echo html::select("grid", $this->lang->block->gridOptions, $grid, "class='form-control'");;?></td><td></td>
    </tr>
    <tr>
      <td></td>
      <td colspan='2'>
        <?php echo html::submitButton();?>
      </td>
    </tr>
  </table>
</form>
<?php include "footer.html.php"; ?>
