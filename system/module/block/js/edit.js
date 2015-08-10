$(document).ready(function()
{
    $('#type').change(function()
    {
        location.href = createLink('block', 'edit', 'id=' + v.id + '&type=' + $(this).val() );
    });
    $.setAjaxForm('#editForm', function(response)
    {   
        if(response.result == 'fail' && response.reason == 'captcha')
        {
            $('.captchaModal').click();
        }   
    }); 

    var $form = $('#editForm');
    $('.nav-tabs li > a').on('show.bs.tab show.zui.tab', function()
    {
        $form.attr('data-tab', $(this).attr('href').replace('#', ''));
    }).first().tab('show');
})
