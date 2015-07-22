<?php
/**
 * The install view file of package module of ChanZhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1 (http://www.chanzhi.org/license/)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     ui
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.modal.html.php';?>
<?php js::set('browseLink', inlink('browse'));?>
<?php if($blocksMerged and empty($error)):?>
  <form method='post' action= '<?php echo inlink('fixTheme');?>' id="ajaxForm">
  <table class='table tabel-condensed'>
    <tr>
      <th class='w-120px'><?php echo $lang->ui->importedBlocks;?></th>
      <th><?php echo $lang->ui->matchedBlock;?></th>
    </tr>
    <?php foreach($importedBlocks as $newBlock):?>
    <tr>
      <td class='text-middle'><?php echo $newBlock->title;?></td>
      <td>
        <div class='input-group'>
          <select name='blocks2Merge[<?php echo $newBlock->originID?>]' class='form-control'>
            <option value='0'></option>
            <?php $selected = '';?>
            <?php foreach($oldBlocks as $block):?>
              <?php $selected = ((strpos(',html,htmlcode,php,', ",{$newBlock->type},") === false) and $selected == '' and $block->type == $newBlock->type) ? 'selected' : '';?>
              <option value='<?php echo $block->id?>' <?php echo $selected?>><?php echo $block->title;?></option>
            <?php endforeach;?>
          </select>
          <span class='input-group-addon'>
          <?php echo html::checkbox('block2Create[]', array($newBlock->id => $lang->ui->createBlock));?>
          </span>
        </div>
      </td>
    </tr>
    <?php endforeach;?>
    <tr><td colspan='3'><?php echo html::submitButton() . html::hidden('package', $package)?></td></tr>
  </table>
</form>
<?php elseif($error):?>
  <div class='alert alert-default'>
    <i class='icon-remove-sign'></i>
    <div class='content'>
      <h4><?php sprintf($lang->package->installFailed, 'install');?></h4>
      <p><?php echo $error;?></p>
      <hr>
      <?php echo html::a('javascript:;', $lang->package->refreshPage, "class='btn btn-reload'");?>
    </div>
  </div>
<?php endif;?>
<?php include '../../common/view/footer.modal.html.php';?>
