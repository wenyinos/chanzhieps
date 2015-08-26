$(document).ready(function()
{
    $('.submit').click(function()
    {
        var groupID = $(this).parents('.editGroup').find('.groupID').val();
        $.setAjaxForm('.editGroupForm' + groupID); 
    });

    $('.icon-edit').click(function()
    {
        $(this).hide();
        $(this).next('.deleter').hide();
        $(this).prev('#name').hide();
        $(this).parents('.card-heading').find('form').show();
        $(this).parents('.card-heading').find('#input').focus();
    });

    //$('.edit.submit').click(function()
    //{
    //    if($(this).next('#input') == v.oldname)  
    //    {
    //        submitButton.popover({trigger:'manual', content:response.message, placement:'right'}).popover('show');
    //        submitButton.next('.popover').addClass('popover-success');
    //        function distroy(){submitButton.popover('destroy')}
    //        setTimeout(distroy,2000);
    //    }
    //}
    
    $('.cancelButton').click(function()
    {
        $(this).parents('form').hide();
        $(this).parents('.card-heading').find('#name').show();
        $(this).parents('.card-heading').find('.icon-edit').show();
        $(this).parents('.card-heading').find('.deleter').show();
    });
})

