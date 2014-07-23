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

    $('a.jsoner').click(function()
    {
        url = $(this).attr('href');
        var button = $(this);
        $.getJSON(url, function(response)
        {
            if(response.result == 'success')
            {
                 button.popover({trigger:'manual', content:response.message, placement:'right'}).popover('show');
                 button.next('.popover').addClass('popover-success');
                 function distroy(){button.popover('destroy')}
                 setTimeout(distroy,2000);
            }
            else
            {
                bootbox.alert(response.message);
            }
        });
        return false;
    });

    if(v.isWechatMenu) $(".leftmenu a[href*='wechat']").parent().addClass('active');

    if(v.type == 'product' && (!$('#setCurrency').length))
    {
        var currencyLink = createLink('product', 'currency');
        var currencyMenu = '<li><a id="setCurrency" href="' + currencyLink + '" data-toggle="modal">';
        currencyMenu += v.currency + '<i class="icon-chevron-right"></i>';
        currencyMenu += '</li>';

        $('.leftmenu').append(currencyMenu);
        $('#setCurrency').modalTrigger();
    }
})
