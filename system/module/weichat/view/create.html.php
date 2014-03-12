<?php
/**
 * The create view file of weichat module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     LGPL
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     weichat
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<div class='panel'>
  <div class='panel-heading'>
    <strong><i class="icon-plus"></i> <?php echo $lang->weichat->create;?></strong>
  </div>
  <div class='panel-body'>
    <form method='post' id='ajaxForm'>
      <table class='table table-form w-p50'>
        <tr>
          <th class='w-100px'><?php echo $lang->weichat->type;?></th>
          <td><?php echo html::select('type', $lang->weichat->typeList, '', "class='form-control'");?></td>
        </tr>
        <tr>
          <th><?php echo $lang->weichat->name;?></th>
          <td><?php echo html::input('name', '', "class='form-control'");?></td>
        </tr>
        <tr>
          <th><?php echo $lang->weichat->account;?></th>
          <td><?php echo html::input('account', '', "class='form-control'");?></td>
        </tr>
        <tr>
          <th><?php echo $lang->weichat->appID;?></th>
          <td><?php echo html::input('appID', '', "class='form-control'");?></td>
        </tr>
        <tr>
          <th><?php echo $lang->weichat->appSecret;?></th>
          <td><?php echo html::input('appSecret', '', "class='form-control'");?></td>
        </tr>
        <tr>
          <th><?php echo $lang->weichat->token;?></th>
          <td><?php echo html::input('token', '', "class='form-control'");?></td>
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
