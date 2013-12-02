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
  <?php if($parent == 0):?>
  <form id='ajaxForm' method='post' class='form-inline'>
    <table class='table table-form'>
      <caption><?php echo $lang->book->createBook;?></caption>
      <tr>
        <th><?php echo $lang->book->author;?></th>
        <td><?php echo html::input('author', $app->user->realname, "class='text-3 form-control'");?></td>
      </tr>
      <tr>
        <th class="w-100px"><?php echo $lang->book->title;?></th>
        <td><?php echo html::input('title', '', 'class=text-1');?></td>
      </tr>
      <tr>
        <th><?php echo $lang->book->alias;?></th>
        <td>
          <div class="input-group text-1">
            <span class="input-group-addon">http://<?php echo $this->server->http_host . $config->webRoot?>book/id@</span>
            <?php echo html::input('alias', '', "class='text-1 form-control' placeholder='{$lang->alias}'");?>
            <span class="input-group-addon">.html</span>
          </div>
        </td>
      </tr>
      <tr>
        <th><?php echo $lang->book->summary;?></th>
        <td><?php echo html::textarea('summary', '', "class='area-1' rows='3'");?></td>
      </tr>
      <tr>
        <th></th><td><?php echo html::submitButton();?></td>
      </tr>
    </table>
  </form>
  <?php else:?>
  <form id='ajaxForm' method='post'>
    <table class='table table-hover table-striped'>
      <caption><?php echo $lang->book->createCatalogue;?></caption>
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
  <?php endif;?>
<?php include '../../common/view/footer.admin.html.php';?>
