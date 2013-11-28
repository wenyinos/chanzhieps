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
<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <?php if($type == 'book'):?>
    <h4 class="modal-title"><?php echo $lang->book->create;?></h4>
    <?php elseif($type == 'chapter'):?>
    <h4 class="modal-title"><?php echo $lang->book->createChapter;?></h4>
    <?php else:?>
    <h4 class="modal-title"><?php echo $lang->book->createArticle;?></h4>
    <?php endif;?>
  </div>
  <div class="modal-body">
    <form id="createForm" method='post' class="form-inline" enctype='multipart/form-data' action='<?php echo helper::createLink('help', 'create', "type=$type&bookID=$book->id")?>'>
      <table class='table table-form'>
        <?php if($type !== 'book'):?>
        <tr>
          <th class='w-100px'><?php echo $lang->article->category;?></th>
          <td><?php echo html::select("parent", $parents, $currentParent, "class='select-3 form-control'");?></td>
        </tr>
        <?php endif;?>
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
        <?php if($type !== 'book'):?>
        <tr>
          <th><?php echo $lang->book->keywords;?></th>
          <td><?php echo html::input('keywords', '', "class='text-1 form-control'");?></td>
        </tr>
        <?php endif;?>
        <tr>
          <th><?php echo $lang->book->summary;?></th>
          <td><?php echo html::textarea('summary', '', "class='area-1' rows='3'");?></td>
        </tr>
        <?php if($type == 'article'):?>
        <tr>
          <th><?php echo $lang->book->content;?></th>
          <td valign='middle'><?php echo html::textarea('content', '', "rows='6' class='area-1 form-control'");?></td>
        </tr>
        <?php endif;?>
        <tr>
          <th></th>
          <td><?php echo html::submitButton();?></td>
        </tr>
      </table>
    </form>
  </div>
</div>
<?php if(isset($pageJS)) js::execute($pageJS);?>
