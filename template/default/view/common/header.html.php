<?php if(helper::isAjaxRequest()):?>
<?php
$webRoot   = $config->webRoot;
$jsRoot    = $webRoot . "js/";
$themeRoot = $webRoot . "theme/";
if(isset($pageCSS)) css::internal($pageCSS);
?>
<div class="modal-dialog" style="width:<?php echo empty($modalWidth) ? 1000 : $modalWidth;?>px;">
  <div class="modal-content">
    <div class="modal-header">
      <?php echo html::closeButton();?>
      <strong class="modal-title"><?php if(!empty($title)) echo $title; ?></strong>
      <?php if(!empty($subtitle)):?>
      <small><?php echo $subtitle;?></small>
      <?php endif;?>
    </div>
    <div class="modal-body">
<?php else:?>
<?php if($extView = $this->getExtViewFile(__FILE__)){include $extView; return helper::cd();}?>
<?php include TPL_ROOT . 'common/header.lite.html.php';?>
<div class='page-container'>
  <div class='blocks' data-region='all-top'><?php $this->block->printRegion($layouts, 'all', 'top');?></div>
  <?php $topNavs = $this->loadModel('nav')->getNavs('desktop_top');?>
  <nav id='navbar' class='navbar' data-type='desktop_top'>
    <div class='navbar-header'>
      <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#navbarCollapse'>
        <span class='icon-bar'></span>
        <span class='icon-bar'></span>
        <span class='icon-bar'></span>
      </button>
      <a class='navbar-brand' href='<?php echo helper::createLink('index');?>'><i class='icon-home'></i></a>
    </div>
    <div class='collapse navbar-collapse' id='navbarCollapse'>
      <ul class='nav navbar-nav'>
        <?php foreach($topNavs as $nav1):?>
          <?php if(empty($nav1->children)):?>
            <li class='<?php echo $nav1->class?>'><?php echo html::a($nav1->url, $nav1->title, "target='$nav1->target'");?></li>
            <?php else: ?>
              <li class="dropdown <?php echo $nav1->class?>">
                <?php echo html::a($nav1->url, $nav1->title . " <b class='caret'></b>", 'class="dropdown-toggle" data-toggle="dropdown"');?>
                <ul class='dropdown-menu' role='menu'>
                  <?php foreach($nav1->children as $nav2):?>
                    <?php if(empty($nav2->children)):?>
                      <li class='<?php echo $nav2->class?>'><?php echo html::a($nav2->url, $nav2->title, "target='$nav2->target'");?></li>
                    <?php else: ?>
                      <li class='dropdown-submenu <?php echo $nav2->class?>'>
                        <?php echo html::a($nav2->url, $nav2->title, ($nav2->target != 'modal') ? "target='$nav2->target'" : '');?>
                        <ul class='dropdown-menu' role='menu'>
                          <?php foreach($nav2->children as $nav3):?>
                          <li><?php echo html::a($nav3->url, $nav3->title, ($nav3->target != 'modal') ? "target='$nav3->target'" : '');?></li>
                          <?php endforeach;?>
                        </ul>
                      </li>
                    <?php endif;?>
                  <?php endforeach;?><!-- end nav2 -->
                </ul>
            </li>
          <?php endif;?>
        <?php endforeach;?><!-- end nav1 -->
      </ul>
    </div>
  </nav>

  <div class='page-wrapper'>
    <div class='page-content'>
      <div class='blocks' data-region='all-banner'><?php $this->block->printRegion($layouts, 'all', 'banner');?></div>
<?php endif;?>
