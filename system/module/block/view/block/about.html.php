<?php
/**
 * The about front view file of block module of chanzhiEPS.
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
$blockClass = '';
if($block->borderless) $blockClass .= 'panel-borderless';
if($block->titleless) $blockClass  .= 'panel-titleless';
?>
<div id="block<?php echo $block->id;?>" class='panel panel-block <?php echo $blockClass;?>'>
  <div class='panel-heading'>
    <h4><i class="<?php echo isset($block->icon) ? $block->icon : 'icon-group';?>"></i> <?php echo $block->title;?></h4>
  </div>
  <div class='panel-body'>
    <div class='article-content'><?php echo $this->config->company->desc;?></div>
    <?php echo html::a(helper::createLink('company', 'index'), $this->lang->more . $this->lang->raquo);?>
  </div>
</div>
