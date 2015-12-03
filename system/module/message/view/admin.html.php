<?php
/**
 * The admin view file of message module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     message
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<?php js::set('type', $type);?>
<div class="panel">
  <div class="panel-heading">
    <strong>
      <?php
      if($type == 'message')
      {
          echo '<i class="icon-comment-alt"></i> ' . $lang->message->common;
      }
      else if($type == 'reply')
      {
          echo '<i class="icon-comment-alt"></i> ' . $lang->message->reply;
      }
      else
      {
          echo '<i class="icon-comments-alt"></i> ' . $lang->comment->common;
      }
      ?>
    </strong>
    <?php
    echo '&nbsp; &nbsp; &nbsp;';
    echo html::a(inlink('admin', "type={$type}&status=0"), $lang->message->statusList[0], $status == 0 ? "class='active'" : '');
    echo html::a(inlink('admin', "type={$type}&status=1"), $lang->message->statusList[1], $status == 1 ? "class='active'" : '');
    ?>
  </div>
  <?php foreach($messages as $messageID => $message):?>
  <div class='message w-p100'>
    <div class='message-id'><?php echo $messageID;?></div>
    <table class='table table-borderless w-p100'>
      <?php $original = $this->message->getOriginal($messageID);?>
      <?php if($original):?>
      <tr class='original'>
        <?php if($original->type != 'message'):?>
        <td>
          <?php
          $config->requestType = $config->frontRequestType;

          if(!empty($original->objectTitle))
          {
              $objectViewLink = html::a($original->objectViewURL, $original->objectTitle, "target='_blank'");
          }
          else
          {
              $objectViewLink = "<span class='alert-error'>{$lang->comment->deletedObject}</span>";
          }

          $commentTo = $original->type == 'reply' ? $lang->message->reply : $lang->comment->commentTo;

          $config->requestType = 'GET';
          echo <<<EOT
          <i class='icon-user'></i> <strong>$original->from</strong> &nbsp; <i class='icon-envelope green icon'></i> $message->email &nbsp; 
          <span class='gray'>$original->date</span> &nbsp; $commentTo $objectViewLink
EOT;
          ?>
        </td>
        <?php else:?>
        <td>
          <?php echo "<i class='icon-user'></i> <strong>{$original->from}</strong> &nbsp;";?>
          <?php echo "<span class='gray'>$original->date</span>";?>
          <?php if(!empty($original->link))  echo html::a($original->link, $original->link, "target='_blank'");?>
          <br/>
          <?php if(!empty($original->phone)) echo "<i class='icon-phone text-info icon'></i> {$original->phone} &nbsp; ";?>
          <?php if(!empty($original->email)) echo "<i class='icon-envelope text-warning icon'></i> {$original->email} &nbsp; ";?>
          <?php if(!empty($original->qq))    echo "<strong class='text-danger'>QQ</strong> {$original->qq} &nbsp; ";?>
        </td>
        <?php endif;?>
      </tr>
      <tr class='original'>
        <td class='content-box'>
          <textarea name="" id="" rows="2" class="form-control borderless" spellcheck="false"><?php echo $original->content;?></textarea>
        </td>
      </tr>
      <?php endif;?>
      <tr <?php if($original) echo 'class="separator"';?>>
        <?php if($message->type != 'message'):?>
        <td>
          <?php 
          $config->requestType = $config->frontRequestType;

          if(!empty($message->objectTitle))
          {
              $objectViewLink = html::a($message->objectViewURL, $message->objectTitle, "target='_blank'");
          }
          else
          {
              $objectViewLink = "<span class='alert-error'>{$lang->comment->deletedObject}</span>";
          }

          $commentTo = $message->type == 'reply' ? $lang->message->reply : $lang->comment->commentTo;

          $config->requestType = 'GET';
          echo <<<EOT
          <i class='icon-user'></i> <strong>$message->from</strong> &nbsp; <i class='icon-envelope green icon'></i> $message->email &nbsp; 
          <span class='gray'>$message->date</span> &nbsp; $commentTo $objectViewLink
EOT;
          ?>
        </td>
        <?php else:?>
        <td>
          <?php echo "<i class='icon-user'></i> <strong>{$message->from}</strong> &nbsp;";?>
          <?php echo "<span class='gray'>$message->date</span>";?>
          <?php if(!empty($message->link))  echo html::a($message->link, $message->link, "target='_blank'");?>
          <br/>
          <?php if(!empty($message->phone)) echo "<i class='icon-phone text-info icon'></i> {$message->phone} &nbsp; ";?>
          <?php if(!empty($message->email)) echo "<i class='icon-envelope text-warning icon'></i> {$message->email} &nbsp; ";?>
          <?php if(!empty($message->qq))    echo "<strong class='text-danger'>QQ</strong> {$message->qq} &nbsp; ";?>
        </td>
        <?php endif;?>
      </tr>
      <tr>
        <td class='content-box'>
          <textarea name="" id="" rows="2" class="form-control borderless" spellcheck="false"><?php echo $message->content;?></textarea>
        </td>
      </tr>
    </table>
    <div class='message-action'>
      <?php
      commonModel::printLink('message', 'reply', "messageID=$message->id", $lang->message->reply, "data-toggle='modal'");
      commonModel::printLink('guarder', 'addToBlacklist', "type=message&id={$message->id}", $lang->addToBlacklist, "data-toggle='modal'");
      echo '<br />';
      if($status == 0) commonModel::printLink('message', 'pass', "messageID=$message->id&type=single", $lang->message->pass, "class='pass'");
      if($status == 0) commonModel::printLink('message', 'pass', "messageID=$message->id&type=pre", $lang->message->passPre, "class='pre' data-confirm='{$lang->message->confirmPassPre}'");
      echo '<br />';
      commonModel::printLink('message', 'delete', "messageID=$message->id&type=single&status=$status", $lang->message->delete, "class='deleter'");
      if($status == 0) commonModel::printLink('message', 'delete', "messageID=$message->id&type=pre&status=$status", $lang->message->deletePre, "class='pre' data-confirm='{$lang->message->confirmDeletePre}'");
      ?>
    </div>
  </div>
  <?php endforeach;?>
  <?php $pager->show();?>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
