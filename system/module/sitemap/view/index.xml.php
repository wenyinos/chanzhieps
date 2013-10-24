<?php echo '<?xml version="1.0" encoding="UTF-8" ?>';?>
<urlset xmlns="http://www.google.com/schemas/sitemap/0.84">
  <?php foreach($categories as $category): ?>
  <url>
    <?php 
    if($category->type == 'product')
    {
        $url = $siteLink . helper::createLink('product', 'browse', "category={$category->id}", "category={$category->alias}");
        echo "<loc>" . $url . "</loc>";
    }
    if($category->type == 'article')
    {
        $url = $siteLink . helper::createLink('article', 'browse', "category={$category->id}", "category={$category->alias}");
        echo "<loc>" . $url . "</loc>";
    }
    if($category->type == 'blog')
    {
        $url = $siteLink . helper::createLink('blog', 'index', "category={$category->id}", "category={$category->alias}");
        echo "<loc>" . $url . "</loc>";
    }
    if(strpos($category->type, 'book_') !== false)
    {
        $code = str_replace('book_', '', $category->type);
        $url = $siteLink . helper::createLink('help', 'book', "type=$code&category={$category->id}", "category={$category->alias}");
        echo "<loc>" . $url . "</loc>";
    }
    ?>
    <lastmod><?php echo $category->postedDate;?></lastmod>
    <changefreq>weekly</changefreq>
    <priority>0.6</priority>
  </url>
  <?php endforeach;?>
  <?php
  foreach($products as $product):
  $categories = $product->categories;
  $category   = current($categories);
  $url = $siteLink . helper::createLink('product', 'view', "id=$product->id", "category={$category->alias}&name=$product->alias");
  ?>
  <url>
    <loc><?php echo $url;?></loc>
    <lastmod><?php echo $product->editedDate == "0000-00-00 00:00:00" ? substr($prodcut->addedDate, 0, 10) : substr($product->editedDate, 0, 10);?></lastmod>
    <changefreq>daily</changefreq>
    <priority>0.9</priority>
  </url>
  <?php endforeach;?>
  <?php
  foreach($articles as $article):
  $categories = $article->categories;
  $category   = current($categories);
  $url = $siteLink . helper::createLink('article', 'view', "id=$article->id", "category={$category->alias}&name=$article->alias");
  ?>
  <url>
    <loc><?php echo $url;?></loc>
    <lastmod><?php echo $article->editedDate == "0000-00-00 00:00:00" ? substr($article->addedDate, 0, 10) : substr($article->editedDate, 0, 10);?></lastmod>
    <changefreq>daily</changefreq>
    <priority>0.8</priority>
  </url>
  <?php endforeach;?>
  <?php
  foreach($bookArticles as $bookArticle):
  $code = str_replace('book_', '', $bookArticle->type);
  $url = $siteLink . helper::createLink('help', 'read', "article=$bookArticle->id&book={$code}", "name=$bookArticle->alias");
  ?>
  <url>
    <loc><?php echo $url;?></loc>
    <lastmod><?php echo $bookArticle->editedDate == "0000-00-00 00:00:00" ? substr($bookArticle->addedDate, 0, 10) : substr($bookArticle->editedDate, 0, 10);?></lastmod>
    <changefreq>daily</changefreq>
    <priority>0.8</priority>
  </url>
  <?php endforeach;?>
  <?php
  foreach($threads as $thread):
  $url = $siteLink . helper::createLink('thread', 'view', "id=$thread->id");
  ?>
  <url>
    <loc><?php echo $url;?></loc>
    <lastmod><?php echo $product->editedDate == "0000-00-00 00:00:00" ? substr($prodcut->addedDate, 0, 10) : substr($product->editedDate, 0, 10);?></lastmod>
    <changefreq>daily</changefreq>
    <priority>0.8</priority>
  </url>
  <?php endforeach;?>
</urlset>
