$(document).ready(function()
{
    $('#commentBox').load( createLink('message', 'index', 'objectType=article&objectID=' + v.articleID) );  
});
