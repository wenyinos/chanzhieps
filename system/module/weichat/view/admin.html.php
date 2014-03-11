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
  <div class='panel-actions'><?php echo html::a($this->inlink('create'), '<i class="icon-plus"></i> ' . $lang->weichat->create, 'class="btn btn-primary"');?></div>
  </div>
  <table class='table table-hover table-striped tablesorter'>
    <thead>
      <tr class='text-center'>
        <th class='w-60px'> <?php echo $lang->weichat->id;?></th>
        <th class='w-60px'> <?php echo $lang->weichat->type;?></th>
        <th>                <?php echo $lang->weichat->name;?></th>
        <th class='w-100px'>  <?php echo $lang->weichat->account;?></th>
        <th class='w-100px'>  <?php echo $lang->weichat->appID;?></th>
        <th class='w-150px'><?php echo $lang->weichat->appSecret;?></th>
        <th class='w-60px'> <?php echo $lang->weichat->token;?></th>
        <th class='w-150px'> <?php echo $lang->weichat->url;?></th>
        <th class='w-100px'><?php echo $lang->actions;?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($publics as $public):?>
      <tr class='text-center'>
        <td><?php echo $public->id;?></td>
        <td><?php echo $public->type;?></td>
        <td><?php echo $public->name;?></td>
        <td><?php echo $public->account;?></td>
        <td><?php echo $public->appID;?></td>
        <td><?php echo $public->appSecret;?></td>
        <td><?php echo $public->token;?></td>
        <td><?php echo $public->url;?></td>
        <td>
          <?php
          echo html::a($this->createLink('weichat', 'edit', "publicID=$public->id"), $lang->edit);
          echo html::a($this->createLink('weichat', 'delete', "publicID=$public->id"), $lang->delete, "class='deleter'");
          ?>
        </td>
      </tr>
      <?php endforeach;?>
    </tbody>
  </table>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
