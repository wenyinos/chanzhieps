<?php 
include '../../common/view/header.html.php'; 
include '../../common/view/treeview.html.php'; 
js::set('pageID', $page->id);
?>
<?php $common->printPositionBar($page);?>
<div class='row'>
  <div class='col-md-9'>
    <div class='box radius'>
      <h4 class='title'><?php echo $page->title;?></h4>
      <div class='content'>
        <p><?php echo $page->content;?></p>
        <div class='article-file mt-10px'><?php $this->loadModel('file')->printFiles($page->files);?></div>
        <?php if($page->keywords):?>
        <div class='keywords'><strong><?php echo $this->lang->article->keywords;?></strong><?php echo $lang->colon . $page->keywords;?></div>
        <?php endif;?>
      </div>
    </div>
  </div>
  <div class='col-md-3'><?php $this->block->printRegion($layouts, 'page_view', 'side');?></div>
</div>
<?php include '../../common/view/footer.html.php'; ?>
