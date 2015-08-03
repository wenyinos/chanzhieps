$(function()
{
    $(document).on('click', '.btn-buy', function()
    {
        window.location.href = $(this).data('url').replace('count', $('#count').val());
    }).on('click', '.btn-cart', function()
    {
        var $btn = $(this);
        if($btn.hasClass('disabled')) return;

        $btn.addClass('disabled')
        $.getJSON($btn.data('url').replace('count', $('#count').val()), function(data, status)
        {
            if(status === 'success')
            {
                if($.isPlainObject(data) && data.result === 'success')
                {
                    if($.isFunction($.refreshCart))
                    {
                        $.refreshCart();
                    }
                    if(window.v && window.v.addToCartSuccess)
                    {
                        $.messager.success(window.v.addToCartSuccess);
                    }
                }
                else if(data && data.locate)
                {
                    window.location.href = data.locate;
                }
                else
                {
                    $.messager.danger($.param(data));
                }
            }
            else
            {
                if(window.v && window.v.lang.timeout)
                {
                    $.messager.danger(window.v.lang.timeout);
                }
            }
            $btn.removeClass('disabled');
        });
    });
});
