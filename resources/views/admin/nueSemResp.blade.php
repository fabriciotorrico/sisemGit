@extends('layouts.layout')

@section('content')

<div class="container">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="http://maps.google.com/maps/api/js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>


        <div class="container-fluid">
          <div class="row-fluid">

            <!--Mapa-->
            <div class="span6">

              <style type="text/css">
                    #map {
                        border:2px solid black;
                        width: 100%;
                        height: 450px;
                        top:25px;
                    }
              </style>

              <!--Dibuajamos el mapa-->
              <div id="map"></div>
              <script>

              var b = "bola";

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

                    var marker = new google.maps.Marker({
                        position: pos,
                        map: map,
                        draggable:true,
                        icon: 'img/semaforo.png',
                        title:"Drag me!"
                    });

                    function openInfoWindow(markerNuevo) {
                        var markerLatLng = markerNuevo.getPosition();
                        infoWindow.setContent([
                            'latitud: ',
                            markerLatLng.lat(),
                            ', longitud: ',
                            markerLatLng.lng()
                        ].join(''));
                        infoWindow.open(map, markerNuevo);
                        return markerLatLng;
                    }


                    var infoWindow = new google.maps.InfoWindow();

                    var markerNuevo = new google.maps.Marker({
                        position: pos,
                        draggable: true,
                        map: map
                    });

                    b=google.maps.event.addListener(markerNuevo, 'drag', function(){
                        x=openInfoWindow(markerNuevo);
                        return x;
                    });
                    //Ver trafico
                    //var trafficLayer = new google.maps.TrafficLayer();
                    //trafficLayer.setMap(map);
                      //b = openInfoWindow(markerNuevo);
                      //b=addListener();
                      return b;

                }

                c=initMap();
                d=c.lat();

                </script>
                <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA3Q4aQ5C6guMx3mg86trNXr6z7Oxp7t4A&callback=initMap"></script>
            </div>


            <div class="span6">
              <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                  <h5>Datos del nuevo semaforo</h5>
                </div>
                <div class="widget-content nopadding">

                  <form action="#" method="get" class="form-horizontal">
                    <div class="control-group">
                      <label class="control-label">Latitud:</label>
                      <input type="button" value="Buscar Dirección" onClick="mapa.getCoords()">
                      <div class="controls">
                        <input type="text" class="span11" placeholder="First name" />
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label"></label>
                      <div class="controls">
                        <input type="text" class="span11" placeholder="Last name" />
                      </div>
                    </div>
                    <div class="control-group">


                      <script>document.write("<label class=control-label>"+c+"</label>");</script>


                      <div class="controls">
                        <input type="password"  class="span11" placeholder="Enter Password"  />
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">Company info :</label>
                      <div class="controls">
                        <input type="text" class="span11" placeholder="Company name" />
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">Description field:</label>
                      <div class="controls">
                        <input type="text" class="span11" />
                        <span class="help-block">Description field</span> </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">Message</label>
                      <div class="controls">
                        <textarea class="span11" ></textarea>
                      </div>
                    </div>
                    <div class="form-actions">
                      <button type="submit" class="btn btn-success">Save</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
</div>
@endsection
