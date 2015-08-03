<?php
/**
 * The aboutus view file of company for mobile template of chanzhiEPS.
 * The view should be used as ajax content
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1 (http://www.chanzhi.org/license/)
 * @author      Hao Sun <daitingting@xirangit.com>
 * @package     product
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<div class='modal-dialog'>
  <div class='modal-content'>
    <div class='modal-header'>
      <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>×</span></button>
      <h5 class='modal-title'><?php echo $lang->aboutUs?></h5>
    </div>
    <div class='modal-body'>
      <div class='article-content'>
        <?php echo $company->content;?>
      </div>
    </div>
  </div>
</div>

