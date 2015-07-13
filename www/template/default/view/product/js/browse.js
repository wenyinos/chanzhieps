$(function()
{
    $('.media-placeholder').each(function()
    {
        var $this = $(this);
        $this.attr('style', 'background-color: hsl(' + $this.data('id') * 57 % 360 + ', 80%, 90%)');
    });

    $('[data-toggle="tooltip"]').tooltip({container: 'body'});

    $('#modeControl a').click(function()
    {
        $('#modeControl a').removeClass('selected');
        $(this).addClass('selected');
        $('#modeControl').parents('.list-condensed').find('section').hide();
        $('#' + $(this).data('mode') + 'Mode').show();
    })
    $('#modeControl a').first().click();
})
