$(document).ready(function()
{
    $('[name*=payment]').change(function()
    {
        if($('[name*=payment][value=alipay]').prop('checked'))
        {
            $('[name*=payment][value=alipaySecured]').prop('checked', false);
            $('.alipay-item').show();
        }

        if($('[name*=payment][value=alipaySecured]').prop('checked'))
        {
            $('[name*=payment][value=alipay]').prop('checked', false);
            $('.alipay-item').show();
        }

        if(!$('[name*=payment][value=alipay]').prop('checked') && !$('[name*=payment][value=alipaySecured]').prop('checked')) $('.alipay-item').hide();
    })
    $('[name*=payment]').change();
})
