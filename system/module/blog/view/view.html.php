<?php
/**
 * The view file of blog view method of chanzhiEPS.
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
$path = array_keys($category->pathNames);
js::set('path', $path);
js::set('categoryID', $category->id);
js::set('articleID', $article->id);
include '../../common/view/treeview.html.php';
?>
<?php
$root = '<li>' . $this->lang->currentPos . $this->lang->colon .  html::a($this->inlink('index'), $lang->home) . '</li>';
$common->printPositionBar($category, $article, '', $root);
?>
<div class='row'>
  <div class='col-md-9'>
    <div class='article'>
      <header>
        <h1><?php echo $article->title;?></h1>
        <dl class='dl-inline'>
          <dd data-toggle='tooltip' data-placement='top' data-original-title='<?php printf($lang->article->lblAddedDate, $article->addedDate);?>'><i class="icon-time icon-large"></i> <?php echo $article->addedDate; ?></dd>
          <dd data-toggle='tooltip' data-placement='top' data-original-title='<?php printf($lang->article->lblAuthor, $article->author);?>'><i class='icon-user icon-large'></i> <?php echo $article->author; ?></dd>
          <?php if(!$article->original):?>
          <dt><?php echo $lang->article->lblSource; ?></dt>
          <dd><?php $article->copyURL ? print(html::a($article->copyURL, $article->copySite, "target='_blank'")) : print($article->copySite); ?></dd>
          <?php endif; ?>
          <dd class='pull-right'>
            <?php if($article->original):?>
            <span class='label label-success'><?php echo $lang->article->originalList[$article->original]; ?></span>
            <?php endif;?>
            <span class='label label-warning' data-toggle='tooltip' data-placement='top' data-original-title='<?php printf($lang->article->lblViews, $article->views);?>'><i class='icon-eye-open'></i> <?php echo $article->views; ?></span>
          </dd>
        </dl>
        <?php if($article->summary):?>
        <section class='abstract'><strong><?php echo $lang->article->summary;?></strong><?php echo $lang->colon . $article->summary;?></section>
        <?php endif; ?>
      </header>
      <section class='article-content'>
        <?php echo $article->content;?>
      </section>
      <section>
        <?php $this->loadModel('file')->printFiles($article->files);?>
      </section>
      <footer>
        <?php if($article->keywords):?>
        <p class='small'><strong class='text-muted'><?php echo $lang->article->keywords;?></strong><span class='article-keywords'><?php echo $lang->colon . $article->keywords;?></span></p>
        <?php endif; ?>
        <?php extract($prevAndNext);?>
        <ul class='pager pager-justify'>
          <?php if($prev): ?>
          <li class='previous'><?php echo html::a(inlink('view', "id=$prev->id", "category={$category->alias}&name={$prev->alias}"), '<i class="icon-arrow-left"></i> ' . $lang->article->prev . $lang->colon . $prev->title); ?></li>
          <?php else: ?>
          <li class='preious disabled'><a href='###'><i class='icon-arrow-left'></i> <?php print($lang->article->none); ?></a></li>
          <?php endif; ?>
          <?php if($next):?>
          <li class='next'><?php echo html::a(inlink('view', "id=$next->id", "category={$category->alias}&name={$next->alias}"), $lang->article->next . $lang->colon . $next->title . ' <i class="icon-arrow-right"></i>'); ?></li>
          <?php else:?>
          <li class='next disabled'><a href='###'> <?php print($lang->article->none); ?><i class='icon-arrow-right'></i></a></li>
          <?php endif; ?>
        </ul>
      </footer>
    </div>
    <div id='commentBox'><?php echo $this->fetch('message', 'comment', "objectType=article&objectID={$article->id}");?></div>
    <?php echo html::a('', '', "name='comment'");?>
  </div>
  <div class='col-md-3'><side class='page-side'><?php $this->block->printRegion($layouts, 'blog_view', 'side');?></side></div>
</div>
<?php include './footer.html.php';?>
