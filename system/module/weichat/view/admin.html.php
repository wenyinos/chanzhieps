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
<div class='actions'>
  <?php echo html::a($this->inlink('create'), '<i class="icon-plus"></i> ', "class='btn btn-primary' title='{$lang->weichat->create}'");?>
  <?php echo html::a($this->createLink('user', 'admin'), '<i class="icon-user"></i> ', "class='btn btn-primary' title='{$lang->weichat->users}'");?>
</div>
<div class='row'>
  <?php foreach($publics as $public):?>
  <div class='col-sm-6 col-md-6'>
    <div class='panel'>
      <div class='panel-heading'>
        <?php echo $public->name;?>
      </div>
      <div class='panel-body'>
        <table class='table'>
          <tr>
            <th><?php echo $lang->weichat->type;?></th>
            <td><?php echo $lang->weichat->typeList[$public->type];?></td>
          </tr>
          <tr>
            <th><?php echo $lang->weichat->account;?></th>
            <td><?php echo $public->account;?></td>
          </tr>
          <tr>
            <th><?php echo $lang->weichat->appID;?></th>
            <td><?php echo $public->appID;?></td>
          </tr>
          <tr>
            <th><?php echo $lang->weichat->appSecret;?></th>
            <td><?php echo $public->appSecret;?></td>
          </tr>
          <tr>
            <th><?php echo $lang->weichat->url;?></th>
            <td><?php echo $public->url;?></td>
          </tr>
          <tr>
            <th><?php echo $lang->weichat->token;?></th>
            <td><?php echo $public->token;?></td>
          </tr>
        </table>
        <div class='panel-actions'>
          <?php echo html::a($this->inlink('setMenu', "id={$public->id}"), $lang->weichat->setMenu, 'class="btn btn-primary"');?>
          <?php echo html::a($this->inlink('setResponse', "id={$public->id}"), $lang->weichat->setResponse, 'class="btn btn-primary"');?>
        </div>
      </div>
    </div>
  </div>
  <?php endforeach;?>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
