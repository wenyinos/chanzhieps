<?php
/**
 * The category form view file of block module of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Yidong wang <yidong@cnezsoft.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
*/
?>
<style>
ul{padding-left:0px;}
li{list-style:none; margin-bottom:5px;}
.icon-plus, .icon-remove, .icon-arrow-up, .icon-arrow-down{cursor:pointer}
</style>
<?php include '../../common/view/chosen.html.php';?>
<tr>
  <th><?php echo $lang->block->content;?></th>
  <td>
    <ul>
      <?php 
      $block->content->item  = explode(',', $block->content->item);
      $block->content->value = explode(',', $block->content->value);
      foreach($block->content->item as $i => $item)
      {
          if(empty($item)) continue;

          $entry  = "<li>";
          $entry .= html::select("params[item][]", $this->lang->block->contact->itemList, $item, "class='select-2'");
          $entry .= html::input("params[value][]", $block->content->value[$i], "class='text-5'");
          $entry .= "<i class='icon-plus plus'></i> <i class='icon-remove remove'></i> <i class='icon-arrow-up'></i> <i class='icon-arrow-down'></i>";
          $entry .= '</li>';
          echo $entry;
      }

      $entry  = "<li>";
      $entry .= html::select("params[item][]", $this->lang->block->contact->itemList, '', "class='select-2'");
      $entry .= html::input("params[value][]", '', "class='text-5'");
      $entry .= "<i class='icon-plus plus'></i> <i class='icon-remove remove'></i> <i class='icon-arrow-up'></i> <i class='icon-arrow-down'></i>";
      $entry .= '</li>';
      echo $entry;
      ?>
    </ul>  
  </td>    
</tr>
</span>
<script>
$(function(){
    $(document).on('click', '.plus', function()
    {
        $(this).parent().after('<li>' + $(this).parent().html() + '</li>');
        $(this).parent().next().find('select').val('');
        $(this).parent().next().find('input').val('');
    });
    /* sort up. */
    $(document).on('click', '.icon-arrow-up', function()
    {
        $(this).parent().prev().before($(this).parent()); 
    });

    /* sort down. */
    $(document).on('click', '.icon-arrow-down', function()
    { 
        var hasNext = $(this).parent().next().find('input').size() > 0;
        if(hasNext) $(this).parent().next().after($(this).parent()); 
    });

    /* delete. */
    $(document).on('click', '.remove', function()
    {
        var count = $(this).parent().parent().find('li').size();
        if(count == 1) return;
        $(this).parent().remove();
    });
});
</script>
