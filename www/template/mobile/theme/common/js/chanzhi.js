$(function()
{
   /**
   * Set required fields, add star class to them.
   *
   * @access public
   * @return void
   */
    var setRequiredFields = function()
    {
        if(!config || !config.requiredFields) return;
        var requiredFields = config.requiredFields.split(',');
        for(i = 0; i < requiredFields.length; i++)
        {
            var $field = $('#' + requiredFields[i]);
            $field.closest('td,th').prepend("<div class='required required-wrapper'></div>");
            $field.closest('.form-group').addClass('required');
            if(window.v && window.v.lang.required)
            {
                $field.attr('placeholder', '(' + window.v.lang.required + ') ' + ($field.attr('placeholder') || ''));
            }
        }
    };

    // Set required feilds in form
    setRequiredFields();

    // make company links on app navbar as modalTrigger to open content with modal
    $('#appnav .nav-system-company a').modalTrigger();
});
