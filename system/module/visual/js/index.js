(function(window, $)
{
    'use strict';
    var visualPage = $('#visualPage').get(0);
    var $$; // the jQuery object of visual page in iframe
    var isInPreview = false;
    var lang = $.extend(window.v.visualLang, window.v.lang, {blocks: window.v.visualBlocks});
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

    var reloadPage = function()
    {
        visualPage.contentWindow.location.replace(visualPageUrl);
    };

    var createActionLink = function(setting, action, options)
    {
        if(!$.isPlainObject(action)) action = setting.actions[action];
        return createLink(action.module || setting.module || setting.code, action.method || setting.method || action.name, (action.params || setting.params || '').format(options));
    }

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
                if(options.dismiss === 'update')
                {
                    updateVisualArea();
                }
                else if(options.dismiss === 'reload')
                {
                    reloadPage();
                    return;
                }
                $$('.ve-editing, .ve-blocks-show-border').removeClass('ve-editing ve-blocks-show-border');
            }
        }, options));
    };

    var getVisualOptions = function($ve)
    {
        var name;
        if(typeof $ve === 'string')
        {
            name = $ve;
            $ve = null;
        }
        else if($ve instanceof $$)
        {
            name = $ve.data('ve');
        }
        var options = $.extend({}, visuals[name], $ve ? $ve.data() : {});
        if($ve && name === 'block')
        {
            options = $.extend(options, $ve.closest('.blocks[data-region]').data());
        }
        return options;
    };

    // visual settings
    $.each(visuals, function(name, setting)
    {
        setting = $.extend(true, {code: name}, DEFAULT_CONFIG, $.isPlainObject(setting) ? setting : {name: setting});
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
                    id = $veMain.data('id') || parseInt(id.replace(name, ''));
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
            if(!setting.hidden)
            {
                setting.invisible = $.trim($veMain.html()) === '';
                $veMain.addClass('ve').toggleClass('ve-invisible', setting.invisible);
                var $heading = $$('<div class="ve-heading"><div class="ve-name"><i class="icon-move"> </i>'
                    + (name === 'block' ? $veMain.data('title') : setting.name)
                    + (setting.invisible ? (' (' + lang.invisible + ')') : '') + '</div></div>');

                var $actions = $$('<ul class="ve-actions"></ul>');
                $.each(setting.actions, function(actionName, action)
                {
                    if(actionName === 'move') $veMain.addClass('ve-movable');
                    if(!action || action.hidden) return;
                    $actions.append('<li data-toggle="tooltip" data-action="' + actionName + '" class="ve-action ve-action-' + actionName + '" title="' + action.text + '">'
                        + (action.icon ? '<i class="icon icon-' + action.icon + '"></i>' : action.text) + '</li>');
                });
                $heading.prepend($actions);
                $veMain.append($$('<div class="ve-cover"/>').append($heading));
            }
            else
            {
                var $actions = $$('<ul class="nav"></ul>');
                $.each(setting.actions, function(actionName, action)
                {
                    if(!action || action.hidden) return;
                    $actions.append('<li><button type="button" data-action="{name}" class="btn btn-block btn-ve ve-preview-hidden ve-action ve-action-{name} ve-action-bar"><i class="icon icon-{icon}"></i> {text}</button></li>'.format(action));
                });
                var position = setting.position && setting.position === 'top' ? 'prepend' : 'append';
                $veMain[position]($$('<div class="ve-actions-bar" data-ve="' + name + '"></div>').append($actions));
            }
            return $ve;
        }
    };

    var postActionData = function(name, action, options, callback, postData)
    {
        var setting = visuals[name];
        showLoadingMessage();
        $.post(
            createActionLink(setting, action, options),
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

            var region = $blocksHolder.data('region');
            if(!region)
            {
                console.error('The blocks area has no region attribute.');
            }

            var withGrid = $blocksHolder.hasClass('row');
            var page = region.substring(0, region.indexOf('-'));
            var location = region.substring(page.length + 1);

            $blocksHolder.attr(
            {
                "data-page": page,
                "data-location": location,
                "data-title": lang.blocks.pages[page] + '-' + lang.blocks.regions[page][location]
            });

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

            $blocksHolder.append('<div class="ve-block-actions ve-preview-hidden"><button type="button" class="btn btn-block btn-ve ve-action-addblock"><i class="icon icon-plus"></i> ' + lang.addBlock + '</button><ul class="breadcrumb"><li>' + lang.blocks.pages[page] + '</li><li>' + lang.blocks.regions[page][location] + '</li></ul></div>');
        });

        var $$body = $$('body');
        $$body.on('mouseenter', '.ve-action-addblock', function()
        {
            $$(this).closest('.blocks').addClass('ve-blocks-show-border');
        }).on('mouseleave', '.ve-blocks-show-border', function()
        {
            $$(this).closest('.blocks').removeClass('ve-blocks-show-border');
        }).on('click', '.ve-action-addblock', function()
        {
            var name = 'block';
            var setting = visuals[name];
            var action = setting.actions.add;
            var $blocksHolder = $$(this).closest('.blocks').addClass('ve-editing');
            var options = $.extend({}, setting, $blocksHolder.data());
            openModal(createActionLink(setting, action, options),
            {
                width : action.width || setting.width,
                icon  : action.icon || 'plus',
                title : (action.title || setting.title || action.text + ' ' + setting.name).format(options)
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

                if(oldGrid !== $col.attr('data-grid'))
                {
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
                }

                $$body.unbind('mousemove.ve.resize', mouseMove).unbind('mouseup.ve.resize', mouseUp);
                event.preventDefault();
                event.stopPropagation();
            };

            $$body.bind('mousemove.ve.resize', mouseMove).bind('mouseup.ve.resize', mouseUp);
            e.preventDefault();
            e.stopPropagation();
        });
    };

    var updateVisualArea = function($ve, response)
    {
        $ve = $ve || $$('.ve-editing').first();
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
        var $ve = null;
        if(typeof ve === 'string')
        {
            name = ve;
        }
        else
        {
            $ve = ve instanceof $$ ? ve : $$(this).closest('.ve');
            name = $ve.data('ve');
        }
        $$('.ve-editing').removeClass('ve-editing');
        if($ve) $ve.addClass('ve-editing');
        var setting = visuals[name];
        var options = getVisualOptions($ve || name);
        var action = setting.actions[actionName];
        openModal(createActionLink(setting, action, options),
        {
            width : action.width || setting.width,
            icon  : action.icon || 'pencil',
            title : action.title || setting.title || action.text + ' ' + (options.title || ''),
            loaded: function(e)
            {
                var modal$ = e.jQuery;
                modal$.setAjaxForm('.ve-form', function(response)
                {
                    $.closeModal();
                    updateVisualArea($ve, response);
                });
            },
            dismiss: action.onDismiss || setting.onDismiss
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
            var actionName = $action.data('action');
            var isBarAaction = $action.hasClass('ve-action-bar');
            var $ve = isBarAaction ? null : $action.closest('.ve');
            var name = isBarAaction ? $action.closest('.ve-actions-bar').data('ve') : $ve.data('ve');

            if(actionName === 'delete')
            {
                deleteVisualArea($ve || name);
            }
            else if(actionName !== 'move')
            {
                openCommonActionModal($ve || name, actionName);
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

    $('#visualReloadBtn').on('click', reloadPage);

    // extend helper methods
    $.updateVisualArea = updateVisualArea;
    $.setModalTitle = function(title)
    {
        $('#veModal').find('.modal-title').html(title);
    };

    $('[data-toggle=tooltip]').tooltip();
}(window, jQuery));
