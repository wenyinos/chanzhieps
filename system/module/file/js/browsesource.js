$(document).ready(function()
{   
    $.setAjaxForm('#fileForm', function(data)
    {
        if(data.result == 'success') location.href = createLink('file', 'browsesource');
    }); 

    $('.image-view').click(function()
    {
        $('.image-view').addClass('selected');
        $('.list-view').removeClass('selected');
        $('#imageView').show();
        $('#listView').hide();
        $.cookie('sourceViewType', 'image', {path: "/"});
    });

    $('.list-view').click(function()
    {
        $('.list-view').addClass('selected');
        $('.image-view').removeClass('selected');
        $('#listView').show();
        $('#imageView').hide();
        $.cookie('sourceViewType', 'list', {path: "/"});
    });

    var type = $.cookie('sourceViewType');
    if(type == '') type = 'image';
    $('.' + type + '-view').click();
    
    $('.file-source input').mouseover(function(){$(this).select()});
});
