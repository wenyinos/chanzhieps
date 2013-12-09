$(document).ready(function()
{
    $.setAjaxForm('#replyForm', function(response)
    {
        if(response.result == 'success')
        {
            if(response.locate) 
            {
                return setTimeout(function()
                {
                    location.href = response.locate.indexOf('#') == 0 ? $.setUrlParam(location.href, 'go2anchor', response.locate.substring(1)) : response.locate;
                }, 1200);
            }
        }
        else
        {
            if(response.reason == 'needChecking')
            {
                $('#captchaBox').html(response.captcha).show();
            }
        }
    });
    $.setAjaxJSONER('.jsoner');
    $('.nav-system-forum').addClass('active');
});
