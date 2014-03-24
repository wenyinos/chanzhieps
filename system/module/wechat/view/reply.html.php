<?php 
/**
 * The reply view file of wechat of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     LGPL
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     wechat 
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<div class='modal-dialog w-700px'>
  <div class='modal-content'>
    <div class='modal-header'>
      <?php echo html::closeButton();?>
      <h4 class='modal-title'><i class="icon-mail-reply"></i> <?php echo $lang->wechat->message->reply;?></h4>
    </div>
    <div class='modal-body'>
      <div id='recordsBox' class='comments-list'>
        <?php foreach($records as $record):?>
          <div class='comment' id="record<?php echo $record->id?>">
            <div class='avatar'><div class='avatar-empty icon-comments-alt'></div></div>
            <div class='content'>
              <div class='text'><span class='author'><strong><?php echo $user->nickname . $lang->colon;?></strong></span> &nbsp;<?php echo nl2br($record->content);?></div>
              <div class='actions text-muted small'><span class='text-important'><?php echo $lang->wechat->message->typeList[$record->type] ?></span> &nbsp; <?php echo $lang->wechat->message->time . $lang->colon . $record->time;?></div>
            </div>
            <?php if(isset($record->replies)):?>
            <div class='comments-list'>
              <?php foreach($record->replies as $reply):?>
                <div class='comment'>
                  <div class='avatar'><div class='avatar-empty icon-reply'></div></div>
                  <div class='content'>
                    <div class='text'><span class='author'><strong><?php echo $reply->from . $lang->colon;?></strong></span> &nbsp;<?php echo nl2br($reply->content);?></div>
                    <div class='actions text-muted small'><?php echo $lang->wechat->message->time . ' ' . $reply->time;?></div>
                  </div>
                </div>
              <?php endforeach;?>
            </div>
          <?php endif;?>
          </div>
        <?php endforeach;?>
      </div>
      <form method='post' action="<?php echo inlink('reply', "messge={$message->id}");?>" id='ajaxForm'>
        <?php echo html::hidden('referer', $this->server->http_referer); ?>
        <div id='replyBox'>
          <?php echo html::textarea('content', '', "class='form-control' rows=2");?>
          <?php echo html::submitButton($lang->wechat->message->reply);?>
        </div>
      </form>
    </div>
  </div>
</div>
<?php if(isset($pageJS)) js::execute($pageJS);?>
