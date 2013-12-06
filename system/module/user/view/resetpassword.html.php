<?php include '../../common/view/header.html.php';?>
<section id="reset">
  <div class="box-radius">
    <div class="panel panel-default">
      <div class="panel-heading"><h4><strong><?php echo $lang->user->recoverPassword;?></strong></h4></div>
      <div class="panel-body">
        <form method='post' id='ajaxForm'>
          <table> 
            <tr>
              <th class='w-100px'><?php echo $lang->user->account;?></th>
              <td><?php echo html::input('account', '', "class='text-box'");?></td>
            </tr>  
            <tr>
              <th><?php echo $lang->user->email;?></th>
              <td><?php echo html::input('email', '', "class='text-box'");?></td>
            </tr>
            <tr>
              <th></th>
              <td><?php echo html::submitButton($lang->user->submit,'btn btn-primary btn-block');?></td>
            </tr>
          </table>
        </form>
      </div>
    </div>  
  </div>
</section>
<?php include '../../common/view/footer.html.php';?>
