<?php
/**
 * The setBlacklist view file of guard module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Qiaqia LI <liqiaqia@cnezsoft.cn>
 * @package     guard
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<div class='panel'>
  <div class='panel-heading'>
    <strong><i class='icon-globe'></i> <?php echo $lang->guarder->setBlacklist;?></strong>
    <?php echo '&nbsp; &nbsp; &nbsp;';?>
    <?php foreach($lang->guarder->blacklistModes as $code => $modeName):?>
    <?php $class = $mode == $code ? "class='active'" : '';?>
    <?php echo html::a(inlink('setBlacklist', "mode=$code"), $modeName, $class);?>
    <?php endforeach;?>
    <span class='panel-actions'><?php commonModel::printLink('guarder', 'addblacklist', '', '<i class="icon-plus"></i> ' . $lang->guarder->addBlacklist, 'class="btn btn-primary" data-toggle="modal"');?></span>
  </div>
  <table class='table table-bordered'>
    <thead>
      <tr>
        <th><?php echo $lang->blacklist->identity;?></th>
        <th class='text-center w-300px'><?php echo $lang->blacklist->expiredDate;?></th>
        <th><?php echo $lang->blacklist->reason;?></th>
        <th class='text-center w-200px'><?php echo $lang->guarder->action;?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($blacklist as $object):?>
      <tr>
        <td>
        <?php echo $object->identity;?>
        </td>
        <td>
        <?php echo ($object->expiredDate == '0000-00-00 00:00:00') ? $lang->guarder->permanent : $object->expiredDate;?>
        </td>
        <td>
        <?php echo $object->reason;?>
        </td>
        <td class='text-center text-middle'>
          <?php commonModel::printLink('guarder', 'delete', "type=$object->type&identity=$object->identity", $lang->delete, "class='deleter'");?>
        </td>
      </tr>
      <?php endforeach;?>
    </tbody>
    <tfoot><tr><td colspan='7' class='text-right'><?php $pager->show();?></td></tr></tfoot>
  </table>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
