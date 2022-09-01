( function ( $ ) {
    "use strict";

    //pie chart
    var ctx = document.getElementById( "pieChart" );
    ctx.height = 300;
    var myChart = new Chart( ctx, {
        type: 'pie',
        data: {
            datasets: [ {
                data: [ 45, 25, 20, 10 ],
                backgroundColor: [
                                    "rgba(0, 194, 146,0.9)",
                                    "rgba(0, 194, 146,0.7)",
                                    "rgba(0, 194, 146,0.5)",
                                    "rgba(0,0,0,0.07)"
                                ],
                hoverBackgroundColor: [
                                    "rgba(0, 194, 146,0.9)",
                                    "rgba(0, 194, 146,0.7)",
                                    "rgba(0, 194, 146,0.5)",
                                    "rgba(0,0,0,0.07)"
                                ]

                            } ],
            labels: [
                            "green",
                            "green",
                            "green"
                        ]
        },
        options: {
            responsive: true
        }
    } );

        //line chart
    var ctx = document.getElementById( "lineChart" );
    ctx.height = 150;
    var myChart = new Chart( ctx, {
        type: 'line',
        data: {
            labels: [ "January", "February", "March", "April", "May", "June", "July" ],
            datasets: [
                {
                    label: "My First dataset",
                    borderColor: "rgba(0,0,0,.09)",
                    borderWidth: "1",
                    backgroundColor: "rgba(0,0,0,.07)",
                    data: [ 20, 47, 35, 43, 65, 45, 35 ]
                            },
                {
                    label: "My Second dataset",
                    borderColor: "rgba(0, 194, 146, 0.9)",
                    borderWidth: "1",
                    backgroundColor: "rgba(0, 194, 146, 0.5)",
                    pointHighlightStroke: "rgba(26,179,148,1)",
                    data: [ 16, 32, 18, 27, 42, 33, 44 ]
                            }
                        ]
        },
        options: {
            responsive: true,
            tooltips: {
                mode: 'index',
                intersect: false
            },
            hover: {
                mode: 'nearest',
                intersect: true
            }

        }
    } );


    //bar chart
    var ctx = document.getElementById( "barChart" );
    //    ctx.height = 200;
    var myChart = new Chart( ctx, {
        type: 'bar',
        data: {
            labels: [ "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul" ],
            datasets: [
                {
                    label: "My First dataset",
                    data: [ 65, 59, 80, 81, 56, 55, 45 ],
                    borderColor: "rgba(0, 194, 146, 0.9)",
                    borderWidth: "0",
                    backgroundColor: "rgba(0, 194, 146, 0.5)"
                            },
                {
                    label: "My Second dataset",
                    data: [ 28, 48, 40, 19, 86, 27, 76 ],
                    borderColor: "rgba(0,0,0,0.09)",
                    borderWidth: "0",
                    backgroundColor: "rgba(0,0,0,0.07)"
                            }
                        ]
        },
        options: {
            scales: {
                yAxes: [ {
                    ticks: {
                        beginAtZero: true
                    }
                                } ]
            }
        }
    } );

            // Bar chart horizontal
            var ctxL = document.getElementById("barChartHorizontal").getContext('2d');
            var myLineChart = new Chart(ctxL, {
              type: 'horizontalBar',
              data: {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [
                  {
                    label: "Traffic",
                    data: [30, 15, 62, 65, 61, 65, 40],
                    backgroundColor: '#19C89D',
                    borderWidth: 0,
                  }
                ]
              },
              options: {
                responsive: true,
                legend: {
                  display: true,
                },
                tooltips: {
                  intersect: false,
                  mode: 'index'
                },
                scales: {
                  xAxes: [{
                    stacked: true,
                    gridLines: {
                      display: true,
                    },

                    ticks: {
                      fontColor: '#99ABB4',
                    }
                  }],
                  yAxes: [{
                    stacked: true,
                    gridLines: {
                      display: false,
                      borderDash: [2],
                      drawBorder: false,
                      zeroLineColor: "#99ABB4",
                      zeroLineBorderDash: [2],
                      zeroLineBorderDashOffset: [2]
                    },
                    ticks: {
                      fontColor: '#99ABB4'
                    }
                  }]
                }
              }
            });

} )( jQuery );