$(document).ready(function()
{
    $('.nav-system-message').addClass('active');
    $.setAjaxForm('#commentForm', function(response)
    {
        if(response.result == 'success')
        {
            setTimeout(function(){location.reload();}, 2000);   
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

    /* Process contents. */
    $('.content-detail').each(function()
    {
        var obj = $(this);
        if(obj.height() > 100)
        {
            var buttons = "<a href='javascript:void(0)' onclick='showDetail(this)' class='showDetail'> ... " + v.showDetail + "</a>";
            buttons    += "<a href='javascript:void(0)' onclick='showAbstract(this)' class='showAbstract'> " + v.showAbstract + "</a>";
            obj.parent().append(buttons);
            obj.parent().find('.showAbstract').hide();
            obj.addClass('content-abstract');
        }
    });
});

function showDetail(obj)
{
    var tdContent = $(obj).parents('.td-content');
    tdContent.find('.content-detail').removeClass('content-abstract');
    tdContent.find('.showDetail').hide();
    tdContent.find('.showAbstract').show();
}

function showAbstract(obj)
{
    var tdContent = $(obj).parents('.td-content');
    tdContent.find('.content-detail').addClass('content-abstract');
    tdContent.find('.showDetail').show();
    tdContent.find('.showAbstract').hide();
}
