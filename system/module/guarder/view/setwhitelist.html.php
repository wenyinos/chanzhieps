<?php
/**
 * The setWhitelist view file of guard module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1 (http://www.chanzhi.org/license/)
 * @author      Qiaqia LI <liqiaqia@cnezsoft.cn>
 * @package     guard
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<div class='panel'>
  <div class='panel-heading'><strong><i class='icon-globe'></i> <?php echo $lang->guarder->setWhitelist;?></strong></div>
  <div class='panel-body'>
    <form method='post' id='ajaxForm' class='form-inline'>
      <table class='table table-form'>
        <tr>
          <th class='w-100px'><?php echo $lang->guarder->IPWhitelist;?></th>
          <td colspan='3'>
            <?php echo html::textarea('IPWhitelist', isset($this->config->guarder->IPWhitelist) ? $this->config->guarder->IPWhitelist : '', "class='form-control'");?>
            <span class='text-important'><?php echo $lang->guarder->IPTip;?></span>
          </td>
        </tr>
        <tr>
          <th class='w-100px'><?php echo $lang->guarder->ACWhitelist;?></th>
          <td colspan='3'>
            <?php echo html::textarea('ACWhitelist', isset($this->config->guarder->ACWhitelist) ? $this->config->guarder->ACWhitelist : '', "class='form-control'");?>
            <span class='text-important'><?php echo $lang->guarder->ACTip;?></span>
          </td>
        </tr>
        <tr>
          <th></th>
          <td colspan='2'>
            <?php echo html::submitButton();?>
          </td>
        </tr>
      </table>
    </div>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
