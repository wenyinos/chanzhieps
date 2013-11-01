<?php include '../../common/view/header.html.php'; ?>
<?php $common->printPositionBar($category);?>
<div class='row'>
  <div class='col-md-3' id='leftmenu'>
    <div class="list-group">
      <strong class="list-group-item list-group-title"><?php echo $lang->help->books;?></strong>
      <?php
      foreach($books as $bookValue)
      {
          $class = 'list-group-item' . (($bookValue->name == $book->name) ? ' active' : '');
          echo html::a(inlink('book', "type=$bookValue->key"), '<i class="icon-book icon-large"></i>' . $bookValue->name . '<i class="icon-chevron-right"></i>', '', "class='$class'");
      }
      ?>
    </div>
  </div>

  <div class='col-md-9'>
    <div class='box radius'>  
      <h4 class='title'><?php echo $book->name;?></h4>
      <dl>
      <?php echo $this->help->getBookCatalogue('book_' . $code, (int) $category->id) ?>
      </dl>
    </div>
  </div>
</div>
<?php include '../../common/view/footer.html.php';?>
