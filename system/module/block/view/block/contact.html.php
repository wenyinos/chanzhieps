<?php
/**
 * The contact front view file of block module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Yidong wang <yidong@cnezsoft.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
*/
?>
<?php
$contact = $this->loadModel('company')->getContact();
$publicList = $this->loadModel('wechat')->getList();
?>
<div id="block<?php echo $block->id;?>" class='panel panel-block <?php echo $blockClass;?>'>
  <div class='panel-heading'>
    <h4><?php echo $icon . $block->title;?></h4>
  </div>
  <div class='panel-body'>
    <table class='table table-data'>
      <?php foreach($contact as $item => $value):?>
      <tr>
        <th><?php echo $this->lang->company->$item . $this->lang->colon;?></th>
        <td><?php echo $value;?></td>
      </tr>
      <?php endforeach;?>
    </table>
  </div>
  <div class='hidden-sm hidden-xs'>
    <table class='w-p100'>
      <tr>
      <?php foreach($publicList as $public):?>
      <?php if(!$public->qrcode) continue;?>
        <td class='wechat-block'>
          <div class='qrcode'><?php echo html::image($public->qrcode, "class='w-180px'");?></div>
          <div class='name'><?php echo $public->name;?></div>
        </td>
      <?php endforeach;?>
      </tr>
    </table>
  </div>
</div>
