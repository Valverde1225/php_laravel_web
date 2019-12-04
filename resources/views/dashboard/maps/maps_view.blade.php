@extends('dashboard.layout')

@section('content')

    <div id="map" style="width: 100%; height: 400px;"></div>
    
    <script>
      var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -35.0463047, lng: -71.316426},
          zoom: 8
        });
      }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBQfOmVbbOMp4fQKuhEEibpk68H1m8LS24&callback=initMap" async defer></script>

@stop
