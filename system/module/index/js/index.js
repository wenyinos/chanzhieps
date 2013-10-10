$(document).ready(function()
{          
    // auto ajust panel height.
    var fitPanelHeight = 0;
    $('.row .panel').each(function(){if($(this).height()>fitPanelHeight) fitPanelHeight = $(this).height();}).height(fitPanelHeight);

    // add "index" class to the body element.
    $('body').addClass('index');

    // slide pictures start.     
    $('#slide').carousel();
    $('#slide .item').first().addClass('active');
    $('.nav-system-home').addClass('active');
})                     
