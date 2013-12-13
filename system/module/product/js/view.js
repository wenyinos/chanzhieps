$(document).ready(function()
{
   	$('a.little-image').click(function()
    {
        $('a.big-image').html($(this).html().replace('s_', 'm_'));
        $('a.big-image img').resizeImage(280, 280);
        return false;
   	});

    $('#commentBox').load( createLink('message', 'comment', 'objectType=article&objectID=' + v.articleID) );  
    $('a.big-image img').resizeImage(280, 280);
    $('a.little-image img').resizeImage(66, 66);
})
