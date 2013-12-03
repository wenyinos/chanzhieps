$(document).ready(function()
{
    $('#original').change();
});

$('.draft').click(function()
{
    $(this).parent().find('#status').remove();
    $(this).after("<input type='hidden' name='status' id='status' value='draft' />");
    $('#ajaxForm').submit();
});

$("#submit").click(function()
{
    $(this).parent().find('#status').remove();
    $('#ajaxForm').submit();
    return false;
});
