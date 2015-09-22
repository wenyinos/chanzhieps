<?php include "header.html.php"; ?>
<form method='post' action='<?php echo inlink('fixblock', "page={$layout->page}&region={$layout->region}&block={$block->id}");?>' class='ve-form mw-800px center-block' enctype='multipart/form-data'>
  <table class='table table-form'>
    <tr>
      <th class='w-100px'><?php echo $lang->block->grid;?></th>
      <td><?php echo html::select("grid", $this->lang->block->gridOptions, $block->grid, "class='form-control'");?></td>
      <td class='w-100px'>
        <label>
          <input type='checkbox' name='titleless' value='1' <?php if($block->borderless) echo 'checked';?>/>
          <?php echo $this->lang->block->titleless?>
        <label>
      </td>
      <td class='w-100px'>
        <label>
        <input type='checkbox' name='borderless' value='1' <?php if($block->borderless) echo 'checked';?>/>
          <?php echo $this->lang->block->borderless?>
        <label>
      </td>
    </tr>
    <tr>
      <td></td>
      <td colspan='2'> <?php echo html::submitButton() . html::hidden('page', $layout->page) . html::hidden('region', $layout->region) . html::hidden('block', $block->id);?> </td>
    </tr>
  </table>
</form>
<?php include "footer.html.php"; ?>
