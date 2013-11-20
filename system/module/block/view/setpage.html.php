<?php
/**
 * The setpage view file of block module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     LGPL
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<form id='ajaxForm' method='post'>
<table class='table table-bordered table-hover table-striped'>
  <caption><?php echo $lang->block->setPage;?></caption>
  <?php foreach($blocks as $blockID => $block):?>
  <tr>
    <td><?php echo $block->name;?></td>
    <td> </td>
  </tr>
  <?php endforeach;?>
  <tr>
    <td colspan='2' class='a-center'><?php echo html::submitButton();?></td>
  </tr>
</table>
</form>
<?php include '../../common/view/footer.admin.html.php';?>
