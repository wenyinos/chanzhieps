<?php
/**
 * The currency view file of product module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     http://api.chanzhi.org/goto.php?item=license
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     product
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<div class='modal-dialog w-500px'>
  <div class='modal-content'>
    <div class='modal-header'>
      <?php echo html::closeButton();?>
      <h4 class='modal-title' id='myModalLabel'>
        <i class='icon-cog'></i> <?php echo $lang->product->currency;?>
      </h4>
    </div>
    <div class='modal-body'>
      <form id='ajaxForm' action="<?php echo inlink('currency');?>" method='post'>
        <table class="table table-form">
          <tr>
            <th class='w-70px'><?php echo $lang->product->currency;?></th>
            <td><?php echo html::input('currency', '', "class='form-control'");?></td>
            <td class='w-160px'><?php echo html::submitButton();?></td>
          </tr>
        </table>
      </form>
    </div>
  </div>
</div>
<?php if(isset($pageJS)) js::execute($pageJS);?>
