<?php
/**
 * The setpage view file of block module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     LGPL
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php'; ?>
<?php include '../../common/view/chosen.html.php'; ?>
<div class='panel'>
  <div class='panel-heading'><strong><i class='icon-cog'></i> <?php echo $lang->block->setPage . ' - '. $lang->block->pages[$page] . ' - ' . $lang->block->regions->{$page}[$region];?></strong></div>
    <form id='ajaxForm' class='table-form' method='post'>
      <table class='table table-striped table-bordered'>
        <thead>
          <tr>
            <th class='text-center col-xs-8'><?php echo $lang->block->title;?></th>
            <th class='w-60px'><?php echo $lang->block->grid;?></th>
            <th class='w-150px'><?php echo $lang->actions;?></th>
          </tr>
        </thead>
        <tbody>
        <?php foreach($blocks as $block) echo $this->block->createEntry($block);?>
        </tbody>
        <tfoot>
          <tr><td colspan='2' class='a-center'> <?php echo html::submitButton();?></td></tr>
        </tfoot>
      </table>
    </form>
    <table class='hide'><tbody id='entry'><?php echo $this->block->createEntry();?></tbody></table>
  </div>
<?php include '../../common/view/footer.admin.html.php';?>
