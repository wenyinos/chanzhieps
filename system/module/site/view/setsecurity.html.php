<?php
/**
 * The setbasic view file of site module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv11.html)
 * @author      xiying Guang <guanxiying@xirangit.com>
 * @package     site
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<div class='panel'>
  <div class='panel-heading'><strong><i class='icon-globe'></i> <?php echo $lang->site->setSecurity;?></strong></div>
  <div class='panel-body'>
    <form method='post' id='ajaxForm' class='form-inline'>
      <table class='table table-form'>
        <tr>
          <th class='w-200px'><?php echo $lang->site->captcha;?></th>
          <td colspan='2'><?php echo html::radio('captcha', $lang->site->captchaList, isset($this->config->site->captcha) ? $this->config->site->captcha : 'auto');?></td><td></td>
        </tr>
        <tr>
          <th class='w-200px'><?php echo $lang->site->checkLoginIP;?></th>
          <td colspan='2'><?php echo html::radio('checkLoginIP', $lang->site->checkLoginIPList, isset($this->config->site->checkLoginIP) ? $this->config->site->checkLoginIP : 'close');?></td><td></td>
        </tr>
        <tr>
          <th></th>
          <td colspan='2'>
            <?php echo html::submitButton();?>
          </td>
        </tr>
      </table>
    </form>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
