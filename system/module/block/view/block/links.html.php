<?php
/**
 * The link front view file of block module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     http://api.chanzhi.org/goto.php?item=license 
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
*/
?>
<?php if(!empty($this->config->links->index)):?>
<div id="block<?php echo $block->id;?>" class='panel panel-block clearfix links <?php echo $blockClass;?>'>
  <div class='heading'><strong><span class='icon'><?php echo $icon;?></span><span class='title'><?php echo $this->lang->link;?></span></strong></div>
  <div class='body'>
    <?php echo $this->config->links->index;?>
    <?php if(trim(strip_tags($this->config->links->all, '<a>'))) echo html::a(helper::createLink('links', 'index'), $this->lang->more . "<i class='icon-double-angle-right'></i>"); ?>
  </div>
</div>
<?php endif;?>
