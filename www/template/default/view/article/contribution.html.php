<?php include TPL_ROOT . 'common/header.html.php';?>
<div class='page-user-control'>
  <div class='row'>
    <?php include TPL_ROOT . 'user/side.html.php';?>
    <div class='col-md-10'>
      <div class='panel'>
        <div class='panel-heading'><strong><i class='icon-envelope-alt'></i> <?php echo $lang->user->contribution;?></strong>
          <div class='panel-actions'><?php commonModel::printLink('article', 'create', "type={$type}&category=0", '<i class="icon-plus"></i> ' . $lang->article->contribution, 'class="btn btn-primary"');?></div>
        </div>
        <table class='table table-hover table-striped tablesorter'>
          <thead>
            <tr>
              <?php $vars = "orderBy=%s&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}";?>
              <th class='text-center w-60px'><?php commonModel::printOrderLink('id', $orderBy, $vars, $lang->article->id);?></th>
              <th class='text-center'><?php commonModel::printOrderLink('title', $orderBy, $vars, $lang->article->title);?></th>
              <th class='text-center w-200px'><?php commonModel::printOrderLink('category', $orderBy, $vars, $lang->article->category);?></th>
              <th class='text-center w-160px'><?php commonModel::printOrderLink('editedDate', $orderBy, $vars, $lang->article->submissionTime);?></th>
              <th class='text-center w-160px'><?php commonModel::printOrderLink('contribution', $orderBy, $vars, $lang->article->status);?></th>
              <th class='text-center w-70px'><?php commonModel::printOrderLink('views', $orderBy, $vars, $lang->article->views);?></th>
              <?php $actionClass = 'w-260px';?>
              <th class="text-center <?php echo $actionClass;?>"><?php echo $lang->actions;?></th>
            </tr>
          </thead>
          <tbody>
            <?php $maxOrder = 0; foreach($articles as $article):?>
            <tr>
              <td class='text-center'><?php echo $article->id;?></td>
              <td>
                <?php echo $article->title;?>
              </td>
              <td class='text-center'><?php foreach($article->categories as $category) echo $category->name . ' ';?></td>
              <td class='text-center'><?php echo $article->editedDate;?></td>
              <td class='text-center'><?php echo $lang->article->contributionStatus->status[$article->contribution];?></td>
              <td class='text-center'><?php echo $article->views;?></td>
              <td class='text-center'>
                <?php
                    echo html::a($this->article->createPreviewLink($article->id), $lang->preview, "target='_blank'");
                    if($article->contribution !== 2)
                    {
                        commonModel::printLink('article', 'edit', "articleID=$article->id&type=$article->type", $lang->edit);
                        commonModel::printLink('article', 'delete', "articleID=$article->id", $lang->delete, 'class="deleter"');
                    }
                ?>
              </td>
            </tr>
            <?php endforeach;?>
          </tbody>
          <tfoot><tr><td colspan='7'><?php $pager->show();?></td></tr></tfoot>
        </table>
      </div>
    </div>
  </div>
</div>
<?php include TPL_ROOT . 'common/footer.html.php';?>
