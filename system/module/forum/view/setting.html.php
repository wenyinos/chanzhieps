<?php include '../../common/view/header.admin.html.php'; ?>
<div class='panel'>
  <div class='panel-heading'><strong><i class='icon-globe'></i> <?php echo $lang->forum->setting;?></strong></div>
  <div class='panel-body'>
    <form id='ajaxForm' action="<?php echo inlink('setting');?>" method='post'>
      <table class='table table-form'>
        <tr>
          <th class='col-xs-2'><?php echo $lang->forum->threadCheck;?></th> 
          <td class='col-xs-2'><?php echo html::radio('threadCheck', $lang->forum->threadCheckOptions, isset($this->config->forum->threadCheck) ? $this->config->forum->threadCheck : 'close', "class='checkbox'");?></td><td></td>
        </tr>
        <tr>
          <th></th>
          <td colspan='2'>
            <?php echo html::submitButton();?>
          </td>
        </tr>
      </table>
    </form>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
