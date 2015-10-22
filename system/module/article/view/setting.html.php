<?php include '../../common/view/header.admin.html.php';?>
<?php include '../../common/view/treeview.html.php';?>
<div class='panel'>
  <div class='panel-heading'><strong><i class='icon-globe'></i> <?php echo $lang->article->setting;?></strong></div>
  <div class='panel-body'>
    <form id='ajaxForm' action="<?php echo inlink('setting');?>" method='post'>
      <table class='table table-form'>
        <tr>
          <th class='col-xs-2'><?php echo $lang->article->contribution;?></th> 
          <td class='col-xs-2'><?php echo html::radio('contribution', $lang->article->contributionOptions, $config->article->contribution, "class='checkbox'");?></td><td></td>
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
