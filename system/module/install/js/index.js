$(document).ready(function()
{
    $('#agree').change(function()
    {
        $('#install').attr('disabled', !$(this).prop('checked'));
    });
});
