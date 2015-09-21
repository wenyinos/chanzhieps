<section id="cardMode" class='cards cards-products cards-borderless hide'>
  <?php foreach($products as $product):?>
  <div class='col-sm-4 col-xs-6'>
    <div class='card' data-ve='product' id='product<?php echo $product->id?>'>
      <?php
      if(empty($product->image))
      {
          echo html::a(inlink('view', "id=$product->id", "category={$product->category->alias}&name=$product->alias"), '<div class="media-placeholder" data-id="' . $product->id . '">' . $product->name . '</div>', "class='media-wrapper'");
      }
      else
      {
          $title = $product->image->primary->title ? $product->image->primary->title : $product->name;
          echo html::a(inlink('view', "id=$product->id", "category={$product->category->alias}&name=$product->alias"), html::image($product->image->primary->middleURL, "title='{$title}' alt='{$product->name}'"), "class='media-wrapper'");
      }
      ?>
      <div class='card-heading'>
        <span class='pull-right'>
          <?php
          if(!$product->unsaleable)
          {
              if($product->promotion != 0)
              {
                  echo "<strong class='text-muted'>"  .'</strong>';
                  echo "<strong class='text-danger'>" . $this->lang->product->currencySymbols[$this->config->product->currency] . $product->promotion . '</strong>&nbsp;&nbsp;';
              }
              else
              {
                  if($product->price != 0)
                  {
                      echo "<strong class='text-danger'>" . $this->lang->product->currencySymbols[$this->config->product->currency] . $product->price . '</strong>&nbsp;&nbsp;';
                  }
              }
          }
          ?>
          <?php $productView = isset($this->config->ui->productView) ? $this->config->ui->productView : true;?>
          <?php if($productView):?><span data-toggle='tooltip' class='text-muted views-count' title='<?php echo $lang->product->viewsCount;?>'><i class="icon icon-eye-open"></i> <?php echo $product->views;?></span><?php endif;?>
        </span>
        <span class='pull-left w-180px text-nowrap text-ellipsis'>
        <?php echo html::a(inlink('view', "id={$product->id}", "category={$product->category->alias}&name=$product->alias"), '<strong>' . $product->name . '</strong>');?>
        </span>
      </div>
    </div>
  </div>
  <?php endforeach;?>
</section>
