$(function()
{
    $.setAjaxJSONER('.changeStatus');

    if(v.categoryID !== 0) 
    {
        $('.leftmenu ul.nav-left li').removeClass('active');
        $('.tree #category' + v.categoryID).addClass('active');
    }
})
