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
  <div class='panel-heading'><strong><i class='icon icon-bar-chart'></i> <?php echo $lang->stat->page->common;?></strong>
    <div class='panel-actions'>
      <ul class='nav nav-tabs'>
        <li <?php echo $mode == 'all' ? "class='active'" : '' ?>><?php echo html::a(inlink('page', "mode=all"), $lang->stat->all);?></li>
        <?php foreach($lang->stat->trafficModes as $code => $modeName):?>
        <?php $class = $mode == $code ? "class='active'" : '';?>
        <li <?php echo $class?>><?php echo html::a(inlink('page', "mode=$code"), $modeName);?></li>
        <?php endforeach;?>
        <li>
          <form method='get'>
            <?php echo html::hidden('m', 'stat') . html::hidden('f', 'report');?>
            <?php echo html::hidden('mode', 'fixed');?>
            <?php echo html::hidden('orderBy', 'pv_desc');?>
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
  <table class='table table-hover table-bordered table-striped tablesorter'>
    <thead>
      <tr class='text-center'>
        <?php $vars = "mode={$mode}&orderBy=%s&begin={$begin}&end={$end}";?>
        <th class='text-center'><?php echo $lang->stat->page->url;?></th>
        <th class='w-100px'> <?php commonModel::printOrderLink('pv',  $orderBy, $vars, $lang->stat->pv);?></th>
        <th class='w-100px'> <?php commonModel::printOrderLink('uv',  $orderBy, $vars, $lang->stat->uv);?></th>
        <th class='w-100px'> <?php commonModel::printOrderLink('ip',  $orderBy, $vars, $lang->stat->ipCount);?></th>
      </tr>
    </thead>
    <?php $i = 0;?>
    <?php foreach($pages as $page):?>
    <?php $i ++;?>
    <tr>
      <td>
        <label class='label label-info label-badge'><?php echo $i;?></label>
        <?php echo html::a($page->item, $page->item);?>
      </td>
      <td class='w-100px text-center'><?php echo $page->pv;?></td>
      <td class='w-100px text-center'><?php echo $page->uv;?></td>
      <td class='w-100px text-center'><?php echo $page->ip;?></td>
    </tr>
    <?php endforeach;?>
  </table>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
