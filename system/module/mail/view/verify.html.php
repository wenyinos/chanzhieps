<?php include '../../common/view/header.modal.html.php';?>
<form class='form-inline' id='verifyForm' action="<?php echo inlink('verify', "url=$url&target=$target");?>" method='post'>
  <table class='table table-form'>
    <tr>
      <th class='w-80px'><?php echo $lang->mail->captcha;?></th>
      <td><?php echo html::input('captcha', '', "class='form-control'");?></td>
    </tr>
    <tr>
      <th></th>
      <td><?php echo html::submitButton();?></td>
    </tr>
  </table>
</form>
<script>
$(document).ready(function()
{
    $.setAjaxForm('#verifyForm', function(response)
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
})
</script>
<?php include '../../common/view/footer.modal.html.php';?>
