FusionCharts.ready(function () {
    var ageGroupChart = new FusionCharts({
        type: 'pie2d',
        renderAt: 'pie-container2',
        width: '100%',
        height: '320',
        dataFormat: 'json',
        dataSource: {
            "chart": {
                "caption": "Monthly Performance",
                    "subCaption": "Nov 2017",
                    "paletteColors": "#6baa01,#008ee4,#f8bd19,#e44a00,#33bdda",
                    "bgAlpha": "0",
                    "borderAlpha": "20",
                    "use3DLighting": "0",
                    "showShadow": "0",
                    "enableSmartLabels": "0",
                    "startingAngle": "20",
                    "showLabels": "0",
                    "showLegend": "1",
                    "legendShadow": "0",
                    "legendBorderAlpha": "0",
                    "enableMultiSlicing": "0",
                    "slicingDistance": "15",
                    "showPercentValues": "1",
                    "showPercentInTooltip": "0",
                    "decimals": "1"
            },
                "data": [{
                "label": "Task",
                    "value": "100"
            }, {
                "label": "Pending",
                    "value": "49",
                    "isSliced": "1"
            }]
        }
    });

    ageGroupChart.render();
});