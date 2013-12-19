$(document).ready(function()
{
    $('#commentBox').load( createLink('message', 'comment', 'objectType=book&objectID=' + v.articleID) );  
});
