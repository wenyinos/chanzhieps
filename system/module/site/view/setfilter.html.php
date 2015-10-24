<?php
/**
 * The setbasic view file of site module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1 (http://www.chanzhi.org/license/)
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
  </div>
  <div class='panel-body'>
    <form method='post' id='ajaxForm' class='form-inline'>
      <table class='table table-form w-600px'>
        <?php foreach($lang->guarder->operationList as $item => $operation):?>
        <tr>
          <th rowspan='2' class='text-middle text-center w-100px'><?php echo $operation;?></th>
          <td>
            <div class='input-group'>
              <?php echo html::input("interval[$item]", zget($this->config->guarder->interval->{$type}, $item), "class='form-control'");?>
              <span class='input-group-addon'><?php echo $lang->guarder->interval?></span>
            </div>
          </td>
          <td>
            <div class='input-group'>
              <span class='input-group-addon'><?php echo $lang->guarder->exceed?></span>
              <?php echo html::input("limits[minute][{$item}]", $this->config->guarder->limits->{$type}->minute->$item, "class='form-control'");?>
            </div>
          </td>
          <td>
            <div class='input-group'>
              <span class='input-group-addon'><?php echo $lang->guarder->disable?></span>
              <?php echo html::input("punishment[minute][{$item}]", $this->config->guarder->punishment->{$type}->minute->$item, "class='form-control'");?>
              <span class='input-group-addon'><?php echo $lang->guarder->hours?></span>
            </div>
          </td>
        </tr>
        <tr>
          <td colspan='2'>
            <div class='input-group'>
              <span class='input-group-addon'><?php echo $lang->guarder->perDay?></span>
              <?php echo html::input("limits[day][{$item}]", $this->config->guarder->limits->{$type}->day->$item, "class='form-control'");?>
            </div>
          </td>
          <td>
            <div class='input-group'>
              <span class='input-group-addon'><?php echo $lang->guarder->disable?></span>
              <?php echo html::input("punishment[day][{$item}]", $this->config->guarder->punishment->{$type}->day->$item, "class='form-control'");?>
              <span class='input-group-addon'><?php echo $lang->guarder->hours?></span>
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
