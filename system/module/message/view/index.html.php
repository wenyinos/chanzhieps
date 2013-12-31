<?php
/**
 * The index view file of message module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     LGPL
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     message
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php $common->printPositionBar();?>
<div class='row'>
  <div class='col-md-9'>
    <div class='panel'>
      <div class='panel-heading'><div class='panel-actions'><a href='#commentForm' class='btn btn-primary'><i class='icon-comment-alt'></i> <?php echo $lang->message->post; ?></a></div><strong><i class='icon-comments-alt'></i> <?php echo $lang->message->list;?></strong></div>
      <div class='panel-body'>
        <?php if(!empty($messages)):?>
        <div class='comments-list'>
        <?php foreach($messages as $number => $message):?>
          <div class='comment' id="comment<?php echo $message->id?>">
            <div class='avatar'><div class='icon-stack icon'><i class='icon-comment icon-stack-base'></i><strong class='icon-content'>#<?php echo ($startNumber + $number + 1)?></strong></div></div>
            <div class='content'>
              <div class='pull-right'><span class='text-muted'><?php echo $message->date;?></span>
              </div>
              <span class='author'><strong><i class='icon-user text-muted'></i> <?php echo $message->from;?></strong></span>
              <div class='text'><?php echo nl2br($message->content);?></div>
            </div>
            <?php if(!empty($replies[$message->id])):?>
              <div class='comments-list'>
                <?php foreach($replies[$message->id] as $reply):?>
                <div class='comment'>
                  <div class='content'>
                    <div class='pull-right'><span class='text-muted'><?php echo $reply->date;?></span>
                    </div>
                    <span class='author'><strong><i class='icon-user text-muted'></i> <?php echo $reply->from;?></strong> <small class='text-muted'><?php echo $lang->message->reply; ?></small></span>
                    <div class='text'><?php echo nl2br($reply->content);?></div>
                  </div>
                </div>
                <?php endforeach; ?>
              </div>
            <?php endif;?>
          </div>
        <?php endforeach; ?>
        </div>
        <?php endif;?>
        <div class='pager clearfix'><?php $pager->show('right', 'short');?></div>
      </div>
    </div>

    <div class='panel'>
      <div class='panel-heading'><strong><i class='icon-comment-alt'></i> <?php echo $lang->message->post;?></strong></div>
      <div class='panel-body'>
        <form method='post' id='commentForm' action="<?php echo $this->createLink('message', 'post', 'type=message');?>">
          <?php
          $from  = $this->session->user->account == 'guest' ? '' : $this->session->user->account;
          $phone = $this->session->user->account == 'guest' ? '' : $this->session->user->phone;
          $qq    = $this->session->user->account == 'guest' ? '' : $this->session->user->qq;
          $email = $this->session->user->account == 'guest' ? '' : $this->session->user->email; 
          ?>
          <table class='table table-form'>
            <tr>
              <th style='width: 90px'><?php echo $lang->message->from;?></th>
              <td style='width: 40%'><?php echo html::input('from', $from, "class='form-control'"); ?></td>
              <td></td>
            </tr>
            <tr>
              <th><?php echo $lang->message->phone;?></th>
              <td><?php echo html::input('phone', $phone, "class='form-control'"); ?></td>
              <td><small class='text-info'><?php echo $lang->message->contactHidden;?></small></td>
            </tr>
            <tr>
              <th><?php echo $lang->message->qq;?></th>
              <td><?php echo html::input('qq', $qq, "class='form-control'"); ?></td>
            </tr>
            <tr>
              <th><?php echo $lang->message->email;?></th>
              <td><?php echo html::input('email', $email, "class='form-control'"); ?></td>
            </tr>
            <tr>
              <th><?php echo $lang->message->content;?></th>
              <td colspan='2'>
                <?php 
                echo html::textarea('content', '', "class='form-control' rows='3'");
                echo html::hidden('objectType', 'message');
                echo html::hidden('objectID', 0);
                ?>
              </td>
            </tr>
            <tr>
              <th></th>
              <td><label class='checkbox'><input type='checkbox' name='public' value='1' checked='checked' /><?php echo $lang->message->secret;?></label></div></td>
            </tr>
            <tr id='captchaBox' style='display:none'></tr>
            <tr>
              <th></th>
              <td><?php echo html::submitButton();?></td>
            </tr>
          </table>
        </form>
      </div>
    </div>
  </div>
  <div class='col-md-3'><?php $this->block->printRegion($layouts, 'message_index', 'side');?></div>
</div>
<?php include '../../common/view/footer.html.php';?>
