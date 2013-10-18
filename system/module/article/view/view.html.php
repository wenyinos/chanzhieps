<?php 
include '../../common/view/header.html.php'; 
include '../../common/view/treeview.html.php'; 

/* set categoryPath for topNav highlight. */
js::set('path',  json_encode($article->path));
js::set('articleID', $article->id);
?>
<?php $common->printPositionBar($category, $article);?>
<div class='row'>
  <div class='col-md-9'>
    <div class='box radius'>
      <div class='content'>
        <h1 class='a-center'><?php echo $article->title;?></h1>
        <div class='f-12px mb-10px a-center'>
          <?php
          printf($lang->article->lblAddedDate, $article->addedDate);
          printf($lang->article->lblAuthor,    $article->author);
          if($article->original)
          {
              echo "<strong>{$lang->article->originalList[$article->original]}</strong> &nbsp;&nbsp;";
          }
          else
          {
              printf($lang->article->lblSource);
              $article->copyURL ? print(html::a($article->copyURL, $article->copySite, '_blank')) : print($article->copySite); 
          }
          printf($lang->article->lblViews, $article->views);

          $sina = json_decode($this->config->oauth->sina);
          if($sina->clientID && $sina->widget) echo "<wb:share-button appkey='$sina->clientID' addition='simple' type='icon' ralateUid='$sina->widget'></wb:share-button>"; 
          ?>
        </div>
        <p><?php echo $article->content;?></p>
        <div class='article-file'><?php $this->article->printFiles($article->files);?></div>
      </div>
    </div>
    <div id='commentBox'></div>
    <?php echo html::a('', '', '', "name='comment'");?>
  </div>
  <?php include '../../common/view/side.html.php'; ?>
</div>
<?php include '../../common/view/footer.html.php'; ?>
