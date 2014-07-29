<?php
/**
 * The install view file of extension module of ChanZhiEPS.
 *
 * @copyright   Copyright 2009-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     http://api.chanzhi.org/goto.php?item=license
 * @author      Chunsheng Wang <chunsheng@xirangit.com>
 * @package     extension
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.modal.html.php';?>
<?php js::set('browseLink', inlink('browse'));?>
<?php if($error):?>
<div class='alert alert-danger'>
  <i class='icon-remove-sign'></i>
  <div class='content'>
    <h4><?php sprintf($lang->extension->installFailed, $installType);?></h4>
    <p><?php echo $error;?></p>
    <hr>
    <?php echo html::a('jaascript:;', $lang->extension->refreshPage, "class='btn btn-reload'");?>
  </div>
</div>
<?php elseif(isset($license)):?>
<div class='alert'>
  <i class='icon-info-sign'></i>
  <div class='content'>
    <h4><?php echo $lang->extension->license;?></h4>
    <p><?php echo html::textarea('license', $license, "class='form-control' disabled rows='15'");?></p>
    <?php echo html::a($agreeLink, $lang->extension->agreeLicense, "class='btn btn-primary loadInModal'");?>
  </div>
</div>
<?php else:?>
<div class='alert alert-success'>
  <h4><i class='icon-ok-sign'></i> <?php echo $lang->extension->successDownloadedPackage;?></h4>
  <h1 class='text-center'><?php echo sprintf($lang->extension->installFinished, $installType);?></h1>
  <div class='text-center'>
    <?php echo html::a('javascript:;', $lang->extension->viewInstalled, "class='btn btn-success' onclick='return parent.location.href=v.browseLink'");?>
  </div>
  <hr>
  <?php
  echo "<h3 class='success'>{$lang->extension->successCopiedFiles}</h3>";
  echo '<ul>';
  foreach($files as $fileName => $md5)
  {
      echo "<li>$fileName</li>";
  }
  echo '</ul>';
  echo "<h3 class='success'>{$lang->extension->successInstallDB}</h3>";
  ?>
</div>
<?php endif;?>
<?php include '../../common/view/footer.modal.html.php';?>
