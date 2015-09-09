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
        add: {icon: 'plus', text: lang.actions.add},
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
        $.zui.messager[type || 'show'](message, $.extend({placement: 'center'}, options));
    };

    var showLoadingMessage = function()
    {
        showMessage(lang.doing, {time: 0, close: false});
    };

    var openModal = function(url, options)
    {
        window.modalTrigger.show(
        $.extend(
        {
            iframeBodyClass : 'body-modal-ve',
            name            : 'veModal',
            url             : url,
            type            : 'iframe',
            width           : '80%',
            icon            : 'pencil',
            title           : '',
            mergeOptions    : true,
            hidden          : function()
            {
                $$('.ve-editing, .ve-blocks-show-border').removeClass('ve-editing ve-blocks-show-border');
            }
        }, options));
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
        if($veMain.is('.block, .panel-block'))
        {
            if($veMain.parent().hasClass('block')) return;
            var blockID = $veMain.data('id');
            if(!blockID)
            {
                blockID = $veMain.attr('id').replace('block', '');
            }
            $veMain.attr(
            {
                'data-ve'   : 'block',
                'data-id'   : blockID,
                'data-title': $veMain.children('.carousel').length ? lang.carousel : ($.trim($ve.children('.panel-heading').children().first().text()) || (visuals.block.name + ' #' + blockID))
            });
            name = 'block';
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
                + (name === 'block' ? $veMain.data('title') : setting.name)
                + (setting.invisible ? (' (' + lang.invisible + ')') : '') + '</div></div>');

            $.each(setting.actions, function(actionName, action)
            {
                if(action.hidden) return;
                $actions.append('<li data-toggle="tooltip" class="ve-action-' + actionName + '" title="' + action.text + '">'
                    + (action.icon ? '<i class="icon icon-' + action.icon + '"></i>' : action.text) + '</li>');
            });

            $heading.prepend($actions);
            $veMain.append($$('<div class="ve-cover"/>').append($heading));
            return $ve;
        }
    };

    var sortBlocks = function($blocksHolder, orders)
    {
        var withGrid = $blocksHolder.hasClass('row');
        var name = 'block';
        var setting = visuals[name];
        var action = setting.actions.move;
        var options = $.extend({orders: orders}, setting, $blocksHolder.data());

        showLoadingMessage();
        $.post(
            createLink(action.module || 'visual', action.method || ('move' + name), (action.params || setting.params || '').format(options)),
            {orders: orders.join(',')},
            function(data)
            {
                if($.isPlainObject(data))
                {
                    if(data.result === 'success')
                    {
                        if(withGrid) $blocksHolder.trigger('tidy');
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
    };

    var addBlock = function(region, blockID)
    {
        var name = 'block';
        var setting = visuals[name];
        var action = setting.actions.move;
        showMessage(lang.saved, 'success');
        $.closeModal();
    };

    $.addBlock = addBlock;

    var initBlocks = function()
    {
        $$('.blocks').each(function()
        {
            var $blocksHolder = $$(this);
            $blocksHolder.find('.block, .panel-block').each(initVisualArea);

            $blocksHolder.sortable({trigger: '.ve-cover', selector: '.col', dragCssClass: '', finish: function(e)
            {
                var orders = [];
                $.each(e.list, function()
                {
                    orders.push($(this).find('.ve').data('id'));
                });

                sortBlocks($blocksHolder, orders);
            }});

            $blocksHolder.append('<div class="ve-block-actions"><button type="button" class="btn btn-block btn-ve ve-preview-hidden ve-action-addblock"><i class="icon icon-plus"></i> {addBlock}</button></div>'.format(lang));
        });

        $$('body').on('mouseenter', '.ve-action-addblock', function()
        {
            $$(this).closest('blocks').addClass('ve-blocks-show-border');
        }).on('mouseleave', '.ve-action-addblock', function()
        {
            $$(this).closest('blocks').removeClass('ve-blocks-show-border');
        }).on('click', '.ve-action-addblock', function()
        {
            var name = 'block';
            var setting = visuals[name];
            var action = setting.actions.add;
            var $blocksHolder = $$(this).closest('.blocks');
            var options = $.extend({}, setting, $blocksHolder.data());
            openModal(createLink(action.module || 'visual', action.method || ('add' + name), (action.params || '').format(options)),
            {
                width : action.width || setting.width,
                icon  : action.icon || 'plus',
                title : action.title || setting.title || action.text + ' ' + setting.name
            });
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
            showMessage(data.message || lang.saved, 'success');
            var $veExtra = $ve.next();
            if($veExtra.is('style')) $veExtra.remove();
            $ve.replaceWith(initVisualArea($wrapper.find(selector)));
            setTimeout(function()
            {
                // $ve.closest('.blocks.row').trigger('tidy');
            }, 100);
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
        openModal(createLink(action.module || setting.module || 'visual', action.method || ('edit' + name), (action.params || setting.params || '').format(options)),
        {
            width : action.width || setting.width,
            icon  : action.icon || 'pencil',
            title : action.title || setting.title || action.text + ' ' + setting.name,
            loaded: function(e)
            {
                var modal$ = e.jQuery;
                modal$.setAjaxForm('.ve-form', function(response)
                {
                    $.closeModal();
                    updateVisualArea(response);
                });
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
                showLoadingMessage();
                $.post(
                    createLink(action.module || 'visual', action.method || ('delete' + name), (action.params || setting.params || '').format(options)),
                    function(data)
                    {
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
                                $forRemove.hide();
                                $ve.closest('.blocks.row').trigger('tidy');
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

    $('[data-toggle=tooltip]').tooltip();
}(window, jQuery));
