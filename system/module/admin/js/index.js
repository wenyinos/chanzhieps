$(document).ready(function()
{
    $('#upgradeNotice').hide();
    if($('#upgradeNotice').size())
    {
        $.getJSON(createLink('misc', 'getLatestRelease'),function(response)
        {
            if(response.result)
            {
                $('#version').html(response.version);
                $('.link-version').attr('href', response.url);
                $('#upgradeNotice').show();
                return true;
            }

            $('#upgradeNotice').remove();
        });
    }
});
