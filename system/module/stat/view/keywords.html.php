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
  <div>
    <ul class='nav nav-tabs'>
      <?php foreach($lang->stat->trafficModes as $code => $modeName):?>
      <?php $class = $mode == $code ? "class='active'" : '';?>
      <li <?php echo $class?>><?php echo html::a(inlink('keywords', "mode=$code"), $modeName);?></li>
      <?php endforeach;?>
    </ul>
  </div>
  <table class='table table-list text-center'>
    <thead>
      <tr class='text-center'>
        <?php foreach($totalInfo as $searchEngin => $report):?>
        <th><?php echo $searchEngin?></th>
        <?php endforeach;?>
        <th><?php echo $lang->stat->totalPV?></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <?php $total = 0;?>
        <?php foreach($totalInfo as $searchEngin => $report):?>
        <?php $total += $report->pv;?>
        <td><?php echo $report->pv?></td>
        <?php endforeach;?>
        <td><?php echo $total?></td>
      </tr>
    </tbody>
  </table>
  <br/>
  <div class='panel'>
  <table class='table table-hover table-bordered table-striped tablesorter'>
    <thead>
      <tr class='text-center'>
        <?php $vars = "mode={$mode}&begin={$begin}&end={$end}&orderBy=%s&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}";?>
        <th class='col-xs-3'> <?php commonModel::printOrderLink('item',  $orderBy, $vars, $lang->stat->keywords);?></th>
        <th class='col-xs-3'> <?php commonModel::printOrderLink('pv',  $orderBy, $vars, $lang->stat->pv);?></th>
        <th class='col-xs-3'><?php commonModel::printOrderLink('uv', $orderBy, $vars, $lang->stat->uv);?></th>
        <th>               <?php commonModel::printOrderLink('ip', $orderBy, $vars, $lang->stat->ipCount);?></th>
        <th><?php echo $lang->actions?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($keywordList as $keyword):?>
      <tr class='text-center text-middle'>
        <td><?php echo html::a(inlink('source', "stat=$keyword->item"), $keyword->item, "data-toggle='modal'");?></td>
        <td><?php echo $keyword->pv;?></td>
        <td><?php echo $keyword->uv;?></td>
        <td><?php echo $keyword->ip;?></td>
        <td><?php echo html::a(inlink('keywordreport', "keyword={$keyword->item}"), $lang->stat->view);?></td>
      </tr>
      <?php endforeach;?>
    </tbody>
    <tfoot><tr><td colspan='4'><?php $pager->show();?></td></tr></tfoot>
  </table>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
