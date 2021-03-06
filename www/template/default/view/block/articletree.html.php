<?php
/**
 * The category front view file of block module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Yidong wang <yidong@cnezsoft.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
*/
?>
<?php
$this->loadModel('tree');
$block->content  = json_decode($block->content);
$type            = str_replace('tree', '', strtolower($block->type));
$browseLink      = $type == 'article' ? 'createBrowseLink' : 'create' . ucfirst($type) . 'BrowseLink';
$startCategory = 0;
if(isset($block->content->fromCurrent) and $block->content->fromCurrent)
{
    if($type == 'article' and $this->app->getModuleName() == 'article' and $this->session->articleCategory)
    {
        $category = $this->tree->getByID($this->session->articleCategory);
        $startCategory = $category->parent;
    }

    if($type == 'blog' and $this->app->getModuleName() == 'blog' and $this->session->articleCategory)
    {
        $category = $this->tree->getByID($this->session->articleCategory);
        $startCategory = $category->parent;
    }

    if($type == 'product' and $this->app->getModuleName() == 'product' and $this->session->productCategory)
    {
        $category = $this->tree->getByID($this->session->productCategory);
        $startCategory = $category->parent;
    }
}
?>
<?php if($block->content->showChildren):?>
<?php $treeMenu = $this->tree->getTreeMenu($type, $startCategory, array('treeModel', $browseLink));?>
<div id="block<?php echo $block->id;?>" class='panel panel-block <?php echo $blockClass;?>'>
  <div class='panel-heading'>
    <strong><?php echo $icon . $block->title;?></strong>
  </div>
  <div class='panel-body'><?php echo $treeMenu;?></div>
</div>
<?php else:?>
<?php $topCategories = $this->tree->getChildren($startCategory, $type);?>
<div id="block<?php echo $block->id?>" class='panel panel-block <?php echo $blockClass;?>'>
  <div class='panel-heading'>
    <strong><?php echo $icon . $block->title;?></strong>
  </div>
  <div class='panel-body'>
    <ul class='nav nav-secondary nav-stacked'>
      <?php
      foreach($topCategories as $topCategory)
      {
          $browseLink = helper::createLink($type, 'browse', "categoryID={$topCategory->id}", "category={$topCategory->alias}");
          if($type == 'blog') $browseLink = helper::createLink('blog', 'index', "categoryID={$topCategory->id}", "category={$topCategory->alias}");
          echo '<li>' . html::a($browseLink, "<i class='icon-folder-close-alt '></i> &nbsp;" . $topCategory->name, "id='category{$topCategory->id}'") . '</li>';
      }
      ?>
    </ul>
  </div>
</div>
<?php endif;?>
