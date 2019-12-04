@extends('dashboard.layout')

@section('content')

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

</head>

<body>
<div class="col-6">
        <h4 class="m-0 font-weight-bold text-primary btn-icon-split align-bottom">Monitoreo Tiempo Real Humedad Suelo</h4>
      </div>
      <br/>
      
<div id="container" style="height: 400px; min-width: 310px"></div>

<script>

    usuario = 'placa1';
    contrasena = '12345678';


    suelos = 0;


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
        if (message.destinationName == usuario + '/' + 'humedadsuelo') { //acá coloco el topic
            //document.getElementById("temperatura").textContent = message.payloadString  + " ºC";
            
            suelos = parseFloat(message.payloadString);
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

// Create the chart
Highcharts.stockChart('container', {
    
    chart: {
        
        events: {
            load: function () {

                // set up the updating of the chart each second
                var series = this.series[0];
                setInterval(function () {
                    var x = (new Date()).getTime(), // current time
                        y = suelos;
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
        text: ''
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
                    0
                ]);
            }
            return data;
        }())
    }]
});

</script>

@stop
