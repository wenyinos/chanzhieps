<?php if($extView = $this->getExtViewFile(__FILE__)){include $extView; return helper::cd();}?>
<?php include_once '../../common/view/header.modal.html.php';?>
<?php js::set('emailSending', sprintf($lang->mail->sending, $user->email));?>
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
  if(!isset($target))   $target   = 'modal';
  if(!isset($account))  $account  = '';
  if(!isset($method))   $method   = '';
  if(!isset($email))    $email    = $this->app->user->email;
  if(!isset($question)) $question = $this->app->user->securityQuestion;
  if(isset($type) and $type != '') $this->config->site->importantValidate = $type;
  ?>
  <?php if(!helper::isAjaxRequest()):?>
  <div class="modal" id="ajaxModal" ref="<?php echo $this->app->getURI();?>">
    <div class="modal-dialog" style='width: 750px'>
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">X</span></button>
          <h4 class="modal-title"><?php echo $lang->mail->verify?></h4>
        </div>
        <div class="modal-body">
  <?php endif;?>
  <form class='form-inline' id='captchaForm' action="<?php echo $this->createLink('mail', 'captcha', "url=$url&target=$target&account=$account&method=$method");?>" method='post'>
    <?php $refUrl  = helper::safe64Decode($url) == 'close' ? $this->app->getURI() : helper::safe64Decode($url);?>
    <?php $fileBtn = html::a($refUrl, $lang->mail->created, "class='btn btn-sm btn-primary okFile'")?>
    <?php $mailBtn = html::submitButton();?>
    <?php $questionBtn = html::submitButton();?>
    <?php $options = explode(',', $this->config->site->importantValidate); $multi = count($options) > 1 ? true : false;?>
    <table class='table table-form'>
      <?php if(in_array('okFile', $options)):?>
      <tr>
        <?php if($multi):?>
        <th class='w-100px'><?php echo $lang->mail->okFile;?></th>
        <?php endif;?>
        <td colspan='3'><?php printf($lang->mail->okFileVerfy, $okFile['okFile'], $fileBtn);?></td>
      </tr>
      <?php endif;?>
      <?php if(in_array('email', $options)):?>
      <tr>
        <?php if($multi):?>
        <th class='w-100px'><?php echo $lang->mail->email;?></th>
        <?php endif;?>
        <?php if(!empty($email) and $this->config->mail->turnon):?>
        <td class='w-250px'><?php echo html::input('captcha', '', "class='form-control' placeholder={$lang->mail->captcha}");?></td>
        <td class='w-50px'><?php echo $mailBtn;?></td>
        <td><?php echo html::a($this->createLink('mail', 'sendmailcode', "account=$account"), $lang->mail->getEmailCode, "id='mailSender' class='btn btn-success'");?></td>
        <?php endif;?>
        <td>
        <?php if(empty($email)) echo $lang->mail->noEmail;?>
        <?php if(!$this->config->mail->turnon) echo '&nbsp;' . $lang->mail->noConfigure;?>
        <?php if(!$this->config->mail->turnon or empty($email)) echo $lang->mail->noCaptcha;?>
        </td>
      </tr>
      <?php endif;?>
      <?php if(in_array('securityQuestion', $options)):?>
      <tr>
        <?php if($multi):?>
        <th class='w-100px'><?php echo $lang->mail->securityQuestion;?></th>
        <?php endif;?>
        <?php if(!empty($question)):?>
        <td class='w-300px' colspan='2'>
          <div class='input-group'>
            <span class='input-group-addon'><?php echo json_decode($question)->question;?></span>
            <?php echo html::input('answer', '', "class='form-control' placeholder={$lang->mail->answer}");?>
          </div>
        </td>
        <td class='w-50px'><?php echo $questionBtn;?></td>
        <?php endif;?>
        <td>
        <?php if(empty($question)) echo $lang->mail->noQuestion;?>
        </td>
      </tr>
      <?php endif;?>
    </table>
  </form>
  <script>
  $(document).ready(function()
  {
      $('#mailSender').click(function()
      {
          $('#mailSender').popover({trigger:'manual', content: v.emailSending, placement:'right'}).popover('show');
          $('#mailSender').next('.popover').addClass('popover-success').css('width', '320px');
          function distroy(){$('#mailSender').popover('destroy')}
          setTimeout(distroy, 2000);
  
          var url = $(this).attr('href');

          $.getJSON(url, function(response)
          {
              $('#mailSender').popover('destroy');
              if(response.result == 'success')
              {
                   $('#mailSender').attr('disabled', 'disabled');
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
