(function(window, $)
{
    'use strict';
    var visualPage = $('#visualPage').get(0);
    var $$;
    var isInPreview = false;
    var lang = $.extend(window.v.visualLang, window.v.lang);
    var visualPageUrl = visualPage.src;
    var visuals = window.v.visuals;
    var DEFAULT_ACTIONS_CONFIG =
    {
        edit: {icon: 'pencil', text: lang.actions.edit},
        delete: {icon: 'remove', text: lang.actions.delete, confirm: lang.confirmDelete},
        move: {icon: 'move', text: lang.actions.move}
    };
    var DEFAULT_CONFIG = {width: '80%', actions: {edit: true}};

    var showMessage = function(message, type, options)
    {
        if($.isPlainObject(type))
        {
            options = type;
            type = '';
        }
        $.messager[type || 'show'](message, $.extend({placement: 'center'}, options));
    };

    // visual settings
    $.each(visuals, function(name, setting)
    {
        setting = $.extend(true, {}, DEFAULT_CONFIG, $.isPlainObject(setting) ? setting : {name: setting});
        $.each(setting.actions, function(actionName, action)
        {
            var actionSetting;
            if(action === false) return;
            else if(action === true)
            {
                actionSetting = {};
            }
            else if($.isPlainObject(action))
            {
                actionSetting = action;
            }
            else
            {
                actionSetting = {text: action};
            }
            setting.actions[actionName] = $.extend({}, DEFAULT_ACTIONS_CONFIG[actionName], actionSetting)
        });
        visuals[name] = setting;
    });
    $.visuals = visuals;

    var initVisualArea = function(ve)
    {
        var $ve = ve instanceof $$ ? ve : $$(this);
        var $veMain = $ve.not('style, script');
        var name = '';

        // init blocks
        if($veMain.hasClass('block') || $veMain.hasClass('panel-block'))
        {
            if($veMain.parent().hasClass('block')) return;
            var blockID = $veMain.attr('id').replace('block', '');
            $veMain.attr(
            {
                'data-ve'   : 'block',
                'data-id'   : blockID,
                'data-title': $.trim($ve.children('.panel-heading').children().first().text()) || ('#' + blockID)
            });
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
            setting.invisible = $.trim($veMain.html()) === '';
            $veMain.addClass('ve').toggleClass('ve-invisible', setting.invisible);
            var $actions = $$('<ul class="ve-actions"></ul>');
            var $heading = $$('<div class="ve-heading"><div class="ve-name">'
                + setting.name + (name === 'block' ? (' #' + $veMain.data('id')) : '')
                + (setting.invisible ? (' (' + lang.invisible + ')') : '') + '</div></div>');

            $.each(setting.actions, function(actionName, action)
            {
                $actions.append('<li data-toggle="tooltip" class="ve-action-' + actionName + '" title="' + action.text + '">'
                    + (action.icon ? '<i class="icon icon-' + action.icon + '"></i>' : action.text) + '</li>');
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
            showMessage(lang.saved, 'success');
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
        var options = $.extend({}, setting, $ve.data());
        var action = setting.actions.edit;
        window.modalTrigger.show(
        {
            name  : 'veModal',
            url   : createLink(action.module || 'visual', action.method || ('edit' + name), (action.params || setting.params || '').format(options)),
            type  : 'iframe',
            width : setting.width,
            icon  : setting.icon || 'pencil',
            title : setting.title || action.text + ' ' + setting.name,
            hidden: function()
            {
                $$('.ve-editing').removeClass('ve-editing');
            }
        });
    };

    var deleteVisualArea = function(ve)
    {
        var $ve = ve instanceof $$ ? ve : $$(this).closest('.ve');
        var name = $ve.data('ve');
        var setting = visuals[name];
        var options = $.extend({}, setting, $ve.data());
        var action = setting.actions.edit;
        var confirmMessage = setting.actions.delete.confirm.format(options);
        var callback = function(result)
        {
            if(result)
            {
                showMessage(lang.doing, {time: 0});
                $.post(
                    createLink(action.module || 'visual', action.method || ('delete' + name), (action.params || setting.params || '').format(options)),
                    function(data)
                    {
                        console.log('data', data);
                        if($.isPlainObject(data))
                        {
                            if(data.result === 'success')
                            {
                                var $forRemove = $ve;
                                if(name === 'block')
                                {
                                    var $veParent = $ve.parent();
                                    if($veParent.is('.col, [class*="col-"]')) $forRemove = $veParent;
                                }
                                $forRemove.remove();
                                showMessage((data.message || action.success || lang.deleted).format(options), 'success');
                            }
                            else
                            {
                                showMessage((data.message || action.fail || lang.operateFail).format(options), 'danger');
                            }
                        }
                        else
                        {
                            showMessage((action.fail || lang.operateFail).format(options), 'danger');
                        }
                    },
                    'json'
                ).error(function(data)
                {
                    showMessage((action.fail || lang.operateFail).format(options), 'danger');
                });
            }
        }

        if(bootbox && bootbox.confirm)
        {
            bootbox.confirm({size: 'small', message: confirmMessage, callback: callback});
        }
        else callback(confirm(confirmMessage));
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
            deleteVisualArea($$(this).closest('.ve'));
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
