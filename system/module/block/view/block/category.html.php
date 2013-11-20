<?php
/**
 * The category form view file of block module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Yidong wang <yidong@cnezsoft.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
*/
?>
<?php include '../../common/view/chosen.html.php';?>
<?php $categories = $this->loadModel('tree')->getOptionMenu('article');?>
<tr>
  <th><?php echo $lang->block->category->type;?></th>
  <td><?php echo html::select('params[type]', $lang->block->category->typeList, isset($block->content->type) ? $block->content->type : '', "class='select-4'");?></td>
</tr>
<tr>
  <th><?php echo $lang->block->category->show;?></th>
  <td><?php echo html::select('params[show]', $lang->block->category->showList, isset($block->content->show) ? $block->content->show : '', "class='select-4' onchange='show(this.value)'");?></td>
</tr>
<tr id='parent'>
  <th><?php echo $lang->block->category->parent;?></th>
  <td><?php echo html::select('params[parnet]', array('' => '') + $categories, isset($block->content->parent) ? $block->content->parent : '', "class='select-4'");?></td>
</tr>
<tr id='selected'>
  <th><?php echo $lang->block->category->content;?></th>
  <td><?php echo html::select('params[selected][]', $categories, isset($block->content->selected) ? $block->content->selected : '', "class='select-1 chosen' multiple='multiple'");?></td>
</tr>
<script>
$(function(){show('<?php echo isset($block->content->show) ? $block->content->show : ''?>')})
function show(type)
{
    if(type == 'selected')
    {
        $('#selected').show();
        $('#parent').hide();
    }
    else
    {
        $('#selected').hide();
        $('#parent').show();
    }
}
</script>
