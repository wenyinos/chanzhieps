<?php
/**
 * The create book view file of help of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     LGPL
 * @author      Tingting Dai<daitingting@xirangit.com>
 * @package     help
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php'; ?>
<form id='ajaxForm' method='post'>
  <table class='table table-hover table-striped'>
    <caption><?php echo $lang->book->create;?></caption>
    <thead>
      <tr>
        <th class='w-p15 a-center'><?php echo $lang->book->type;?></th>
        <th class='a-center'><?php echo $lang->book->title;?></th>
        <th class='w-p15'><?php echo $lang->actions; ?></th>
      </tr>
    </thead>
    <tbody id='entry'>
      <?php
      $maxOrder = 0;
      foreach($catalogues as $catalogue):
      ?>
      <tr class='v-middle'>
      <?php
        if($book->order > $maxOrder) $maxOrder = $catalogue->order;
        echo '<td>' . html::select("type[$catalogue->id]", $lang->book->typeList, $catalogue->type, "class='select-2'") . '</td>';
        echo '<td>' . html::input("title[$catalogue->id]", $catalogue->title, "class='text-1'") . '</td>';
        echo "<td><i class='icon-arrow-up'></i><i class='icon-arrow-down'></i></td>";
        echo '<td>' . html::hidden("mode[$catalogue->id]", 'update') . '</td>';
      ?>
      </tr>
      <?php endforeach;?>
      <?php
      for($i = 0; $i < HELP::NEW_CATALOGUE_COUNT ; $i ++)
      {
         echo '<tr>';
                echo '<td>' . html::select("type[]", $lang->book->typeList, '', "class='select-2'") . '</td>';
                echo '<td>' . html::input("title[]", '', "class='text-1'") . '</td>';
                echo "<td><i class='icon-arrow-up'></i> &nbsp;<i class='icon-arrow-down'></i></td>";
                echo '<td>' . html::hidden("mode[]", 'new') . '</td>';
         echo '</tr>';
      }
      ?>
    </tbody>
    <tfoot>
      <tr><td colspan='2' class='a-center'><?php echo html::submitButton() . html::hidden('parent', $parent) . html::hidden('maxOrder', $maxOrder);?></td></tr>
    </tfoot>
  </table>
</form>
<?php include '../../common/view/footer.admin.html.php';?>
