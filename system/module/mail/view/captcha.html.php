<?php if($target != 'modal'):?>
<div class="modal" id="ajaxModal">
  <div class="modal-dialog">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">X</span></button>
      <h4 class="modal-title"><?php echo $title?></h4>
    </div>
    <div class="modal-content">
<?php else:?>
<?php include '../../common/view/header.modal.html.php';?>
<?php endif;?>

<form class='form-inline' id='sendMailForm' action="<?php echo $this->createLink('mail', 'captcha', "type=$type&url=$url&target=$target");?>" method='post'>
  <div class='alert alert-success'>
    <?php echo sprintf($lang->mail->sendNotice, $type, $email) . html::submitButton($this->lang->send) . html::hidden('sendMail', 1);?>
  </div>
</form>
<script>
$(document).ready(function()
{
    $.setAjaxForm('#sendMailForm', function(response)
    {   
        if(response.result == 'success')
        {   
            target = $('#ajaxModal');
            url = response.locate;

            setTimeout(function()
            {   
                target.attr('rel', url);
                target.load(url, function()
                {   
                    if(target.hasClass('modal'))
                    {   
                        $.ajustModalPosition('fit', target);
                    }   
                }); 
            }, 2000);
        }   
    }); 
})
</script>

<?php if($target != 'modal'):?>
    </div>
  </div>
</div>
<script>
$(document).ready(function()
{
    $('.clearfix').find('.panel').remove();
    $('#ajaxModal').modal('show', 'fit');
})
</script>
<?php else:?>
<?php include '../../common/view/footer.modal.html.php';?>
<?php endif;?>
