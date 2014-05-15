<?php
/**
 * The index view file of admin module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     LGPL
 * @author      Xiying Guan <guanxiyingl@xirangit.com>
 * @package     admin
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<div class='container' id='shortcutBox'>

  <?php if(strpos($this->server->php_self, '/admin.php') !== false && empty($this->config->global->ignoreAdminEntry)):?>
  <form method='post' id='ajaxForm' action='<?php echo $this->createLink('admin', 'ignore');?>'>
    <div class="alert alert-danger">
      <button type="submit" class="close">&times;</button>
      <strong><?php echo $lang->admin->adminEntry;?></strong>
    </div>
  </form>
  <?php endif;?>
  <?php if(1 or !isset($this->config->global->ignoreUpgrade) or !$this->config->global->ignoreUpgrade):?>
  <div class='alert alert-danger' id='upgradeNotice'>
    <div>
      <?php echo $lang->newVersion;?>
      <?php echo html::a('', $lang->seeLatestRelease, "target='_blank' class='link-version'");?>
      <button class="close"><?php echo html::a(inlink('ignoreUpgrade'), '&times;', "class='reload'");?></button>
    </div>
  </div>
  <?php endif;?>
  <div class='row'>
    <div class='col-md-4 col-sm-6'> 
      <div class="shortcut article-admin">
        <?php echo html::a($this->createLink('article', 'create'), '<h3>' . $lang->admin->shortcuts->article . '</h3>')?>
      </div>
    </div>
    <div class='col-md-4 col-sm-6'>
      <div class="shortcut product-admin">
        <?php echo html::a($this->createLink('product', 'create'), '<h3>' . $lang->admin->shortcuts->product . '</h3>')?>
      </div>
    </div>
    <div class='col-md-4 col-sm-6'>
      <div class="shortcut feedback-admin">
        <?php echo html::a($this->createLink('message', 'admin'), '<h3>' . $lang->admin->shortcuts->feedback . '</h3>')?>  
      </div>
    </div>
    <div class='col-md-4 col-sm-6'>
      <div class="shortcut site-admin">
        <?php echo html::a($this->createLink('site', 'setBasic'), '<h3>' . $lang->admin->shortcuts->site . '</h3>')?>
      </div>
    </div>
    <div class='col-md-4 col-sm-6'>
      <div class="shortcut company-admin">
        <?php echo html::a($this->createLink('company', 'setBasic'), '<h3>' . $lang->admin->shortcuts->company . '</h3>')?>
      </div>
    </div>
    <div class='col-md-4 col-sm-6'>
      <div class="shortcut contact-admin">
        <?php echo html::a($this->createLink('company', 'setcontact'), '<h3>' . $lang->admin->shortcuts->contact . '</h3>')?>  
      </div>
    </div>      
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
