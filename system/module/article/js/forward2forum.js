$(document).ready(function()
{
    $.each(v.parents, function(index,value)
    {
        $('#board').find("[value=" + value + ']').prop('disabled', true);
    });
});
