$().ready(function()
{
    $('[name^=blocks2merge]').change(function()
    {
        $(this).parents('td').find('[type=checkbox]').prop('checked', $(this).val() == 0);
    })
    $('[name^=blocks2merge]').change();
})
