<?php
/**
 * The admin view file of weichat of chanzhiEPS.
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
    <strong><i class="icon-list-ul"></i> <?php echo $lang->weichat->list;?></strong>
    <div class='panel-actions'>
      <?php echo html::a($this->inlink('create'), '<i class="icon-plus"></i>', "class='btn btn-primary', title='{$lang->weichat->create}'");?>
      <?php echo html::a($this->createLink('user', 'admin'), '<i class="icon-user"></i> ', "class='btn btn-primary' title='{$lang->weichat->users}'");?>
    </div>
  </div>
  <table class='table table-hover table-striped tablesorter'>
    <thead>
      <tr class='text-center'>
        <th class='w-60px'> <?php echo $lang->weichat->id;?></th>
        <th>                <?php echo $lang->weichat->name;?></th>
        <th class='w-100px'><?php echo $lang->weichat->type;?></th>
        <th class='w-160px'><?php echo $lang->weichat->account;?></th>
        <th class='w-160px'><?php echo $lang->weichat->appID;?></th>
        <th class='w-200px'><?php echo $lang->actions;?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($publics as $public):?>
      <tr class='text-center'>
        <td><?php echo $public->id;?></td>
        <td><?php echo $public->name;?></td>
        <td><?php echo $lang->weichat->typeList[$public->type];?></td>
        <td><?php echo $public->account;?></td>
        <td><?php echo $public->appID;?></td>
        <td>
          <?php
          echo html::a($this->createLink('public', 'setMenu', "publicID=$public->id"), $lang->weichat->setMenu);
          echo html::a($this->createLink('public', 'setResponse', "publicID=$public->id"), $lang->weichat->setResponse);
          ?>
          <a href='###' class='access' data-container='body' data-toggle='popover' data-placement='left' data-content='<?php printf($lang->weichat->accessInfo, $public->appSecret, $public->url, $public->token);?>'>
            <?php echo $lang->weichat->access;?>
          </a>
        </td>
      </tr>
      <?php endforeach;?>
    </tbody>
  </table>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
