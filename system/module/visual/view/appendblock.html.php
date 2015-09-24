<?php include "header.html.php"; ?>
<?php
echo html::a('###', "<i class='icon icon-plus'> </i>" . $lang->visual->createBlock, "class='btn btn-primary' id='createBlockBtn'");
commonModel::printLink('block', 'admin', '', "<i class='icon icon-cog'> </i>" . $lang->visual->manageBlock, "class='btn' target='_blank'");
?>
<hr>
<div class='row row-main'>
  <?php foreach($config->block->categoryList as $category => $blockList):?>
  <div class='col col-xs-3'>
    <h4><?php echo $lang->block->categoryList[$category];?></h4>
    <ul class='nav nav-blocks'>
      <?php foreach($blocks as $block):?>
      <?php if(strpos($blockList, ",$block->type,") !== false):?>
      <li><a href='###' class='btn-add-block' title="<?php echo $block->title?>" data-id='<?php echo $block->id;?>'><?php echo helper::subStr($block->title, 20);?></a></li>
      <?php endif;?>
      <?php endforeach;?>
    </ul>
  </div>
  <?php endforeach;?>
</div>
<script>
$(function()
{
    $(document).on('click', '.btn-add-block:not(.disabled)', function()
    {
        window.parent.$.addBlock('<?php echo $page?>', '<?php echo $region?>', $(this).data('id'), '<?php echo $parent?>');
    });

    $('#createBlockBtn').on('click', function()
    {
        window.parent.$.createBlock('<?php echo $page?>', '<?php echo $region?>', '<?php echo $parent?>');
    });
});
</script>
<?php include "footer.html.php"; ?>
