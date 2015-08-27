<?php
/**
 * The aboutus view file of company for mobile template of chanzhiEPS.
 * The view should be used as ajax content
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1 (http://www.chanzhi.org/license/)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     company
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include TPL_ROOT . 'common/header.html.php';?>
<div class='block-region region-top no-padding'><?php $this->block->printRegion($layouts, 'company_index', 'top');?></div>
<div class='article-content'>
  <?php echo $company->content;?>
</div>
<div class='block-region region-bottom no-padding'><?php $this->block->printRegion($layouts, 'company_index', 'bottom');?></div>
