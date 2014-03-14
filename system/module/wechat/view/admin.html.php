<?php
/**
 * The admin view file of wechat of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     LGPL
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     wechat
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<div class='panel'>
  <div class='panel-heading'>
    <strong><i class="icon-list-ul"></i> <?php echo $lang->wechat->list;?></strong>
    <div class='panel-actions'>
      <?php echo html::a($this->inlink('create'), '<i class="icon-plus"></i>', "class='btn btn-primary', title='{$lang->wechat->create}'");?>
      <?php echo html::a($this->createLink('user', 'admin'), '<i class="icon-user"></i> ', "class='btn btn-primary' title='{$lang->wechat->users}'");?>
    </div>
  </div>
  <table class='table table-hover table-striped tablesorter'>
    <thead>
      <tr class='text-center'>
        <th class='w-60px'> <?php echo $lang->wechat->id;?></th>
        <th>                <?php echo $lang->wechat->name;?></th>
        <th class='w-100px'><?php echo $lang->wechat->type;?></th>
        <th class='w-160px'><?php echo $lang->wechat->account;?></th>
        <th class='w-160px'><?php echo $lang->wechat->appID;?></th>
        <th class='w-300px'><?php echo $lang->actions;?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($publics as $public):?>
      <tr class='text-center'>
        <td><?php echo $public->id;?></td>
        <td><?php echo $public->name;?></td>
        <td><?php echo $lang->wechat->typeList[$public->type];?></td>
        <td><?php echo $public->account;?></td>
        <td><?php echo $public->appID;?></td>
        <td>
          <?php
          echo html::a($this->createLink('tree', 'browse', "type=wx_$public->id"), $lang->wechat->setMenu);
          echo html::a($this->createLink('wechat', 'adminResponse', "publicID=$public->id"), $lang->wechat->adminResponse);
          echo html::a($this->createLink('wechat', 'editResponse', "publicID=$public->id&group=default"), $lang->wechat->defaultResponse);
          echo html::a($this->createLink('wechat', 'editResponse', "publicID=$public->id&group=subscribe"), $lang->wechat->subscribeResponse);
          ?>
          <a href='###' class='access' data-container='body' data-toggle='popover' data-placement='left' data-content='<?php printf($lang->wechat->accessInfo, $public->appSecret, $public->url, $public->token);?>'>
            <?php echo $lang->wechat->access;?>
          </a>
        </td>
      </tr>
      <?php endforeach;?>
    </tbody>
  </table>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
