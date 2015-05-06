$(document).ready(function()
{
    $('[name=checkIP]').change(function()
    {
        var checkIP = $('[name=checkIP]:checked').val(); 
        if(checkIP == 'close') $('#allowedIP').parents('tr').addClass('hide');
        else $('#allowedIP').parents('tr').removeClass('hide');
    });
    $('[name=checkIP]').change();

    $('[name=checkPosition]').change(function()
    {
        var checkIP = $('[name=checkPosition]:checked').val(); 
        if(checkIP == 'close') $('#allowedPosition').parents('tr').addClass('hide');
        else $('#allowedPosition').parents('tr').removeClass('hide');
    });
    $('[name=checkPosition]').change();

    $('#usePosition').click(function()
    {
        $('#allowedPositionShow').val(v.position);
        $('#allowedPosition').val(v.position);
        return false;
    });
});
