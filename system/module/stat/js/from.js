$(document).ready(function()
{
    var options = { scaleShowLabels: true };
    if(v.charts) chart = $('#chartBox').pieChart(v.charts.pv, options);
    $('#switchBar label').click(function()
    {
        type = $(this).data('type');
        $('#switchBar .active').removeClass('active');
        $(this).addClass('active');
        chart.segments[0].value = v.charts[type][0].value;
        chart.segments[1].value = v.charts[type][1].value;
        chart.segments[2].value = v.charts[type][2].value;
        chart.update();
    })
})
