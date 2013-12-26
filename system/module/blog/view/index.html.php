<?php
/**
 * The index view file of blog module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     LGPL
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     blog
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php 
include './header.html.php';
include '../../common/view/treeview.html.php';
$path = array_keys($category->pathNames);
if(!empty($path))         js::set('path',  $path);
if(!empty($category->id)) js::set('categoryID', $category->id );
?>
<?php
$root = '<li>' . $this->lang->currentPos . $this->lang->colon .  html::a($this->inlink('index'), $lang->home) . '</li>';
if(!empty($category)) echo $common->printPositionBar($category, '', '', $root);
?>
<div class='row'>
  <div class='col-md-9' id='articles'>
    <?php foreach($articles as $article):?>
      <?php $url = inlink('view', "id=$article->id", "category={$category->alias}&name=$article->alias"); ?>
      <div class="card">
        <?php echo html::a($url, $article->title, "class='card-heading'");?>
        <div class="card-content text-muted">
          <?php if(!empty($article->image)):?>
            <div class='media pull-right'>
              <?php
              $title = $article->image->primary->title ? $article->image->primary->title : $article->title;
              echo html::a($url, html::image($article->image->primary->smallURL, "title='{$title}' class='thumbnail'" ));
              ?>
            </div>
          <?php endif;?>
          <?php echo $article->summary;?>
        </div>
        <div class="card-actions"><span class='text-muted'><i class="icon-time"></i> <?php echo date('Y/m/d', strtotime($article->addedDate));?></span></div>
      </div>
    <?php endforeach;?>

    <div class='clearfix pager'><?php $pager->show('right', 'short');?></div>
  </div>
  <div class='col-md-3'><side class='page-side'><?php $this->block->printRegion($layouts, 'blog_index', 'side');?></side></div>
</div>
<?php include './footer.html.php';?>
