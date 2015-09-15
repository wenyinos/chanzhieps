$(function()
{
    responsiveNavbar();
    fixCategoryNav();
});

/**
 * make the navbar responsivable
 *
 * @access public
 * @return void
 */
function responsiveNavbar()
{
    var lis = $('#mainNavbar .navbar-nav').first().addClass('mainNavbarNav').find('li');
    var lisSize = lis.length;
    if(lisSize>5)
    {
      var i = 0;
      lis.each(function()
      {
          if(i++>10) $(this).addClass('simple-mode-b'); else $(this).addClass('simple-mode-a');
      });
    }

    $('#navbarSwitcher').click(function()
    {
        var navbar = $(this).closest('.navbar');
        if(navbar.hasClass('navbar-simple')) navbar.removeClass('navbar-simple');
        else  navbar.addClass('navbar-simple');
    });
}

/**
 * fix height of category nav in 'leftmenu'
 *
 * @access public
 * @return void
 */
function fixCategoryNav()
{
    var $categoryNav = $('.category-nav');
    if($categoryNav.length)
    {
        var $panelBody = $categoryNav.find('.panel-body');
        var ajustHeight = function()
        {

            if($('html').hasClass('screen-phone'))
            {
                $panelBody.css('max-height', 'auto');
            }
            else
            {
                $panelBody.css('max-height', $(window).height() - 170 - $('.leftmenu > .nav-stacked').height());
            }
        };
        ajustHeight();
        $(window).resize(ajustHeight);
    }
}

/**
 * Init theme picker for admin menu
 */
$(function()
{
    var $themePicker = $('#menu .theme-picker');

    var refreshPicker = function(template)
    {
        var currentTemplate = $themePicker.attr('data-template');
        var currentTheme = $themePicker.attr('data-theme');
        if(!template || typeof(template) !== 'string') template = $(this).data('template') || currentTemplate;

        $themePicker.find('.menu-template.hover').removeClass('hover');
        $themePicker.find('.menu-template[data-template="' + template + '"]').addClass('hover');

        $themePicker.find('.menu-theme.current').removeClass('current');
        $themePicker.find('.menu-themes.show').removeClass('show');
        $themePicker.find('.menu-themes[data-template="' + template + '"]').addClass('show');
        $themePicker.find('.menu-themes[data-template="' + currentTemplate + '"] .menu-theme[data-theme="' + currentTheme + '"]').addClass('current');
    };

    $themePicker.on('mouseenter', '.menu-template', refreshPicker)
    .on('click', '.menu-template > a, .menu-theme', function(e)
    {
        var $this = $(this);
        $.getJSON($this.attr('href') || $this.data('url'), function(response)
        {
            if(response.result == 'success')
            {
                $themePicker.find('.menu-theme.current').removeClass('current');
                if($this.hasClass('menu-theme')) $this.addClass('current');
                messager.success(response.message);
                setTimeout(function(){window.location.reload();}, 1000);
            }
            else
            {
                bootbox.alert(data.message);
            }
        });
        return false;
    }).on('click', '.btn-custom', function(e){e.stopPropagation();});

    $('.menu-theme-picker').on('show.bs.dropdown show.zui.dropdown', function()
    {
        var $list = $('#menu .menu-themes');
        $list.css('max-height', $(window).height() - 130);
        refreshPicker();
    });

    refreshPicker();

    window.refreshThemePicker = function(template, theme)
    {
        $themePicker.find('.menu-template.active').removeClass('active');
        $themePicker.find('.menu-template[data-template="' + template + '"]').addClass('active');
        $themePicker.find('.menu-theme.active').removeClass('active');
        $themePicker.find('.menu-theme[data-theme="' + theme + '"]').addClass('active');
        $themePicker.attr('data-template', template).attr('data-theme', theme);
        refreshPicker(template, theme);
    };

    $('#deviceMenu a').click(function()
    {
        $.getJSON($(this).attr('href'), function(response)
        {
            if(response.result == 'success')
            {
                messager.success(response.message);
                location.reload();
            }
            return false;
        })
        return false;
    });
});
