<?php
/**
 * The link front view file of block module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     http://api.chanzhi.org/goto.php?item=license (http://www.gnu.org/licenses/lgpl.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
*/
?>
<?php if(!empty($this->config->links->index)):?>
<div id="block<?php echo $block->id;?>" class='panel panel-block links <?php echo $blockClass;?>'>
  <strong class='heading'><?php echo $icon . $this->lang->link; ?></strong>
  <?php echo $this->config->links->index;?>
  <?php if(trim(strip_tags($this->config->links->all, '<a>'))) echo html::a(helper::createLink('links', 'index'), $this->lang->more . "<i class='icon-double-angle-right'></i>"); ?>
</div>
<?php endif;?>
