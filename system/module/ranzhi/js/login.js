$(document).ready(function()
{
    $.setAjaxForm('#registerForm', function(response)
    {
        if(response.result == 'success')
        {
            bootbox.alert(response.info, function(){ location.href = response.locate; });
        }
    });

    $.setAjaxForm('#bindForm');
});
