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
                    bootbox.dialog(
                    {  
                        message: v.addToCartSuccess,  
                        buttons:
                        {  
                            back:
                            {  
                                label:     v.goback,
                                className: 'btn-default',  
                                callback:  function(){location.reload();}  
                            },
                            cart:
                            {  
                                label:     v.gotoCart,  
                                className: 'btn-primary',  
                                callback:  function(){location.href = createLink('cart', 'browse');}  
                            }  
                        }  
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
