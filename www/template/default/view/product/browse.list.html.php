<section id="listMode" class='list-products'>
  <table class='table table-list'>
    <tbody>
      <?php foreach($products as $product):?>
      <tr>
        <td class='w-80px text-middle'>
        <?php 
        if(empty($product->image)) 
        {
            echo html::a(inlink('view', "id=$product->id", "category={$product->category->alias}&name=$product->alias"), '<div class="media-placeholder" data-id="' . $product->id . '">' . $product->name . '</div>', "class='w-80px'");
        }
        else
        {
            $title = $product->image->primary->title ? $product->image->primary->title : $product->name;
            echo html::a(inlink('view', "id=$product->id", "category={$product->category->alias}&name=$product->alias"), html::image($product->image->primary->middleURL, "width='80' title='{$title}' alt='{$product->name}'"), "class='w-80px'");
        }
        ?>
        </td>
        <td>
          <?php echo html::a(inlink('view', "id={$product->id}", "category={$product->category->alias}&name=$product->alias"), '<strong>' . $product->name . '</strong>');?>
        </td>
        <td>
          <?php echo "<strong class='text-danger'>" . $this->lang->product->currencySymbols[$this->config->product->currency] . $product->price . '</strong>&nbsp;&nbsp;'; ?>
        </td>
        <td class='text-muted'>
          <span class='icon icon-eye-open'><?php echo $lang->product->views . $lang->colon . $product->views;?></span><br>
          <span class='icon icon-comments-alt'><?php echo $lang->product->comments . $lang->colon . $product->comments;?></span>
        </td>
        <td class="w-100px">
          <?php if(commonModel::isAvailable('order')):?>
          <?php echo html::a(inlink('view', "id={$product->id}", "category={$product->category->alias}&name=$product->alias"), $lang->product->buyNow, "class='btn btn-xs btn-success'")?>
          <?php else:?>
          <?php echo html::a(inlink('view', "id={$product->id}", "category={$product->category->alias}&name=$product->alias"), $lang->product->detail, "class='btn btn-xs btn-success'")?>
          <?php endif;?>
        </td>
      </tr>
      <?php endforeach;?>
    </tbody>
  </table>
</section>
