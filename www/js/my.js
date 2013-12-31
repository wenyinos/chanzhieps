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

    /* Set 'back to top' button. */
    setBack2Top();
});
