<?php include '../../common/view/header.modal.html.php';?>
<form method='post' id='ajaxForm' action='<?php echo $this->createLink('file', 'sourceedit', "fileID=$file->id&objectType=source")?>'>
  <table class='table table-form'>
    <tr>
      <th class='w-80px'><?php echo $lang->file->title;?></th> 
      <td><?php echo html::input('filename',$file->title, "class='form-control'");?></td>
    </tr>
    <tr>
      <th></th>
      <td><?php echo html::submitButton()?></td>
    </tr>
  </table>
</form>
<?php include '../../common/view/footer.modal.html.php';?>
