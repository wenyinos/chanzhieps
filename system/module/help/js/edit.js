$(document).ready(function()
{
    $.setAjaxForm('#editForm', function(response)
    {
        if('success' == response.result) window.location.reload();
    });
});
