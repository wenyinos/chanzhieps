<section id="cardMode" class='cards cards-products cards-borderless hide'>
  <?php foreach($products as $product):?>
  <div class='col-sm-4 col-xs-6'>
    <div class='card'>
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
      <?php $productView = isset($this->config->product->view) ? $this->config->product->view : true;?>
      <?php if($productView):?><div class='card-info'><span data-toggle='tooltip' class='text-muted views-count' title='<?php echo $lang->product->viewsCount;?>'><i class="icon icon-eye-open"></i> <?php echo $product->views;?></span></div><?php endif;?>
      <div class='card-heading'>
        <?php echo html::a(inlink('view', "id={$product->id}", "category={$product->category->alias}&name=$product->alias"), '<strong>' . $product->name . '</strong>');?>
        <span class='card-content text-latin'>
        <?php
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
        ?>
        </span>
      </div>
    </div>
  </div>
  <?php endforeach;?>
</section>
