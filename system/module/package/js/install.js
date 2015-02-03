$(document).ready(function()
{
    $.setAjaxLoader('.loadInModal', '#ajaxModal');

    $('.btn-reload').click(function(){ $.reloadAjaxModal();});
});
