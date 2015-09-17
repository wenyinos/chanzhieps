$(document).ready(function()
{
    var data = {labels: v.labels, datasets: v.chartData};

    var options = {multiTooltipTemplate: "<%= datasetLabel %> <%= value %>"}
    chart = $('#chartBox').lineChart(data, options);
})
