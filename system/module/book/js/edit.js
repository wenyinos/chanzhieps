$(document).ready(function()
{
    $.setAjaxForm('#editForm', function(response)
    {
        if(response.result == 'success') window.location.reload();
    });
});
