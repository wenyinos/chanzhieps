$(document).ready(function()
{
    $('#type').change(function()
    {
        $('#ajaxForm').find('.link, .text, .news').hide().find(':input, select').attr('disabled', true);
        $('#ajaxForm').find('.' + $(this).val()).show().find(':input, select').attr('disabled', false);;
    });

    $('#type').change();

    $('select[name*=Block], #linkModule').change(function()
    {
        $(this).parent().next('.manual').toggle($(this).val() == 'manual').find(':input').focus();   
    });
    $('select[name*=Block], #linkModule').change();

    $('#newsBlock').change(function()
    {
         $('.articleTree, .productTree').hide().find('select').attr('disabled', true);

         var block = $(this).val();
         if((/.*article.*/i).test(block))
         {
             $('.articleTree').show().find('select').attr('disabled', false);
         }
         else
         {
             $('.productTree').show().find('select').attr('disabled', false);
         }

         $('#limit').toggle(!(/.*Tree.*/i).test(block));
    });
    $('#newsBlock').change();
});
