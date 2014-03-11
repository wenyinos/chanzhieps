$(document).ready(function() 
{
    setRequiredFields();

    $.setAjaxModal();
    $.setAjaxForm('#ajaxForm');
    $.setAjaxDeleter('.deleter');
    $.setReloadDeleter('.reloadDeleter');
    $.setReload('.reload');

    /* Ping for keep login every six minute. */
    if(needPing) setInterval('ping()', 1000 * 360);

    /* Enable lightbox. */
    $("[data-toggle=lightbox]").lightbox();
    
    /* Load message notify. */
    $('#headNav #msgBox').load(createLink('message', 'notify'), function()
    {
        if($('#headNav #msgBox').find('.label').length > 0) $('#msgBox').removeClass('hide').show();
    });

    /* Set 'go to top' button. */
    setGo2Top();

    /* Slide pictures start.   */
    if($('#slide').length)
    {
        $('#slide').carousel();
        $('#slide .item').first().addClass('active');
    }

    /* fixed submenu position for browser which doesn't suppport relative postion in a table cell, like firefox. */
    if(navigator.userAgent.indexOf('Firefox') != -1)
    {
        $('#navbar .dropdown > .dropdown-menu').each(function(){$(this).css('left', $(this).closest('.dropdown').position().left - 2);});
    }

    /* Auto ajust block grid width */
    autoBlockGrid();

    /* Handle touch event for mobile devices */
    handleTouch();

    /* Mark empty headNav */
    var headNav = $('#headNav');
    if(!headNav.find('nav a').length) headNav.addClass('hide');
});

