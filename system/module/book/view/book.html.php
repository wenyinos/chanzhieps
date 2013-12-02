<?php include '../../common/view/header.html.php'; ?>
<?php $common->printPositionBar($category);?>
<div class='row'>
  <div class='col-md-3' id='leftmenu'>
    <div class="list-group">
      <strong class="list-group-item list-group-title"><?php echo $lang->help->books;?></strong>
      <?php
      foreach($books as $bookValue)
      {
          $class = 'list-group-item' . (($bookValue->title == $book->title) ? ' active' : '');
          echo html::a(inlink('book', "bookID=$bookValue->id"), '<i class="icon-book icon-large"></i>' . $bookValue->title . '<i class="icon-chevron-right"></i>', "class='$class'");
      }
      ?>
    </div>
  </div>

  <div class='col-md-9'>
    <div class='box radius'>  
      <h4 class='title'><?php echo $book->title;?></h4>
      <dl>
      <?php echo $this->help->getBookCatalogue($book->id) ?>
      </dl>
    </div>
  </div>
</div>
<?php include '../../common/view/footer.html.php';?>
