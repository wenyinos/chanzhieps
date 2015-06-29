<?php
/**
 * The logo view file of ui module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv11.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     ui
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<div class='panel'>
  <div class='panel-heading'>
    <strong><i class='icon-certificate'></i><?php echo $lang->ui->others;?></strong>
  </div>
  <div class='panel-body'>
    <form method='post' id='ajaxForm' enctype='multipart/form-data'>
      <table class='table table-form'>
        <tr>
          <th class='w-80px'><?php echo $lang->ui->productView;?></td>
          <td><?php echo html::radio('productView', $lang->ui->productViewList, isset($this->config->ui->productView) ? $this->config->ui->productView : '1');?></td>
        </tr>
        <tr><td colspan='2'><?php echo html::submitButton();?></td></tr>
      </table>
    </form>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
