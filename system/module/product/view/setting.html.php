<?php
/**
 * The currency view file of product module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1 (http://www.chanzhi.org/license/)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     product
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.modal.html.php';?>
<form id='' action="<?php echo inlink('setting');?>" method='post'>
  <table class="table table-form">
    <tr>
      <th class='w-60px'><?php echo $lang->product->stock;?></th>
      <td><?php echo html::radio('stock', $lang->product->stockOptions, isset($config->product->stock) ? $config->product->stock : '');?></td>
    </tr>
    <tr>
      <th><?php echo $lang->product->currency;?></th>
      <td><?php echo html::radio('currency', $lang->product->currencyList, isset($config->product->currency) ? $config->product->currency : '');?></td>
    </tr>
    <tr>
      <th></th>
      <td><?php echo html::submitButton();?></td>
    </tr>
  </table>
</form>
<?php include '../../common/view/footer.modal.html.php';?>
