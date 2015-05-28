<?php if($extView = $this->getExtViewFile(__FILE__)){include $extView; return helper::cd();}?>
<?php include_once '../../common/view/header.modal.html.php';?>
<?php if($methodName == 'setsecurity') $this->config->site->importantValidate = 'okFile';?>
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
    <div class="modal-dialog" style='width: 710px'>
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">X</span></button>
          <h4 class="modal-title"><?php echo $lang->mail->verify?></h4>
        </div>
        <div class="modal-body">
  <?php endif;?>
  <form class='form-inline' id='captchaForm' action="<?php echo $this->createLink('mail', 'captcha', "url=$url&target=$target&account=$account");?>" method='post'>
    <?php $refUrl  = helper::safe64Decode($url) == 'close' ? $this->app->getURI() : helper::safe64Decode($url);?>
    <?php $fileBtn = html::a($refUrl, $lang->confirm, "class='btn btn-mini btn-primary okFile'")?>
    <?php $mailBtn = html::submitButton();?>
    <table class='table table-form'>
      <?php if(strpos($this->config->site->importantValidate, 'okFile') !== false):?>
      <tr>
        <th class='w-80px'><?php echo $lang->mail->okFile;?></th>
        <td colspan='3'><?php printf($lang->mail->okFileVerfy, $okFile['okFile'], $fileBtn);?></td>
      </tr>
      <?php endif;?>
      <?php if(strpos($this->config->site->importantValidate, 'email')  !== false):?>
      <tr>
        <th><?php echo $lang->mail->email;?></th>
        <td><?php echo html::input('captcha', '', "class='form-control' placeholder={$lang->mail->captcha}");?></td>
        <td class='w-50px'><?php echo $mailBtn;?></td>
        <td><?php echo html::a($this->createLink('mail', 'sendmailcode', "account=$account"), $lang->mail->getEmailCode, "id='mailSender' class='btn btn-xs'");?></td>
      </tr>
      <?php endif;?>
    </table>
  </form>
  <script>
  $(document).ready(function()
  {
      $('#mailSender').click(function()
      {
          var url = $(this).attr('href');

          $.getJSON(url, function(response)
          {
              if(response.result == 'success')
              {
                   $('#mailSender').popover({trigger:'manual', content:response.message, placement:'right'}).popover('show');
                   $('#mailSender').next('.popover').addClass('popover-success');
                   function distroy(){$('#mailSender').popover('destroy')}
                   setTimeout(distroy,2000);
              }
              else
              {
                  bootbox.alert(response.message);
              }
          })
          return false;
      })

      $.setAjaxForm('#captchaForm', function(response)
      {
          if(response.result == 'success')
          {
              if(response.locate == 'close')
              {
                  $('#formError').remove();
                  return setTimeout(function(){$('#ajaxModal button.close').click()}, 1200);
              }
              if(response.target == 'modal')
              {
                  target = $('#ajaxModal');
                  url = response.locate;

                  return setTimeout(function()
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
              else
              {
                  setTimeout(function(){$('#ajaxModal button.close').click()}, 1200);
                  return setTimeout(function(){location.href = response.locate;}, 2000);
              }
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
