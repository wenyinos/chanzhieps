function showPriv(value)
{
  location.href = createLink('group', 'managePriv', "type=byGroup&param="+ groupID + "&menu=&version=" + value);
}

$('.checkModule').click(function()
{
    $(this).parents('tr').find('[type=checkbox]').prop('checked', $(this).prop('checked'));
});
$('.selectAll').click(function()
{
    $(this).parents('table').find('[type=checkbox]').prop('checked', $(this).prop('checked'));
});
