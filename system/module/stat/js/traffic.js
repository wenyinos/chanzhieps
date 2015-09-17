$(document).ready(function()
{
    var data = {labels: v.labels, datasets: v.chartData};

    console.log(data)   
    var options = {multiTooltipTemplate: "<%= datasetLabel %> <%= value %>"}
    chart = $('#chartBox').lineChart(data, options);
})
