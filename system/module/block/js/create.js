$(document).ready(function()
{
    $('#type').change(function()
    {
        location.href = createLink('block', 'create', 'editTemplate=' + v.editTemplate + 'editTheme=' + v.editTheme + 'type=' + $(this).val());
    })

    $.setAjaxForm('#createForm', function(response)
    {   
        if(response.result == 'fail' && response.reason == 'captcha')
        {
            $('.captchaModal').click();
        }   
        if(response.result == 'success' && response.locate != '')
        {
            $('.captchaModal').click();
            location.href = response.locate;
        }   
    }); 
})
