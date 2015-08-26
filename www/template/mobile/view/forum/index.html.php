<?php
/**
 * The index view file of forum for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1 (http://www.chanzhi.org/license/)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     forum
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include TPL_ROOT . 'common/header.html.php';?>
<div class='block-region region-top'><?php $this->loadModel('block')->printRegion($layouts, 'forum_index', 'top');?></div>
<?php foreach($boards as $parentBoard):?>
<div class='panel-section'>
  <div class='panel-heading'>
    <div class='title'><i class='icon icon-comments'></i> <strong><?php echo $parentBoard->name;?></strong></div>
  </div>
  <div class='panel-body'>
    <div class='cards cards-list'>
    <?php foreach($parentBoard->children as $childBoard):?>
      <?php
      $isNewBoard = $this->forum->isNew($childBoard);
      $moderators = '';
      foreach($childBoard->moderators as $moderator)
      {
          if(!empty($moderator))
          {
              $moderators .= $moderator . ' ';
          }
      }
      ?>
      <a class='card' href='<?php echo inlink('board', "id=$childBoard->id", "category={$childBoard->alias}");?>'>
        <div class='table-layout'>
          <div class='table-cell'>
            <div class='card-heading'>
              <h4>
                <?php
                echo $childBoard->name;
                if(!empty($moderators)) printf('<small>' . $lang->forum->lblOwner . '</small>', $moderators);
                ?>
              </h4>
            </div>
            <div class='card-content text-muted small'><?php echo $childBoard->desc;?></div>
            <?php
            if($childBoard->postedBy)
            {
                echo "<div class='card-footer small text-muted'>{$lang->forum->lastPost}: ";
                echo substr($childBoard->postedDate, 5, -3) . " {$childBoard->postedByRealname}"; 
                echo '</div>';
            }
            ?>
          </div>
          <div class='table-cell middle thumbnail-cell text-right'>
            <div class='counter text-center'><div class='title<?php if($isNewBoard) echo ' text-success';?>'><?php echo $childBoard->threads;?></div><div class='caption text-muted small'><?php echo $lang->forum->threadCount;?></div></div>
          </div>
        </div>
      </a>
    <?php endforeach;?>
    </div>
  </div>
</div>
<?php endforeach;?>
<div class='block-region region-bottom'><?php $this->loadModel('block')->printRegion($layouts, 'forum_index', 'bottom');?></div>
<?php include TPL_ROOT . 'common/footer.html.php';?>
