$(document).ready(function()
{
    /* Set the orginal and copySite, copyURL fields. */
    $('#source').change(function()
    {
        $('#copyBox').hide().find(':input').attr('disabled', true);
        if($(this).val() != 'original') $('#copyBox').show().find(':input').attr('disabled', false);
    });

    $('#isLink').change(function()
    {   
        if($(this).prop('checked'))
        {   
            $('.articleInfo').addClass('hidden');
            $('.link').removeClass('hidden');
        }   
        else
        {   
            $('.articleInfo').removeClass('hidden');
            $('.link').addClass('hidden');
        }   
    }); 
    
    /* Set current active topNav. */
    if(v.path && v.path.length)
    {
        var hasActive = false;
        $.each(v.path, function(index, category) 
        { 
            if(!hasActive)
            {
                if($('.nav-article-' + category).length >= 1) hasActive = true;
                $('.nav-article-' + category).addClass('active');
            }
        });
        if(!hasActive) $('.nav-article-0').addClass('active');
    }

    if(v.categoryID !== 0) $('.tree #category' + v.categoryID).addClass('active');
});
