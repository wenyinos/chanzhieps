$(document).ready(function()
{
    $('#upgradeNotice').hide();
    if($('#upgradeNotice').size())
    {
        if(latestversion.new)
        {
            $('#version').html(latestversion.version);
            $('.link-version').attr('href', latestversion.url);
            $('#upgradeNotice').show();
            return true;
        }
        $('#upgradeNotice').remove();
    }
});
