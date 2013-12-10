<?php
/**
 * The create book view file of book of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     LGPL
 * @author      Tingting Dai<daitingting@xirangit.com>
 * @package     book
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php'; ?>
<?php 
$path = 0;
if($parent) $path = array_keys($parent->pathNames);
js::set('path', json_encode($path));
?>
<?php if(!$parent):?>
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
          <span class="input-group-addon">http://<?php echo $this->server->http_host . $config->webRoot?>book/</span>
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
    <caption><?php echo $lang->book->create;?></caption>
    <thead>
      <tr class='a-center'>
        <th class='w-p10'><?php echo $lang->book->type;?></th>
        <th class='w-p10'><?php echo $lang->book->author;?></th>
        <th><?php echo $lang->book->title;?></th>
        <th class='w-p30'><?php echo $lang->book->alias;?></th>
        <th class='w-p10'><?php echo $lang->book->keywords;?></th>
        <th class='w-80px'><?php echo $lang->actions; ?></th>
      </tr>
    </thead>
    <tbody>
    <?php foreach($catalogues as $catalogue):?>
    <tr class='v-middle a-center'>
      <td><?php echo html::select("type[$catalogue->id]", $lang->book->typeList, $catalogue->type, "class='select-1'");?></td>
      <td><?php echo html::input("author[$catalogue->id]", $catalogue->author, "class='text-1'");?></td>
      <td><?php echo html::input("title[$catalogue->id]", $catalogue->title, "class='text-1'");?></td>
      <td><?php echo html::input("alias[$catalogue->id]", $catalogue->alias, "class='text-1'");?></td>
      <td><?php echo html::input("keywords[$catalogue->id]", $catalogue->keywords, "class='text-1'");?></td>
      <td><i class='icon-arrow-up'></i> <i class='icon-arrow-down'></i><?php echo html::hidden("order[$catalogue->id]", $catalogue->order, "class='order'");?><?php echo html::hidden("mode[$catalogue->id]", 'update');?></td>
    </tr>
    <?php endforeach;?>
    <?php for($i = 0; $i < BOOK::NEW_CATALOGUE_COUNT ; $i ++):?>
    <tr class='v-middle a-center'>
      <td><?php echo html::select("type[]", $lang->book->typeList, '', "class='select-1'");?></td>
      <td><?php echo html::input("author[]", $app->user->realname, "class='text-1'");?></td>
      <td><?php echo html::input("title[]", '', "class='text-1'");?></td>
      <td><?php echo html::input("alias[]", '', "class='text-1' placeholder='{$lang->alias}'");?></td>
      <td><?php echo html::input("keywords[]", '', "class='text-1'");?></td>
      <td><i class='icon-arrow-up'></i> <i class='icon-arrow-down'></i><?php echo html::hidden("order[]", '', "class='order'");?><?php echo html::hidden("mode[]", 'new');?></td>
    </tr>
    <?php endfor;?>
    </tbody>
    <tfoot>
      <tr><td colspan='5' class='a-center'><?php echo html::submitButton();?></td></tr>
    </tfoot>
  </table>
</form>
<?php endif;?>
<?php include '../../common/view/footer.admin.html.php';?>
