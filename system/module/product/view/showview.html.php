<?php
/**
 * The setproductview view file of product module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv11.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     product
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.modal.html.php';?>
<form id='ajaxForm' action="<?php echo inlink('showView');?>" method='post'>
  <table class="table table-form">
    <tr>
      <td><?php echo html::radio('showView', $lang->product->showViewList, isset($this->config->product->view) ? $this->config->product->view : '1');?></td>
    </tr>
    <tr>
      <td><?php echo html::submitButton();?></td>
    </tr>
  </table>
</form>
<?php include '../../common/view/footer.modal.html.php';?>
