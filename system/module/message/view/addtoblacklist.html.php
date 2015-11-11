<?php include '../../common/view/header.modal.html.php';?>
<form id='ajaxForm' method='post' action="<?php echo inlink('addToBlacklist', "id={$message->id}");?>">
  <table class='table table-form form-inline table-borderd'>
    <tr>
      <th class='w-80px'><?php echo $lang->message->content;?></th>
      <td colspan='3'>
        <?php echo $message->content;?>
      </td>
    </tr>
    <tr>
      <th><?php echo $lang->blacklist->keywords;?></th>
      <td colspan='3'>
        <?php echo html::textarea('keywords', '', "class='form-control'");?>
      </td>
    </tr>
    <tr>
      <th><?php echo $lang->blacklist->ip;?></th>
      <td class='w-160px'>
        <?php echo html::checkbox('item[ip]', array($message->ip => $message->ip), '', "checkbox-inline");?>
      </td>
      <td class='w-200px'>
        <div class='input-group'>
        <span class='input-group-addon'><?php echo $lang->guarder->disable;?></span>
        <?php echo html::select('hour[ip]', $lang->guarder->punishOptions, '', "class='form-control'");?>
        </div>
      </td>
      <td></td>
    </tr>
    <?php if(!empty($message->account)):?>
    <tr>
      <th><?php echo $lang->blacklist->account;?></th>
      <td>
        <?php echo html::checkbox('item[account]', array($message->account => $message->account), '', "checkbox-inline");?>
      </td>
      <td class='w-200px'>
        <div class='input-group'>
        <span class='input-group-addon'><?php echo $lang->guarder->disable;?></span>
        <?php echo html::select('hour[account]', $lang->guarder->punishOptions, '', "class='form-control'");?>
        </div>
      </td>
      <td></td>
    </tr>
    <?php endif;?>
    <?php if(!empty($message->email)):?>
    <tr>
      <th><?php echo $lang->blacklist->email;?></th>
      <td>
        <?php echo html::checkbox('item[email]', array($message->email => $message->email), '', "checkbox-inline");?>
      </td>
      <td class='w-200px'>
        <div class='input-group'>
          <span class='input-group-addon'><?php echo $lang->guarder->disable;?></span>
          <?php echo html::select('hour[email]', $lang->guarder->punishOptions, '', "class='form-control'");?>
        </div>
      </td>
      <td></td>
    </tr>
    <?php endif;?>
    <tr><td></td><td><?php echo html::submitButton();?></td></tr>
  </table>
</form>
<?php include '../../common/view/footer.modal.html.php';?>
