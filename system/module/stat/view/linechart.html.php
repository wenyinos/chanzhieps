<div class='lineTypeBar'> <?php if(!empty($lineCharts)):?> <div><?php echo html::radio('lineType', $lang->stat->dataTypes, 'pv');?></div><?php endif;?> </div>
<div class='chart-canvas'><canvas height='260' width='900' id='lineChart'></canvas></div>
