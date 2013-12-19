<?php
/**
 * The create view file of product category of chanzhiEPS.
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
<?php include '../../common/view/kindeditor.html.php';?>
<?php include '../../common/view/chosen.html.php';?>
<div class='panel'>
  <div class='panel-heading'><?php echo $lang->product->edit;?></div>
  <div class='panel-body'>
    <form method='post' class='form-horizontal' id='ajaxForm'> 
      <div class='form-group'>
        <label class='col-sm-2 control-label'><?php echo $lang->product->category;?></label>
        <div class='col-sm-5'><?php echo html::select("categories[]", $categories, array_keys($product->categories), "multiple='multiple' class='form-control chosen'");?></div>
      </div>
      <div class='form-group'>
        <label class='col-sm-2 control-label required'><?php echo $lang->product->name;?></label>
        <div class='col-sm-10'><?php echo html::input('name', $product->name, "class='form-control'");?></div>
      </div>
      <div class='form-group'>
        <label class='col-sm-2 control-label'><?php echo $lang->product->alias;?></label>
        <div class='col-sm-10'>
          <div class="input-group">
            <span class="input-group-addon">http://<?php echo $this->server->http_host . $config->webRoot?>product/id_</span>
            <?php echo html::input('alias', $product->alias, "class='form-control' placeholder='{$lang->alias}'");?>
            <span class="input-group-addon">.html</span>
          </div>
        </div>
      </div>
      <div class='form-group'>
        <label class='col-sm-2 control-label'><?php echo $lang->product->mall;?></label>
        <div class='col-sm-10'><?php echo html::input('mall', $product->mall, "class='form-control'");?></div>
      </div>
      <div class='form-group'>
        <label class='col-sm-2 control-label'><?php echo $lang->product->keywords;?></label>
        <div class='col-sm-10'><?php echo html::input('keywords', $product->keywords, "class='form-control'");?></div>
      </div>
      <div class='form-group'>
        <label class='col-sm-2 control-label'><?php echo $lang->product->summary;?></label>
        <div class='col-sm-10'><?php echo html::textarea('summary', $product->summary, "rows='2' class='form-control'");?></div>
      </div>
      <div class='form-group'>
        <label class='col-sm-2 control-label required'><?php echo $lang->product->content;?></label>
        <div valign='middle' class='col-sm-10'><?php echo html::textarea('content', $product->content, "rows='10' class='form-control'");?></div>
      </div>
      <div class='form-group'>
        <label class='col-sm-2 control-label'><?php echo $lang->product->attribute?></label>
        <div class='col-sm-10'>
          <div class="row">
            <div class='col-sm-2 col-md-1'><?php echo $lang->product->brand;?></div>
            <div class='col-sm-4 col-md-5'> <?php echo html::input('brand', $product->brand, "class='form-control'");?></div>
            <div class='col-sm-2 col-md-1'><?php echo $lang->product->model;?></div>
            <div class='col-sm-4 col-md-5'><?php echo html::input('model', $product->model, "class='form-control'");?></div>
          </div>
        </div>
      </div>
      <div class='form-group'>
        <div class='col-sm-2'></div>
        <div class='col-sm-10'>
          <div class="row">
            <div class='col-sm-2 col-md-1'><?php echo $lang->product->color;?></div>
            <div class='col-sm-4 col-md-5'><?php echo html::input('color', $product->color, "class='form-control'");?></div>
            <div class='col-sm-2 col-md-1'><?php echo $lang->product->amount;?> </div>
            <div class='col-sm-4 col-md-5'><?php echo html::input('amount', $product->amount, "class='form-control'");?></div>
          </div>
        </div>
      </div>
      <div class='form-group'>
        <div class='col-sm-2'></div>
        <div class='col-sm-10'>
          <div class="row">
            <div class='col-sm-2 col-md-1'><?php echo $lang->product->origin;?></div>
            <div class='col-sm-4 col-md-5'><?php echo html::input('origin', $product->origin, "class='form-control'");?></div>
            <div class='col-sm-2 col-md-1'><?php echo $lang->product->unit;?></div>
            <div class='col-sm-4 col-md-5'><?php echo html::input('unit', $product->unit, "class='form-control'");?></div>
          </div>
        </div>
      </div>
      <div class='form-group'>
        <div class='col-sm-2'></div>
        <div class='col-sm-10'>
          <div class="row">
            <div class='col-sm-2 col-md-1'><?php echo $lang->product->price;?></div>
            <div class='col-sm-4 col-md-5'><?php echo html::input('price', $product->price, "class='form-control'");?></div>
            <div class='col-sm-2 col-md-1'><?php echo $lang->product->promotion;?></div>
            <div class='col-sm-4 col-md-5'><?php echo html::input('promotion', $product->promotion, "class='form-control'");?></div>
          </div>
        </div>
      </div>
      <div class='form-group'>
        <label class='col-sm-2'></label>
        <div class='col-sm-10'><?php echo html::submitButton();?></div>
      </div>
    </form>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
