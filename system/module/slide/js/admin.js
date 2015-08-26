$(document).ready(function()
{
    $('.submit').click(function()
    {
        var groupID = $(this).parents('.editGroup').find('.groupID').val();
        $.setAjaxForm('#editGroupForm' + groupID); 
    });

    $('.icon-edit').click(function()
    {
        //Just show current edit form.
        $('.icon-edit').parents('.card-heading').find('form').hide();
        $('.icon-edit').show();
        $('.icon-edit').next('.deleter').show();
        $('.icon-edit').prev('#name').show();

        $(this).hide();
        $(this).parent().next('.deleter').hide();
        $(this).parent().prev('#name').hide();
        $(this).parents('.card-heading').find('form').show();
        $(this).parents('.card-heading').find('#input').focus();
    });
    
    $('.cancelButton').click(function()
    {
        $(this).parents('form').hide();
        $(this).parents('.card-heading').find('#name').show();
        $(this).parents('.card-heading').find('.icon-edit').show();
        $(this).parents('.card-heading').find('.deleter').show();
    });
})

