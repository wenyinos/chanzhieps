<?php include '../../common/view/header.modal.html.php';?>
<?php include '../../common/view/chosen.html.php';?>
<form method='post' action='<?php echo $this->inLink('add',"type=$currentType");?>' id='addBlacklistForm' class='form'>
<table class='table table-form borderless'>
  <tbody class='addBlacklist'>
    <tr>
      <th class='w-120px'><?php echo $lang->guarder->type;?></th> 
      <td class='w-p40'><?php echo html::select('type', $typeList, $currentType, "class='form-control chosen'");?></td><td></td>
    </tr>
    <tr>
      <th class='w-120px'><?php echo $lang->guarder->content;?></th> 
      <td><?php echo html::input('identity', '', "class='form-control'");?></td><td></td>
    </tr>
    <tr>
      <th class='w-120px'><?php echo $lang->guarder->reason;?></th> 
      <td><?php echo html::input('reason', '', "class='form-control'");?></td><td></td>
    </tr>
    <tr>
      <th class='w-120px'><?php echo $lang->guarder->expiration;?></th> 
      <td><?php echo html::input('expired', '', "class='form-control'");?></td>
    </tr>
    <tr><td></td><td><?php echo html::submitButton();?></td></tr>
  </tbody>
</table>
</form>
<?php include '../../common/view/footer.modal.html.php';?>
