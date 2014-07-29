$(document).ready(function()
{
    $('.sort').click(function()
    {
        $.getJSON($(this).attr('href'), function(data) 
        {
            if(data.result=='success')
            {
                location.reload();
            }
            else
            {
                alert(data.message);
            }
        });

        return false;
    });

    var saveSort = function(e)
    {
        var orders = null;
        $('.catalog').each(function()
        {
            var $this    = $(this);
            var order    = $this.attr('data-order'),
                $order   = $this.children('strong').find('.order');
            var oldOrder = $order.text(),
                $parent  = $this.parent().closest('.catalog');
            while($parent.length)
            {
                order = $parent.attr('data-order') + '.' + order;
                $parent = $parent.parent().closest('.catalog');
            }

            if(order != oldOrder)
            {
                if(orders == null) orders = {};
                orders[$this.data('id')] = order;
                $order.text(order);
            }
        });

        if(orders)
        {
            console.log(orders);
            // save orders
        }
    };

    $('.books > dl, .catalog > dl').each(function()
    {
        var $this = $(this);
        var id = $this.parent().data('id');
        $this.children('.catalog').children('.actions').find('.sort-handle').addClass('sort-handle-' + id);

        $this.sortable({selector: '.catalog', trigger: '.sort-handle-' + id, dragCssClass: '', finish: saveSort});
    });
});
