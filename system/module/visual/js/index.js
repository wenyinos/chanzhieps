(function(window, $)
{
    var visualPage = $('#visualPage').get(0);
    var visual$;
    var visualPageUrl = visualPage.src;
    var visuals = window.v.visuals;

    var initVisualArea = function(ve)
    {
        var $ve = ve instanceof visual$ ? ve : visual$(this);
        var code = $ve.data('ve');
        $ve.addClass('ve');
        var $hint = visual$('<div class="ve-hint"><i class="icon icon-pencil"></i><span class="ve-hint-name nobr"> ' + window.v.visualEdit + ' ' + visuals[code] + '</span></div>');
        $ve.append($hint);
        return $ve;
    };

    var updateVisualArea = function(data)
    {
        var $ve = visual$('.ve-editing').first();
        var code = $ve.data('ve');
        var selector = '[data-ve="' + code + '"]';
        var $wrapper = visual$('<div/>');
        $wrapper.load(visualPageUrl + ' ' + selector, function(data)
        {
            $.messager.success("已保存！");
            $ve.replaceWith(initVisualArea($wrapper.find(selector)));
        });
    };

    var openEditModal = function(ve)
    {
        var $ve = ve instanceof visual$ ? ve : visual$(this);
        var code = $ve.data('ve');
        visual$('.ve-editing').removeClass('ve-editing');
        $ve.addClass('ve-editing');
        window.modalTrigger.show(
        {
            url: window.config.webRoot + 'admin.php?m=visual&f=' + code,
            type: 'iframe',
            width: '60%',
            icon: 'pencil',
            title: $ve.find('.ve-hint').text()
        });
    };

    var initVisualPage = function()
    {
        // load visual edit style
        if(window.v.visualStyle) visual$('head').append(visual$('<link type="text/css" rel="stylesheet" />').attr('href', window.v.visualStyle));

        // init visual edit area
        visual$('[data-ve]').each(initVisualArea);

        // bind event
        visual$('body').on('click', '.ve', openEditModal);

        // set ajax options
        visual$.ajaxSetup({beforeSend: function (xhr)
        {
            xhr.setRequestHeader('X-Requested-With', {toString: function(){return 'XMLHttpRequest_VE';}});
        }});
    };


    visualPage.onload = visualPage.onreadystatechange = function()
    {
        if (this.readyState && this.readyState != 'complete') return;
        try
        {
            var $frame = $(window.frames['visualPage'].document);
            if($frame.length)
            {
                visualPageUrl = $frame.context.URL;
                var title = $frame.find('head > title').text();
                $('#visualPageName').text((title && title.indexOf(' ') > -1) ? title.split(' ')[0] : title).attr('href', visualPageUrl);
            }

            visual$ = window.frames['visualPage'].$;
            initVisualPage();
        }
        catch(e){}
    };

    $('#visualPreviewBtn').on('mouseenter', function()
    {
        visual$.addClass('ve-preview-in');
    }).on('mouseleave', function()
    {
        visual$.removeClass('ve-preview-in');
    });

    // extend helper methods
    $.updateVisualArea = updateVisualArea
}(window, jQuery));
