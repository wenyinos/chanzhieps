$(document).ready(function()
{
    $('.access').popover({container: 'body', html:true, trigger:'manual'}).mouseover(function()
    {
        $('.access').removeClass('showThis');
        $(this).addClass('showThis').popover('show');
        $(".access:not('.showThis')").popover('hide');
    });

    $('.text-muted').popover({trigger:'hover'});

    $(document).click(function()
    {
        $('.access').popover('hide').removeClass('showThis');
    }).on('click', '.popover', function(event){event.stopPropagation();});
});
