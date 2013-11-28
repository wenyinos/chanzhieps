$(document).ready(function()
{
    $.setAjaxForm('#createForm', function(response)
    {
        if('success' == response.result) window.location.reload();
    });
});
