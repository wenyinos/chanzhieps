<?php
/**
 * The admin view file of product of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     LGPL
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     product
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<table class='table table-bordered table-hover table-striped tablesorter'>
  <caption><?php echo $lang->product->list;?><span class='pull-right mr-10px'><?php echo html::a($this->inlink('create', "category={$categoryID}"), $lang->product->create);?></span></caption>
  <thead>
    <tr class='a-center'>
      <?php $vars = "categoryID=$categoryID&corderBy=%s&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}";?>
      <th class='w-60px'> <?php commonModel::printOrderLink('id',        $orderBy, $vars, $lang->product->id);?></th>
      <th>                <?php commonModel::printOrderLink('name',      $orderBy, $vars, $lang->product->name);?></th>
      <th class='w-p15'>  <?php commonModel::printOrderLink('category',  $orderBy, $vars, $lang->product->category);?></th>
      <th class='w-p10'>  <?php commonModel::printOrderLink('amount',    $orderBy, $vars, $lang->product->amount);?></th>
      <th class='w-160px'><?php commonModel::printOrderLink('addedDate', $orderBy, $vars, $lang->product->addedDate);?></th>
      <th class='w-60px'> <?php commonModel::printOrderLink('status',    $orderBy, $vars, $lang->product->status);?></th>
      <th class='w-60px'> <?php commonModel::printOrderLink('views',     $orderBy, $vars, $lang->product->views);?></th>
      <th class='w-200px'><?php echo $lang->actions;?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($products as $product):?>
    <tr class='a-center'>
      <td><?php echo $product->id;?></td>
      <td class='a-left'><?php echo $product->name;?></td>
      <td class='a-left'><?php foreach($product->categories as $category) echo $category->name . ' ';?></td>
      <td><?php echo $product->amount;?></td>
      <td><?php echo $product->addedDate;?></td>
      <td><?php echo $lang->product->statusList[$product->status];?></td>
      <td><?php echo $product->views;?></td>
      <td>
        <?php
        $categories    = $product->categories;
        $categoryAlias = current($categories)->alias;
        $changeStatus  = $product->status == 'normal' ? 'offline' : 'normal';
        echo html::a($this->createLink('product', 'edit', "productID=$product->id"), $lang->edit);
        echo html::a($this->createLink('file',    'browse', "objectType=product&objectID=$product->id"), $lang->product->files, "data-toggle='modal' data-width='1000'");
        echo html::a($this->createLink('product', 'delete', "productID=$product->id"), $lang->delete, "class='deleter'");
        echo html::a($this->createLink('product', 'changeStatus', "productID=$product->id&status=$changeStatus"), $lang->product->statusList[$changeStatus], "class='changeStatus'");
        echo html::a(commonModel::createFrontLink('product', 'view',  "productID=$product->id", "name=$product->alias&category=$categoryAlias"), $lang->preview, "target='_blank'");
        ?>
      </td>
    </tr>
    <?php endforeach;?>
  </tbody>
  <tfoot><tr><td colspan='8'><?php $pager->show();?></td></tr></tfoot>
</table>
<?php include '../../common/view/footer.admin.html.php';?>
