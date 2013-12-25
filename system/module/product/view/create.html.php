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
  <div class='panel-heading'>
    <strong><i class="icon-plus"></i> <?php echo $lang->product->create;?></strong>
  </div>
  <div class='panel-body'>
    <form method='post' id='ajaxForm'>
      <table class='table table-form'>
        <tr>
          <th style='width: 100px'><?php echo $lang->product->category;?></th>
          <td style='width: 40%'><?php echo html::select("categories[]", $categories, $currentCategory, "multiple='multiple' class='form-control chosen'");?></td><td></td>
        </tr>
        <tr>
          <th><?php echo $lang->product->name;?></th>
          <td colspan='2'><?php echo html::input('name', '', "class='form-control'");?></td>
        </tr>
        <tr>
          <th><?php echo $lang->product->alias;?></th>
          <td colspan='2'>
            <div class="input-group">
              <span class="input-group-addon">http://<?php echo $this->server->http_host . $config->webRoot?>product/id_</span>
              <?php echo html::input('alias', '', "class='form-control' placeholder='{$lang->alias}'");?>
              <span class="input-group-addon">.html</span>
            </div>
          </td>
        </tr>
        <tr>
          <th><?php echo $lang->product->mall;?></th>
          <td colspan='2'><?php echo html::input('mall', '', "class='form-control'");?></td>
        </tr>
        <tr>
          <th><?php echo $lang->product->keywords;?></th>
          <td colspan='2'><?php echo html::input('keywords', '', "class='form-control'");?></td>
        </tr>
        <tr>
          <th><?php echo $lang->product->summary;?></th>
          <td colspan='2'><?php echo html::textarea('summary', '', "rows='2' class='form-control'");?></td>
        </tr>
        <tr>
          <th><?php echo $lang->product->content;?></th>
          <td colspan='2'><?php echo html::textarea('content', '', "rows='10' class='form-control'");?></td>
        </tr>
        <tr>
          <th rowspan='4'><?php echo $lang->product->attribute?></th>
          <td colspan='2'>
            <div class="row">
              <div class='col-sm-2 col-md-1'><?php echo $lang->product->brand;?></div>
              <div class='col-sm-4 col-md-5'> <?php echo html::input('brand', '', "class='form-control'");?></div>
              <div class='col-sm-2 col-md-1'><?php echo $lang->product->model;?></div>
              <div class='col-sm-4 col-md-5'><?php echo html::input('model', '', "class='form-control'");?></div>
            </div>
          </td>
        </tr>
        <tr>
          <td colspan='2'>
            <div class="row">
              <div class='col-sm-2 col-md-1'><?php echo $lang->product->color;?></div>
              <div class='col-sm-4 col-md-5'><?php echo html::input('color', '', "class='form-control'");?></div>
              <div class='col-sm-2 col-md-1'><?php echo $lang->product->amount;?> </div>
              <div class='col-sm-4 col-md-5'><?php echo html::input('amount', '', "class='form-control'");?></div>
            </div>
          </td>
        </tr>
        <tr>
          <td colspan='2'>
            <div class="row">
              <div class='col-sm-2 col-md-1'><?php echo $lang->product->origin;?></div>
              <div class='col-sm-4 col-md-5'><?php echo html::input('origin', '', "class='form-control'");?></div>
              <div class='col-sm-2 col-md-1'><?php echo $lang->product->unit;?></div>
              <div class='col-sm-4 col-md-5'><?php echo html::input('unit', '', "class='form-control'");?></div>
            </div>
          </td>
        </tr>
        <tr>
          <td colspan='2'>
            <div class="row">
              <div class='col-sm-2 col-md-1'><?php echo $lang->product->price;?></div>
              <div class='col-sm-4 col-md-5'><?php echo html::input('price', '', "class='form-control'");?></div>
              <div class='col-sm-2 col-md-1'><?php echo $lang->product->promotion;?></div>
              <div class='col-sm-4 col-md-5'><?php echo html::input('promotion', '', "class='form-control'");?></div>
            </div>
          </td>
        </tr>
        <tr>
          <th></th>
          <td colspan='2'><?php echo html::submitButton();?></td>
        </tr>
      </table>
    </form>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
