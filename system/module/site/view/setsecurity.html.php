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
<?php include '../../common/view/header.modal.html.php';?>
<?php js::set('position', $position)?>
<?php if(isset($pass) and !$pass):?>
<?php 
$module = 'user';
$method = 'edit';
$url    = helper::safe64Encode($this->app->getURI());
$target = 'self';
include '../../mail/view/captcha.html.php';
?>
<?php else:?>
<div class='panel'>
  <div class='panel-heading'><strong><i class='icon-globe'></i> <?php echo $lang->site->setSecurity;?></strong></div>
  <div class='panel-body'>
    <form method='post' id='ajaxForm' class='form-inline'>
      <table class='table table-form'>
        <tr>
          <th class='w-200px'><?php echo $lang->site->captcha;?></th>
          <td colspan='3'><?php echo html::radio('captcha', $lang->site->captchaList, isset($this->config->site->captcha) ? $this->config->site->captcha : 'auto');?></td>
        </tr>
        <tr>
          <th><?php echo $lang->site->safeMode;?></th>
          <td colspan='3'>
            <?php echo html::checkbox('safeMode', array('1' => $lang->site->safeMode), isset($this->config->site->safeMode) ? $this->config->site->safeMode : '');?><br>
            <span class='text-important'><?php echo $lang->site->safeModeholder;?></span>
          </td>
        </tr>
        <tr>
          <th class='w-200px'><?php echo $lang->site->checkPosition;?></th>
          <td colspan='2'><?php echo html::radio('checkPosition', $lang->site->checkPositionList, isset($this->config->site->checkPosition) ? $this->config->site->checkPosition : 'close');?></td>
          <td></td>
        </tr>
        <tr>
          <?php $allowedPosition = isset($this->config->site->allowedPosition) ? $this->config->site->allowedPosition : '';?>
          <th class='w-200px'><?php echo $lang->site->allowedPosition;?></th>
          <td colspan='2'><?php echo html::input('allowedPositionShow', $allowedPosition, "class='form-control' disabled='disabled'");?></td>
          <td>
            <?php echo html::input('allowedPosition', $allowedPosition, "class='hide'");?>
            <?php echo $allowedPosition == $position ? '' : html::a('', sprintf($lang->site->usePosition, $position), "id='usePosition' class=''")?>
          </td>
        </tr>
        <tr>
          <th><?php echo $lang->site->checkSessionIP;?></th>
          <td colspan='3'>
            <?php echo html::radio('checkSessionIP', $lang->site->sessionIpoptions, isset($this->config->site->checkSessionIP) ? $this->config->site->checkSessionIP : 0);?>
            <br/><span class='text-important'><?php echo $lang->site->sessionIpTip;?></span>
          </td>
        </tr>
        <tr>
          <th class='w-200px'><?php echo $lang->site->checkIP;?></th>
          <td colspan='3'>
            <?php echo html::textarea('allowedIP', isset($this->config->site->allowedIP) ? $this->config->site->allowedIP : '', "class='form-control' placeholder='{$lang->site->allowedIPTip}'");?>
            <span class='text-important'><?php echo $lang->site->allowedIPTip;?></span>
          </td>
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
<?php endif;?>
<?php include '../../common/view/footer.modal.html.php';?>
