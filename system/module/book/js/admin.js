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
        console.log(e);
        var orders = {}, list = e.list;
        list.each(function()
        {
            var $this = $(this);
            var order = $this.attr('data-order');
            var $parent = $this.parent().closest('.catalog');
            if($parent.length)
            {
                order = $parent.children('strong').find('.order').text() + '.' + order;
            }
            var $children = $this.children('dl').children('.catalog');
            if($children.length)
            {
                $children.each(function()
                {
                    var $child = $(this);
                    var childOrder= order + '.' + $child.attr('data-order');
                    $child.children('strong').find('.order').text(childOrder);
                    orders[$child.attr('data-id')] = childOrder;
                });
            }
            orders[$this.attr('data-id')] = order;
            $this.children('strong').find('.order').text(order);
        });
        
        // save orders
        console.log(orders);
    };

    $('.books > dl').sortable({selector: '.catalog.chapter', trigger: '.sort-chapter', dragCssClass: '', finish: saveSort});
    $('.books > dl > .catalog.chapter > dl').sortable({selector: '.catalog.article', trigger: '.sort-article', dragCssClass: '', finish: saveSort});
});
