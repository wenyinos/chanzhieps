$(document).ready(function()
{
    $('.leftmenu').find('a[href*="domain"]').parent().addClass('active');
    var data    = {labels: v.lineLabels, datasets: v.lineChart};
    var options = {multiTooltipTemplate: "<%= datasetLabel %> <%= value %>", datasetFill : false}
    lineChart   = $('#lineChart').lineChart(data, options);
})
