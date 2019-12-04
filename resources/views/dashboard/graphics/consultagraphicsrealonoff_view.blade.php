@extends('dashboard.layout')

@section('content')

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

<script src='https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js'></script>

<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css'>

<script src='https://api.cloudmqtt.com/js/mqttws31.js' type='text/javascript'></script> 

  <!-- https://api.cloudmqtt.com/sso/js/mqttws31.js -->

  <style type="text/css">
    .a200x160px {
      width: 200px;
      height: 160px;
    }

    .switch {
      position: relative;
      display: inline-block;
      width: 120px;
      height: 68px;
    }

    .switch input {display:none;}

    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: red;
      -webkit-transition: .4s;
      transition: .4s;
    }

    .slider:before {
      position: absolute;
      content: "";
      height: 52px;
      width: 52px;
      left: 8px;
      bottom: 8px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
    }

    input:checked + .slider {
      background-color: green;
    }

    input:focus + .slider {
      box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
      -webkit-transform: translateX(52px);
      -ms-transform: translateX(52px);
      transform: translateX(52px);
    }

    .slider.round {
      border-radius: 68px;
    }

    .slider.round:before {
      border-radius: 55%;
    }

    input[type=range] {
      height: 26px;
      -webkit-appearance: none;
      margin: 10px 0;
      width: 120px;
    }
    input[type=range]:focus {
      outline: none;
    }
    input[type=range]::-webkit-slider-runnable-track {
      width: 100%;
      height: 14px;
      cursor: pointer;
      animate: 0.2s;
      box-shadow: 1px 1px 1px #50555C;
      background: #50555C;
      border-radius: 14px;
      border: 0px solid #000000;
    }
    input[type=range]::-webkit-slider-thumb {
      box-shadow: 0px 0px 0px #000000;
      border: 0px solid #000000;
      height: 20px;
      width: 40px;
      border-radius: 12px;
      background: green;
      cursor: pointer;
      -webkit-appearance: none;
      margin-top: -3px;
    }
    input[type=range]:focus::-webkit-slider-runnable-track {
      background: #50555C;
    }
   
    input[type=range]:focus::-ms-fill-lower {
      background: #50555C;
    }
    input[type=range]:focus::-ms-fill-upper {
      background: #50555C;
    }
  </style>


<div class="col-6">
        <h4 class="m-0 font-weight-bold text-primary btn-icon-split align-bottom">Control Manual de Riego</h4>
      </div>
      <br/>
      <br/>
  <br/>

  <div style="margin: 0 auto; width: 50%;">
  <div>
  <div>

         <svg width="150" height="75" viewBox="0 0 640 480">
         <defs>
          <linearGradient id="svg_6" x1="0" y1="0" x2="1" y2="0">
           <stop stop-color="#bfbfbf" offset="0"/>
           <stop stop-color="#404040" offset="1"/>
          </linearGradient>
          <linearGradient id="svg_11" x1="0" y1="0" x2="1" y2="1" spreadMethod="pad">
           <stop stop-color="#000000" stop-opacity="0.992188" offset="0"/>
           <stop id="led1" stop-color="#820101" stop-opacity="0.988281" offset="1"/>
          </linearGradient>
          <linearGradient id="svg_14" x1="0" y1="0" x2="1" y2="1" spreadMethod="pad">
           <stop stop-color="#ffffff" stop-opacity="0.996094" offset="0"/>
           <stop id="led2" stop-color="#d30606" stop-opacity="0.984375" offset="0.703125"/>
          </linearGradient>
         </defs>

         <g>
          <title>Layer 1</title>
          <circle fill="url(#svg_6)" stroke-width="17.5" stroke-linecap="round" cx="320" cy="240" r="196.125" id="svg_3" fill-opacity="0.77" transform="rotate(90, 320, 240)"/>
          <circle fill="url(#svg_6)" stroke-width="17.5" stroke-linecap="round" fill-opacity="0.64" cx="319.252837" cy="239.999045" r="160" id="svg_7"/>
          <circle fill="url(#svg_11)" stroke-width="17.5" stroke-linecap="round" cx="320.000535" cy="240.001698" r="150" id="svg_8"/>
          <ellipse fill="url(#svg_14)" stroke-width="17.5" stroke-linecap="round" cx="250.179609" cy="170.124194" rx="75.675959" ry="44.402987" id="svg_20" transform="rotate(-47.7626, 250.18, 170.125)"/>
         </g>
        </svg>

        <div style="width:70%; height:auto; float:right;">
          <label class="switch">
          <input type="checkbox" onclick='OnOff2()'>
          <span class="slider round"></span>
        </label>
        </div>

        </div>
        </div>
  </div>

    <script>      
    
      usuario = 'placa1';
      contrasena = '12345678';

      estadoDigital = "OFF";

      function OnOff2(){
        if (estadoDigital == "OFF"){
          message = new Paho.MQTT.Message("ON");
          message.destinationName = usuario + '/motor'
          client.send(message);
          toastr.success('Riego Encendido!', 'Recuerda monitorear a través de gráficos')

        }
        else if (estadoDigital == "ON"){
          message = new Paho.MQTT.Message("OFF");
          message.destinationName = usuario + '/motor'
          client.send(message);
          toastr.warning('Riego Apagado!', 'Recuerda encender el riego manual, solo cuando lo amerite, CUIDA EL AGUA!')

        }
        
      };

       
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
        if (message.destinationName == usuario + '/' + 'motor') { //acá coloco el topic
            //document.getElementById("salidaDigital").textContent = message.payloadString;
            estadoDigital = message.payloadString;

            if (estadoDigital == "OFF") {
              document.getElementById("led1").setAttribute("stop-color", "#FE0101");
              document.getElementById("led2").setAttribute("stop-color", "#FE0101");
            }
            else if (estadoDigital == "ON") {
              document.getElementById("led1").setAttribute("stop-color", "#17FE01");
              document.getElementById("led2").setAttribute("stop-color", "#17FE01");
            }
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
    </script>

@stop
