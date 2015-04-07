<?php
/**
 * The manage privilege by group view of group module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv11.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     group
 * @version     $Id: managepriv.html.php 1517 2011-03-07 10:02:57Z wwccss $
 * @link        http://www.zentao.net
 */
?>
<form class='form-condensed' method='post' id='ajaxForm'>
  <div class='panel'>
    <div class='panel-heading'><i class='icon-lock'> <?php echo $group->name;?></i></div>
    <table class='table table-hover table-striped table-bordered table-form'> 
      <thead>
        <tr>
          <th><?php echo $lang->group->module;?></th>
          <th><?php echo $lang->group->method;?></th>
        </tr>
      </thead>
      <?php foreach($lang->resource as $moduleName => $moduleActions):?>
      <tr class='<?php echo cycle('even, bg-gray');?>'>
        <th class='text-right w-150px'>
          <?php echo $this->lang->$moduleName->common;?>
          <input type="checkbox" class='checkModule' />
        </th>
        <td id='<?php echo $moduleName;?>' class='pv-10px'>
          <?php $i = 1;?>
          <?php foreach($moduleActions as $action => $actionLabel):?>
          <div class='group-item'>
            <input type='checkbox' name='actions[<?php echo $moduleName;?>][]' value='<?php echo $action;?>' <?php if(isset($groupPrivs[$moduleName][$action])) echo "checked";?> />
            <span class='priv' id="<?php echo $moduleName . '-' . $actionLabel;?>"><?php echo isset($lang->$moduleName->$actionLabel) ? $lang->$moduleName->$actionLabel : $lang->$actionLabel;?></span>
          </div>
          <?php endforeach;?>
        </td>
      </tr>
      <?php endforeach;?>
      <tr>
        <th class='text-right'>
          <?php echo $lang->group->selectAll?>
          <input type="checkbox" class='selectAll' />
        </th>
        <td>
          <?php 
          echo html::submitButton($lang->save, 'btn', "onclick='setNoChecked()'");
          echo html::linkButton($lang->goback, $this->createLink('group', 'browse'));
          echo html::hidden('foo'); // Just a hidden var, to make sure $_POST is not empty.
          echo html::hidden('noChecked'); // Save the value of no checked.
          ?>
        </td>
      </tr>
    </table>
  </div>
</form>
<script type='text/javascript'>
var groupID = <?php echo $groupID?>;
</script>
