@extends('layouts.layout')

@section('content')

<div class="container">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="http://maps.google.com/maps/api/js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>

        <style type="text/css">
              #map {
                  border:2px solid black;
                  width: 100%;
                  height: 600px;
                  top:30px;
              }
        </style>

        <!--Dibuajamos el mapa-->
        <div id="map"></div>
        <script>

          function initMap() {

              //Indicamos latitud y longitud donde se centrara el mapa
              var pos = {lat: -16.493161, lng: -68.121140};

              //Dibujamos el mapa
              var map = new google.maps.Map(document.getElementById('map'), {
                zoom:15,
                center: pos
              });

              //Obtenemos los datos de cada semaforo
              var semaforos = <?php print_r(json_encode($semaforos)) ?>;

              //Dibujamos los iconos de los semaforos
              $.each( semaforos, function( index, value ){
                  //Obtenemos los valores latitud y longitud de cada semaforo
                  var pos = {lat: value.lat, lng: value.lng};

                  //Dibujar marcador con icono de semaforo
                  var marker = new google.maps.Marker({
                      position: pos,
                      map: map,
                      title: value.descripcion,
                      icon: 'img/semaforo.png'
                  });

                  //Definimos el texto que tendra la ventana de informacion
                  var contentString = '<div>'+
                                '<h3 id="firstHeading" class="firstHeading">' + value.descripcion +'</h3>'+
                                '<p><b>Tiempo Rojo: </b>' + value.t_rojo + ' segundos.'+
                                '<p><b>Tiempo Amarillo: </b>' + value.t_amarillo + ' segundos.'+
                                '<p><b>Tiempo Verde: </b>' + value.t_verde + ' segundos.'+
                                '</div>';

                  //Variable ventana de informacion
                  var infowindow = new google.maps.InfoWindow({
                    content: contentString
                  });

                  //Añadimos ventana de informacion al hacer click
                  marker.addListener('click', function() {
                    infowindow.open(map, marker);
                  });
              });

              //Ver trafico
              //var trafficLayer = new google.maps.TrafficLayer();
              //trafficLayer.setMap(map);
          }

        </script>

        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA3Q4aQ5C6guMx3mg86trNXr6z7Oxp7t4A&callback=initMap"></script>
</div>
@endsection
