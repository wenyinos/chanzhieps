$(document).ready(function()
{
   	$('.little-image img').click(function()
    {
        $('.product-image.media-wrapper img').attr('src', $(this).attr('src').replace('s_', 'm_'));
        return false;
    });

    $('#commentBox').load( createLink('message', 'comment', 'objectType=article&objectID=' + v.productID) );  
})
