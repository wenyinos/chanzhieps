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
  <div class="panel-heading pd-l0">
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
</div>
  <div class="panel-">
  <table class='table table-hover table-bordered'>
    <thead>
      <tr class='text-center'>
        <th class='text-middle' rowspan='2'><?php echo $lang->stat->keyword;?></th>
        <?php foreach($searchEngines as $engine):?>
        <th colspan='3'> <?php echo $engine;?></th>
        <?php endforeach;?>
        <th class='text-middle' rowspan='2'><?php echo $lang->actions?></th>
      </tr>
      <tr class='text-center'>
        <?php foreach($searchEngines as $engine):?>
        <th>pv</th>
        <th>uv</th>
        <th>ip</th>
        <?php endforeach;?>
      </tr>
    </thead>
    <tbody>
      <?php foreach($keywordList as $keyword => $reports):?>
      <tr class='text-center text-middle'>
        <td><?php echo $keyword;?></td>
        <?php foreach($searchEngines as $engine):?>
        <?php if(isset($reports[$engine])):?>
        <td class='<?php echo $engine;?>'><?php echo $reports[$engine]->pv;?></td>
        <td class='<?php echo $engine;?>'><?php echo $reports[$engine]->uv;?></td>
        <td class='<?php echo $engine;?>'><?php echo $reports[$engine]->ip;?></td>
        <?php else:?>
        <td class='<?php echo $engine;?>'>0</td>
        <td class='<?php echo $engine;?>'>0</td>
        <td class='<?php echo $engine;?>'>0</td>
        <?php endif;?>
        <?php endforeach;?>
        <td><?php echo html::a(inlink('keywordreport', "keyword={$keyword}"), $lang->stat->view);?></td>
      </tr>
      <?php endforeach;?>
    </tbody>
    <tfoot><tr><td colspan='20'><?php $pager->show();?></td></tr></tfoot>
  </table>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
