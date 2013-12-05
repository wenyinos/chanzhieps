$(document).ready(function()
{
    $.setAjaxForm('#commentForm', function(response)
    {
        if(response.result == 'success')
        {
            bootbox.alert(response.message, function(){location.reload();});   
        }
        else
        {
            if(response.reason == 'needChecking')
            {
                $('#captchaBox').html(response.captcha).show();
            }
            else
            {
                bootbox.alert(response.info);
            }
        }
    });
});
