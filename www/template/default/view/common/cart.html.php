<?php if($this->app->user->account != 'guest'):?>
<script>
    function loadCartInfo(twinkle)
    {
        $('#headNav .login-msg').append("<span class='text-center text-middle' id='cartBox'></span>");
        $('#cartBox').load(createLink('cart', 'printTopBar'),
            function()
            {
                if(twinkle) 
                {
                    $('#cartBox a .text-danger').css('color', '#fff');
                    $('#cartBox a').addClass('btn btn-lg btn-success').fadeOut().fadeToggle(
                        'slow',
                        'linear',
                        function()
                        {
                            $('#cartBox a').removeClass('btn btn-lg btn-success')
                            $('#cartBox a .text-danger').css('color', '');
                        });
                }
            }
        );
    }

$(document).ready(function()
{
    loadCartInfo(false);
})
</script>
<?php endif;?>
