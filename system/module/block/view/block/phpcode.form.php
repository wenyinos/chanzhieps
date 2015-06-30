<?php
/**
 * The php code block form view file of block module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv11.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
*/
?>
<?php include '../../common/view/codeeditor.html.php';?>
<tr>
  <th><?php echo $lang->block->phpcode;?></th>
  <td><?php echo html::textarea('content', isset($block) ? $block->content : '<?php', "rows=20 class='form-control codeeditor' data-mode='php'");?></td>
</tr>
