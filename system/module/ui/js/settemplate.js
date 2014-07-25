$(document).ready(function()
{
    var template = 'default';
    var theme = 'default';
    var modal = $('#chooseThemes');

    $('.card-template').click(function()
    {
        var $this = $(this);
        if(template == $this.data('template')) return;

        $.getJSON($this.data('url'), function(response)
        {
            if(response.result == 'success')
            {
                messager.success(response.message);
                $('.card-template.current').removeClass('current');
                $this.addClass('current');
                template = $this.data('template');
                theme = $this.data('theme');
            }
        });
    });

    modal.on('show.bs.modal', function()
    {
        $this = $(this);
        if($this.data('template') != template)
        {
            $this.data('template', template);
            var $themeList = $('.card[data-template="' + template + '"] .themes-list li a');
            var $themes = $this.find('.cards-themes').empty();
            $themeList.each(function()
            {
                var $item = $(this);
                $themes.append("<div class='col-card'><div class='card-theme card {current}' data-name='{name}' data-url='{url}' data-theme='{theme}'><i class='icon-ok theme-choosed'></i><img src='{img}' alt=''><div class='card-caption'><h4 class='text-center'>{name}</h4></div></div></div>".format({name: $item.attr('title'), url: $item.attr('href'), img: $item.find('img').attr('src'), theme:$item.data('theme'), current: (theme == $item.data('theme') ? 'current' : '')}));
            });
            $themes.find('.card').click(function()
            {
                var $this = $(this);
                if(theme == $this.data('theme')) return;

                $.getJSON($this.data('url'), function(response)
                {
                    if(response.result == 'success')
                    {
                        messager.success(response.message);
                        $('.card-theme.current').removeClass('current');
                        $this.addClass('current');
                        theme = $this.data('theme');
                        modal.modal('hide');

                        var card = $('.card[data-template="' + template + '"]');
                        card.find('img').attr('src', $this.find('img').attr('src'));
                        card.find('.theme-name strong').text($this.data('name'));
                    }
                });
            });
        }
    });
})
