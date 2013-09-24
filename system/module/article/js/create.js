$(document).ready(function()
{
    $('#original').change();
    $('.leftmenu li.active').removeClass('active');
    $('.leftmenu a[href*=' + v.type + ']').parent().addClass('active');
});
