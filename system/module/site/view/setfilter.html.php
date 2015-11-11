<?php
/**
 * The setbasic view file of site module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      xiying Guang <guanxiying@xirangit.com>
 * @package     site
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<div class='panel'>
  <div class='panel-heading'>
    <strong><i class='icon-globe'></i> <?php echo $lang->site->setFilter;?></strong>
    <?php echo html::a(inlink('setfilter', "type=ip"), $lang->site->ipFilter, $class = $type == 'ip' ? "class='active'" : '');?>
    <?php echo html::a(inlink('setfilter', "type=account"), $lang->site->accountFilter, $class = $type == 'account' ? "class='active'" : '');?>
  </div>
  <div class='panel-body'>
    <form method='post' id='ajaxForm' class='form-inline'>
      <table class='table table-form'>
        <?php foreach($lang->guarder->operationList as $item => $operation):?>
        <tr>
          <th class='text-middle text-center w-100px'><?php echo $operation;?></th>
          <td>
            <div class='input-group'>
              <?php echo html::input("interval[$item]", zget($this->config->guarder->interval->{$type}, $item), "class='form-control'");?>
              <span class='input-group-addon'><?php echo $lang->guarder->interval?><?php echo $lang->guarder->exceed?></span>
              <?php echo html::input("limits[interval][{$item}]", $this->config->guarder->limits->{$type}->interval->$item, "class='form-control'");?>
              <span class='input-group-addon'><?php echo $lang->guarder->times . $lang->guarder->then . $lang->guarder->disable?></span>
              <?php echo html::select("punishment[interval][{$item}]", $lang->guarder->punishOptions, $this->config->guarder->punishment->{$type}->interval->$item, "class='form-control'");?>
            </div>
          </td>
          <td>
            <div class='input-group'>
              <span class='input-group-addon'><?php echo $lang->guarder->perDay?></span>
              <?php echo html::input("limits[day][{$item}]", $this->config->guarder->limits->{$type}->day->$item, "class='form-control'");?>
              <span class='input-group-addon'><?php echo $lang->guarder->times . $lang->guarder->then . $lang->guarder->disable?></span>
              <?php echo html::select("punishment[day][{$item}]",$lang->guarder->punishOptions, $this->config->guarder->punishment->{$type}->day->$item, "class='form-control'");?>
            </div>
          </td>
        </tr>
        <?php endforeach;?>
        <tr>
          <th></th>
          <td colspan='2'>
            <?php echo html::submitButton();?>
          </td>
        </tr>
      </table>
    </form>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
