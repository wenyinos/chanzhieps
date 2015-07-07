$(document).ready(function()
{   
    $.setAjaxForm('#fileForm', function(data)
    {
        if(data.result == 'success') location.href = createLink('file', 'sourcebrowse');
    }); 

    $('.image-view').click(function()
    {
        $('.image-view').addClass('selected');
        $('.list-view').removeClass('selected');
        $('#imageView').show();
        $('#listView').hide();
    });

    $('.list-view').click(function()
    {
        $('.list-view').addClass('selected');
        $('.image-view').removeClass('selected');
        $('#listView').show();
        $('#imageView').hide();
    });

    $('[data-toggle="popover"]').popover();
});
