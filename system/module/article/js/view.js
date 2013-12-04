$(document).ready(function()
{
    $('#commentBox').load( createLink('message', 'comment', 'objectType=article&objectID=' + v.articleID) );  
    $('.article-file img').resizeImage(350, 200);
});
