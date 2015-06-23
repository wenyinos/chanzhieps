<?php
/**
 * The setting view file of order module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv11.html)
 * @author      xiying Guang <guanxiying@xirangit.com>
 * @package     order
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<div class='panel'>
  <div class='panel-heading'><strong><i class='icon-globe'></i> <?php echo $lang->order->setting;?></strong></div>
  <div class='panel-body'>
    <form method='post' id='ajaxForm' class='form-inline'>
      <table class='table table-form'>
        <tr>
          <th class='col-xs-1'><?php echo $lang->order->confirmLimit;?></th> 
          <td>
            <div class='w-100px'>
            <div class='input-group'>
              <?php echo html::input('confirmLimit', isset($this->config->shop->confirmLimit) ? $this->config->shop->confirmLimit: 7, "class='form-control'");?>
              <span class='input-group-addon'><?php echo $lang->order->days;?></span>
            </div>
            </div>
          </td>
        </tr>
        <tr>
          <th><?php echo $lang->order->payment;?></th> 
          <td class='col-xs-6' colspan='2'><?php echo html::checkbox('payment', $lang->order->paymentList, isset($this->config->shop->payment) ? $this->config->shop->payment : 'COD,alipay', "class='checkbox'");?></td>
        </tr>
        <tr class='alipay-item'>
          <th><?php echo $lang->order->alipayPid;?></th>
          <td><?php echo html::input('pid', $this->config->alipay->pid, "class='form-control' placeholder='{$lang->order->placeholder->pid}'" );?>
        </tr>
        <tr class='alipay-item'>
          <th><?php echo $lang->order->alipayKey;?></th>
          <td><?php echo html::input('key', $this->config->alipay->key, "class='form-control' placeholder='{$lang->order->placeholder->key}'" );?>
        </tr>
        <tr class='alipay-item'>
          <th><?php echo $lang->order->alipayEmail;?></th>
          <td><?php echo html::input('email', $this->config->alipay->email, "class='form-control' placeholder='{$lang->order->placeholder->email}'" );?>
        </tr>
        <tr>
          <th></th>
          <td><?php echo html::submitButton();?></td>
        </tr>
      </table>
    </form>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
