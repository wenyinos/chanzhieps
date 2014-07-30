$(function()
{
    tempColor = new color();
    $('.color').each(function()
    {
        var $this = $(this);
        var c = $this.attr('data');
        if(!c) return;
        var cc = new color(c).contrast().hexStr();

        ($this.hasClass('input-group') ? $this.find('.input-group-btn .dropdown-toggle') : $this).css({'background': c, 'color': cc}).find('.caret').css('border-top-color', cc);
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
            var ic = (new color(val)).contrast().hexStr();
            $this.attr('placeholder', val).closest('.color').removeClass('error').find('.input-group-btn .dropdown-toggle').css({'background': val, 'color': ic}).find('.caret').css('border-top-color', ic);;
        }
        else
        {
            $this.closest('.color').addClass('error');
        }
    });

    if(v.type == 'phpcode' && !v.cancreatephp)
    {
        var message = '<div class="alert"><h5>请按照下面的步骤操作以确认您的管理员身份。</h5>';
        message += '<p>创建 <input value="' + v.okFile + '" readonly class="autoSelect red"/> 文件。如果存在该文件，使用编辑软件打开，重新保存一遍。</p></div>';

        bootbox.alert(message, function()
        {
            location.href = createLink('block', 'create');
        });
    }
});
