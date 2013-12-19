<?php include '../../common/view/header.html.php'; ?>
<?php $common->printPositionBar($node->origins);?>
<div class='row'>

  <div class='col-md-3' id='leftmenu'>
    <div class="list-group">
      <strong class="list-group-item list-group-title"><?php echo $lang->book->list;?></strong>
      <?php
      foreach($books as $menu)
      {
          $class = 'list-group-item' . (($menu->id == $book->id) ? ' active' : '');
          echo html::a(inlink('browse', "bookID=$menu->id", "book=$menu->alias"), '<i class="icon-book icon-large"></i>' . $menu->title . '<i class="icon-chevron-right"></i>', "class='$class'");
      }
      ?>
    </div>
  </div>

  <div class='col-md-9'>
    <div class='box radius'>  
      <h4 class='title'><i class='icon-book'></i><?php echo $book->title;?></h4>
      <dl  class='books'><?php echo $catalog;?></dl>
    </div>
  </div>

</div>
<?php include '../../common/view/footer.html.php';?>
