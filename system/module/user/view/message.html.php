<?php include '../../common/view/header.html.php';?>
<div class='row'>
  <?php include './side.html.php';?>
  <div class='col-md-10'>
    <form method='post' id='ajaxForm' action="<?php echo $this->createLink('message', 'batchDelete');?>">
      <table class='table table-bordered  table-hover' id='messages'>
        <caption><?php echo $lang->user->message;?></caption>
        <tr>
          <th class='w-10px'><input type='checkbox' id='selectAll'></th>
          <th class='w-50px'><?php echo $lang->user->message->from;?></th>
          <th class='w-100px'><?php echo $lang->message->date;?></th>
          <th><?php echo $lang->message->content;?></th>
          <th class='w-50px'><?php echo $lang->message->readed;?></th>
          <th class='w-80px'><?php echo $lang->actions;?></th>
        </tr>
        <?php foreach($messages as $message):?>
        <tr class='a-center'>
          <td><input type='checkbox' name='messages[]' value="<?php echo $message->id?>" /></td>
          <td><?php echo $message->from;?></td>
          <td><?php echo substr($message->date, 5);?></td>
          <td class='a-left'><?php echo $message->content;?></td>
          <td><?php echo $lang->message->readedStatus[$message->readed];?></td>
          <?php if(!$message->readed):?>
          <td><?php echo html::a($this->createLink('message', 'view', "message=$message->id"), $message->link ? $lang->message->view : $lang->message->readed);?></td>
          <?php else:?>
          <td><?php echo $lang->message->readed;?></td>
          <?php endif;?>
        </tr>
        <?php endforeach;?>
        <tr>
          <td colspan='6'>
            <?php
            if($messages) echo html::submitButton($lang->message->deleteSelected);
            $pager->show();
            ?>
          </td>
        </tr>
      </table>
    </form>
  </div>
</div>
<?php include '../../common/view/footer.html.php';?>
