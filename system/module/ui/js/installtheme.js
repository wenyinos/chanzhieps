$().ready(function()
{
    $('[name^=blocks2Merge]').change(function()
    {
        $(this).parents('td').find('[type=checkbox]').prop('checked', $(this).val() == 0);
    })

    $('[name^=blocks2Merge]').change();

    $(document).on('click', '.btn-reload', function()
    {
        $.reloadAjaxModal(); 
    })
})
