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
<?php if(isset($pieCharts)) js::set('pieCharts', $pieCharts);?>
<?php if(isset($lineCharts)) js::set('lineCharts', $lineCharts);?>
<?php if(isset($lineLabels)) js::set('lineLabels', $lineLabels);?>
<?php js::set('type', $type);?>
<div class='panel'>
  <div class="panel-heading">
    <strong>
      <i class='icon icon-bar-chart'></i> <?php echo strpos(',os,browser,device,', ",$type,") === false ? $lang->stat->{$type} : $lang->stat->client;?>
    </strong>
    <?php
    if(strpos(',os,browser,device,', ",$type,") !== false)
    {
        echo html::a(inlink('report', "type=browser"), $lang->stat->browser, $type == 'browser' ? "class='active'" : '');
        echo html::a(inlink('report', "type=os"), $lang->stat->os, $type == 'os' ? "class='active'" : '');
        echo html::a(inlink('report', "type=device"), $lang->stat->device, $type == 'device' ? "class='active'" : '');
    }
    ?>
    <div class="panel-actions">
      <form method='get' action="<?php echo inlink('from')?>">
        <?php echo html::hidden('m', 'stat') . html::hidden('f', 'from'). html::hidden('mode', 'fixed');?>
        <table class='table table-borderless'>
          <tr>
            <td><?php echo html::a(inlink('from'), $lang->stat->all);?></td>
            <td style='padding:4px'>
              <?php echo html::input('begin', $this->get->begin, "placeholder='{$lang->stat->begin}' class='form-date w-120px'")?> 
              <?php echo html::input('end', $this->get->end, "placeholder='{$lang->stat->end}' class='form-date w-120px'")?>
              <?php echo html::submitButton($lang->stat->view, "btn btn-xs btn-info");?>
            </td>
          </tr>
        </table>
      </form>
    </div>
  </div>
  <?php if(!empty($lineCharts)) include 'linechart.html.php';?>
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
            <td></td>
            <?php foreach($pieCharts['pv'] as $report):?>
            <td><?php echo $report->label;?></td>
            <?php endforeach;?>
          </tr>
        </thead>
        <?php foreach($pieCharts as $item => $reports):?>
        <tr class='text-center'>
          <td><?php echo $item;?></td>
          <?php foreach($reports as $report):?>
          <td><?php echo $report->value;?></td>
          <?php endforeach;?>
        </tr>
        <?php endforeach;?>
      </table>
  </div>  
  <?php else:?>
  <div class='panel-body text-danger'><?php echo $lang->stat->noData;?></div>
  <?php endif;?>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
