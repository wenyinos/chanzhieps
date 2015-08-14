<?php
/**
 * The read view file of book for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1 (http://www.chanzhi.org/license/)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     book
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php
include TPL_ROOT . 'common/header.html.php';
include TPL_ROOT . 'common/files.html.php';
?>
<?php js::set('articleID', $article->id)?>
<?php $common->printPositionBar($article->origins);?>
<div class='block-region region-top'><?php $this->loadModel('block')->printRegion($layouts, 'book_read', 'top');?></div>
<div class='appheader'>
  <div class='heading'>
    <h2><?php echo $article->title;?></h2>
    <div class='caption text-muted'>
      <small><i class='icon-time icon-large'></i> <?php echo formatTime($article->addedDate); ?></small> &nbsp;&nbsp;
      <small><i class='icon-user icon-large'></i> <?php echo $article->author; ?></small> &nbsp;&nbsp;
      <small><i class='icon-eye-open'></i> <?php echo $article->views; ?></small>
    </div>
  </div>
</div>

<div class='panel-section article'>
  <?php if($article->summary):?>
  <section class='abstract bg-gray-pale small with-padding'><strong><?php echo $lang->book->summary;?></strong><?php echo $lang->colon . $article->summary;?></section>
  <?php endif; ?>
  <div class='panel-body'>
    <hr class="space">
    <section class='article-content'>
      <?php echo $article->content;?>
    </section>
  </div>
  <?php if(!empty($article->files)):?>
  <section class="article-files">
    <?php $this->loadModel('file')->printFiles($article->files);?>
  </section>
  <?php endif;?>
  <div class='panel-footer'>
    <div class='article-moreinfo clearfix'>
      <?php if($article->editor):?> 
      <?php $editor = $this->loadModel('user')->getByAccount($article->editor);?>
      <?php if(!empty($editor)): ?> 
      <p class='text-muted'><i class='icon-edit'></i> <?php printf($lang->book->lblEditor, $editor->realname, formatTime($article->editedDate));?></p>
      <?php endif;?>
      <?php endif;?>
      <?php if($article->keywords):?>
      <p class='small'><strong class="text-muted"><?php echo $lang->book->keywords;?></strong><span class="article-keywords"><?php echo $lang->colon . $article->keywords;?></span></p>
      <?php endif; ?>
    </div>
    <?php extract($prevAndNext);?>

      <?php if($prev): ?>
      <?php echo html::a(inlink('read', "articleID=$prev->id", "book={$book->alias}&node={$prev->alias}"), "<i class='icon-arrow-left'></i> " . $prev->title, "class='btn block text-left default'"); ?>
      <?php else: ?>
      <a href='###' class='btn block text-left default disabled'><i class='icon-arrow-left'></i> <?php print($lang->book->none); ?></a>
      <?php endif; ?>
      <?php if($next):?>
      <?php echo html::a(inlink('read', "articleID=$next->id", "book={$book->alias}&node={$next->alias}"), "<i class='icon-arrow-right'></i> " . $next->title, "class='btn block text-left default'"); ?>
      <?php else:?>
      <a href='###' class='btn block text-left default disabled'><?php print($lang->book->none); ?><i class='icon-arrow-right'></i></a>
      <?php endif; ?>
      <?php echo html::a(inlink('browse', "bookID={$parent->id}", "book={$book->alias}&title={$parent->alias}"), "<i class='icon-list-ul'></i> " . $lang->book->chapter, "class='btn block text-left default'");?>
  </div>
</div>

<?php if(commonModel::isAvailable('message')):?>
<div id='commentBox'><?php echo $this->fetch('message', 'comment', "objectType=article&objectID={$article->id}");?></div>
<?php endif;?>
<div class='block-region region-bottom'><?php $this->loadModel('block')->printRegion($layouts, 'book_read', 'bottom');?></div>
<?php include TPL_ROOT . 'common/footer.html.php';?>
