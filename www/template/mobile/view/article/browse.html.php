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
//TODO: Print block: article_browse
?>

<?php echo $common->printPositionBar($category);?>

<div class='panel panel-section'>
  <div class='panel-heading'>
    <div class='title'><strong><?php echo $category->name;?></strong></div>
  </div>
  <div class='cards condensed cards-list'>
    <?php foreach($sticks as $stick):?>
    <?php $url = inlink('view', "id=$stick->id", "category={$stick->category->alias}&name=$stick->alias");?>
    <a class='card' href='<?php echo $url?>'>
      <div class='card-heading'>
        <div class='pull-right'>
          <small class='bg-danger-pale text-danger'><?php echo $lang->article->stick;?></small>
        </div>
        <h5><?php echo $stick->title?></h5>
      </div>
      <div class='table-layout'>
        <div class='table-cell'>
          <div class='card-content text-muted small'><?php echo helper::substr($stick->summary, 60, '...');?></div>
          <div class='card-footer small text-muted'>
            <span title="<?php echo $lang->article->views;?>"><i class='icon-eye-open'></i> <?php echo $stick->views;?></span>
            <?php if($stick->comments):?>&nbsp;&nbsp; <span title="<?php echo $lang->article->comments;?>"><i class='icon-comments-alt'></i> <?php echo $stick->comments;?></span> &nbsp;<?php endif;?>
            &nbsp;&nbsp; <span title="<?php echo $lang->article->addedDate;?>"><i class='icon-time'></i> <?php echo substr($stick->addedDate, 0, 10);?></span>
          </div>
        </div>
        <?php if(!empty($stick->image)):?>
        <div class='table-cell thumbnail-cell'>
        <?php
          $title = $stick->image->primary->title ? $stick->image->primary->title : $stick->title;
          echo html::image($stick->image->primary->smallURL, "title='{$title}' class='thumbnail'" );
        ?>
        </div>
        <?php endif;?>
      </div>
    </a>
    <?php unset($articles[$stick->id]);?>
    <?php endforeach;?>

    <?php foreach($articles as $article):?>
    <?php $url = inlink('view', "id=$article->id", "category={$article->category->alias}&name=$article->alias");?>
    <a class='card' href='<?php echo $url?>'>
      <div class='card-heading'>
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
    <?php unset($articles[$stick->id]);?>
    <?php endforeach;?>
  </div>
  <div class='panel-footer'>
    <?php $pager->show('justify');?>
  </div>
</div>

<?php include TPL_ROOT . 'common/footer.html.php';?>
