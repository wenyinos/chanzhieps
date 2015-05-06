<?php include_once '../../common/view/header.modal.html.php';?>
<?php if(isset($pass) and $pass):?>
<script>
$(document).ready(function()
{
    $('#formError').remove();
    setTimeout(function(){$('#ajaxModal button.close').click()}, 500);
});
</script>
<div class='alert'><?php echo $lang->mail->verifySuccess;?></div>
<?php else:?>
  <?php
  if(!isset($target))  $target  = 'modal';
  if(!isset($account)) $account = '';
  if(!isset($email))   $email   = $this->app->user->email;
  ?>
  <?php if(!helper::isAjaxRequest()):?>
  <div class="modal" id="ajaxModal" ref="<?php echo $this->app->getURI();?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">X</span></button>
          <h4 class="modal-title"><?php echo $lang->mail->verify?></h4>
        </div>
        <div class="modal-body">
  <?php endif;?>
  <form class='form-inline' id='sendMailForm' action="<?php echo $this->createLink('mail', 'captcha', "type=$type&url=$url&target=$target&account=$account");?>" method='post'>
    <div class='alert'>
      <?php $refUrl = helper::safe64Decode($url) == 'close' ? $this->app->getURI() : helper::safe64Decode($url);?>
      <?php $fileBtn = html::a($refUrl, $lang->confirm, "class='btn btn-mini btn-primary okFile'")?>
      <?php $mailBtn = $check['result'] == 'success' ? html::submitButton($this->lang->send, 'btn btn-mini btn-primary') . html::hidden('sendMail', 1) : $check['message'];?>
      <?php echo sprintf($lang->mail->sendNotice, $type, $okFile['okFile'], $fileBtn, $email, $mailBtn);?>
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
      <?php if($target == 'modal'):?>
      $.setAjaxLoader('.okFile', '#ajaxModal');
      <?php endif;?>
  })
  </script>
  <?php if(!helper::isAjaxRequest()):?>
        </div>
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
  <?php endif;?>
<?php endif;?>
<?php include_once '../../common/view/footer.modal.html.php';?>
