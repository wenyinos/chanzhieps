<?php
/**
 * The admin browse view file of stat module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1 (http://www.chanzhi.org/license/)
 * @author      Xiying Guan<guanxiying@xirangit.com>
 * @package     stat
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<div class='panel'>
  <div class="panel-heading">
    <strong><i class='icon-stats'></i> <?php echo $lang->stat->keywords;?></strong>
    <div class="panel-actions">
      <form method='post' class='form-inline form-search'>
        <div class="input-group">
          <?php echo html::input('stat', $this->post->stat, "class='form-control search-query'");?>
          <span class="input-group-btn">
            <?php echo html::submitButton($lang->stat->search, "btn btn-primary"); ?>
          </span>
        </div>
      </form>
    </div>
  </div>
  <table class='table table-hover table-bordered table-striped tablesorter'>
    <thead>
      <tr class='text-center'>
        <?php $vars = "orderBy=%s&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}";?>
        <th class='col-xs-3'> <?php commonModel::printOrderLink('item',  $orderBy, $vars, $lang->stat->keywords);?></th>
        <th class='col-xs-3'> <?php commonModel::printOrderLink('pv',  $orderBy, $vars, $lang->stat->pv);?></th>
        <th class='col-xs-3'><?php commonModel::printOrderLink('uv', $orderBy, $vars, $lang->stat->uv);?></th>
        <th>               <?php commonModel::printOrderLink('ip', $orderBy, $vars, $lang->stat->ipCount);?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($keywordList as $keyword):?>
      <tr class='text-center text-middle'>
        <td><?php echo html::a(inlink('source', "stat=$keyword->item"), $keyword->item, "data-toggle='modal'");?></td>
        <td><?php echo $keyword->pv;?></td>
        <td><?php echo $keyword->uv;?></td>
        <td><?php echo $keyword->ip;?></td>
      </tr>
      <?php endforeach;?>
    </tbody>
    <tfoot><tr><td colspan='4'><?php $pager->show();?></td></tr></tfoot>
  </table>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
