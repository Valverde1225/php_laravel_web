<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Humedad Ambiente Tiempo Real</title>
<script src='https://api.cloudmqtt.com/js/mqttws31.js' type='text/javascript'></script> 
<!-- https://api.cloudmqtt.com/js/mqttws31.js -->
<script src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
<script src="https://code.highcharts.com/stock/modules/export-data.js"></script>
<script src='https://customer.cloudmqtt.com/js/site.js?671311' type='text/javascript'></script>
<script src="https://api.cloudmqtt.com/js/jquery-3.4.1.min.js"></script>
<script src="https://api.cloudmqtt.com/js/bootstrap.min.js"></script>
<script src="https://api.cloudmqtt.com/js/bootstrap-notify.min.js"></script>
<script src="https://api.cloudmqtt.com/js/bootstrap-switch.min.js"></script>
<script src="https://api.cloudmqtt.com/js/eventsource.js"></script>
    
<div id="container" style="height: 400px; min-width: 310px"></div>

<script>

    usuario = 'placa1';
    contrasena = '12345678';


    ambientes = -1;


      // called when the client connects
      function onConnect() {
        // Once a connection has been made, make a subscription and send a message.
        console.log("onConnect");
        client.subscribe("#");
      }
        
      // called when the client loses its connection
      function onConnectionLost(responseObject) {
        if (responseObject.errorCode !== 0) {
          console.log("onConnectionLost:", responseObject.errorMessage);
          setTimeout(function() { client.connect() }, 5000);
        }
      }
        
      // called when a message arrives
      function onMessageArrived(message) {
        if (message.destinationName == usuario + '/' + 'humedadambiente') { 
            
            ambientes = parseFloat(message.payloadString);
        }
        
      }

        function onFailure(invocationContext, errorCode, errorMessage) {
          var errDiv = document.getElementById("error");
          errDiv.textContent = "Could not connect to WebSocket server, most likely you're behind a firewall that doesn't allow outgoing connections to port 39627";
          errDiv.style.display = "block";
        }
        
        var clientId = "ws" + Math.random();
        // Create a client instance
        var client = new Paho.MQTT.Client("soldier.cloudmqtt.com", 38361, clientId);
        
        // set callback handlers
        client.onConnectionLost = onConnectionLost;
        client.onMessageArrived = onMessageArrived;
        
        // connect the client
        client.connect({
          useSSL: true,
          userName: usuario,
          password: contrasena,
          onSuccess: onConnect,
          onFailure: onFailure
        });

        Highcharts.setOptions({
            global: {
                useUTC: false
            }
        });
        


        Highcharts.theme = {
    colors: ['#2b908f', '#90ee7e', '#f45b5b', '#7798BF', '#aaeeee', '#ff0066',
        '#eeaaee', '#55BF3B', '#DF5353', '#7798BF', '#aaeeee'],
    chart: {
        backgroundColor: {
            linearGradient: { x1: 0, y1: 0, x2: 1, y2: 1 },
            stops: [
                [0, '#2a2a2b'],
                [1, '#3e3e40']
            ]
        },
        style: {
            fontFamily: '\'Unica One\', sans-serif'
        },
        plotBorderColor: '#606063'
    },
    title: {
        style: {
            color: '#E0E0E3',
            textTransform: 'uppercase',
            fontSize: '20px'
        }
    },
    subtitle: {
        style: {
            color: '#E0E0E3',
            textTransform: 'uppercase'
        }
    },
    xAxis: {
        gridLineColor: '#707073',
        labels: {
            style: {
                color: '#E0E0E3'
            }
        },
        lineColor: '#707073',
        minorGridLineColor: '#505053',
        tickColor: '#707073',
        title: {
            style: {
                color: '#A0A0A3'

            }
        }
    },
    yAxis: {
        gridLineColor: '#707073',
        labels: {
            style: {
                color: '#E0E0E3'
            }
        },
        lineColor: '#707073',
        minorGridLineColor: '#505053',
        tickColor: '#707073',
        tickWidth: 1,
        title: {
            style: {
                color: '#A0A0A3'
            }
        }
    },
    tooltip: {
        backgroundColor: 'rgba(0, 0, 0, 0.85)',
        style: {
            color: '#F0F0F0'
        }
    },
    plotOptions: {
        series: {
            dataLabels: {
                color: '#B0B0B3'
            },
            marker: {
                lineColor: '#333'
            }
        },
        boxplot: {
            fillColor: '#505053'
        },
        candlestick: {
            lineColor: 'white'
        },
        errorbar: {
            color: 'white'
        }
    },
    legend: {
        itemStyle: {
            color: '#E0E0E3'
        },
        itemHoverStyle: {
            color: '#FFF'
        },
        itemHiddenStyle: {
            color: '#606063'
        }
    },
    credits: {
        style: {
            color: '#666'
        }
    },
    labels: {
        style: {
            color: '#707073'
        }
    },

    drilldown: {
        activeAxisLabelStyle: {
            color: '#F0F0F3'
        },
        activeDataLabelStyle: {
            color: '#F0F0F3'
        }
    },

    navigation: {
        buttonOptions: {
            symbolStroke: '#DDDDDD',
            theme: {
                fill: '#505053'
            }
        }
    },

    // scroll charts
    rangeSelector: {
        buttonTheme: {
            fill: '#505053',
            stroke: '#000000',
            style: {
                color: '#CCC'
            },
            states: {
                hover: {
                    fill: '#707073',
                    stroke: '#000000',
                    style: {
                        color: 'white'
                    }
                },
                select: {
                    fill: '#000003',
                    stroke: '#000000',
                    style: {
                        color: 'white'
                    }
                }
            }
        },
        inputBoxBorderColor: '#505053',
        inputStyle: {
            backgroundColor: '#333',
            color: 'silver'
        },
        labelStyle: {
            color: 'silver'
        }
    },

    navigator: {
        handles: {
            backgroundColor: '#666',
            borderColor: '#AAA'
        },
        outlineColor: '#CCC',
        maskFill: 'rgba(255,255,255,0.1)',
        series: {
            color: '#7798BF',
            lineColor: '#A6C7ED'
        },
        xAxis: {
            gridLineColor: '#505053'
        }
    },

    scrollbar: {
        barBackgroundColor: '#808083',
        barBorderColor: '#808083',
        buttonArrowColor: '#CCC',
        buttonBackgroundColor: '#606063',
        buttonBorderColor: '#606063',
        rifleColor: '#FFF',
        trackBackgroundColor: '#404043',
        trackBorderColor: '#404043'
    },

    // special colors for some of the
    legendBackgroundColor: 'rgba(0, 0, 0, 0.5)',
    background2: '#505053',
    dataLabelsColor: '#B0B0B3',
    textColor: '#C0C0C0',
    contrastTextColor: '#F0F0F3',
    maskColor: 'rgba(255,255,255,0.3)'
};

// Apply the theme
Highcharts.setOptions(Highcharts.theme);


// Create the chart
Highcharts.stockChart('container', {
    
    chart: {
        
        events: {
            load: function () {

                // set up the updating of the chart each second
                var series = this.series[0];
                setInterval(function () {
                    var x = (new Date()).getTime(), // current time
                        y = ambientes;
                    series.addPoint([x, y]);
                }, 1000);
            }
        }
    },

    time: {
        useUTC: false
    },

    rangeSelector: {
        buttons: [{
            count: 1,
            type: 'minute',
            text: '1M'
        }, {
            count: 5,
            type: 'minute',
            text: '5M'
        }, {
            type: 'all',
            text: 'All'
        }],
        inputEnabled: false,
        selected: 0
    },

    title: {
        text: 'Humedad Ambiente %'
    },

    exporting: {
        enabled: false
    },

    series: [{
        name: '%',
        data: (function () {
            // generate an array of random data
            var data = [],
                time = (new Date()).getTime(),
                i;

            for (i = -300; i <= 0; i += 1) {
                data.push([
                    time + i * 1000,
                    -1
                ]);
            }
            return data;
        }())
    }]
});

</script>
</body>
</html>