<?php
/**
 * The browse view file of extension module of ChanZhiEPS.
 *
 * @copyright   Copyright 2009-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     http://api.chanzhi.org/goto.php?item=license
 * @author      Chunsheng Wang <chunsheng@xirangit.com>
 * @package     extension
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<div class='panel'>
  <div class='panel-heading'>
    <strong><?php echo $lang->extension->common;?></strong>
    <?php
    echo '&nbsp; &nbsp; &nbsp;';
    echo html::a(inlink('browse', "status=installed"),   $lang->extension->installed,   $status == 'installed' ? "class='active'" : '');
    echo html::a(inlink('browse', "status=deactivated"), $lang->extension->deactivated, $status == 'deactivated' ? "class='active'" : '');
    echo html::a(inlink('browse', "status=available"), $lang->extension->available,   $status == 'available' ? "class='active'" : '');
    ?>
    <div class='panel-actions'>
      <?php echo html::a(inlink('upload'), $lang->extension->upload, "class='btn btn-primary' data-toggle='modal'");?>
      <?php echo html::a(inlink('obtain'), $lang->extension->obtain, "class='btn btn-primary'");?>
    </div>
  </div>
  <div class='panel-body'>
  <div class='cards'>
    <?php foreach($extensions as $extension):?>
    <div class='col-md-6'><div class='card'>
      <div class='card-heading'><strong><?php echo $extension->name;?></strong></div>
      <div class='card-content text-muted'><?php echo $extension->desc;?></div>
        <div class='card-actions'>
          <div class='pull-right'>
            <div class='btn-group'>
              <?php
              $structureCode  = html::a(inlink('structure',  "extension=$extension->code"), $lang->extension->structure,  "class='btn' data-toggle='modal'");
              $deactivateCode = html::a(inlink('deactivate', "extension=$extension->code"), $lang->extension->deactivate, "class='btn' data-toggle='modal'");
              $activateCode   = html::a(inlink('activate',   "extension=$extension->code"), $lang->extension->activate,   "class='btn' data-toggle='modal'");
              $uninstallCode  = html::a(inlink('uninstall',  "extension=$extension->code"), $lang->extension->uninstall,  "class='btn' data-toggle='modal'");
              $installCode    = html::a(inlink('install',    "extension=$extension->code"), $lang->extension->install,    "class='btn' data-toggle='modal'");
              $eraseCode      = html::a(inlink('erase',      "extension=$extension->code"), $lang->extension->erase,      "class='btn' data-toggle='modal'");
              
              if(isset($extension->viewLink))
              {
                  echo html::a($extension->viewLink, $lang->extension->view, "class='btn extension'");
              }
              if($extension->status == 'installed')
              {
                  echo $structureCode;
              }
              if($extension->status == 'installed' and !empty($extension->upgradeLink))
              {
                  echo html::a($extension->upgradeLink, $lang->extension->upgrade, "class='btn iframe'");
              }
   
              if($extension->type != 'patch')
              {
                  if($extension->status == 'installed')   echo $deactivateCode . $uninstallCode;
                  if($extension->status == 'deactivated') echo $activateCode   . $uninstallCode;
                  if($extension->status == 'available')   echo $installCode    . $eraseCode;
              }
              echo html::a($extension->site, $lang->extension->site, 'class=btn');
              ?>          
            </div>
          </div>
          <?php
          echo "{$lang->extension->version}: <i>{$extension->version}</i> ";
          echo "{$lang->extension->author}:  <i>{$extension->author}</i> ";
          ?>
        </div>
      </div></div>
      <?php endforeach;?>
    </div>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
