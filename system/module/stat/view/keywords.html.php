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
<?php include '../../common/view/datepicker.html.php';?>
<div class='panel'>
  <div class="panel-heading">
    <strong><i class='icon-stats'></i> <?php echo $lang->stat->keywords;?></strong>
    <div class='panel-actions'>
      <ul class='nav nav-tabs'>
        <?php foreach($lang->stat->trafficModes as $code => $modeName):?>
        <?php $class = $mode == $code ? "class='active'" : '';?>
        <li <?php echo $class?>><?php echo html::a(inlink('keywords', "mode=$code"), $modeName);?></li>
        <?php endforeach;?>
        <li>
          <form method='get' action="<?php echo inlink('keywordreport')?>">
            <?php echo html::hidden('m', 'stat') . html::hidden('f', 'keywords') . html::hidden('mode', 'fixed');?>
            <table class='table table-borderless'>
              <tr>
                <td style='padding:4px'>
                  <?php echo html::input('begin', $this->get->begin, "placeholder='{$lang->stat->begin}' class='form-date w-120px'")?> 
                  <?php echo html::input('end', $this->get->end, "placeholder='{$lang->stat->end}' class='form-date w-120px'")?>
                  <?php echo html::submitButton($lang->stat->view, "btn btn-xs btn-info");?>
                </td>
              </tr>
            </table>
          </form>
        </li>
      </ul>
    </div>
  </div>
  <table class='table table-list text-center'>
    <thead>
      <tr class='text-center'>
        <?php foreach($searchEngines as $searchEngine):?>
        <th><?php echo $searchEngine->searchEngine?></th>
        <?php endforeach;?>
        <th><?php echo $lang->stat->totalPV?></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <?php $total = 0;?>
        <?php foreach($searchEngines as $searchEngine => $info):?>
        <?php if(isset($totalInfo[$searchEngine])) $report = $totalInfo[$searchEngine];?>
<?php
if(!isset($totalInfo[$searchEngine]))
{
    $report = new stdclass();
    $report->pv = 0;  
    $report->uv = 0;  
    $report->ip = 0;  
}
?>
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
    <tfoot><tr><td colspan='5'><?php $pager->show();?></td></tr></tfoot>
  </table>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
