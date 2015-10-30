<?php include '../../common/view/header.modal.html.php';?>
<form id='ajaxForm' method='post' action="<?php echo inlink('addToBlacklist', "id={$thread->id}");?>">
  <table class='table table-form form-inline table-borderd'>
    <tr>
      <th class='w-80px'><?php echo $lang->thread->content;?></th>
      <td colspan='3'>
        <?php echo $thread->content;?>
      </td>
    </tr>
    <tr>
      <th><?php echo $lang->blacklist->keywords;?></th>
      <td colspan='3'>
        <?php echo html::textarea('keywords', '', "class='form-control'");?>
      </td>
    </tr>
    <?php if(!empty($thread->ip)):?>
    <tr>
      <th><?php echo $lang->blacklist->ip;?></th>
      <td class='w-160px'>
        <?php echo html::checkbox('item[ip]', array($thread->ip => $thread->ip), '', "checkbox-inline");?>
      </td>
      <td class='w-200px'>
        <div class='input-group'>
        <span class='input-group-addon'><?php echo $lang->guarder->disable;?></span>
        <?php echo html::input('hour[ip]', '', "class='form-control'");?>
        <span class='input-group-addon'><?php echo $lang->blacklist->hour;?></span>
        </div>
      </td>
      <td></td>
    </tr>
    <?php endif;?>
    <?php if(!empty($thread->author)):?>
    <tr>
      <th><?php echo $lang->blacklist->account;?></th>
      <td>
        <?php echo html::checkbox('item[account]', array($thread->author => $thread->author), '', "checkbox-inline");?>
      </td>
      <td class='w-200px'>
        <div class='input-group'>
        <span class='input-group-addon'><?php echo $lang->guarder->disable;?></span>
        <?php echo html::input('hour[account]', '', "class='form-control'");?>
        <span class='input-group-addon'><?php echo $lang->blacklist->hour;?></span>
        </div>
      </td>
      <td></td>
    </tr>
    <?php endif;?>
    <?php if(!empty($thread->email)):?>
    <tr>
      <th><?php echo $lang->blacklist->email;?></th>
      <td>
        <?php echo html::checkbox('item[email]', array($thread->email => $thread->email), '', "checkbox-inline");?>
      </td>
      <td class='w-200px'>
        <div class='input-group'>
        <span class='input-group-addon'><?php echo $lang->guarder->disable;?></span>
        <?php echo html::input('hour[email]', '', "class='form-control'");?>
        <span class='input-group-addon'><?php echo $lang->blacklist->hour;?></span>
        </div>
      </td>
      <td></td>
    </tr>
    <?php endif;?>
    <tr><td></td><td><?php echo html::submitButton();?></td></tr>
  </table>
</form>
<?php include '../../common/view/footer.modal.html.php';?>
