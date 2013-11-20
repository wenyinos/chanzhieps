<?php
/**
 * The article form view file of block module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 ?ൺϢ????????Ϣ???޹?˾ (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
*/
?>
<?php include '../../common/view/chosen.html.php';?>
<?php $categories = $this->loadModel('tree')->getOptionMenu('article');?>
<tr>
  <th><?php echo $lang->block->articleType;?></th>
  <td><?php echo html::select('params[articleTypeList]', $lang->block->articleTypeList, isset($block->content->articleTypeList) ? $block->content->articleTypeList : '', "class='select-3'");?></td>
</tr>
<tr>
  <th><?php echo $lang->block->limit;?></th>
  <td><?php echo html::input('params[limit]', isset($block->content->limit) ? $block->content->limit : '', "class='text-3'");?></td>
</tr>
<tr>
  <th><?php echo $lang->block->category;?></th>
  <td><?php echo html::select('params[category][]', $categories, isset($block) ? $block->content->category : '', "class='text-3 chosen' multiple='multiple'");?></td>
</tr>
<tr>
  <th><?php echo $lang->block->showImage;?></th>
  <td><?php echo html::checkbox('params[image]', $lang->block->image, isset($block) ? $block->content->image : '');?></td>
</tr>
