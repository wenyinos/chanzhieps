<?php
/**
 * The category front view file of block module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Yidong wang <yidong@cnezsoft.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
*/
?>
<?php if($block->showChildren):?>
<?php
 include $this->app->getModuleRoot() . 'common/view/treeview.html.php';
$treeMenu = $this->tree->getTreeMenu('article', 0, array('treeModel', 'createBlogBrowseLink'));
?>
<div class='box widget radius'> 
  <h4 class='title'><?php echo $block->title;?></h4>
  <?php echo $treeMenu;?>
</div>
<?php else:?>
<?php $topCategories = $this->loadModel('tree')->getChildren(0, 'blog');?>
<div class='list-group'> 
  <strong class='list-group-item list-group-title'><?php echo $lang->categoryMenu;?></strong>
  <?php
  foreach($topCategories as $topCategory){
      $browseLink = $this->createLink('article', 'browse', "categoryID={$topCategory->id}", "category={$topCategory->alias}");
      if($category->name==$topCategory->name)
      {
          echo html::a($browseLink, "<i class='icon-folder-open-alt '></i>" . $topCategory->name, "id='category{$topCategory->id}' class='list-group-item active'");
      }
      else
      {
          echo html::a($browseLink, "<i class='icon-folder-close-alt '></i>" . $topCategory->name, "id='category{$topCategory->id}' class='list-group-item'");
      }
  }
  ?>
</div>
<?php endif;?>
