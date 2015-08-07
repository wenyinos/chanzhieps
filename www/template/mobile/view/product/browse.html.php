<?php
/**
 * The browse view file of product for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1 (http://www.chanzhi.org/license/)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     product
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include TPL_ROOT . 'common/header.html.php';?>
<?php echo $common->printPositionBar($category);?>
<?php 
$leftCards  = '';
$rightCards = '';
$index = 0;
foreach($products as $product)
{
    $url   = inlink('view', "id={$product->id}", "category={$product->category->alias}&name=$product->alias");
    $card = "<a class='card' href='{$url}'>";
    
    $card .= "<div class='card-img'>";
    if(empty($product->image)) 
    {
        $imgColor = $product->id * 57 % 360;
        $card .= "<div class='media-placeholder' style='background-color: hsl({$imgColor}, 60%, 80%); color: hsl({$imgColor}, 80%, 30%);' data-id='{$product->id}'>{$product->name}</div>";
    }
    else
    {
        $card .= html::image($product->image->primary->middleURL, "title='{$title}' alt='{$product->name}'");
    }
    $card .= '</div>'; // end of .card-img

    $card .= "<div class='card-content'>";
    $card .= "<div>{$product->name}</div>";
    if(!$product->unsaleable)
    {
        if($product->promotion != 0)
        {
            $card .= "<strong class='text-danger'>" . $this->lang->product->currencySymbols[$this->config->product->currency] . $product->promotion . '</strong>';
            if($product->price != 0)
            {
                $card .= "&nbsp;&nbsp;<small class='text-muted text-line-through'>" . $this->lang->product->currencySymbols[$this->config->product->currency] . $product->price . '</small>';
            }
        }
        else if($product->price != 0)
        {
            $card .= "<strong class='text-danger'>" . $this->lang->product->currencySymbols[$this->config->product->currency] . $product->price . '</strong>';
        }
    }
    $card .= '</div>'; // end of .card-content

    $card .= '</a>';   // end of .card
    if($index % 2 == 0) $leftCards .= $card;
    else $rightCards .= $card;
    $index++;
}
?>

<div class='block-region region-top'><?php $this->loadModel('block')->printRegion($layouts, 'product_browse', 'top');?></div>

<div class='panel panel-section'>
  <div class='panel-heading'>
    <div class='title'><strong><?php echo $category->name;?></strong></div>
  </div>
  <div class='panel-body'>
    <div class='row cards cards-products'>
      <div class='col-6'>
        <?php echo $leftCards;?>
      </div>
      <div class='col-6'>
        <?php echo $rightCards;?>
      </div>
    </div>
  </div>
  <div class='panel-footer'>
    <?php $pager->show('justify');?>
  </div>
</div>

<div class='block-region region-bottom'><?php $this->loadModel('block')->printRegion($layouts, 'product_browse', 'bottom');?></div>
<?php include TPL_ROOT . 'common/footer.html.php';?>
