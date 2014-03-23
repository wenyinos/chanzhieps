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
      <div id='recordsBox'>
        <table class='table table-border-none'>
          <?php foreach($records as $record):?>
          <tr>
            <td>
              <?php echo $user->nickname . $record->time;?><br>
              <span><?php echo $lang->wechat->message->typeList[$record->type] . $lang->colon . $record->content;?></span>
            </td>
          </tr>
          <?php if(isset($record->replies)):?>
          <?php foreach($record->replies as $reply):?>
          <tr class='reply'>
            <td>
              <label><?php echo $reply->from . $reply->time;?></label><br/>
              <span><?php echo $reply->content;?></span>
            </td>
          </tr>
          <?php endforeach;?>
          <?php endif;?>
          <?php endforeach;?>
        </table>
      </div>
      <form method='post' action="<?php echo inlink('reply', "messge={$message->id}");?>" id='ajaxForm'>
        <table class='table table-form'>
          <tr>
            <td><?php echo html::textarea('content', '', "class='form-control' rows=2");?></td>
            <td class='w-50px'><?php echo html::submitButton($lang->wechat->message->reply) . html::hidden('referer', $this->server->http_referer);?></td>
          </tr>
        </table>
      </form>
    </div>
  </div>
</div>
<?php if(isset($pageJS)) js::execute($pageJS);?>
