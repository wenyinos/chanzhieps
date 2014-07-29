<?php
/**
 * The setpage view file of block module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     http://api.chanzhi.org/goto.php?item=license
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.modal.html.php';?>
<?php js::set('key', count($blocks));?>
<form id='ajaxForm' action="<?php echo inlink('setregion', "page={$page}&region={$region}&templat={$template}");?>" method='post'>
  <table class='table table-striped table-form'>
    <thead>
      <tr>
        <th class='text-center col-xs-6'><?php echo $lang->block->title;?></th>
        <th class='text-center col-xs-2'><?php echo $lang->block->grid;?></th>
        <th class='text-center col-xs-2'><?php echo $lang->actions;?></th>
      </tr>
    </thead>
    <tbody>
    <?php $key = 0; foreach($blocks as $block){ echo $this->block->createEntry($block, $key); $key ++;  }?>
    </tbody>
    <tfoot>
      <tr><td colspan='3' class='a-center'> <?php echo html::submitButton();?></td></tr>
    </tfoot>
  </table>
</form>
<table class='hide'><tbody id='entry'><?php echo $this->block->createEntry(null, 'key');?></tbody></table>
<?php include '../../common/view/footer.modal.html.php';?>
