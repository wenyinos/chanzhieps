<?php echo '<?xml version="1.0" encoding="UTF-8" ?>';?>
<urlset xmlns="http://www.google.com/schemas/sitemap/0.84">
  <?php
  foreach($products as $product):
  $categories = $product->categories;
  $category   = current($categories);
  $url        = $systemURL . helper::createLink('product', 'view', "id=$product->id", "category={$category->alias}&name=$product->alias");
  ?>
  <url>
    <loc><![CDATA[<?php echo $url;?>]]></loc>
    <lastmod><?php echo substr($product->editedDate, 0, 10);?></lastmod>
    <changefreq>daily</changefreq>
    <priority>0.9</priority>
  </url>
  <?php endforeach;?>
  <?php
  foreach($articles as $article):
  $categories = $article->categories;
  $category   = current($categories);
  $url        = $systemURL . helper::createLink('article', 'view', "id=$article->id", "category={$category->alias}&name=$article->alias");
  ?>
  <url>
    <loc><![CDATA[<?php echo $url;?>]]></loc>
    <lastmod><?php echo substr($article->editedDate, 0, 10);?></lastmod>
    <changefreq>daily</changefreq>
    <priority>0.8</priority>
  </url>
  <?php endforeach;?>
  <?php
  foreach($blogs as $blog):
  $categories = $blog->categories;
  $category   = current($categories);
  $url        = $systemURL . helper::createLink('blog', 'view', "id=$blog->id", "category={$category->alias}&name=$blog->alias");
  ?>
  <url>
    <loc><![CDATA[<?php echo $url;?>]]></loc>
    <lastmod><?php echo substr($blog->editedDate, 0, 10);?></lastmod>
    <changefreq>daily</changefreq>
    <priority>0.8</priority>
  </url>
  <?php endforeach;?>
  <?php
  foreach($menus as $menu):
  $code = str_replace('book_', '', $menu->type);
  $url  = $systemURL . helper::createLink('book', 'read', "article=$menu->id&book={$code}", "name=$menu->alias");
  ?>
  <url>
    <loc><![CDATA[<?php echo $url;?>]]></loc>
    <lastmod><?php echo substr($menu->editedDate, 0, 10);?></lastmod>
    <changefreq>daily</changefreq>
    <priority>0.8</priority>
  </url>
  <?php endforeach;?>
  <?php
  foreach($threads as $id => $editedDate):
  $url = $systemURL . helper::createLink('thread', 'view', "id=$id");
  ?>
  <url>
    <loc><![CDATA[<?php echo $url;?>]]></loc>
    <lastmod><?php echo substr($editedDate, 0, 10);?></lastmod>
    <changefreq>daily</changefreq>
    <priority>0.8</priority>
  </url>
  <?php endforeach;?>
</urlset>
