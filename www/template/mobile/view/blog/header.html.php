<?php if($extView = $this->getExtViewFile(__FILE__)){include $extView; return helper::cd();}?>
<?php include TPL_ROOT . 'common/header.lite.html.php';?>

<div class='block-region region-all-top'><?php $this->block->printRegion($layouts, 'all', 'top');?></div>

<style>
.appbar-title-label {

}
</style>
<header class='appbar fix-top' id='appbar'>
  <div class='appbar-title'>
    <a href='<?php echo $webRoot;?>'><?php
      if(isset($this->config->site->logo))
      {
          $template    = $this->config->template->{$this->device}->name;
          $theme       = $this->config->template->{$this->device}->theme;
          $logoSetting = json_decode($this->config->site->logo);
          $logo = isset($logoSetting->$template->$theme) ? $logoSetting->$template->$theme : (isset($logoSetting->$template->all) ? $logoSetting->$template->all : false);
          echo html::image($logo->webPath, "class='logo' title='{$this->config->company->name}'");
      }
      else
      {
          echo '<h4>' . $this->config->site->name . '</h4>';
      }
      ?>
      <small class='appbar-title-label bg-primary'><?php echo $lang->blog->common;?></small>
    </a>
  </div>
  <div class='appbar-actions'>
    <div class='dropdown'>
      <?php if(commonModel::isAvailable('search')):?>
      <button type='button' class='btn'><i class='icon-search'></i></button>
      <?php endif; ?>

      <?php if(!isset($this->config->site->type) or $this->config->site->type != 'blog'):?>
      <?php echo html::a($config->webRoot, '<i class="icon-home icon-large"></i>', "class='btn'");?>
      <?php endif; ?>

      <button type='button' class='btn' data-toggle='dropdown'><i class='icon-bars'></i></button>
      <ul class='dropdown-menu pull-right'>
        <?php echo commonModel::printTopBar(true);?>
        <li class='divider'></li>
        <?php echo commonModel::printLanguageBar(true);?>
      </ul>
    </div>
  </div>
</header>

<nav class='appnav fix-top' id='appnav'>
  <div class='mainnav'>
    <ul class='nav'>
      <li <?php if(empty($category)) echo "class='active'"?>>
         <?php echo html::a($this->inlink('index'), (isset($this->config->site->type) and $this->config->site->type == 'blog') ? $lang->home : $lang->blog->home)?>
      </li>
      <?php 
      $navs = $this->tree->getChildren(0, 'blog');
      foreach($navs as $nav)
      {
        isset($category->id) ? $categoryID = $category->id : $categoryID = 0;
        $class = $nav->id == $categoryID ? "class='nav-blog-$nav->id active'" : "class='nav-blog-$nav->id'";
        echo "<li {$class}>" . html::a($this->inlink('index', "id={$nav->id}", "category={$nav->alias}"), $nav->name) . '</li>';
      }
      ?>
    </ul>
  </div>
</nav>

<div class='block-region region-all-banner'>
  <?php $this->block->printRegion($layouts, 'all', 'banner');?>
</div>
