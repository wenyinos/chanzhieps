$(document).ready(function()
{
    $('.leftmenu li.active').removeClass('active');
    
    /* Set current active moduleMenu. */
    if(v.path && v.path.length)
    {
        $.each(eval(v.path), function(index, bookID) 
        { 
            $('.leftmenu a[href*=' + bookID + ']').parent().addClass('active');
        })
    }

    $('.sort').click(function()
    {
        $.getJSON($(this).attr('href'), function(data) 
        {
            if(data.result=='success')
            {
                location.reload();
            }
            else
            {
                alert(data.message);
            }
        });

        return false;
    });
});

