$(document).ready(function()
{
    $('[name*=payment]').change(function()
    {
        if($('[name*=payment][value=alipay]').prop('checked')) $('.alipay-item').show();
        if(!$('[name*=payment][value=alipay]').prop('checked')) $('.alipay-item').hide();
    })
    $('[name*=payment]').change();
})
