$(document).ready(function()
{          
    // auto ajust panel height.
    $('.row .panel').height($('.row').height() - 59);

    // slide pictures start.     
    $('#slide').carousel();
    $('#slide .item').first().addClass('active');
    $('.nav-system-home').addClass('active');
})                     
