<?php
/**
 * The related view file of tag of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv11.html)
 * @author      Tingting Dai<daitingting@xirangit.com>
 * @package     tag
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.modal.html.php';?>
<?php if(!empty($articles['article'])):?>
<div class='panel'>
  <div class='panel-heading'><?php echo $lang->tag->relatedArticle;?></div>
  <ul class='list-group'>
    <?php foreach($articles['article'] as $article):?>
    <li class='list-group-item'><?php echo html::a($this->loadModel('article')->createPreviewLink($article->id), $article->title, "target='_blank'");?></li>
    <?php endforeach;?>
  </ul>
</div>
<?php endif;?>

<?php if(!empty($articles['blog'])):?>
<div class='panel'>
  <div class='panel-heading'><?php echo $lang->tag->relatedBlog;?></div>
  <ul class='list-group'>
    <?php foreach($articles['blog'] as $article):?>
    <li class='list-group-item'><?php echo html::a($this->loadModel('article')->createPreviewLink($article->id), $article->title, "target='_blank'");?></li>
    <?php endforeach;?>
  </ul>
</div>
<?php endif;?>

<?php if(!empty($articles['page'])):?>
<div class='panel'>
  <div class='panel-heading'><?php echo $lang->tag->relatedPage;?></div>
  <ul class='list-group'>
    <?php foreach($articles['page'] as $article):?>
    <li class='list-group-item'><?php echo html::a($this->loadModel('article')->createPreviewLink($article->id), $article->title, "target='_blank'");?></li>
    <?php endforeach;?>
  </ul>
</div>
<?php endif;?>

<?php if($products):?>
<div class='panel'>
  <div class='panel-heading'><?php echo $lang->tag->relatedProduct;?></div>
  <ul class='list-group'>
    <?php foreach($products as $product):?>
    <li class='list-group-item'><?php echo html::a(commonModel::createFrontLink('product', 'view', "productID=$product->id"), $product->name, "target='_blank'");?></li>
    <?php endforeach;?>
  </ul>
</div>
<?php endif;?>

<?php if($nodes):?>
<div class='panel'>
  <div class='panel-heading'><?php echo $lang->tag->relatedBook;?></div>
  <ul class='list-group'>
    <?php foreach($nodes as $node):?>
    <?php if($node->type != 'article') continue;?>
    <li class='list-group-item'><?php echo html::a(commonModel::createFrontLink('book', 'read', "nodeID=$node->id", "book=$node->book->alias&node=$node->alias"), $node->title, "target='_blank'");?></li>
    <?php endforeach;?>
  </ul>
</div>
<?php endif;?>
<?php include '../../common/view/footer.modal.html.php';?>
