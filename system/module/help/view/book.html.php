<?php include '../../common/view/header.html.php'; ?>
<?php $common->printPositionBar($category);?>
<div class='row'>
  <div class='col-md-3' id='leftmenu'>
    <div class="list-group">
      <strong class="list-group-item list-group-title"><?php echo $lang->help->books;?></strong>
      <?php
      foreach($books as $bookValue)
      {
          $class = 'list-group-item' . (($bookValue->name == $book->name)?' active':'');
          echo html::a(inlink('book', "type=$bookValue->key"), '<i class="icon-book icon-large"></i>' . $bookValue->name . '<i class="icon-chevron-right"></i>', '', "class='$class'");
      }
      ?>
    </div>
  </div>

  <div class='col-md-9'>
    <div class='box radius'>  
      <h4 class='title'><?php echo $book->name;?></h4>
      <dl>
      <?php
      foreach($categories as $category)
      {
          $alias = $this->loadModel('tree')->getAliasByID($category->id);
          if(isset($category->id))echo "<dt class='f-16px'><strong>$category->i." . ' ' . html::a(inlink('book',"type=$code&categoryID=$alias", "category={$category->alias}"), $category->name) . "</strong></dt>";
          else $category->id=null;
          if(isset($articles[$category->id]) or isset($category->children))
          {
              $j = 1;
              echo "<dd><dl>";
              if(isset($articles[$category->id]))
              {
                  foreach($articles[$category->id] as $article)
                  {
                      echo "<dt class='article-title f-14px'>$category->i.$j " . ' ' . html::a(inlink('read', "article=$article->id&book={$code}", "category={$category->alias}&name=$article->alias"), $article->title) . "</dt>";
                      $j ++;
                  }
              }

              if(isset($category->children))
              {
                  foreach($category->children as $child)
                  {
                      $child = $this->loadModel('tree')->getByID($child->id);
                      $alias = $this->loadModel('tree')->getAliasByID($child->id);
                      echo "<dt class='f-14px'>$category->i.$child->j" . ' ' .  html::a(inlink('book', "type=$code&categoryID=$alias", "category={$child->alias}"), $child->name) . "</dt>";
                      if(isset($articles[$child->id]))
                      {
                          $k = 1;
                          echo "<dd><dl>";
                          foreach($articles[$child->id] as $article)
                          {
                              echo "<dt class='article-title f-14px'>$category->i.$child->j.$k " . html::a(inlink('read', "article=$article->id&book={$code}", "category={$child->alias}&name=$article->alias"), $article->title) . "</dt>";
                              $k ++;
                          }
                          echo "</dl></dd>";
                      }
                  }
              }
              echo "</dl></dd>";
          }
      }
      ?>
      </dl>
    </div>
  </div>
</div>
<?php include '../../common/view/footer.html.php'; ?>
