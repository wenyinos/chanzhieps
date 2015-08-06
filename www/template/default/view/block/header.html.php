<?php
/**
 * The header view file of block module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1 (http://www.chanzhi.org/license/)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
*/
?>
<header id='header' class='clearfix'>
  <div id='headTitle'>
    <div class="wrapper">
      <?php if(isset($this->config->site->logo)):?>
      <?php $device = helper::getDevice();?>
      <?php $template    = $this->config->template->{$device}->name;?>
      <?php $theme       = $this->config->template->{$device}->theme;?>
      <?php $logoSetting = json_decode($this->config->site->logo);?>
      <?php $logo = isset($logoSetting->$template->$theme) ? $logoSetting->$template->$theme : (isset($logoSetting->$template->all) ? $logoSetting->$template->all : false);?>
      <div id='siteLogo'>
        <?php echo html::a($this->config->webRoot, html::image($logo->webPath, "class='logo' title='{$this->config->company->name}'"));?>
      </div>
      <?php else: ?>
      <div id='siteName'><h2><?php echo $this->config->site->name;?></h2></div>
      <?php endif;?>
      <div id='siteSlogan'><span><?php echo $this->config->site->slogan;?></span></div>
    </div>
  </div>
  <div id='headNav'>
    <div class='wrapper'>
      <nav>
        <?php echo commonModel::printTopBar();?>
        <span id='languageBar'><?php echo commonModel::printLanguageBar();?></span>
      </nav>
    </div>
  </div>
  <?php if(commonModel::isAvailable('search')):?>
  <div id='searchbar'>
    <form action='<?php echo helper::createLink('search')?>' method='get' role='search'>
      <div class='input-group'>
        <?php $keywords = ($this->app->getModuleName() == 'search') ? $this->session->serachIngWord : '';?>
        <?php echo html::input('words', $keywords, "class='form-control' placeholder=''");?>
        <?php if($this->config->requestType == 'GET') echo html::hidden($this->config->moduleVar, 'search') . html::hidden($this->config->methodVar, 'index');?>
        <div class='input-group-btn'>
          <button class='btn btn-default' type='submit'><i class='icon icon-search'></i></button>
        </div>
      </div>
    </form>
  </div>
  <?php endif;?>
</header>
