<?php
/**
 * The index view file of admin module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiyingl@xirangit.com>
 * @package     admin
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<?php if(!$ignoreUpgrade) js::import('http://api.chanzhi.org/latest.php?version=' . $this->config->version);?>
<div class='container' id='shortcutBox'>

  <?php if(strpos($this->server->php_self, '/admin.php') !== false && empty($this->config->global->ignoreAdminEntry)):?>
  <form method='post' id='ajaxForm' action='<?php echo $this->createLink('admin', 'ignore');?>'>
    <div class="alert alert-danger">
      <button type="submit" class="close">&times;</button>
      <strong><?php echo $lang->admin->adminEntry;?></strong>
    </div>
  </form>
  <?php endif;?>

  <?php if(!$ignoreUpgrade):?>
  <div class='alert alert-success' id='upgradeNotice'>
    <div>
      <?php echo $lang->newVersion;?>
      <button class="close"><?php echo html::a(inlink('ignoreUpgrade'), '&times;', "class='reload'");?></button>
    </div>
  </div>
  <?php endif;?>

  <?php if(!$checkLocation):?>
  <div class='alert alert-success'>
    <div>
      <?php echo $lang->site->changeLocation;?>
      <?php echo html::a($this->createLink('site', 'setsecurity'), $lang->site->changeSetting, "class='red'");?>
    </div>
  </div>
  <?php endif;?>

  <div class='row'>
    <div class='col-xs-4'>
      <div class='panel'>
        <div class='panel-heading'><strong><?php echo $lang->admin->thread;?></strong></div>
        <div class='panel-body'>
          <table class='table table-hover table-condensed'>
          <?php foreach($newThreads as $thread):?> 
          <tr>
            <td><?php echo html::a(commonmodel::createFrontLink('thread', 'view', "threadid=$thread->id"), $thread->title, "target='_blank'");?></td>
            <td><?php echo $thread->author;?></td>
            <td><?php echo substr($thread->editedDate, -8);?></td>
          </tr>
          <?php endforeach;?>
          </table>
        </div>
      </div>
    </div>
    <div class='col-xs-4'>
      <div class='panel'>
        <div class='col-md-4'> 
          <div class="shortcut article-admin">
            <?php echo html::a($this->createLink('article', 'create'), '<h3>' . $lang->admin->shortcuts->article . '</h3>')?>
          </div>
        </div>
        <div class='col-md-4'>
          <div class="shortcut product-admin">
            <?php echo html::a($this->createLink('product', 'create'), '<h3>' . $lang->admin->shortcuts->product . '</h3>')?>
          </div>
        </div>
        <div class='col-md-4'>
          <div class="shortcut feedback-admin">
            <?php echo html::a($this->createLink('message', 'admin'), '<h3>' . $lang->admin->shortcuts->feedback . '</h3>')?>  
          </div>
        </div>
        <div class='col-md-4'>
          <div class="shortcut site-admin">
            <?php echo html::a($this->createLink('site', 'setBasic'), '<h3>' . $lang->admin->shortcuts->site . '</h3>')?>
          </div>
        </div>
        <div class='col-md-4'>
          <div class="shortcut company-admin">
            <?php echo html::a($this->createLink('company', 'setBasic'), '<h3>' . $lang->admin->shortcuts->company . '</h3>')?>
          </div>
        </div>
        <div class='col-md-4'>
          <div class="shortcut contact-admin">
            <?php echo html::a($this->createLink('company', 'setcontact'), '<h3>' . $lang->admin->shortcuts->contact . '</h3>')?>  
          </div>
        </div>      
      </div>
    </div>
    <div class='col-xs-4'>
      <div class='panel'>
        <div class='panel-heading'><strong><?php echo $lang->admin->order;?></strong></div>
        <div class='panel-body'>
          <table class='table table-hover table-condensed'>
          <?php foreach($newOrders as $order):?> 
          <?php $orderTitle = sprintf($lang->admin->orderTitle, $order->account, $order->amount);?>
          <tr>
            <td><?php commonModel::printLink('order', 'admin','', $orderTitle, "target='_blank'");?></td>
            <td><?php echo substr($order->createdDate, -8);?></td>
          </tr>
          <?php endforeach;?>
          </table>
        </div>
      </div>
    </div>
    <?php if(commonModel::isAvailable('contribution')):?>
    <div class='col-xs-4'>
      <div class='panel'>
        <div class='panel-heading'><strong><?php echo $lang->admin->contribution;?></strong></div>
        <div class='panel-body'>
          <table class='table table-hover table-condensed'>
          <?php foreach($newContributions as $contribution):?> 
          <tr>
            <td><?php commonModel::printLink('article', 'admin','type=contribution&tab=feedback', $contribution->title, "target='_blank'");?></td>
            <td><?php echo $contribution->author;?></td>
            <td><?php echo substr($contribution->editedDate, -8);?></td>
          </tr>
          <?php endforeach;?>
          </table>
        </div>
      </div>
    </div>
    <?php endif;?>
    <div class='col-xs-4'>
      <div class='panel'>
        <div class='panel-heading'><strong><?php echo $lang->admin->feedback;?></strong></div>
        <div class='panel-body'>
          <table class='table table-hover table-condensed'>
          <?php foreach($messages as $type => $message):?> 
          <?php $messageTitle     = sprintf($lang->admin->$type, $message);?>
          <tr>
            <td><?php commonModel::printLink('message', 'admin', "type={$type}", $messageTitle, "target='_blank'");?></td>
          </tr>
          <?php endforeach;?>
          <tr>
            <?php $threadReplyTitle = sprintf($lang->admin->threadReply, $threadReply);?>
            <td><?php commonModel::printLink('reply', 'admin', "order=id_desc&tab=feedback", $threadReplyTitle, "target='_blank'");?></td>
          </tr>
          </table>
        </div>
      </div>
    </div>
    <div class='col-xs-4'>
      <div class='panel'>
        <div class='panel-heading'><strong><?php echo $lang->admin->category;?></strong></div>
        <div class='panel-body'>
          <table class='table table-hover table-condensed'>
          <?php foreach($categories as $key => $category):?> 
          <tr>
            <td><?php commonmodel::printLink('article', 'admin', "type=article&categoryID={$key}", $category, "target='_blank'");?></td>
          </tr>
          <?php endforeach;?>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
