<?php include '../../common/view/header.modal.html.php';?>
<ul class='files-list clearfix'>
<?php foreach($result['fileList'] as $file):?>
    <?php
    if($type == 'image' and $file['isPhoto'])
    {
        echo "<li class='file-image file-{$file['filetype']}'>" . html::a('javascript:void(0)', html::image($result['currentUrl'] . $file['filename']), "onclick='selectFile(this, $callback)' data-url={$result['currentUrl']}{$file['filename']}") . "</li>";
    }
    if($type != 'image' and !($file['isPhoto']))
    {
        echo "<li class='file file-{$file['filetype']}'>" . html::a('javascript:void(0)', $file['filename'], "onclick='selectFile(this, $callback)' data-url={$result['currentUrl']}.{$file['filename']}") . "</li>";
    }
    ?>
<?php endforeach;?>          
</ul>
<?php include '../../common/view/footer.modal.html.php';?>
