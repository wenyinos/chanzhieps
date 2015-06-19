<?php
/**
 * The admin view file of article of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv11.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     article
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<?php include '../../common/view/treeview.html.php';?>
<?php js::set('categoryID', $categoryID);?>
<div class='panel'>
  <div class='panel-heading'>
  <?php if($type == 'blog'):?>
  <strong><i class="icon-th-large"></i> <?php echo $lang->blog->list;?></strong>
  <div class='panel-actions'><?php commonModel::printLink('article', 'create', "type={$type}&category={$categoryID}", '<i class="icon-plus"></i> ' . $lang->blog->create, 'class="btn btn-primary"');?></div>
  <?php elseif($type == 'page'):?>
  <strong><i class="icon-list-ul"></i> <?php echo $lang->page->list;?></strong>
  <div class='panel-actions'><?php commonModel::printLink('article', 'create', "type={$type}", '<i class="icon-plus"></i> ' . $lang->page->create, 'class="btn btn-primary"');?></div>
  <?php else:?>
  <strong><i class="icon-list-ul"></i> <?php echo $lang->article->list;?></strong>
  <div class='panel-actions'><?php commonModel::printLink('article', 'create', "type={$type}&category={$categoryID}", '<i class="icon-plus"></i> ' . $lang->article->create, 'class="btn btn-primary"');?></div>
  <?php endif;?>
  </div>
  <table class='table table-hover table-striped tablesorter'>
    <thead>
      <tr>
        <?php $vars = "type=$type&categoryID=$categoryID&orderBy=%s&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}";?>
        <th class='text-center w-60px'><?php commonModel::printOrderLink('id', $orderBy, $vars, $lang->article->id);?></th>
        <th class='text-center'><?php commonModel::printOrderLink('title', $orderBy, $vars, $lang->article->title);?></th>
        <?php if($type != 'page'):?>
        <th class='text-center w-200px'><?php commonModel::printOrderLink('category', $orderBy, $vars, $lang->article->category);?></th>
        <?php endif;?>
        <th class='text-center w-160px'><?php commonModel::printOrderLink('addedDate', $orderBy, $vars, $lang->article->addedDate);?></th>
        <th class='text-center w-70px'><?php commonModel::printOrderLink('views', $orderBy, $vars, $lang->article->views);?></th>
        <?php $actionClass = $type == 'page' ? 'w-200px' : 'w-220px';?>
        <th class='text-center <?php echo $actionClass;?>'><?php echo $lang->actions;?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($sticks as $stick):?>
      <tr>
        <td class='text-center'><?php echo $stick->id;?></td>
        <td>
          <?php echo $stick->title;?>
          <span class='label label-danger'><?php echo $lang->article->stick;?></span>
          <?php if($stick->status == 'draft') echo '<span class="label label-xsm label-warning">' . $lang->article->statusList[$stick->status] .'</span>';?>
        </td>
        <?php if($type != 'page'):?>
        <td class='text-center'><?php foreach($stick->categories as $category) echo $category->name . ' ';?></td>
        <?php endif;?>
        <td class='text-center'><?php echo $stick->addedDate;?></td>
        <td class='text-center'><?php echo $stick->views;?></td>
        <td class='text-center'>
          <?php
          commonModel::printLink('article', 'edit', "articleID=$stick->id&type=$stick->type", $lang->edit);
          commonModel::printLink('file', 'browse', "objectType=$stick->type&objectID=$stick->id&isImage=1", $lang->article->images, "data-toggle='modal'");
          commonModel::printLink('file', 'browse', "objectType=$stick->type&objectID=$stick->id&isImage=0", $lang->article->files, "data-toggle='modal'");
          echo html::a($this->article->createPreviewLink($stick->id), $lang->preview, "target='_blank'");
          ?>
          <?php if($type != 'page'):?>
          <span class='dropdown'>
            <a data-toggle='dropdown' href='###'><?php echo $lang->article->stick; ?><span class='caret'></span></a>
            <ul class='dropdown-menu' role='menu' aria-labelledby='dLabel'>
              <?php
              foreach($lang->article->sticks as $sticky => $label)
              {
                  if($stick->sticky != $sticky)
                  {
                      echo '<li>';
                      commonModel::printLink('article', 'stick', "article=$stick->id&stick=$sticky", $label, "class='jsoner'");
                      echo '</li>';
                  }
                  else
                  {
                      echo '<li class="active"><a href="###">' . $label . '</a></li>';
                  }
              }
              ?>
            </ul>
          </span>
          <?php endif;?>
          <span class='dropdown'>
            <a data-toggle='dropdown' href='javascript:;'><?php echo $this->lang->more;?><span class='caret'></span></a>
            <ul class='dropdown-menu pull-right'>    
              <li><?php commonModel::printLink('article', 'delete', "articleID=$stick->id", $lang->delete, 'class="deleter"');?></li>
              <li><?php commonModel::printLink('article', 'setcss', "articleID=$stick->id", $lang->article->css, "data-toggle='modal'");?></li>
              <li><?php commonModel::printLink('article', 'setjs', "articleID=$stick->id", $lang->article->js, "data-toggle='modal'");?></li>
            </ul>
          </span>
        </td>
      </tr>
      <?php unset($articles[$stick->id])?>
      <?php endforeach;?>
      <?php $maxOrder = 0; foreach($articles as $article):?>
      <tr>
        <td class='text-center'><?php echo $article->id;?></td>
        <td>
          <?php echo $article->title;?>
          <?php if($article->status == 'draft') echo '<span class="label label-xsm label-warning">' . $lang->article->statusList[$article->status] .'</span>';?>
        </td>
        <?php if($type != 'page'):?>
        <td class='text-center'><?php foreach($article->categories as $category) echo $category->name . ' ';?></td>
        <?php endif;?>
        <td class='text-center'><?php echo $article->addedDate;?></td>
        <td class='text-center'><?php echo $article->views;?></td>
        <td class='text-center'>
          <?php
          commonModel::printLink('article', 'edit', "articleID=$article->id&type=$article->type", $lang->edit);
          commonModel::printLink('file', 'browse', "objectType=$article->type&objectID=$article->id&isImage=1", $lang->article->images, "data-toggle='modal'");
          commonModel::printLink('file', 'browse', "objectType=$article->type&objectID=$article->id&isImage=0", $lang->article->files, "data-toggle='modal'");
          echo html::a($this->article->createPreviewLink($article->id), $lang->preview, "target='_blank'");
          ?>
          <?php if($type != 'page'):?>
          <span class='dropdown'>
            <a data-toggle='dropdown' href='###'><?php echo $lang->article->stick; ?><span class='caret'></span></a>
            <ul class='dropdown-menu' role='menu' aria-labelledby='dLabel'>
            <?php
              foreach($lang->article->sticks as $stick => $label)
              {
                  if($article->sticky != $stick)
                  {
                      echo '<li>';
                      commonModel::printLink('article', 'stick', "article=$article->id&stick=$stick", $label, "class='jsoner'");
                      echo '</li>';
                  }
                  else
                  {
                      echo '<li class="active"><a href="###">' . $label . '</a></li>';
                  }
              }
              ?>
            </ul>
          </span>
          <?php endif;?>
          <span class='dropdown'>
            <a data-toggle='dropdown' href='javascript:;'><?php echo $this->lang->more;?><span class='caret'></span></a>
            <ul class='dropdown-menu pull-right'>    
              <li><?php commonModel::printLink('article', 'delete', "articleID=$article->id", $lang->delete, 'class="deleter"');?></li>
              <li><?php commonModel::printLink('article', 'setcss', "articleID=$article->id", $lang->article->css, "data-toggle='modal'");?></li>
              <li><?php commonModel::printLink('article', 'setjs',  "articleID=$article->id", $lang->article->js, "data-toggle='modal'");?></li>
            </ul>
          </span>
        </td>
      </tr>
      <?php endforeach;?>
    </tbody>
    <tfoot><tr><td colspan='7'><?php $pager->show();?></td></tr></tfoot>
  </table>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
