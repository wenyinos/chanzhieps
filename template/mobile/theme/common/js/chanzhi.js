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
    $('#appnav .nav-system-company a, #appnav a[data-toggle="modal"]').modalTrigger();

    // set active item on #appnav
    var $appNav = $('#appnav');
    var activedNav = v.activedNav;
    if(!activedNav)
    {
        if(config && config.currentModule)
        {
            var moduleName = config.currentModule;
            if(moduleName === 'article' || moduleName === 'product' || moduleName === 'blog')
            {
                var liFinded = false;
                $appNav.find('li > a').each(function()
                {
                    var $a        = $(this);
                    var href      = $a.attr('href'), 
                        $li       = $a.parents('li'),
                        pathName  = document.location.pathname;
                    var hrefIndex = href.indexOf(pathName);
                    if(href !== '/' && hrefIndex === 0 && !$li.hasClass('active'))
                    {
                        $li.addClass('active');
                        liFinded = true;
                    }
                });
                if(!liFinded) activedNav = '.nav-' + moduleName + '-0';
            }
            else activedNav = '.nav-system-' + (moduleName === 'index' ? 'home' : moduleName);
        }
    }
    $appNav.find(activedNav).addClass('active');

    // init deleter
    $(document).on('click', '.deleter', function(e)
    {

        var $this   = $(this);
        var options = $.extend({url: $this.attr('href'), confirm: window.v.lang.confirmDelete}, $this.data());
        e.preventDefault();
        $.ajaxaction(options, $this);
    });

    function tidyCardsRow($row)
    {
        var $cards = $row.children('.col');
        if($cards.length < 2)
        {
            $cards.css('width', '100%');
            return;
        }
        var contentHeight = 0, minImgHeight = 9999, maxImgHeight = 0;
        var width = 100.0 / $cards.length;
        $cards.each(function()
        {
            var $col = $(this).css('width', width + '%');
            contentHeight = Math.max(contentHeight, $col.find('.card-content').height());
            var $img = $col.find('.card-img').css('height', 'auto');
            var imgHeight = $img.height();
            if(!$img.find('.media-placeholder').length) minImgHeight = Math.min(minImgHeight, imgHeight);
            maxImgHeight = Math.max(maxImgHeight, imgHeight);
        });
        if(minImgHeight === 9999) return;
        $cards.find('.card-content').css('height', contentHeight);
        if(minImgHeight > 20)
        {
            $cards.find('.card-img').css({'height': minImgHeight})
                .find('.media-placeholder').css({'height': minImgHeight, 'line-height': minImgHeight + 'px'});
        }
        if(maxImgHeight !== minImgHeight || minImgHeight <= 20) {setTimeout(function(){tidyCardsRow($row);}, 500);}
    };

    $.fn.tidyCards = function()
    {
        return $(this).each(function()
        {
            $(this).children('.row').each(function(){tidyCardsRow($(this));});
        });
    };
    $('.cards-products').tidyCards();

    $(window).on('lazyloaded', function(e, $img)
    {
        var $row = $img.closest('.row');
        if($row.parent().hasClass('cards-products')) tidyCardsRow($row);
    })
});
