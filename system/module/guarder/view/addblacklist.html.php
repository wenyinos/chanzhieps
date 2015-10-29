<?php include '../../common/view/header.modal.html.php';?>
<?php include '../../common/view/datepick.html.php';?>
<form method='post' action='<?php echo $this->inLink('addblacklist');?>' id='ajaxForm' class='form'>
<table class='table table-form borderless'>
  <tbody class='addBlacklist'>
    <tr>
      <th class='w-120px'><?php echo $lang->blacklist->identity;?></th> 
      <td colspan='2'><?php echo html::input('identity', '', "class='form-control'");?></td>
    </tr>
    <tr>
      <th class='w-120px'><?php echo $lang->blacklist->reason;?></th> 
      <td colspan='2'><?php echo html::input('reason', '', "class='form-control'");?></td>
    </tr>
    <tr>
      <th class='w-120px'><?php echo $lang->blacklist->expiredDate;?></th> 
      <td class='w-200px'>
        <div class='input-group'>
          <?php echo html::input('expired', '', "class='form-control'");?>
          <span class='input-group-addon'><?php echo $lang->blacklist->hour?></span>
        </div>
      </td><td></td>
    </tr>
    <tr><td></td><td><?php echo html::submitButton();?></td></tr>
  </tbody>
</table>
</form>
<?php include '../../common/view/footer.modal.html.php';?>
