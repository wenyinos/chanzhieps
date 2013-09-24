$(document).ready(function()
{
    /* Load the children of current category when page loaded. */
    var link = createLink('tree', 'children', 'type=' + v.type + '&root=' + v.root);
    $('#categoryBox').load(link);
    
    $('.leftmenu li.active').removeClass('active');
    $('.leftmenu a[href*=' + v.type + ']').parent().addClass('active');

    $.setAjaxLoader('#treeMenuBox .ajax', '#categoryBox');
})
