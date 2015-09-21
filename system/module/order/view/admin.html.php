<?php 
/**
 * The admin view of order module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1 (http://www.chanzhi.org/license/)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     order 
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<?php js::set('finishWarning', $lang->order->finishWarning);?>
<div class='panel'>
  <div class='panel-heading'>
    <strong><i class="icon-list-ul"> </i><?php echo $lang->order->admin;?></strong>
    <?php
    echo '&nbsp; &nbsp; &nbsp;';
    echo html::a(inlink('admin', "mode=status&status=normal"), $lang->order->statusList['normal'], $value == 'normal' ? "class='active'" : '');
    echo html::a(inlink('admin', "mode=status&status=finished"), $lang->order->statusList['finished'], $value == 'finished' ? "class='active'" : '');
    echo html::a(inlink('admin', "mode=status&status=canceled"), $lang->order->statusList['canceled'], $value == 'canceled' ? "class='active'" : '');
    ?>
  </div>
  <table class='table table-hover table-striped tablesorter'>
    <thead>
      <tr class='text-center'>
        <?php $vars = "mode=$mode&value={$value}&orderBy=%s&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}";?>
        <th class='w-60px'><?php commonModel::printOrderLink('id', $orderBy, $vars, $lang->order->id);?></th>
        <th class='w-80px'><?php commonModel::printOrderLink('account', $orderBy, $vars, $lang->order->account);?></th>
        <th><?php echo $lang->order->productInfo;?></th>
        <th class='w-80px'><?php commonModel::printOrderLink('amount', $orderBy, $vars, $lang->order->amount);?></th>
        <th class='w-220px'><?php echo $lang->order->life;?></th>
        <th class='w-200px'><?php echo $lang->order->expressInfo;?></th>
        <th class='w-80px'><?php commonModel::printOrderLink('status', $orderBy, $vars, $lang->product->status);?></th>
        <th class='w-150px'><?php echo $lang->actions;?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($orders as $order):?>
      <tr class='text-center text-middle'>
        <td><?php echo $order->id;?></td>
        <td class='text-left'><?php echo $order->account;?></td>
        <td>
          <?php if($order->type == 'score'):?>
          <?php echo $lang->order->score;?>
          <?php else:?>
          <dl>
            <?php foreach($order->products as $product):?>
            <dd class='text-left'>
              <span><?php echo html::a(commonModel::createFrontLink('product', 'view', "id=$product->productID"), $product->productName, "target='_blank'");?></span>
              <span><?php echo $lang->order->price . $lang->colon . $product->price . ' ' . $lang->order->count . $lang->colon . $product->count;?></span>
            </dd>
            <?php endforeach;?>
          </dl>
          <?php endif;?>
        </td>
        <td class='text-center'><?php echo $order->amount;?></td>
        <td>
          <?php echo $lang->order->createdDate . $lang->colon .  $order->createdDate . '</br>';?>
          <?php if($order->payment != 'COD' and ($order->paidDate > $order->createdDate)) echo $lang->order->paidDate . $lang->colon .  $order->paidDate . '</br>';?>
          <?php if($order->deliveriedDate > $order->createdDate) echo $lang->order->deliveriedDate . $lang->colon .  $order->deliveriedDate . '</br>';?>
          <?php if($order->confirmedDate > $order->deliveriedDate) echo $lang->order->confirmedDate . $lang->colon .  $order->confirmedDate . '</br>';?>
          <?php if($order->payment == 'COD' and ($order->paidDate > $order->createdDate)) echo $lang->order->paidDate . $lang->colon .  $order->paidDate . '</br>';?>
        </td>
        <td class = 'text-left'>
          <?php if($order->deliveryStatus !== 'not_send') 
                {
                    echo $lang->order->express . $lang->colon . $this->order->expressInfo($order) . '</br>';
                    echo $lang->order->waybill . $lang->colon . $order->waybill . '</br>'; 
                    echo $lang->order->receiver . $lang->colon . json_decode($order->address)->contact . '[' . json_decode($order->address)->phone . ']' . '</br>';
                }
                else echo $lang->order->noRecord;
          ?>
        </td>
        <td>
          <?php echo $this->order->processStatus($order);?>
        </td>
        <td><?php $this->order->printActions($order);?></td>
      </tr>
      <?php endforeach;?>
    </tbody>
    <tfoot><tr><td colspan='8'><?php $pager->show();?></td></tr></tfoot>
  </table>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
