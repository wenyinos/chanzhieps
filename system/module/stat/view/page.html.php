<?php
/**
 * The page access view file of stat module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2010 QingDao Nature Easy Soft Network Technology Co,LTD (www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv11.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     stat
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<div class='panel'>
  <div class='panel-heading'><strong><i class='icon icon-bar-chart'></i> <?php echo $lang->stat->page->common;?></strong></div>
  <table class='table table-hover table-striped'>
    <thead>
      <th><?php echo $lang->stat->page->url;?></th>
      <th class='w-100px text-center'><?php echo $lang->stat->pv;?></th>
    </thead>
    <?php foreach($pages as $page):?>
    <tr>
      <td><?php echo html::a($page->item, $page->item);?></td>
      <td class='text-center'><?php echo $page->pv;?></td>
    </tr>
    <?php endforeach;?>
  </table>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
