$(document).ready(function()
{
    $.setAjaxForm('#uploadForm', function(response) { if(response.result == 'success') $('#ajaxModal').load(response.locate); });
    //$.setAjaxForm('#uploadForm');
});

