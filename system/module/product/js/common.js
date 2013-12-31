$(document).ready(function()
{
    /* Set current active topNav. */
    if(v.path && v.path.length)
    {
        $.each(eval(v.path), function(index, category)
        {
            if($('.nav-product-' + category).length == 0) category = 0;
            $('.nav-product-' + category).addClass('active');
        })
    }
})
