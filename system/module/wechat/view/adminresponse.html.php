<?php
/**
 * The admin response view file of wechat module of chanzhiEPS.
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
    <strong><i class="icon-list-ul"></i> <?php echo $lang->wechat->response->list;?></strong>
    <div class='panel-actions'>
      <?php echo html::a($this->inlink('setResponse', "publicID=$publicID"), $lang->wechat->setResponse, "class='btn btn-primary'");?>
    </div>
  </div>
  <table class='table table-hover table-striped tablesorter'>
    <thead>
      <tr class='text-center'>
        <th class='w-100px'><?php echo $lang->wechat->response->type;?></th>
        <th class='w-100px'><?php echo $lang->wechat->response->source;?></th>
        <th class='w-p20'>  <?php echo $lang->wechat->response->key;?></th>
        <th>                <?php echo $lang->wechat->response->block;?></th>
        <th class='w-160px'><?php echo $lang->actions;?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($responseList as $response):?>
      <tr class='text-center'>
        <td><?php echo $lang->wechat->response->typeList[$response->type];?></td>
        <td><?php echo $lang->wechat->response->sourceList[$response->source];?></td>
        <td>
          <?php if($response->key == 'subscribe') echo $lang->wechat->subscribeResponse;?>
          <?php if($response->key == 'default')  echo $lang->wechat->defaultResponse;?>
          <?php if($response->key != 'subscribe' && $response->key != 'default') echo $response->key;?>
        </td>
        <td>
          <?php if($response->type == 'text' && $response->source != 'manual') echo $lang->wechat->response->textBlockList[$response->content];?>
          <?php if($response->type == 'news') echo $lang->wechat->response->newsBlockList[$response->content->block];?>
          <?php if($response->type == 'link' && $response->source != 'manual') echo $lang->wechat->response->moduleList[$response->content];?>
          <?php if($response->source == 'manual') echo $response->content;?>
        </td>
        <td>
          <?php
          echo html::a($this->createLink('wechat', 'setResponse', "public={$response->public}&group={$response->group}&key=$response->key"), $lang->edit);
          echo html::a($this->createLink('wechat', 'deleteResponse', "responseID=$response->id"), $lang->delete, "class='deleter'");
          ?>
        </td>
      </tr>
      <?php endforeach;?>
    </tbody>
  </table>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
