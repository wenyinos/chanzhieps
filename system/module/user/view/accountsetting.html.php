<?php include '../../common/view/header.admin.html.php';?>
<div class='panel'>
  <div class='panel-heading'><?php echo $lang->accountSetting;?></div>
  <div class='panel-body'>
    <form method='post' id='accountForm'>
      <table class='table table-form'> 
        <tbody>
          <div>
            <div class='safeQuestion'><?php echo '<strong>' . $lang->user->setSafeQuestion . '</strong>';?></div> 
            <div>
              <tr>
                <th class='w-200px'><?php echo $lang->user->safeQuestion;?></th>
                <td><?php echo html::input('safeQuestion','', "class='form-control'");?></td>  
              </tr>
              <tr>
                <th><?php echo $lang->user->answer;?></th>
                <td><?php echo html::input('answer', '', "class='form-control'");?></td>
              </tr>
            </div>
          </div>
        </tbody>
        <tr>
          <th></th><td><?php echo html::submitButton();?></td> 
        </tr>
      </table>
    </form>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
