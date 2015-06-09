$(document).ready(function()
{
   	$('.little-image').mouseover(function()
    {
        $('.product-image.media-wrapper img').attr('src', $(this).find('img').attr('src').replace('s_', 'f_'));
        return false;
    });

    $('.btn-buy').click(function()  { location.href = createLink('order', 'confirm', 'product=' + v.productID + '&count=' + $('#count').val()); });

    $('.btn-cart').click(function() 
    { 
        var button = $('#cartBox');
        cartLink = createLink('cart', 'add', 'product=' + v.productID + '&count=' + $('#count').val());
        $.getJSON(cartLink, function(response)
        {
            if(response.result == 'success')
            {
                loadCartInfo(true);
            }
            else
            {
                location.href = response.locate;           
            }
        });
    });
    $('.icon-plus').parent().click(function() { $('#count').val(parseInt($('#count').val()) + 1); });
    $('.icon-minus').parent().click(function() 
    { 
        if($('#count').val() <= 1) return false;
        $('#count').val(parseInt($('#count').val()) - 1);  
    });
})
