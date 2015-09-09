<?php
/**
 * The browse view file of product of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1 (http://www.chanzhi.org/license/)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     product
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php
include TPL_ROOT . 'common/header.html.php';
$path = isset($category->pathNames) ? array_keys($category->pathNames) : array(0);
js::set('path', $path);
js::set('categoryID', $category->id);

include TPL_ROOT . 'common/treeview.html.php';
?>
<?php echo $common->printPositionBar($category, isset($product) ? $product : '');?>
<div class='row'><?php $this->block->printRegion($layouts, 'product_browse', 'topBanner', true);?></div>
<div class='row'>
  <div class='col-md-9 col-main'>
    <div class='list list-condensed'>
    <div class='row'><?php $this->block->printRegion($layouts, 'product_browse', 'top', true);?></div>
      <header>
        <strong><i class='icon-th'></i> <?php echo $category->name;?></strong>
        <span class='pull-right' id="modeControl">
          <?php foreach($lang->product->listMode as $mode => $text):?>
          <?php echo html::a("javascript:;", $text, "data-mode='{$mode}'");?>
          <?php endforeach;?>
        </span>
      </header>
      <?php include 'browse.card.html.php';?>
      <?php include 'browse.list.html.php';?>
      <footer class='clearfix'>
        <?php $pager->show('right', 'short');?>
      </footer>
    </div>
    <div class='row'><?php $this->block->printRegion($layouts, 'product_browse', 'bottom', true);?></div>
  </div>
  <div class='col-md-3 col-side'>
    <side class='page-side blocks'><?php $this->block->printRegion($layouts, 'product_browse', 'side');?></side>
  </div>
</div>
<div class='row'><?php $this->block->printRegion($layouts, 'product_browse', 'bottomBanner', true);?></div>
<?php include TPL_ROOT . 'common/footer.html.php';?>
