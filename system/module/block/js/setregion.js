$(document).ready(function()
{
    $('#blockList').sortable(
    {
        trigger:'.sort-handle',
        selector: '.block-item',
        dragCssClass: '',
    });
})
