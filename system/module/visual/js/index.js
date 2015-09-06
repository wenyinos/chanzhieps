(function(window, $)
{
    'use strict';
    var visualPage = $('#visualPage').get(0);
    var visual$;
    var isInPreview = false;
    var lang = window.v.visualLang;
    var visualPageUrl = visualPage.src;
    var visuals = window.v.visuals;
    var actionConfig = {edit: 'icon-pencil', delete: 'icon-remove', move: 'icon-move', 'info': 'icon-info-sign'};
    var actionsNames = window.v.visualActions;
    var DEFAULT_CONFIG = {width: '80%', actions: {edit: true}};
    $.each(visuals, function(code, setting)
    {
        visuals[code] = $.extend(true, {}, DEFAULT_CONFIG, $.isPlainObject(setting) ? setting : {name: setting});
    });

    console.log("visuals", visuals);

    var initVisualArea = function(ve)
    {
        var $ve = ve instanceof visual$ ? ve : visual$(this);
        var name = '';

        // init blocks
        if($ve.hasClass('block') || $ve.hasClass('panel-block'))
        {
            $ve.attr({'data-ve': 'block', 'data-id': $ve.attr('id').replace('block', '')});
            name = 'block';
        }
        else if($ve.hasClass('carousel'))
        {
            $ve.attr('data-ve', 'carousel');
            name = 'carousel';
        }
        else
        {
            name = $ve.data('ve') || $ve.attr('id');
        }

        $ve.data('ve', name);
        var setting = visuals[name];
        if($.isPlainObject(setting))
        {
            $ve.addClass('ve');
            var $actions = visual$('<ul class="ve-actions"></ul>');
            var $heading = visual$('<div class="ve-heading"><div class="ve-name">' + setting.name  + '</div></div>');

            $.each(actionConfig, function(action, icon)
            {
                if(setting.actions[action])
                {
                    $actions.append('<li data-toggle="tooltip" class="ve-action-' + action + '" title="' + (actionsNames[action]) + '">' + (setting.actions[action] === true ? '<i class="icon ' + icon + '"></i>' : setting.actions[action]) + '</li>');
                }
            });
            $heading.prepend($actions);
            $ve.append(visual$('<div class="ve-cover"/>').append($heading));
            return $ve;
        }
    };

    var initBlocks = function()
    {
        visual$('.blocks').each(function()
        {
            var $blocksHolder = $(this);
            var withGrid = $blocksHolder.hasClass('row');
            $blocksHolder.find('.block, .panel-block, .carousel').each(initVisualArea);
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
            $.messager.success(lang.saved);
            $ve.replaceWith(initVisualArea($wrapper.find(selector)));
        });
    };

    var openEditModal = function(ve)
    {
        var $ve = ve instanceof visual$ ? ve : visual$(this).closest('.ve');
        var name = $ve.data('ve');
        visual$('.ve-editing').removeClass('ve-editing');
        $ve.addClass('ve-editing');
        var setting = visuals[name];
        var options = $ve.data();
        window.modalTrigger.show(
        {
            name: 'veModal',
            url: window.config.webRoot + 'admin.php?m=visual&f=edit' + name,
            url: createLink('visual', 'edit' + name, setting.params ? setting.params.format(options) : ''),
            type: 'iframe',
            width: setting.width,
            icon: setting.icon || 'pencil',
            title: setting.title || actionsNames.edit + ' ' + setting.name,
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
        $.messager.success(lang.v.deleted);
    };

    var initVisualPage = function()
    {
        // load visual edit style
        if(window.v.visualStyle) visual$('head').append(visual$('<link type="text/css" rel="stylesheet" />').attr('href', window.v.visualStyle));

        // init visual edit area
        $.each(visuals, function(name, setting)
        {
            visual$('[data-ve="' + name + '"], #' + name).each(initVisualArea);
        });

        initBlocks();

        // bind event
        visual$('body').on('click', '.ve-cover', openEditModal)
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

        if(isInPreview) visual$('body').addClass('ve-preview-in');
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
        visual$('body').addClass('ve-preview-hover');
    }).on('mouseleave', function()
    {
        visual$('body').removeClass('ve-preview-hover');
    }).on('click', function()
    {
        var $body = visual$('body');
        $body.toggleClass('ve-preview-in');
        isInPreview = $body.hasClass('ve-preview-in');
        $(this).toggleClass('text-danger', isInPreview).html(isInPreview ? ("<i class='icon-eye-close'></i> " + lang.exitPreview)
            : ("<i class='icon-eye-open'></i> " + lang.preview));
    });

    // extend helper methods
    $.updateVisualArea = updateVisualArea;
    $.setModalTitle = function(title)
    {
        $('#veModal').find('.modal-title').html(title);
    };
}(window, jQuery));
