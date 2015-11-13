$(document).ready(function()
{
    $('.blogTD').hide();
    $('[name=type]').change(function()
    {
        type = $(this).val();
        $('.articleTD, .blogTD').hide();
        $('.' + type + 'TD').show();
    });
    $('#source').change();
});
