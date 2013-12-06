<?php 
include '../../common/view/header.html.php'; 
include '../../common/view/treeview.html.php'; 
?>
<?php $common->printPositionBar($page);?>
<div class='row'>
  <div class='col-md-9'>
    <div class='box radius'>
      <h4 class='title'><?php echo $page->title;?></h4>
      <div class='content'>
        <?php if($page->summary):?>
        <div class='summary'><strong><?php echo $lang->page->summary;?></strong><?php echo $lang->colon . $page->summary;?></div>
        <?php endif;?>
        <p><?php echo $page->content;?></p>
        <div class='article-file mt-10px'><?php $this->loadModel('article')->printFiles($page->files);?></div>
        <?php if($page->keywords):?>
        <div class='keywords'><strong><?php echo $lang->page->keywords;?></strong><?php echo $lang->colon . $page->keywords;?></div>
        <?php endif;?>
      </div>
    </div>
    <div id='commentBox'></div>
    <?php echo html::a('', '', "name='comment'");?>
  </div>
  <div class='col-md-3'>
    <?php if(isset($layouts['page_view']['side'])) echo $this->block->printRegion($layouts['page_view']['side']);?>
  </div>
</div>
<?php include '../../common/view/footer.html.php'; ?>
