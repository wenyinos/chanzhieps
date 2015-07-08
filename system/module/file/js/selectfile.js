function selectFile(obj, callback)
{
    var url = $(obj).attr('data-url');
    $('.image-select').val(url);
    $('#ajaxModal').modal('hide');
    if($.isFunction(callback)) return callback();
}
