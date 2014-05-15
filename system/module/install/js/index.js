$(document).ready(function()
{
    $('#buttonBox').hide();
    $('#choseVersion').hide();
    $.getJSON(createLink('misc', 'getLatestRelease'),function(response)
    {
        if(response.result)
        {
            $('#checkRelease').hide();
            $('#version').html(response.version);
            $('.link-version').attr('href', response.url);
            $('#choseVersion').show();
        }
        else
        {
            $('#buttonBox').show();
            $('#checkRelease').remove();
        }
    });

    $('#agree').change(function()
    {
        $('.btn-install').attr('disabled', !$(this).prop('checked'));
    });
});
