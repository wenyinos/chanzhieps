<?php include '../../common/view/header.html.php'; ?>
<?php $common->printPositionBar($book);?>
<div class='row'>
  <div class='col-md-3' id='leftmenu'>
    <div class="list-group">
      <strong class="list-group-item list-group-title"><?php echo $lang->book->list;?></strong>
      <?php
      foreach($books as $bookValue)
      {
          $class = 'list-group-item' . (($bookValue->title == $root->title) ? ' active' : '');
          echo html::a(inlink('browse', "bookID=$bookValue->id", "book=$bookValue->alias"), '<i class="icon-book icon-large"></i>' . $bookValue->title . '<i class="icon-chevron-right"></i>', "class='$class'");
      }
      ?>
    </div>
  </div>

  <div class='col-md-9'>
    <div class='box radius'>  
      <h4 class='title'><?php echo $root->title;?></h4>
      <dl>
      <?php echo $catalogue;?>
      </dl>
    </div>
  </div>
</div>
<?php include '../../common/view/footer.html.php';?>
