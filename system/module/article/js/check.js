$(document).ready(function()
{
    $('.blogTD').hide();
    $('[name=type]').change(function()
    {
        type = $(this).val();
        $('.articleTD, .blogTD').hide();
        $('.' + type + 'TD').show();
    });
    $('#source').change();
    $(document).on('click', '.rejecter', function()
    {
        var deleter = $(this);
        bootbox.confirm(v.confirmReject, function(result)
        {
            if(result)
            {
                deleter.text(v.lang.deleteing);

                $.getJSON(deleter.attr('href'), function(data)
                {
                    if(data.result == 'success')
                    {
                        if(deleter.parents('#ajaxModal').size())
                        {
                            if(typeof(data.locate) != 'undefined' && data.locate)
                            {
                                $('#ajaxModal').attr('rel', data.locate).load(data.locate);
                            }
                            else
                            {
                                $.reloadAjaxModal(1200);
                            }
                        }
                        else
                        {
                            if(typeof(data.locate) != 'undefined' && data.locate)
                            {
                                location.href = data.locate;
                            }
                            else
                            {
                                location.reload();
                            }
                        }
                        return true;
                    }
                    else
                    {
                        alert(data.message);
                    }
                });
            }
            return true;
       });
       return false;
    })
});
