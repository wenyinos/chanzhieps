<?php include '../common/header.modal.html.php';?>
<form id='replyForm' method='post' action="<?php echo inlink('reply', "messageID={$message->id}");?>">
  <table class='table table-form'>
    <?php if($this->session->user->account == 'guest' && ($message->objectType == 'comment' || $message->objectType == 'article')): ?>
    <tr>
      <div class='required required-wrapper'></div>
      <th class='w-50px'><?php echo $lang->message->from;?></th>
      <td><?php echo html::input('from', '', "class='form-control'"); ?></td>
    </tr>
    <tr>
      <th><?php echo $lang->message->email;?></th>
      <td><?php echo html::input('email', '', "class='form-control'"); ?></td>
    </tr>
    <?php elseif($this->session->user->account == 'guest' && $message->objectType == 'message'): ?>
    <tr>
      <div class='required required-wrapper'></div>
      <th class='w-50px'><?php echo $lang->message->from;?></th>
      <td><?php echo html::input('from', '', "class='form-control'"); ?></td>
    </tr>
    <tr>
      <th><?php echo $lang->message->phone;?></th>
      <td><?php echo html::input('phone', '', "class='form-control'"); ?></td>
    </tr>
    <tr>
      <th><?php echo $lang->message->qq;?></th>
      <td><?php echo html::input('qq', '', "class='form-control'"); ?></td>
    </tr>
    <tr>
      <th><?php echo $lang->message->email;?></th>
      <td><?php echo html::input('email', '', "class='form-control'"); ?></td>
    </tr>
    <?php else: ?>
    <tr>
      <th><?php echo $lang->message->from;?></th>
      <td>
        <div class='required required-wrapper'></div>
        <?php echo html::input('from', $app->user->realname, "class='form-control'");?>
      </td>
    </tr>
    <?php endif; ?>
    <tr>
      <th><?php echo $lang->message->content;?></th>
      <td>
        <div class='required required-wrapper'></div>
        <?php echo html::textarea('content', '', "class='form-control' rows='5'");?>
      </td>
    </tr>
    <tr><td></td><td><?php echo html::submitButton();?></td></tr>
  </table>
</form>
<?php include '../common/footer.modal.html.php';?>
