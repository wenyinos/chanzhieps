<?php
/**
 * The hot product front view file of block module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1 (http://www.chanzhi.org/license/)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
*/
?>
<?php
$content  = json_decode($block->content);
$type     = str_replace('product', '', strtolower($block->type));
$method   = 'get' . $type;
if(empty($content->category)) $content->category = 0;
$products = $this->loadModel('product')->$method($content->category, $content->limit);
?>
<div id="block<?php echo $block->id;?>" class="panel-cards with-cards panel panel-block <?php echo $blockClass;?>">
  <div class='panel-heading'>
    <strong><?php echo $icon;?> <?php echo $block->title . $content->recPerRow;?></strong>
    <?php if(!empty($content->moreText) and !empty($content->moreUrl)):?>
    <div class='pull-right'><?php echo html::a($content->moreUrl, $content->moreText);?></div>
    <?php endif;?>
  </div>
  <?php if(isset($content->image)):?>
  <div class='panel-body no-padding'>
    <div class='row cards cards-products'>
      <?php
      $cardsCols = array();
      $colsCount = min($content->recPerRow, count($products));
      for ($i = 0; $i < $colsCount; $i++) $cardsCols[$i] = '';
      $index = 0;
      foreach($products as $product)
      {
          $url = helper::createLink('product', 'view', "id=$product->id", "category={$product->category->alias}&name=$product->alias");
          $card = "<div class='card'>";

          $card .= "<a class='card-img' href='{$url}'>";
          if(empty($product->image))
          {
              $imgColor = $product->id * 57 % 360;
              $card .= "<div class='media-placeholder' style='background-color: hsl({$imgColor}, 60%, 80%); color: hsl({$imgColor}, 80%, 30%);' data-id='{$product->id}'>{$product->name}</div>";
          }
          else
          {
              $card .= html::image($product->image->primary->middleURL, "title='{$product->name}' alt='{$product->name}'");
          }
          $card .= '</a>'; // end of .card-img

          $card .= "<div class='card-content'>";
          if(isset($content->showCategory) and $content->showCategory == 1)
          {
              if($content->categoryName == 'abbr')
              {
                  $categoryName = '[' . ($product->category->abbr ? $product->category->abbr : $product->category->name) . '] ';
                  $card .= html::a(helper::createLink('product', 'browse', "categoryID={$product->category->id}", "category={$product->category->alias}"), $categoryName, "class='text-special'");
              }
              else
              {
                  $card .= html::a(helper::createLink('product', 'browse', "categoryID={$product->category->id}", "category={$product->category->alias}"), '[' . $product->category->name . '] ', "class='text-special'");
              }
          }
          $card .= "<a href='{$url}'>{$product->name}</a>";
          if(!$product->unsaleable)
          {
              if($product->promotion != 0)
              {
                  $card .= "<div><strong class='text-danger'>" . $this->lang->product->currencySymbols[$this->config->product->currency] . $product->promotion . '</strong>';
                  if($product->price != 0)
                  {
                      $card .= "&nbsp;&nbsp;<small class='text-muted text-line-through'>" . $this->lang->product->currencySymbols[$this->config->product->currency] . $product->price . '</small></div>';
                  }
              }
              else if($product->price != 0)
              {
                  $card .= "<div><strong class='text-danger'>" . $this->lang->product->currencySymbols[$this->config->product->currency] . $product->price . '</strong></div>';
              }
          }
          $card .= '</div>'; // end of .card-content
          $card .= '</div>';   // end of .card

          $cardsCols[$index % $content->recPerRow] .= $card;
          $index++;
      }
      ?>
      <?php foreach ($cardsCols as $col): ?>
      <div class='col col-custom-<?php echo $colsCount; ?>'>
        <?php echo $col;?>
      </div>
      <?php endforeach; ?>
    </div>
    <style><?php echo ".col-custom-{$colsCount} {width: " . (100/$colsCount) . "%}"; ?></style>
  </div>
  <?php else:?>
  <div class='panel-body no-padding'>
    <div class='list-group simple'>
      <?php
      foreach($products as $product):
      $url = helper::createLink('product', 'view', "id=$product->id", "category={$product->category->alias}&name=$product->alias");
      ?>
      <div class='list-group-item'>
        <span class='text-latin pull-right'>
        <?php
        if(!$product->unsaleable)
        {
            if($product->promotion != 0)
            {
                if($product->price != 0)
                {
                    echo "<small class='text-muted text-line-through'>" . $this->lang->product->currencySymbols[$this->config->product->currency] . $product->price . '</small>&nbsp;&nbsp;';
                }
                echo "<strong class='text-danger'>" . $this->lang->product->currencySymbols[$this->config->product->currency] . $product->promotion . '</strong>';
            }
            else if($product->price != 0)
            {
                echo "<strong class='text-danger'>" . $this->lang->product->currencySymbols[$this->config->product->currency] . $product->price . '</strong>';
            }
        }
        ?>
        </span>
        <?php if(isset($content->showCategory) and $content->showCategory == 1):?>
        <?php if($content->categoryName == 'abbr'):?>
        <?php $categoryName = '[' . ($product->category->abbr ? $product->category->abbr : $product->category->name) . '] ';?>
        <?php echo html::a(helper::createLink('product', 'browse', "categoryID={$product->category->id}", "category={$product->category->alias}"), $categoryName, "class='text-special'");?>
        <?php else:?>
        <?php echo html::a(helper::createLink('product', 'browse', "categoryID={$product->category->id}", "category={$product->category->alias}"), '[' . $product->category->name . '] ', "class='text-special'");?>
        <?php endif;?>
        <?php endif;?>
        <?php echo html::a($url, $product->name);?>
      </div>
      <?php endforeach;?>
    </div>
  </div>
  <?php endif;?>
</div>
