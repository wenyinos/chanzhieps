$(document).ready(function()
{
    /* Load the children of current category when page loaded. */
    var link = createLink('tree', 'children', 'type=' + v.type + '&root=' + v.root);
    $('#categoryBox').load(link, function(){if($.fn.placeholder) $('[placeholder]').placeholder();});
    $('#treeMenuBox li:has(ul)').each(function()
    {
        $(this).children('.deleter').remove();
    });

    $.setAjaxLoader('#treeMenuBox .ajax', '#categoryBox', function(){if($.fn.placeholder) $('[placeholder]').placeholder();});

    setTimeout(function()
    {
        if(v.type == 'forum')
        {
            $('.treeview > li').each(function()
            {
                var li   = $(this);
                var href = li.find('a[href*="children"]').attr('href');
                if(li.find('ul').length || href == $('#childForm').attr('action')) return;

                li.append("<div class='alert alert-warning hiding'><span><i class='icon-info-sign'></i> </span>" + v.lang['forumCategoryTip'] + " &nbsp; <a class='ajax alert-link' href='" + href + "'>" + v.lang['setChildren'] + " <i class='icon-double-angle-right'></i></a></div>");

                li.find('.alert').slideDown('fast').find('a').click(function(){$(this).closest('.alert').slideUp('fast')});
            });
        }
    }, 1000);
})
