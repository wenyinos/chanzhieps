$(function()
{
    tempColor = new color();
    $('.color').each(function()
    {
        var $this = $(this);
        var c = $this.attr('data');

        ($this.hasClass('input-group') ? $this.find('.input-group-addon') : $this).css({'background': c, 'color': (new color(c)).contrast().hexStr()});
    }).click(function()
    {
        var $this = $(this);
        if($this.hasClass('input-group')) return;
        var $plate = $this.closest('.colorplate');
        $plate.find('.color.active').removeClass('active');
        if($this.hasClass('color-tile')) $plate.find('.input-color').val($this.attr('data')).change();
        $this.addClass('active');
    });

    $('.input-color').on('keyup change', function()
    {
        var $this = $(this);
        var val = $this.val();
        $this.closest('.colorplate').find('.color.active').removeClass('active');

        if(tempColor.isHexColor(val))
        {
            var ic = (new color(val)).contrast();
            $this.attr('placeholder', val).closest('.color').removeClass('error').find('.input-group-addon').css({'background': val, 'color': ic.hexStr()});
        }
        else
        {
            $this.closest('.color').addClass('error');
        }
    });

    $('input:radio[name="bg"]').change(function()
    {
        $('.bg-section').removeClass('hide').not('[data-id="' + $(this).val() + '"]').addClass('hide');
    });
    $('.bg-section:not([data-id="' + $('input:radio[name="bg"]:checked').val() + '"])').addClass('hide');
});
