//****************** LINE & BAR SWITCH CHART ******************//
    var d1 = [
        [0, 950], [1, 1300], [2, 1600], [3, 1900], [4, 2100], [5, 2500], [6, 2200], [7, 2000], [8, 1950], [9, 1900], [10, 2000], [11, 2120], [12, 950], [13, 1300], [14, 1600], [15, 1900], [16, 2100], [17, 2500], [18, 2200], [19, 2000], [20, 1950], [21, 1900], [22, 2000], [23, 2120]
    ];
    /*var d2 = [
        [0, 450], [1, 500], [2, 600], [3, 550], [4, 600], [5, 800], [6, 900], [7, 800], [8, 850], [9, 830], [10, 1000], [11, 1150]
    ];*/

    var tickArray = ['Janv', 'Fev', 'Mars', 'Apri', 'May', 'June', 'July', 'Augu', 'Sept', 'Nov'];

    /****  Line Chart  ****/
        var graph_lines = [{
        label: "Line 1",
        data: d1,
        lines: {
            lineWidth: 2
        },
        shadowSize: 0,
        color: '#0090D9'
    }, {
        label: "Line 1",
        data: d1,
        points: {
            show: true,
            fill: true,
            radius: 6,
            fillColor: "#0090D9",
            lineWidth: 3
        },
        color: '#fff'
    }/*, {
        label: "Line 2",
        data: d2,
        animator: {
            steps: 300,
            duration: 1000,
            start: 0
        },
        lines: {
            fill: 0.7,
            lineWidth: 0,
        },
        color: '#18A689'
    }, {
        label: "Line 2",
        data: d2,
        points: {
            show: true,
            fill: true,
            radius: 6,
            fillColor: "#18A689",
            lineWidth: 3
        },
        color: '#fff'
    },*/ ];

    function lineCharts(){
        var line_chart = $.plotAnimator($('#graph-lines'), graph_lines, {
            xaxis: {
                tickLength: 0,
                tickDecimals: 0,
                min: 0,
                ticks: [
                    [0, 'Ene'], [1, 'Fev'], [2, 'Mar'], [3, 'Apr'], [4, 'May'], [5, 'Jun'], [6, 'Jul'], [7, 'Aug'], [8, 'Sept'],  [9, 'Oct'], [10, 'Nov'], [11, 'Dec']
                ],
                font: {
                    lineHeight: 12,
                    weight: "bold",
                    family: "Open sans",
                    color: "#8D8D8D"
                }
            },
            yaxis: {
                ticks: 3,
                tickDecimals: 0,
                tickColor: "#f3f3f3",
                font: {
                    lineHeight: 13,
                    weight: "bold",
                    family: "Open sans",
                    color: "#8D8D8D"
                }
            },
            grid: {
                backgroundColor: {
                    colors: ["#fff", "#fff"]
                },
                borderColor: "transparent",
                margin: 0,
                minBorderMargin: 0,
                labelMargin: 15,
                hoverable: true,
                clickable: true,
                mouseActiveRadius: 4
            },
            legend: {
                show: false
            }
        });
    }
    lineCharts();

    /****  Bars Chart  ****/
    var graph_bars = [{
        // Visitors
        data: d1,
        color: '#00b5f3'
    }, /*{
        // Returning Visitors
        data: d2,
        color: '#008fc0',
        points: {
            radius: 4,
            fillColor: '#008fc0'
        }
    }*/];

    function barCharts(){
        bar_chart = $.plotAnimator($('#graph-bars'), graph_bars, {
            series: {
                bars: {
                    fill: 1,
                    show: true,
                    barWidth: .6,
                    align: 'center'
                },
                shadowSize: 0
            },
            xaxis: {
                tickColor: 'transparent',
                ticks: [
                    [0, 'Jan'], [1, 'Fev'], [2, 'Mar'], [3, 'Apr'], [4, 'May'], [5, 'Jun'], [6, 'Jul'], [7, 'Aug'], [8, 'Sept'], [9, 'Oct'], [10, 'Nov'], [11, 'Dec']
                ],
                font: {
                    lineHeight: 12,
                    weight: "bold",
                    family: "Open sans",
                    color: "#9a9a9a"
                }
            },
            yaxis: {
                ticks: 3,
                tickDecimals: 0,
                tickColor: "#f3f3f3",
                font: {
                    lineHeight: 13,
                    weight: "bold",
                    family: "Open sans",
                    color: "#9a9a9a"
                }
            },
            grid: {
                backgroundColor: {
                    colors: ["#fff", "#fff"]
                },
                borderColor: "transparent",
                margin: 0,
                minBorderMargin: 0,
                labelMargin: 15,
                hoverable: true,
                clickable: true,
                mouseActiveRadius: 4
            },
            legend: {
                show: false
            }
        });
    }

    $("#graph-lines").on("animatorComplete", function () {
        $("#lines, #bars").removeAttr("disabled");
    });

    $("#lines").on("click", function () {
        $('#bars').removeClass('active');
        $('#graph-bars').fadeOut();
        $(this).addClass('active');
        $("#lines, #bars").attr("disabled", "disabled");
        $('#graph-lines').fadeIn();
        lineCharts();
    });

    $("#graph-bars").on("animatorComplete", function () {
        $("#bars, #lines").removeAttr("disabled")
    });

    $("#bars").on("click", function () {
        $("#bars, #lines").attr("disabled", "disabled");
        $('#lines').removeClass('active');
        $('#graph-lines').fadeOut();
        $(this).addClass('active');
        $('#graph-bars').fadeIn().removeClass('hidden');
        barCharts();
    });

    $('#graph-bars').hide();

    function showTooltip(x, y, contents) {
        $('<div id="flot-tooltip">' + contents + '</div>').css({
            position: 'absolute',
            display: 'none',
            top: y + 5,
            left: x + 5,
            color: '#fff',
            padding: '2px 5px',
            'background-color': '#717171',
            opacity: 0.80
        }).appendTo("body").fadeIn(200);
    };

    $("#graph-lines, #graph-bars").bind("plothover", function (event, pos, item) {
        $("#x").text(pos.x.toFixed(0));
        $("#y").text(pos.y.toFixed(0));
        if (item) {
            if (previousPoint != item.dataIndex) {
                previousPoint = item.dataIndex;
                $("#flot-tooltip").remove();
                var x = item.datapoint[0].toFixed(0),
                    y = item.datapoint[1].toFixed(0);
                showTooltip(item.pageX, item.pageY, y + " visitors");
            }
        } else {
            $("#flot-tooltip").remove();
            previousPoint = null;
        }
    });