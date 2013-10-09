$(document).ready(function()
{          
    // auto ajust panel height.
    $('.row .panel').height($('.row').height() - 20);

    // add "index" class to the body element.
    $('body').addClass('index');

    // slide pictures start.     
    $('#slide').carousel();
    $('#slide .item').first().addClass('active');
    $('.nav-system-home').addClass('active');
})                     
