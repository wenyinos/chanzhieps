(function(window, $)
{
    'use strict';
    var visualPage = $('#visualPage').get(0);
    var visual$;
    var visualPageUrl = visualPage.src;
    var visuals = window.v.visuals;
    var actionConfig = {edit: 'icon-pencil', delete: 'icon-remove', move: 'icon-move'};
    var actionsNames = window.v.visualActions;
    var DEFAULT_CONFIG = {width: '80%', actions: {edit: true}};
    $.each(visuals, function(code, config)
    {
        visuals[code] = $.extend(true, {}, DEFAULT_CONFIG, $.isPlainObject(config) ? config : {name: config});
    });

    console.log("visuals", visuals);

    var initVisualArea = function(ve)
    {
        var $ve = ve instanceof visual$ ? ve : visual$(this);
        var code = $ve.data('ve');
        var config = visuals[code];
        if($.isPlainObject(config))
        {
            $ve.addClass('ve');
            var $actions = visual$('<ul class="ve-actions"></ul>');
            var $heading = visual$('<div class="ve-heading"><div class="ve-name">' + config.name  + '</div></div>');

            $.each(actionConfig, function(action, icon)
            {
                if(config.actions[action])
                {
                    $actions.append('<li data-toggle="tooltip" class="ve-action-' + action + '" title="' + (actionsNames[action]) + '">' + (config.actions[action] === true ? '<i class="icon ' + icon + '"></i>' : config.actions[action]) + '</li>');
                }
            })
            $heading.prepend($actions);
            $ve.append($heading);
            return $ve;
        }
    };

    var initBlocks = function()
    {
        visual$('.blocks').each(function()
        {
            var $blocksHolder = $(this);
            var withGrid = $blocksHolder.hasClass('row');
            var $blocks = $blocksHolder.find('.block, .panel-block');
            $blocks.each(function()
            {
                var $block = visual$(this).attr('data-ve', 'block');
                initVisualArea($block);
            });

            var $carousels = $blocksHolder.find('.carousel');
            $carousels.each(function()
            {
                var $carousel = visual$(this).attr('data-ve', 'carousel');
                initVisualArea($carousel);
            });
        });
    };

    var updateVisualArea = function(data)
    {
        var $ve = visual$('.ve-editing').first();
        var id = $ve.attr('id');
        var selector = '#' + id;
        var $wrapper = visual$('<div/>');
        $wrapper.load(visualPageUrl + ' ' + selector, function(data)
        {
            $.messager.success(window.v.visualSaved);
            $ve.replaceWith(initVisualArea($wrapper.find(selector)));
        });
    };

    var openEditModal = function(ve)
    {
        var $ve = ve instanceof visual$ ? ve : visual$(this).closest('.ve');
        var code = $ve.data('ve');
        visual$('.ve-editing').removeClass('ve-editing');
        $ve.addClass('ve-editing');
        var config = visuals[code];
        window.modalTrigger.show(
        {
            url: window.config.webRoot + 'admin.php?m=visual&f=' + code,
            type: 'iframe',
            width: config.width,
            icon: config.icon || 'pencil',
            title: actionsNames.edit + ' ' + config.name,
            hidden: function()
            {
                visual$('.ve-editing').removeClass('ve-editing');
            }
        });
    };

    var deleteVisualArea = function(ve)
    {
        var $ve = ve instanceof visual$ ? ve : visual$(this).closest('.ve');
        var code = $ve.data('ve');
        // todo: send request to remote server
        $ve.remove();
        $.messager.success(window.v.visualDeleted);
    };

    var initVisualPage = function()
    {
        // load visual edit style
        if(window.v.visualStyle) visual$('head').append(visual$('<link type="text/css" rel="stylesheet" />').attr('href', window.v.visualStyle));

        // init visual edit area
        visual$('[data-ve]').each(initVisualArea);
        initBlocks();

        // bind event
        visual$('body').on('click', '.ve', openEditModal)
        .on('click', '.ve-action-edit', function(e)
        {
            openEditModal(visual$(this).closest('.ve'));
            e.stopPropagation();
        }).on('click', '.ve-action-delete', function(e)
        {
            var $ve = visual$(this).closest('.ve');
            var callback = function(result)
            {
                if(result) deleteVisualArea($ve);
            }
            if(bootbox && bootbox.confirm)
            {
                bootbox.confirm({size: 'small', message: window.v.lang.confirmDelete, callback: callback});
            }
            else callback(confirm(window.v.lang.confirmDelete));
            e.stopPropagation();
        });

        // set ajax options
        visual$.ajaxSetup({beforeSend: function (xhr)
        {
            xhr.setRequestHeader('X-Requested-With', {toString: function(){return 'XMLHttpRequest_VE';}});
        }});

        if(visual$.fn.tooltip)
        {
            visual$('.ve-actions > li').tooltip({container: 'body', placement: 'bottom'});
        }
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
        visual$('body').addClass('ve-preview-in');
    }).on('mouseleave', function()
    {
        visual$('body').removeClass('ve-preview-in');
    });

    // extend helper methods
    $.updateVisualArea = updateVisualArea
}(window, jQuery));
