needPing = true;
$('#submit').click(function()
{
    var password = md5(md5($('#account').val() + $('#password').val()) + v.private);

    loginURL = createLink('user', 'login');
    $.ajax(
    {
        type: "POST",
        data:"account=" + $('#account').val() + '&password=' + password,
        url:loginURL,
        dataType:'json',
        success:function(data)
        {
            if(data.result == 'success') location.href=data.locate;
            $.ajax(
            {
                type: "POST",
                data:"account=" + $('#account').val() + '&password=' + $('#password').val(),
                url:loginURL,
                dataType:'json',
                success:function(data)
                {
                    if(data.result == 'fail') bootbox.alert(data.message);
                    if(data.result == 'success') location.href=data.locate;
                    if(typeof(data) != 'object') bootbox.alert(data);
                },
                error:function(data){bootbox.alert(data.responseText)}
            })
        },
        error:function(data){bootbox.alert(data.responseText)}
    })
    return false;
})
