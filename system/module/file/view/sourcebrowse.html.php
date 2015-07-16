<?php include '../../common/view/header.admin.html.php';?>
<div class='modal fade' id='uploadModal'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'><?php echo $lang->file->uploadSource?></div>
      <form id="fileForm" method='post' enctype='multipart/form-data' action='<?php echo inlink('upload', "objectType=source&objectID={$this->config->template->name}_{$this->config->template->theme}");?>'>
        <table class='table table-form'>
          <?php if($writeable):?>
          <tr>
            <td class='w-10px'></td>
            <td class='text-middle w-100px'><?php echo $lang->file->source . sprintf($lang->file->limit, $this->config->file->maxSize / 1024 /1024);?></td>
            <td><?php echo $this->fetch('file', 'buildForm');?></td>
            <td class='w-40px'></td>
          </tr>
          <tr><td colspan='4' class='text-center'><?php echo html::submitButton();?></td></tr>
          <?php else:?>
          <tr><td colspan='4'><h5 class='text-danger'><?php echo $lang->file->errorUnwritable;?></h5></td></tr>
          <?php endif;?>
        </table>
      </form>
    </div>
  </div>
</div>
<div class='panel'>
  <div class='panel-heading'>
    <?php echo $lang->file->sourceList?>
    <span class='panel-actions'>
      <?php echo html::a('javascript:void(0)', "<i class='icon icon-th-large'></i> " . $lang->file->viewType[0], "class='image-view selected'")?>
      <?php echo html::a('javascript:void(0)', "<i class='icon icon-list'></i> " . $lang->file->viewType[1], "class='list-view'")?>
      <?php echo html::commonButton($lang->file->uploadSource, 'btn btn-sm btn-primary', "data-toggle='modal' data-target='#uploadModal'")?>
    </span>
  </div>
  <div id='imageView' class='panel-body'>
    <ul class='files-list clearfix'>
    <?php foreach($files as $file):?>
        <?php
        $imageHtml = '';
        $fileHtml  = '';
        $fullURL = html::input('', $file->fullURL, "size='" . strlen($file->fullURL) . "' style='border:none; background:none;' onmouseover='this.select()'");
        if($file->isImage)
        {
            $imageHtml .= "<li class='file-image file-{$file->extension}'>" . html::a(helper::createLink('file', 'download', "fileID=$file->id&mose=left"), html::image($file->fullURL), "target='_blank' data-toggle='lightbox'");
            $imageHtml .= "<span class='file-actions'>";
            $imageHtml .= html::a(helper::createLink('file', 'sourcedelete', "id=$file->id"), "<i class='icon-trash'></i>", "class='deleter'");
            $imageHtml .= html::a(helper::createLink('file', 'sourceedit', "id=$file->id"), "<i class='icon-edit'></i>", "data-toggle='modal'");
            $imageHtml .= html::a('javascript:void(0)', $lang->file->sourceURI, "data-toggle='modal' data-custom=\"$fullURL\"");
            $imageHtml .= '</span>';
            $imageHtml .= '</li>';
        }
        else
        {
            $file->title = $file->title . ".$file->extension";
            $fileHtml .= "<li class='file file-{$file->extension}'>" . html::a(helper::createLink('file', 'download', "fileID=$file->id&mouse=left"), $file->title, "target='_blank'");
            $fileHtml .= "<span class='file-actions'>";
            $fileHtml .= html::a(helper::createLink('file', 'sourcedelete', "id=$file->id"), "<i class='icon-trash'></i>", "class='deleter'");
            $fileHtml .= html::a(helper::createLink('file', 'sourceedit', "id=$file->id"), "<i class='icon-edit'></i>", "data-toggle='modal'");
            $fileHtml .= html::a('javascript:void(0)', $lang->file->sourceURI, "data-toggle='modal' data-custom=\"$fullURL\"");
            $fileHtml .= '</span>';
            $fileHtml .= '</li>';
        }
        if($imageHtml or $fileHtml) echo $imageHtml . $fileHtml;
        ?>
    <?php endforeach;?>          
    </ul>
    <div class='clearfix'><?php $pager->show();?></div>
  </div>
  <div id='listView' class='hide'>
    <table class='table table-bordered'>
      <thead>
        <tr>
          <th class='text-center w-60px'><?php echo $lang->file->id;?></th>
          <th class='text-center'><?php echo $lang->file->source;?></th>
          <th class='text-center w-60px'><?php echo $lang->file->extension;?></th>
          <th class='text-center w-80px'><?php echo $lang->file->size;?></th>
          <th class='text-center w-100px'><?php echo $lang->file->addedBy;?></th>
          <th class='text-center w-160px'><?php echo $lang->file->addedDate;?></th>
          <th class='text-center w-150px'><?php echo $lang->actions;?></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($files as $file):?>
        <tr class='text-center text-middle'>
          <td><?php echo $file->id;?></td>
          <td>
            <?php
            if($file->isImage)
            {
                echo html::a(inlink('download', "id=$file->id"), html::image($file->smallURL, "class='image-small' title='{$file->title}'"), "data-toggle='lightbox' target='_blank'");
            }
            else
            {
                echo html::a(inlink('download', "id=$file->id"), $file->title, "target='_blank'");
            }
            ?>
          </td>
          <td><?php echo $file->extension;?></td>
          <td><?php echo number_format($file->size / 1024 , 1) . 'K';?></td>
          <td><?php echo isset($users[$file->addedBy]) ? $users[$file->addedBy] : '';?></td>
          <td><?php echo $file->addedDate;?></td>
          <td class='text-center'>
          <?php
          $fullURL = html::input('', $file->fullURL, "size='" . strlen($file->fullURL) . "' style='border:none; background:none;' onmouseover='this.select()'");
          commonModel::printLink('file', 'sourcedelete', "id=$file->id", $lang->delete, "class='deleter'");
          commonModel::printLink('file', 'sourceedit',   "id=$file->id", $lang->edit, "data-toggle='modal'");
          echo html::a('javascript:void(0)', $lang->file->sourceURI, "data-toggle='modal' data-custom=\"$fullURL\"");
          ?>
          </td>
        </tr>
        <?php endforeach;?>          
      </tbody>
      <tfoot><tr><td colspan='8'><?php $pager->show();?></td></tr></tfoot>
    </table>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
