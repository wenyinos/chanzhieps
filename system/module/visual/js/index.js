(function(window, $)
{
    'use strict';

    var DEBUG = window.v.debug;
    var visualPage = $('#visualPage').get(0);
    var isInPreview = false;
    var lang = $.extend(window.v.visualLang, window.v.lang, {blocks: window.v.visualBlocks});
    var visualPageUrl = visualPage.src;
    var visuals = window.v.visuals;
    var DEFAULT_ACTIONS_CONFIG =
    {
        edit: {icon: 'pencil', text: lang.actions.edit},
        add: {icon: 'plus', text: lang.actions.add},
        "delete": {icon: 'remove', text: lang.actions["delete"], confirm: lang.confirmDelete},
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

    var tidyBlocks = function($blocks)
    {
        if(typeof $blocks === 'string') $blocks = $$($blocks);
        else if(!($blocks instanceof $$)) $blocks = $$('.row.blocks .col-row > .row');
        $blocks = $blocks.closest('.row');
        $blocks.trigger('tidy');

    };

    var createActionLink = function(setting, action, options)
    {
        if(!$.isPlainObject(action)) action = setting.actions[action];
        return createLink(action.module || setting.module || setting.code, action.method || setting.method || action.name, (action.params || setting.params || '').format(options));
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
                if(options.dismiss === 'update')
                {
                    $.updateVisualArea();
                }
                else if(options.dismiss === 'reload')
                {
                    reloadPage();
                    return;
                }
                $$('.ve-editing, .ve-show-border-in-in, .ve-using').removeClass('ve-using ve-editing ve-show-border-in-in');
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
        var parentOptions = ($ve && name === 'block') ? $ve.closest('.blocks[data-region]').data() : {};
        var options = $.extend(parentOptions, visuals[name], $ve ? $ve.data() : {});
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
    if(DEBUG) console.log(visuals);

    var initCarouselArea = function($carousel, setting)
    {
        var createAction = setting.groupActions.add;
        createAction.url = createActionLink(setting, createAction, $carousel.data());
        $carousel.append('<div class="ve-actions-bar"><a href="{url}" class="ve-slide-action ve-action-addslide ve-btn-carousel" title="{text}" data-toggle="tooltip" data-action="add"><i class="icon icon-{icon}"></i></a></div>'.format(createAction));

        var $items = $carousel.find('.carousel-inner > .item');
        var actions = setting.itemActions;

        $.each(actions, function(actionName, action)
        {
            action.url = createActionLink(setting, action);
            action.name = actionName;
        });
        var itemsCount = $items.length;
        $items.each(function(idx)
        {
            idx += 1;
            var $item = $$(this).attr('data-order', idx);
            var itemData = $item.data();
            var $actions = $$('<div class="ve-actions-bar" />');
            $.each(actions, function(actionName, action)
            {
                var $a = $$(('<a href="' + action.url.format(itemData) + '" class="ve-btn-carousel ve-action-{name}slide ve-slide-action ve-btn-carousel" title="{text}" data-toggle="tooltip" data-action="{name}"><i class="icon icon-{icon}"></i></a>').format(action));

                if(actionName === 'up')
                {
                    if(idx === 1) $a.attr({title: lang.alreadyFirstSlide, disabled: 'disabled'}).addClass('disabled');
                    else $a.attr('title', action.text.format(idx - 1));

                    $a = $a.add('<span class="ve-carousel-order" data-toggle="tooltip" title="' + lang.slideOrder + '"> ' + idx + ' <small>/ ' + itemsCount + '</small></span>');
                }
                else if(actionName === 'down')
                {
                    if(idx === itemsCount) $a.attr({title: lang.alreadyLastSlide, disabled: 'disabled'}).addClass('disabled');
                    else $a.attr('title', action.text.format(idx + 1));
                }

                $actions.append($a);
            });
            $item.append($actions);
        });

        $carousel.find('[data-toggle="tooltip"]').tooltip({container: 'body'});

        $carousel.on('click', '.ve-slide-action', function()
        {
            var $this = $$(this);
            if($this.hasClass('disabled')) return false;

            var actionName = $this.data('action');
            var action = actions[actionName] || setting.groupActions[actionName];
            var actionUrl = $this.attr('href');
            $carousel.addClass('ve-using');
            $this.tooltip('hide');

            if(actionName === 'delete')
            {
                var confirmMessage = action.confirm || lang.confirmDelete;
                var callback = function(result)
                {
                    if(result)
                    {
                        postActionData(actionUrl, action, null, function(result)
                        {
                            if(result === 'success')
                            {
                                if($.updateVisualArea) $.updateVisualArea($carousel, result);
                            }
                        });
                    }
                }

                if(bootbox && bootbox.confirm)
                {
                    bootbox.confirm({size: 'small', message: confirmMessage, callback: callback});
                }
                else callback(confirm(confirmMessage));
            }
            else if(actionName === 'up' || actionName === 'down')
            {
                var $item = $this.closest('.item');
                var order = $item.data('order');
                if(actionName === 'up')
                {
                    $item.attr('data-order', order - 1);
                    $item.prev('.item').attr('data-order', order);
                }
                else
                {
                    $item.attr('data-order', order + 1);
                    $item.next('.item').attr('data-order', order);
                }
                var orders = {};
                $carousel.find('.carousel-inner > .item').each(function()
                {
                    $item = $(this);
                    orders['order[' + $item.data('id') + ']'] = $item.data('order');
                });

                postActionData(actionUrl, action, null, function(result)
                {
                    if(result === 'success')
                    {
                        if($.updateVisualArea) $.updateVisualArea($carousel, result);
                    }
                }, orders);
            }
            else
            {
                openModal(actionUrl,
                {
                    width : action.width,
                    icon  : action.icon,
                    height: 'auto',
                    title : action.title || action.text,
                    loaded: function(e)
                    {
                        var modal$ = e.jQuery;
                        modal$.setAjaxForm('.ve-form', function(response)
                        {
                            $.closeModal();
                            if($.updateVisualArea) $.updateVisualArea($carousel, response);
                        });
                    },
                    dismiss: action.onDismiss
                });
            }

            return false;
        });
    };

    var initVisualArea = function(ve)
    {
        var $ve = ve instanceof $$ ? ve : $$(this);
        var $veMain = $ve.not('style, script');

        if($veMain.data('veInit')) return;

        var name = $veMain.data('ve') || $veMain.attr('data-ve');

        // init blocks
        if(name === 'block')
        {
            if($veMain.parent().hasClass('block')) return;

            var blockID = $veMain.data('id');
            var isCarousel = $veMain.children('.carousel').length;
            var isRow = $veMain.hasClass('row');
            var title = $veMain.attr('data-title');

            if(!blockID)
            {
                var idAttr = $veMain.attr('id');
                if(idAttr) blockID = idAttr.replace('block', '');
            }

            if(!title)
            {
                if(isCarousel) title = lang.carousel;
                else if(isRow) title = lang.subRegion;
                else title = $.trim($ve.children('.panel-heading').children().first().text()) || (visuals.block.name + ' #' + blockID);
            }

            $veMain.data(
            {
                ve    : 'block',
                id    : blockID,
                title : '[' + title + ']'
            });
        }
        else
        {
            var id = $veMain.attr('id');
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

        $veMain.data('ve', name).data('veInit', true);
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
                    if(actionName === 'move')
                    {
                        $veMain.addClass('ve-movable');
                        $heading.find('.ve-name').addClass('ve-move-handler');
                    }
                    else if(actionName === 'edit' && !(name === 'block' && $veMain.hasClass('row')))
                    {
                        $heading.find('.ve-name').addClass('ve-action ve-action-edit').attr('action', 'edit');
                    }

                    if(!action || action.hidden) return;
                    $actions.append('<li data-action="' + actionName + '" class="ve-action ve-action-' + actionName + '" title="' + action.text + '">'
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
                $veMain[position]($$('<div class="ve-actions-bar" data-ve-name="' + name + '" data-target="#' + $veMain.attr('id') + '"></div>').append($actions));
            }

            if(name === 'carousel') initCarouselArea($ve, setting);
            return $ve;
        }
    };

    var postActionData = function(name, action, options, callback, postData)
    {
        var setting = visuals[name];
        showLoadingMessage();
        $.post(
            setting ? createActionLink(setting, action, options) : name,
            postData,
            function(data)
            {
                if($.isPlainObject(data))
                {
                    if(data.result === 'success')
                    {
                        callback && callback('success', data);
                        showMessage((data.message || action.success).format(options), 'success');
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
                    showMessage((action.fail || lang.operateFail).format(options), 'warning');
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
                if(withGrid) tidyBlocks($blocksHolder);
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

            $blocksHolder.find('.block, .panel-block, .col-row > .row').each(function()
            {
                var $ve = $$(this);
                if($ve.data('veInit')) return;

                $ve.attr('data-ve', 'block').data('ve', 'block');

                initVisualArea($ve);
                if(withGrid)
                {
                    $ve.children('.ve-cover').append('<div class="ve-resize-handler left"><i class="icon icon-resize-horizontal"></i></div><div class="ve-resize-handler right"><i class="icon icon-resize-horizontal"></i></div>');
                }
            });

            if(withGrid)
            {
                $blocksHolder.children('.col-row').each(function()
                {
                    var $row = $$(this);
                    if($row.data('veInit')) return;

                    $row = $row.data('veInit', true).children('.row').sortable(
                    {
                          trigger: '.ve-move-handler',
                          selector: '.col',
                          dragCssClass: '',
                          finish: function(e)
                          {
                              var orders = [];
                              $.each(e.list, function()
                              {
                                  orders.push($$(this).find('.ve').data('id'));
                              });

                              sortBlocks($row, orders);
                          }
                    });
                });
            }

            if($blocksHolder.data('veInit')) return;

            var region   = $blocksHolder.data('region');
            var page     = $blocksHolder.data('page') || (region ? region.substring(0, region.indexOf('-')) : null);
            var location = $blocksHolder.data('location') || (region ? region.substring(page.length + 1) : null);

            if(!region && (!page || !location))
            {
                console.error('The blocks area has no region or (page, location) attribute.');
            }

            $blocksHolder.data(
            {
                veInit: true,
                page: page,
                region: location,
                location:page + '-' + location,
                title: lang.blocks.pages[page] + '-' + lang.blocks.regions[page][location]
            });

            $blocksHolder.sortable(
            {
                  trigger: function($e)
                  {
                      return $e.find(($e.hasClass('col-row') ? '.row.ve > .ve-cover ' : '') + '.ve-move-handler');
                  },
                  selector: withGrid ? '.col' : '.ve',
                  dragCssClass: '',
                  finish: function(e)
                  {
                      var orders = [];
                      $.each(e.list, function()
                      {
                          orders.push($$(this).find('.ve').data('id'));
                      });

                      sortBlocks($blocksHolder, orders);
                  }
            });

            var actionsBar = '<div class="ve-block-actions ve-actions-bar ve-preview-hidden"><ul class="nav"><li><button type="button" class="btn btn-block btn-ve ve-action-addblock"><i class="icon icon-plus"></i> ' + lang.addBlock + '</button></li>';
            if(withGrid) actionsBar += '<li style="width: 35%"><button type="button" class="btn btn-block btn-ve ve-action-addSubRegion"><i class="icon icon-plus-sign"></i> ' + lang.addSubRegion + '</button></li>';
            actionsBar += '</ul><ul class="breadcrumb"><li>' + lang.blocks.pages[page] + '</li><li>' + lang.blocks.regions[page][location] + '</li></ul></div>'

            $blocksHolder.append(actionsBar);
        });

        var $$body = $$('body');
        if($$body.data('ve-blocks-events')) return;
        $$body.data('ve-blocks-events', true);

        $$body.on('mouseenter', '.ve-block-actions', function()
        {
            $$(this).closest('.blocks').addClass('ve-show-border-in');
        }).on('mouseleave', '.ve-show-border-in', function()
        {
            $$(this).closest('.blocks').removeClass('ve-show-border-in');
        }).on('click', '.ve-action-addblock', function()
        {
            var name = 'block';
            var setting = visuals[name];
            var action = setting.actions.add;
            var $blocksHolder = $$(this).closest('.blocks').addClass('ve-editing');
            var options = $.extend({title: $blocksHolder.attr('data-title'), location: $blocksHolder.attr('data-location'), page: $blocksHolder.attr('data-page')}, setting, $blocksHolder.data());
            openModal(createActionLink(setting, action, options),
            {
                width : action.width || setting.width,
                icon  : action.icon || 'plus',
                title : (action.title || setting.title || action.text + ' ' + setting.name).format(options)
            });
        }).on('mousedown', '.ve-resize-handler', function(e)
        {
            var $ve = $$(this).closest('.ve');
            var $col = $ve.parent().addClass('ve-resizing');
            var $row = $ve.closest('.row' + ($ve.hasClass('row') ? ':not(.ve)' : ''));
            var $blocksHolder = $ve.closest('.row.blocks');
            var startX = e.pageX;
            var startWidth = $col.width();
            var rowWidth = $row.width();
            var oldGrid = $col.attr('data-grid');
            var lastGrid = oldGrid;

            var mouseMove = function(event)
            {
                $ve.addClass('ve-editing ve-editing-resize');
                var x = event.pageX;
                var grid = Math.max(1, Math.min(12, Math.round(12 * (startWidth + (x - startX)) / rowWidth)));
                if(lastGrid != grid)
                {
                    $col.attr('data-grid', grid);
                    showMessage(lang.gridWidth + ': ' + Math.round(100*grid/12) + '% (' + grid + '/12)', 'show', {scale:  false});
                    lastGrid = grid;
                }
                event.preventDefault();
                event.stopPropagation();
            };

            var mouseUp = function(event)
            {
                $ve.removeClass('ve-editing ve-editing-resize');
                $col.removeClass('ve-resizing');

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
                        tidyBlocks($blocksHolder);
                    }, {grid: $col.attr('data-grid')});
                }
                else $.zui.messager.hide();

                $$body.off('mousemove.ve.resize', mouseMove).off('mouseup.ve.resize', mouseUp);
                event.preventDefault();
                event.stopPropagation();
            };

            $$body.on('mousemove.ve.resize', mouseMove).on('mouseup.ve.resize', mouseUp);
            e.preventDefault();
            e.stopPropagation();
        });
    };

    var updateVisualArea = function($ve, response)
    {
        $ve = $ve || $$('.ve-editing, .ve-using').first();
        var name = $ve.data('ve');
        var id = $ve.attr('id');
        var selector = '#' + id;
        if(name === 'block')
        {
            $ve = $ve.closest('.blocks[data-region]');
            if($ve.length)
            {
                selector = '.blocks[data-region="' + $ve.attr('data-region') + '"]';
            }
            else if(DEBUG)
            {
                console.error('Cant\'t find a region for the block on update visual area.');
            }
        }
        var $wrapper = $$('<div/>');
        $wrapper.load(visualPageUrl + ' ' + selector, function(data)
        {
            $ve.replaceWith($wrapper.find(selector));
            initVisualAreas();
            setTimeout(function()
            {
                if(name === 'block') tidyBlocks($ve);
            }, 100);
            showMessage(data.message || lang.saved, 'success');
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
        var url = createActionLink(setting, action, options);
        openModal(url,
        {
            width : action.width || setting.width,
            icon  : action.icon || 'pencil',
            title : action.title || setting.title || action.text + ' ' + (options.title || setting.name || ''),
            loaded: function(e)
            {
                var modal$ = e.jQuery;
                modal$.setAjaxForm('.ve-form', function(response)
                {
                    $.closeModal();
                    updateVisualArea($ve, response);
                });
                if(DEBUG) console.log('Modal loaded:', url);
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
        console.log('deleteVisualArea', name, $ve, options);
        var action = setting.actions["delete"];
        var confirmMessage = setting.actions["delete"].confirm.format(options);
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
                        tidyBlocks($ve.closest('.blocks.row'));
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

    var initVisualAreas = function()
    {
        $.each(visuals, function(name, setting)
        {
            $$('[data-ve="' + name + '"], #' + name).each(initVisualArea);
        });

        initBlocks();
    };

    var initVisualPage = function()
    {
        // load visual edit style
        if(window.v.visualStyle) $$('head').append($$('<link type="text/css" rel="stylesheet" />').attr('href', window.v.visualStyle));

        // init visual edit area
        initVisualAreas();

        // bind event
        var $$body = $$('body').on('click', function()
        {
            $(document).trigger('click.zui.dropdown.data-api');
        })
        .on('click', '.ve-action', function(e)
        {
            var $action = $$(this);
            var actionName = $action.data('action');
            var isBarAaction = $action.hasClass('ve-action-bar');
            var $ve = isBarAaction ? null : $action.closest('.ve');
            var name;
            if(isBarAaction)
            {
                var $bar = $action.closest('.ve-actions-bar');
                name = $bar.data('veName');
                $$($bar.data('target')).addClass('ve-using');
            }
            else
            {
                name = $ve.data('ve');
            }

            if(actionName === 'delete')
            {
                deleteVisualArea($ve || name);
            }
            else if(actionName !== 'move')
            {
                openCommonActionModal($ve || name, actionName);
            }
            e.stopPropagation();
            return false;
        });

        // set ajax options
        $$.ajaxSetup({beforeSend: function (xhr)
        {
            xhr.setRequestHeader('X-Requested-With', {toString: function(){return 'XMLHttpRequest_VE';}});
        }});

        if($$.fn.tooltip)
        {
            $$('.ve-actions > li').tooltip({container: 'body', placement: 'bottom'});
            $$('[data-toggle=tooltip]').tooltip({container: 'body'});
        }

        if(isInPreview) $$body.addClass('ve-preview-in');

        $$body.addClass('ve-mode');

        setTimeout(tidyBlocks, 500);
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
                window.history.replaceState({}, title, url);

                $('#visualPageName').html('<i class="icon icon-external-link-sign"></i>' + ((title && title.indexOf(' ') > -1) ? title.split(' ')[0] : title)).attr('href', visualPageUrl);
            }

            window.$$ = window.frames['visualPage'].$;
            initVisualPage();
        }
        catch(e){}
    };

    $('#visualPreviewBtn').on('mouseenter', function()
    {
        $$('body').addClass('ve-preview-hover');
        tidyBlocks();
    }).on('mouseleave', function()
    {
        $$('body').removeClass('ve-preview-hover');
        tidyBlocks();
    }).on('click', function()
    {
        var $body = $$('body');
        $body.toggleClass('ve-preview-in');
        isInPreview = $body.hasClass('ve-preview-in');
        $(this).toggleClass('text-danger', isInPreview).html(isInPreview ? ("<i class='icon-eye-close'></i> " + lang.exitPreview)
            : ("<i class='icon-eye-open'></i> " + lang.preview));
        tidyBlocks();
    });

    $('#visualReloadBtn').on('click', reloadPage);

    $('#customThemeBtn').on('click', function()
    {
        var $this = $(this);
        var url = $(this).attr('href');
        openModal(url,
        {
            width : 1200,
            icon  : 'cog',
            title : $this.attr('title') || $this.attr('data-original-title'),
            loaded: function(e)
            {
                var modal$ = e.jQuery;
                modal$.setAjaxForm('.ve-form', function(response)
                {
                    $.closeModal();
                    reloadPage();
                });
                if(DEBUG) console.log('Modal loaded:', url);
            }
        });
        return false;
    });

    // extend helper methods
    $.updateVisualArea = updateVisualArea;
    $.setModalTitle = function(title)
    {
        $('#veModal').find('.modal-title').html(title);
    };

    $('[data-toggle=tooltip]').tooltip({container: 'body'});
}(window, jQuery));
