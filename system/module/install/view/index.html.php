<?php
/**
 * The html template file of index method of install module of chanzhiEPS.
 *
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     LGPL
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     chanzhiEPS
 * @version     $Id: index.html.php 867 2010-06-17 09:32:58Z wwccss $
 */
?>
<?php include '../../common/view/header.lite.html.php';?>
<div class='container'>
  <div class='modal-dialog'>
    <div class='modal-body'>
      <h3><?php echo $lang->install->welcome;?></h3>
      <div><?php echo $lang->install->desc;?></div>
    </div>
    <div class='modal-footer'>
      <button class='btn dropdown'><?php include '../../common/view/selectlang.html.php';?></button>
      <?php
      if(!isset($latestRelease))
      {
          echo html::a($this->createLink('install', 'step1'), $lang->install->start, "class='btn btn-primary'");
      }
      else
      {
          echo $lang->install->choice;
          echo html::a($latestRelease->url, $lang->install->seeLatestRelease, "target='_blank'");
          echo ' &nbsp; ' . html::a($this->createLink('install', 'step1'), $lang->install->keepInstalling, "class='btn btn-primary'");
      }
      ?>
    </div>
  </div>
</div>
<?php include './footer.html.php';?>
