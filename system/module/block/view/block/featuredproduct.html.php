<?php
/**
 * The featured product front view file of block module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
*/
?>
<?php 
$content  = json_decode($block->content);
$product  = $this->loadModel('product')->getByID($content->product);
$category = array_shift($product->categories);
$url      = helper::createLink('product', 'view', "id={$product->id}", "category={$category->alias}&name={$product->alias}");
?>
<div class="col-md-4">
  <div class='panel product-box'>
    <?php echo html::a($url, html::image($product->image->primary->middleURL), "class='thumbnail'");?>
    <div class="caption">
      <h3><?php echo html::a($url, $product->name);?></h3>
      <p><?php echo $product->summary;?></p>
    </div>
    <div class="widget-footer">
      <p>
        <?php echo html::a($url, $this->lang->more . $this->lang->raquo);?>
      </p>
    </div>
  </div>
</div>
