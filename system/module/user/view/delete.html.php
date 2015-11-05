<?php include '../../common/view/header.admin.html.php';?>
<div class='panel'>
  <div class='panel-heading'><strong><i class='icon-globe'></i> <?php echo $lang->user->delete->common;?></strong></div>
  <div class='panel-body'>
    <form id='ajaxform' method='post' action="<?php echo inlink('delete', "account={$account}");?>">
      <table class='table table-form form-inline table-borderd'>
        <tr>
          <th colspan='2'><?php echo $lang->user->delete->thread;?></th>
          <td>
          <?php foreach($userHistory->threads as $thread):?>
          <?php echo html::checkbox('thread[]', $thread->title);?>
          <?php endforeach;?>
          </td>
        </tr>
        <tr>
          <th colspan='2'><?php echo $lang->user->delete->reply;?></th>
          <td>
          <?php foreach($userHistory->replies as $reply):?>
          <?php echo html::checkbox('reply[]', $reply->content);?>
          <?php endforeach;?>
          </td>
        </tr>
        <tr>
          <th colspan='2'><?php echo $lang->user->delete->comment;?></th>
          <td>
          <?php foreach($userHistory->comments as $comment):?>
          <?php echo html::checkbox('comment[]', $comment->content);?>
          <?php endforeach;?>
          </td>
        </tr>
        <tr>
          <th colspan='2'><?php echo $lang->user->delete->message;?></th>
          <td>
          <?php foreach($userHistory->messages as $message):?>
          <?php echo html::checkbox('message[]', $message->content);?>
          <?php endforeach;?>
          </td>
        </tr>
        <tr>
          <th colspan='2'><?php echo $lang->user->delete->order;?></th>
          <td>
          <?php foreach($userHistory->orders as $order):?>
          <?php 
            $orderTitle = ''; 
            foreach($order as $product) $orderTitle .= $product->productName;
          ?> 
          <?php echo html::checkbox('order[]', $orderTitle);?>
          <?php endforeach;?>
          </td>
        </tr>
        <tr>
          <th colspan='2'><?php echo $lang->user->delete->address;?></th>
          <td>
          <?php foreach($userHistory->addresses as $address):?>
          <?php echo html::checkbox('address[]', $address->address);?>
          <?php endforeach;?>
          </td>
        </tr>
        <tr>
          <th colspan='2'><?php echo $lang->user->delete->contribution;?></th>
          <td>
          <?php foreach($userHistory->contributions as $contribution):?>
          <?php echo html::checkbox('contribution[]', $contribution->title);?>
          <?php endforeach;?>
          </td>
        </tr>
        <tr><td></td><td><?php echo html::submitButton();?></td></tr>
      </table>
    </form>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
