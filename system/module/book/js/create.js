$(document).ready(function()
{
    /* Set current active moduleMenu. */
    if(v.path && v.path.length)
    {
        $.each(eval(v.path), function(index, bookID)
        {
            var current = $(".leftmenu a[href$='book=" + bookID + "']").parent();
            current.addClass('active').siblings().removeClass('active');
        })
    }

   /* Sort up. */
    $(document).on('click', '.icon-arrow-up', function()
    {
        $(this).parents('tr').prev().before($(this).parents('tr')); 
        $('tr .order').each(function(index,obj){$(this).val(index + 1);});
    });

    /* Sort down. */
    $(document).on('click', '.icon-arrow-down', function()
    { 
        var hasNext = $(this).parents('tr').next().find('.icon-arrow-down').size() > 0;
        if(hasNext)
        {
            $(this).parents('tr').next().after($(this).parents('tr')); 
            $('tr .order').each(function(index,obj){$(this).val(index + 1);});
        }
    });

    $('tr .order').each(function(index,obj){$(this).val(index + 1);});
});
