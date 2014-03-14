<?php
/**
 * The setresponse view file of wechat module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     LGPL
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     wechat
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<?php include '../../common/view/chosen.html.php';?>
<div class='panel'>
  <div class='panel-heading'>
    <strong><i class="icon-plus"></i> <?php echo $lang->wechat->setResponse;?></strong>
  </div>
  <div class='panel-body'>
    <form method='post' id='ajaxForm'>
      <table class='table table-form'>
        <?php if(!$group):?>
        <tr>
          <th class='w-100px'><?php echo $lang->wechat->response->key;?></th>
          <td class='w-220px'><?php echo html::input('key', '', "class='form-control'");?></td>
          <td></td>
        </tr>
        <?php endif;?>
        <tr>
          <th class='w-100px'><?php echo $lang->wechat->response->type;?></th>
          <td class='w-220px'><?php echo html::select('type', $lang->wechat->response->typeList, '', "class='form-control'");?></td>
          <td></td>
        </tr>

        <tr class='link'>
          <th><?php echo $lang->wechat->response->module;?></th>
          <td colspan='2'>
            <div class='form-group'>
              <div class='col-sm-3'><?php echo html::select('linkModule', $this->lang->wechat->response->moduleList, '', "class='form-control'");?></div>
              <div class='col-sm-9 manual'><?php echo html::input('content', '', "class='form-control'");?></div>
            </div>
          </td>
        </tr>

        <tr class='text'>
          <th><?php echo $lang->wechat->response->block;?></th>
          <td colspan='2'>
            <div class='form-group'>
              <div class='col-sm-3'><?php echo html::select('textBlock', $this->lang->wechat->response->textBlockList, '', "class='form-control'");?></div>
              <div class='col-sm-10 manual'><?php echo html::textarea('content', '', "class='form-control'");?></div>
            </div>
          </td>
        </tr>

        <tr class='news'>
          <th><?php echo $lang->wechat->response->block;?></th>
          <td>
          <?php echo html::select('newsBlock', $this->lang->wechat->response->newsBlockList, '', "class='form-control newsBlock'");?>
          </td>
          <td>
            <div class='form-group'>
              <div class='col-sm-7'>
                <span class='articleTree'><?php echo html::select('category', $articleTree, '', "class='form-control chosen' multiple='multiple' data-placeholder='{$lang->wechat->placeholder->category}'");?></span>
                <span class='productTree'><?php echo html::select('category', $productTree, '', "class='form-control chosen' multiple='multiple' data-placeholder='{$lang->wechat->placeholder->category}'");?></span>
              </div>
              <div class='col-sm-4'> <?php echo html::input('limit', '', "class='form-control' placeholder='{$lang->wechat->placeholder->limit}'");?></div>
            </div>
          </td>
        </tr>

        <tr>
          <th></th>
          <td>
            <?php echo html::submitButton();?>
            <?php echo html::hidden('group', $group);?>
            <?php if($group) echo html::hidden('key', $group);?>
          </td>
        </tr>
      </table>
    </form>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
