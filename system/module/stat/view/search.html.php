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
<?php js::set('charts', $charts);?>
<div class='panel'>
  <div class="panel-heading">
    <strong><i class='icon icon-bar-chart'></i> <?php echo $lang->stat->from;?></strong>
    <div class="panel-actions">
      <form method='get' action="<?php echo inlink('from')?>">
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
        <?php echo html::hidden('m', 'stat') . html::hidden('f', 'from');?>
      </form>
    </div>
  </div>
  <?php if(!empty($charts)):?>
  <div class='panel-body'>
    <div class='col-md-6'>
      <div class='chart-canvas'><canvas height='260' width='400' id='chartBox'></canvas></div>
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
            <?php foreach($charts['pv'] as $report):?>
            <td><?php echo $report->label;?></td>
            <?php endforeach;?>
          </tr>
        </thead>
        <?php foreach($charts as $item => $reports):?>
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
