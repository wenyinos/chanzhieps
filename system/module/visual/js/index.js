(function(window, $)
{
    'use strict';
    var visualPage = $('#visualPage').get(0);
    var $$;
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

    var initVisualArea = function(ve)
    {
        var $ve = ve instanceof $$ ? ve : $$(this);
        var $veMain = $ve.not('style, script');
        var name = '';

        // init blocks
        if($veMain.hasClass('block') || $veMain.hasClass('panel-block'))
        {
            if($veMain.parent().hasClass('block')) return;
            $veMain.attr({'data-ve': 'block', 'data-id': $veMain.attr('id').replace('block', '')});
            name = 'block';
        }
        else if($veMain.hasClass('carousel'))
        {
            $veMain.attr('data-ve', 'carousel');
            name = 'carousel';
        }
        else
        {
            name = $veMain.data('ve') || $veMain.attr('id');
        }

        $veMain.data('ve', name);
        var setting = visuals[name];
        if($.isPlainObject(setting))
        {
            $veMain.addClass('ve');
            var $actions = $$('<ul class="ve-actions"></ul>');
            var $heading = $$('<div class="ve-heading"><div class="ve-name">' + setting.name  + '</div></div>');

            $.each(actionConfig, function(action, icon)
            {
                if(setting.actions[action])
                {
                    $actions.append('<li data-toggle="tooltip" class="ve-action-' + action + '" title="' + (actionsNames[action]) + '">' + (setting.actions[action] === true ? '<i class="icon ' + icon + '"></i>' : setting.actions[action]) + '</li>');
                }
            });
            $heading.prepend($actions);
            $veMain.append($$('<div class="ve-cover"/>').append($heading));
            return $ve;
        }
    };

    var initBlocks = function()
    {
        $$('.blocks').each(function()
        {
            var $blocksHolder = $(this);
            var withGrid = $blocksHolder.hasClass('row');
            $blocksHolder.find('.block, .panel-block, .carousel').each(initVisualArea);
        });
    };

    var updateVisualArea = function(response)
    {
        var $ve = $$('.ve-editing').first();
        var id = $ve.attr('id');
        var selector = '#' + id + ',#' + id + '+style';
        var $wrapper = $$('<div/>');
        $wrapper.load(visualPageUrl + ' ' + selector, function(data)
        {
            $.messager.success(lang.saved);
            var $veExtra = $ve.next();
            if($veExtra.is('style')) $veExtra.remove();
            $ve.replaceWith(initVisualArea($wrapper.find(selector)));
        });
    };

    var openEditModal = function(ve)
    {
        var $ve = ve instanceof $$ ? ve : $$(this).closest('.ve');
        var name = $ve.data('ve');
        $$('.ve-editing').removeClass('ve-editing');
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
                $$('.ve-editing').removeClass('ve-editing');
            }
        });
    };

    var deleteVisualArea = function(ve)
    {
        var $ve = ve instanceof $$ ? ve : $$(this).closest('.ve');
        var code = $ve.data('ve');
        // todo: send request to remote server
        $ve.remove();
        $.messager.success(lang.v.deleted);
    };

    var initVisualPage = function()
    {
        // load visual edit style
        if(window.v.visualStyle) $$('head').append($$('<link type="text/css" rel="stylesheet" />').attr('href', window.v.visualStyle));

        // init visual edit area
        $.each(visuals, function(name, setting)
        {
            $$('[data-ve="' + name + '"], #' + name).each(initVisualArea);
        });

        initBlocks();

        // bind event
        $$('body').on('click', '.ve-cover', openEditModal)
        .on('click', '.ve-action-edit', function(e)
        {
            openEditModal($$(this).closest('.ve'));
            e.stopPropagation();
        }).on('click', '.ve-action-delete', function(e)
        {
            var $ve = $$(this).closest('.ve');
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
        $$.ajaxSetup({beforeSend: function (xhr)
        {
            xhr.setRequestHeader('X-Requested-With', {toString: function(){return 'XMLHttpRequest_VE';}});
        }});

        if($$.fn.tooltip)
        {
            $$('.ve-actions > li').tooltip({container: 'body', placement: 'bottom'});
        }

        if(isInPreview) $$('body').addClass('ve-preview-in');
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

            $$ = window.frames['visualPage'].$;
            initVisualPage();
        }
        catch(e){}
    };

    $('#visualPreviewBtn').on('mouseenter', function()
    {
        $$('body').addClass('ve-preview-hover');
    }).on('mouseleave', function()
    {
        $$('body').removeClass('ve-preview-hover');
    }).on('click', function()
    {
        var $body = $$('body');
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
