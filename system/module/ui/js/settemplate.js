$(document).ready(function()
{
    $('.theme-preview').click(function()
    {
        var btn = $(this);
        $.getJSON($(this).attr('href'), function(response)
        {
            if(response.result == 'success')
            {
                messager.success(response.message)
                btn.parents('.table-templateinfo').parent().next().find('img').attr('src', btn.find('img').attr('src'));
                btn.parents('.table-templateinfo').find('.btn-success').removeClass('btn-success');
                btn.addClass('btn-success');
            }
        });
        return false;
    });
})
