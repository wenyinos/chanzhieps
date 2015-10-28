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
  <div class='panel-heading'>
    <strong><?php echo $lang->site->setYangcong?></strong>
    <div class='panel-actions'>
      <?php //echo html::a('http://api.chanzhi.org/goto.php?item=help_' . $providerCode . 'oauth', '<i class="icon-question-sign"></i> ' . $lang->site->oauthHelp, "target='_blank' class='btn btn-link'");?>
    </div>
  </div>
  <div class='panel-body'>
    <form method='post' id='ajaxForm' class='form-horizontal'>
      <table class="table table-form">
        <tr>
          <th class='w-100px'><?php echo $lang->site->yangcong->appID;?></th>
          <td class='w-300px'>
            <?php echo html::input('appID', zget($setting, 'appID', ' '), "class='form-control'");?>
          </td>
          <td></td>
        </tr>
        <tr>
          <th><?php echo $lang->site->yangcong->key;?></th>
          <td>
            <?php echo html::input('key', zget($setting, 'key', ' '), "class='form-control'");?>
          </td>
        </tr>
        <tr>
          <th><?php echo $lang->site->yangcong->auth;?></th>
          <td>
            <?php echo html::input('auth', zget($setting, 'auth', ' '), "class='form-control'");?>
          </td>
        </tr>
        <tr>
         <th></th> <td><?php echo html::submitButton();?></td>
        </tr>
      </table>
    </form>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
