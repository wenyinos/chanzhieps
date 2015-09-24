<?php
/**
 * The from view file of stat module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2010 QingDao Nature Easy Soft Network Technology Co,LTD (www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv11.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     stat
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<?php include '../../common/view/chart.html.php';?>
<?php include '../../common/view/datepicker.html.php';?>
<?php js::set('lineLabels', $labels);?>
<?php js::set('lineChart',  $lineChart);?>
<?php js::set('pieCharts',  $pieCharts);?>
<div class='panel'>
  <div class="panel-heading">
    <strong>
      <i class='icon icon-bar-chart'></i> <?php echo $lang->stat->domain;?>
    </strong>
    <label class='text-important'><?php echo $domain?></label>
    <div class="panel-actions">
      <ul class='nav nav-tabs'>
        <?php foreach($lang->stat->trafficModes as $code => $modeName):?>
        <?php $class = $mode == $code ? "class='active'" : '';?>
        <li <?php echo $class?>><?php echo html::a(inlink('domain', "domain={$domain}&mode=$code"), $modeName);?></li>
        <?php endforeach;?>
        <li>
          <form method='get' action="<?php echo inlink('domain')?>">
            <?php echo html::hidden('m', 'stat') . html::hidden('f', 'domain') . html::hidden('domain', $domain) . html::hidden('mode', 'fixed');?>
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
      <ul>
    </div>
  </div>
  <?php if(!empty($lineChart)):?>
  <div class='chart-canvas'><canvas height='260' width='900' id='lineChart'></canvas></div>
  <?php endif;?>
  <?php if(!empty($pieCharts)):?>
  <div class='panel-body'>
    <div class='col-md-6'>
      <div class='chart-canvas'><canvas height='260' width='400' id='pieChart'></canvas></div>
      <div class='text-center w-400px' id='switchBar'>
        <label data-type='pv' class='active'> <?php echo $lang->stat->pv;?></label>
        <label data-type='uv'> <?php echo $lang->stat->uv;?></label>
        <label data-type='ip'> <?php echo $lang->stat->ipCount;?></label>
      </div>
    </div>
    <div class='clo-md-6'>
      <table class='table table-bordered table-report w-500px' id='reportData'>
        <thead>
          <tr class='text-center'>
            <td><?php echo $lang->stat->link?></td>
            <td><?php echo $lang->stat->pv;?></td>
            <td><?php echo $lang->stat->uv;?></td>
            <td><?php echo $lang->stat->ipCount;?></td>
          </tr>
        </thead>
        <?php for($i = 0 ; $i < count($pieCharts['pv']); $i ++):?>
        <?php $report = $pieCharts['pv'][$i];?>
        <tr class='text-center'>
          <td><?php echo $report->label;?></td>
          <td><?php echo $report->value;?></td>
          <td><?php echo $pieCharts['uv'][$i]->value;?></td>
          <td><?php echo $pieCharts['ip'][$i]->value;?></td>
        </tr>
        <?php endfor;?>
      </table>
  </div>  
  <?php else:?>
  <div class='panel-body text-danger'><?php echo $lang->stat->noData;?></div>
  <?php endif;?>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
