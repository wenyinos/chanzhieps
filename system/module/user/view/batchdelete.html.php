<?php include '../../common/view/header.admin.html.php';?>
<div class='panel'>
  <div class='panel-heading'><strong><i class='icon-globe'></i> <?php echo $lang->user->userHistory;?></strong></div>
  <form id='ajaxForm' method='post' action="<?php echo inlink('batchDelete');?>">
    <div class='panel'>
      <table class='table table-hover table-striped' id='batchForm'>
      <?php foreach($userHistory as $account => $history):?>
      <tr>
        <td class='w-80px'><?php echo $users[$account];?></td>
        <td><span class='<?php echo $history->thread ? 'warning' : '';?>'><?php echo $history->thread;?></span><?php echo $lang->user->threadHistory;?></td>
        <td><span class='<?php echo $history->reply ? 'warning' : '';?>'><?php echo $history->reply;?></span><?php echo $lang->user->replyHistory;?></td>
        <td><span class='<?php echo $history->contribution ? 'warning' : '';?>'><?php echo $history->contribution;?></span><?php echo $lang->user->contributionHistory;?></td>
        <td><span class='<?php echo $history->comment ? 'warning' : '';?>'><?php echo $history->comment;?></span><?php echo $lang->user->commentHistory;?></td>
        <td><span class='<?php echo $history->message ? 'warning' : '';?>'><?php echo $history->message;?></span><?php echo $lang->user->messageHistory;?></td>
        <td><span class='<?php echo $history->order ? 'warning' : '';?>'><?php echo $history->order;?></span><?php echo $lang->user->orderHistory;?></td>
        <td><span class='<?php echo $history->address ? 'warning' : '';?>'><?php echo $history->address;?></span><?php echo $lang->user->addressHistory;?></td>
      </tr>
      <?php endforeach;?>
      </table>
      <div class='panel-footer'>
      <?php echo $lang->guarder->password;?>
      <?php echo html::password('password', '', "placeholder='{$lang->guarder->passwordHolder}'") . '<br />';?>
      <?php echo html::a('javascript:;', $lang->delete, "class='btn btn-primary submit'");?>
      <?php echo html::hidden('users', implode(',', array_keys($userHistory)));?>
      </div>
    </div>
  </form>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
