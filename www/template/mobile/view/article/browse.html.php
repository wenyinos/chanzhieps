<?php
/**
 * The browse view file of article for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1 (http://www.chanzhi.org/license/)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     article
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include TPL_ROOT . 'common/header.html.php';?>
<?php
$path = array_keys($category->pathNames);
js::set('path', $path);
js::set('categoryID', $category->id);
?>
<?php echo $common->printPositionBar($category);?>
<div class='block-region region-top'><?php $this->loadModel('block')->printRegion($layouts, 'article_browse', 'top');?></div>
<div class='panel panel-section'>
  <div class='panel-heading'>
    <div class='title'><strong><?php echo $category->name;?></strong></div>
  </div>
  <div class='cards condensed cards-list'>
    <?php foreach($articles as $article):?>
    <?php $url = inlink('view', "id=$article->id", "category={$article->category->alias}&name=$article->alias");?>
    <a class='card' href='<?php echo $url?>'>
      <div class='card-heading'>
        <?php if($article->sticky):?>
        <div class='pull-right'>
          <small class='bg-danger-pale text-danger'><?php echo $lang->article->stick;?></small>
        </div>
        <?php endif;?>
        <h5><?php echo $article->title?></h5>
      </div>
      <div class='table-layout'>
        <div class='table-cell'>
          <div class='card-content text-muted small'><?php echo helper::substr($article->summary, 60, '...');?></div>
          <div class='card-footer small text-muted'>
            <span title="<?php echo $lang->article->views;?>"><i class='icon-eye-open'></i> <?php echo $article->views;?></span>
            <?php if($article->comments):?>&nbsp;&nbsp; <span title="<?php echo $lang->article->comments;?>"><i class='icon-comments-alt'></i> <?php echo $article->comments;?></span> &nbsp;<?php endif;?>
            &nbsp;&nbsp; <span title="<?php echo $lang->article->addedDate;?>"><i class='icon-time'></i> <?php echo substr($article->addedDate, 0, 10);?></span>
          </div>
        </div>
        <?php if(!empty($article->image)):?>
        <div class='table-cell thumbnail-cell'>
        <?php
          $title = $article->image->primary->title ? $article->image->primary->title : $article->title;
          echo html::image($article->image->primary->smallURL, "title='{$title}' class='thumbnail'" );
        ?>
        </div>
        <?php endif;?>
      </div>
    </a>
    <?php endforeach;?>
  </div>
  <div class='panel-footer'>
    <?php $pager->show('justify');?>
  </div>
</div>

<div class='block-region region-bottom'><?php $this->loadModel('block')->printRegion($layouts, 'article_browse', 'bottom');?></div>

<?php include TPL_ROOT . 'common/footer.html.php';?>
