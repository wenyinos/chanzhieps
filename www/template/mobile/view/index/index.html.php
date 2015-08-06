<?php
/**
 * The index view file for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1 (http://www.chanzhi.org/license/)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     index
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include TPL_ROOT . 'common/header.html.php';?>

<div id='focus'>
  <div id='focusTop' class='focus-region focus-top'>
    <?php $this->block->printRegion($layouts, 'index_index', 'top', false);?>
  </div>
  <div id='focusMiddle' class='focus-region focus-middle'>
    <?php $this->block->printRegion($layouts, 'index_index', 'middle', false);?>
  </div>
  <div id='focusBottom' class='focus-region focus-bottom'>
    <?php $this->block->printRegion($layouts, 'index_index', 'bottom', false);?>
  </div>
</div>

<?php include TPL_ROOT . 'common/footer.html.php';?>
