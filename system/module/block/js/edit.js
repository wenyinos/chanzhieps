$(document).ready(function()
{
    $('#type').change(function()
    {
        location.href = createLink('block', 'edit', 'editTemplate=' + v.editTemplate + 'editTheme=' + v.editTheme + 'id=' + v.id + '&type=' + $(this).val() );
    });
    $.setAjaxForm('#editForm', function(response)
    {   
        if(response.result == 'fail' && response.reason == 'captcha')
        {
            $('.captchaModal').click();
        }   
    }); 
})
