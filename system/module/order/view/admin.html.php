<?php 
/**
 * The admin view of order module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv11.html)
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
        <th class='w-60px'><?php commonModel::printOrderLink('account', $orderBy, $vars, $lang->order->account);?></th>
        <th><?php echo $lang->order->productInfo;?></th>
        <th class='w-80px'><?php commonModel::printOrderLink('amount', $orderBy, $vars, $lang->order->amount);?></th>
        <th class='w-200px'><?php echo $lang->order->life;?></th>
        <th class='w-60px'><?php commonModel::printOrderLink('status', $orderBy, $vars, $lang->product->status);?></th>
        <th class='w-150px'><?php echo $lang->actions;?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($orders as $order):?>
      <tr class='text-center text-middle'>
        <td><?php echo $order->id;?></td>
        <td class='text-left'><?php echo $order->account;?></td>
        <td>
          <dl>
            <?php foreach($order->products as $product):?>
            <dd class='text-left'>
              <span class='text-info'><?php echo $product->productName;?></span>
              <span>
              <?php echo $lang->order->price . $lang->colon . $product->price . ' ' . $lang->order->count . $lang->colon. $product->count; ?>
              </span>
            </dd>
            <?php endforeach;?>
          </dl>
        </td>
        <td class='text-right'><?php echo $order->amount;?></td>
        <td>
          <?php echo $lang->order->createdDate . $lang->colon .  $order->createdDate;?>
          <?php if($order->payment != 'COD' and ($order->paidDate > $order->createdDate)) echo $lang->order->paidDate . $lang->colon .  $order->paidDate;?>
          <?php if($order->deliveriedDate > $order->createdDate)echo $lang->order->deliveriedDate . $lang->colon .  $order->deliveriedDate;?>
          <?php if($order->confirmedDate > $order->deliveriedDate)echo $lang->order->confirmedDate . $lang->colon .  $order->confirmedDate;?>
          <?php if($order->payment == 'COD' and ($order->paidDate > $order->createdDate)) echo $lang->order->paidDate . $lang->colon .  $order->paidDate;?>
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
