<?php
/**
 * The setbasic view file of site module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     LGPL
 * @author      xiying Guang <guanxiying@xirangit.com>
 * @package     site
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<div class='row'>
<?php foreach($lang->user->oauth->providers as $providerCode => $providerName):?>
<?php $oauth = json_decode($this->config->oauth->$providerCode);?>
<div class='col-sm-6'>
  <div class='panel'>
    <div class='panel-heading'>
      <strong><i class="icon-<?php echo $providerCode; ?>"></i> <?php echo $providerName;?></strong>
      <div class='panel-actions'>
        <?php echo html::a("http://www.chanzhi.org/help-read-23.html", '<i class="icon-question-sign"></i> ' . $lang->site->oauthHelp, "target='_blank'");?>
      </div>
    </div>
    <div class='panel-body'>
      <form method='post' id='<?php echo $providerCode;?>AjaxForm' class='form-horizontal'>
        <div class='form-group'>
          <label for='verification' class='col-md-3 control-label'><?php echo $lang->user->oauth->verification;?></label>
          <div class='col-lg-8 col-md-9'>
            <?php echo html::input('verification', $oauth->verification, "class='form-control'");?>
          </div>
        </div>
        <div class='form-group'>
          <label for='clientID' class='col-md-3 control-label'><?php echo $lang->user->oauth->clientID;?></label>
          <div class='col-lg-8 col-md-9'>
            <?php echo html::input('clientID', $oauth->clientID, "class='form-control'");?>
          </div>
        </div>
        <div class='form-group'>
          <label for='clientSecret' class='col-md-3 control-label'><?php echo $lang->user->oauth->clientSecret;?></label>
          <div class='col-lg-8 col-md-9'>
            <?php echo html::input('clientSecret', $oauth->clientSecret, "class='form-control'");?>
          </div>
        </div>
        <?php if($providerCode == 'sina'):?>
        <div class='form-group'>
          <label for='widget' class='col-md-3 control-label'><?php echo $lang->user->oauth->widget;?></label>
          <div class='col-lg-8 col-md-9'>
            <?php echo html::input('widget', $oauth->widget, "class='form-control'");?>
          </div>
        </div>
        <?php endif;?>
        <div class='form-group'>
          <div class='col-md-offset-3 col-md-9'><?php echo html::submitButton() . html::hidden('provider', $providerCode);?></div>
        </div>
      </form>
    </div>
  </div>
</div>
<?php endforeach;?>
</div>

<?php include '../../common/view/footer.admin.html.php';?>
