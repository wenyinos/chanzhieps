$().ready(function()
{
    associateSelect('#template', '#theme', v.themes, v.template, v.theme);
    $('#template').change();
})
