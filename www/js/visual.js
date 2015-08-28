$(function()
{
    var $document = $(document);
    var visuals = window.v.visuals;

    var initVisualArea = function(ve)
    {
        var $ve = ve instanceof jQuery ? ve : $(this);
        var code = $ve.data('ve');
        $ve.addClass('ve');
        $ve.append('<div class="ve-hint"><i class="icon icon-pencil"></i><span class="ve-hint-name nobr"> ' + window.v.visualEdit + ' ' + visuals[code] + '</span></div>');
        return $ve;
    };

    $.updateVisualArea = function(data)
    {
        var $ve = $('.ve-editing').first();
        var code = $ve.data('ve');
        var selector = '[data-ve="' + code + '"]';
        var $wrapper = $('<div/>');
        $wrapper.load(window.location.href + ' ' + selector, function(data)
        {
            console.log('load', data);
            $.messager.success("已保存！");
            $ve.replaceWith(initVisualArea($wrapper.find(selector)));
        });
    };

    $.ajaxSetup({beforeSend: function (xhr)
    {
        xhr.setRequestHeader('X-Requested-With', {toString: function(){return 'XMLHttpRequest_VE';}});
    }});

    $('[data-ve]').each(initVisualArea);
    $document.on('click', '.ve', function()
    {
        var $ve = $(this);
        var code = $ve.data('ve');
        $('.ve-editing').removeClass('ve-editing');
        $ve.addClass('ve-editing');
        window.modalTrigger.show(
        {
            url: window.config.webRoot + 'admin.php?m=visual&f=' + code,
            type: 'iframe',
            width: '70%',
            icon: 'pencil',
            title: $ve.find('.ve-hint').text()
        });
    });

    $('#visualPreviewBtn').on('mouseenter', function()
    {
        $('body').addClass('ve-preview-in');
    }).on('mouseleave', function()
    {
        $('body').removeClass('ve-preview-in');
    });
});
