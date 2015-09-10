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
        move: {icon: 'move', text: lang.actions.move, hidden: true}
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

    var getVisualOptions = function($ve)
    {
        var name = $ve.data('ve');
        var options = $.extend({}, visuals[name], $ve.data());
        if(name === 'block')
        {
            options = $.extend(options, $ve.closest('.blocks[data-region]').data());
        }
        return options;
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
            setting.actions[actionName] = $.extend({name: actionName}, DEFAULT_ACTIONS_CONFIG[actionName], actionSetting)
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
            var id = $veMain.attr('id');
            name = $veMain.data('ve');
            if(id)
            {
                if(name)
                {
                    id = parseInt(id.replace(name, ''));
                    $veMain.attr('data-id', id);
                }
                else
                {
                    name = id;
                }
            }
        }

        $veMain.data('ve', name);
        var setting = visuals[name];
        if($.isPlainObject(setting))
        {
            setting.invisible = $.trim($veMain.html()) === '';
            $veMain.addClass('ve').toggleClass('ve-invisible', setting.invisible);
            var $actions = $$('<ul class="ve-actions"></ul>');
            var $heading = $$('<div class="ve-heading"><div class="ve-name"><i class="icon-move"> </i>'
                + (name === 'block' ? $veMain.data('title') : setting.name)
                + (setting.invisible ? (' (' + lang.invisible + ')') : '') + '</div></div>');

            $.each(setting.actions, function(actionName, action)
            {
                if(actionName === 'move') $veMain.addClass('ve-movable');
                if(action.hidden) return;
                $actions.append('<li data-toggle="tooltip" data-action="' + actionName + '" class="ve-action ve-action-' + actionName + '" title="' + action.text + '">'
                    + (action.icon ? '<i class="icon icon-' + action.icon + '"></i>' : action.text) + '</li>');
            });

            $heading.prepend($actions);
            $veMain.append($$('<div class="ve-cover"/>').append($heading));
            return $ve;
        }
    };

    var postActionData = function(name, action, options, callback, postData)
    {
        var setting = visuals[name];
        showLoadingMessage();
        $.post(
            createLink(action.module || setting.module || 'visual', action.method || (action.name + name), (action.params || setting.params || '').format(options)),
            postData,
            function(data)
            {
                if($.isPlainObject(data))
                {
                    if(data.result === 'success')
                    {
                        callback && callback('success', data);
                        showMessage((data.message || action.success || lang.deleted).format(options), 'success');
                    }
                    else
                    {
                        callback && callback('fail', data);
                        showMessage((data.message || action.fail || lang.operateFail).format(options), 'danger');
                    }
                }
                else
                {
                    callback && callback('unknown', data);
                    showMessage((action.fail || lang.operateFail).format(options), 'danger');
                }
            },
            'json'
        ).error(function(data)
        {
            callback && callback('error', data);
            showMessage((action.fail || lang.operateFail).format(options), 'danger');
        });
    };

    var sortBlocks = function($blocksHolder, orders)
    {
        var withGrid = $blocksHolder.hasClass('row');
        var name = 'block';
        var setting = visuals[name];
        var action = setting.actions.move;
        var options = $.extend({orders: orders}, setting, $blocksHolder.data());

        postActionData(name, action, options, function(result)
        {
            if(result === 'success')
            {
                if(withGrid) $blocksHolder.trigger('tidy');
            }
        }, orders.join(','));
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
            var withGrid = $blocksHolder.hasClass('row');
            $blocksHolder.find('.block, .panel-block').each(function()
            {
                var $ve = $$(this);
                initVisualArea($ve);

                if(withGrid)
                {
                    $ve.find('.ve-cover').append('<div class="ve-resize-handler left"><i class="icon icon-resize-horizontal"></i></div><div class="ve-resize-handler right"><i class="icon icon-resize-horizontal"></i></div>');
                }
            });

            $blocksHolder.sortable({trigger: '.ve-name', selector: withGrid ? '.col' : '.ve', dragCssClass: '', finish: function(e)
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

        var $$body = $$('body');
        $$body.on('mouseenter', '.ve-action-addblock', function()
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
        }).on('mousedown', '.ve-resize-handler', function(e)
        {
            var $ve = $$(this).closest('.ve');
            var $col = $ve.parent();
            var $row = $ve.closest('.row');
            var $blocksHolder = $ve.closest('.row.blocks');
            var startX = e.pageX;
            var startWidth = $col.width();
            var rowWidth = $row.width();
            var oldGrid = $col.attr('data-grid');

            var mouseMove = function(event)
            {
                $ve.addClass('ve-editing ve-editing-resize');
                var x = event.pageX;
                var grid = Math.max(1, Math.min(12, Math.round(12 * (startWidth + (x - startX)) / rowWidth)));
                $col.attr('data-grid', grid);
                event.preventDefault();
                event.stopPropagation();
            };

            var mouseUp = function(event)
            {
                $ve.removeClass('ve-editing ve-editing-resize');
                var name = 'block';
                var setting = visuals[name];
                var options = getVisualOptions($ve);
                postActionData(name, setting.actions.layout, options, function(result)
                {
                    if(result !== 'success')
                    {
                        $col.attr('data-grid', oldGrid);
                    }
                    $blocksHolder.trigger('tidy');
                }, {grid: $col.attr('data-grid')});
                $$body.unbind('mousemove.ve.resize', mouseMove).unbind('mouseup.ve.resize', mouseUp);
                event.preventDefault();
                event.stopPropagation();
            };

            $$body.bind('mousemove.ve.resize', mouseMove).bind('mouseup.ve.resize', mouseUp);
            e.preventDefault();
            e.stopPropagation();
        });
    };

    var updateVisualArea = function(response)
    {
        var $ve = $$('.ve-editing').first();
        var name = $ve.data('ve');
        var id = $ve.attr('id');
        var parentSelector = '';
        if(name === 'block')
        {
            var $blocksHolder = $ve.closest('.blocks[data-region]');
            if($blocksHolder.length)
            {
                parentSelector = '.blocks[data-region="' + $blocksHolder.data('region') + '"] ';
            }
        }
        var selector = parentSelector + '#' + id + ', ' + parentSelector + '#' + id + '+style';
        var $wrapper = $$('<div/>');
        $wrapper.load(visualPageUrl + ' ' + selector, function(data)
        {
            showMessage(data.message || lang.saved, 'success');
            var $veExtra = $ve.next();
            if($veExtra.is('style')) $veExtra.remove();
            selector = '#' + id + ', #' + id + '+style';
            var $newVe = initVisualArea($wrapper.find(selector));
            $ve.replaceWith($newVe);
            setTimeout(function()
            {
                if(name === 'block') $newVe.closest('.blocks.row').trigger('tidy');
            }, 100);
        });
    };

    var openCommonActionModal = function(ve, actionName)
    {
        actionName = actionName || 'edit';
        var $ve = ve instanceof $$ ? ve : $$(this).closest('.ve');
        var name = $ve.data('ve');
        $$('.ve-editing').removeClass('ve-editing');
        $ve.addClass('ve-editing');
        var setting = visuals[name];
        var options = getVisualOptions($ve);
        var action = setting.actions[actionName];
        openModal(createLink(action.module || setting.module || 'visual', action.method || (actionName + name), (action.params || setting.params || '').format(options)),
        {
            width : action.width || setting.width,
            icon  : action.icon || 'pencil',
            title : action.title || setting.title || action.text + ' ' + options.title,
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
        var options = getVisualOptions($ve);
        var action = setting.actions.delete;
        var confirmMessage = setting.actions.delete.confirm.format(options);
        var callback = function(result)
        {
            if(result)
            {
                postActionData(name, action, options, function(result)
                {
                    if(result === 'success')
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
                    }
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
        $$('body').on('click', '.ve-name', openCommonActionModal)
        .on('click', '.ve-action', function(e)
        {
            var $action = $$(this);
            var $ve = $action.closest('.ve');
            var actionName = $action.data('action');
            if(actionName === 'delete')
            {
                deleteVisualArea($ve);
            }
            else if(actionName !== 'move')
            {
                openCommonActionModal($ve, actionName);
            }
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
                var url = createLink('visual', 'index', 'referer=' + visualPageUrl);
                window.history.pushState({}, title, url);

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
