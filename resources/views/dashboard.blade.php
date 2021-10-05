<x-app-layout>

    <style>
        .map-container{
          overflow:hidden;
          padding-bottom:56.25%;
          position:relative;
          height:0;
        }
        .map-container iframe{
          left:0;
          top:0;
          height:100%;
          width:100%;
          position:absolute;
        }
      </style>
      
      <style>
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map {
          height: 100%;
        }
        /* Optional: Makes the sample page fill the window. */
        html, body {
          height: 100%;
          margin: 0;
          padding: 0;
        }
      </style>




    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Georeferencia GPS') }}
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="max-w-12xl mx-auto sm:px-12 lg:px-12">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="table-responsive">
                    <table class="table table-bordered table-auto">
                        <thead>
                        <tr>
                            
                            <th scope="col">Dispositivo</th>
                            <th scope="col">LAC:MOVISTAR</th>
                            <th scope="col">CID:MOVISTAR</th>
                            <th scope="col">LAC:CLARO</th>
                            <th scope="col">CID:CLARO</th>
                            <th scope="col">LA:CNT</th>
                            <th scope="col">CID:CNT</th>
                            <th scope="col">RSSI:MOVISTAR</th>
                            <th scope="col">RSSI:CLARO</th>
                            <th scope="col">RSSI:CNT</th>
                            <th scope="col">TIEMPO SUBIDA</th>
                            <th scope="col">LATITUD</th>
                            <th scope="col">LONGITUD</th>
                            <th scope="col">FECHA</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr id="datos">
                          <td id="codDispositivo"></td>
                          <td id="codMovi"></td>
                          <td id="celdaMovi"></td>
                          <td id="codClaro"></td>
                          <td id="celdaClaro"></td>
                          <td id="codCnt"></td>
                          <td id="celdaCnt"></td>
                          <td id="potenciaMovistar"></td>
                          <td id="potenciaClaro"></td>
                          <td id="potenciaCnt"></td>
                          <td id="tiempoActualizacion"></td>
                          <td id="auxlt"></td>
                          <td id="auxln"></td>
                          <td id="fecha"></td>
                            
                        </tr>
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
    </div>
    <div id="map" class="z-depth-1-half map-container" style="height: 500px">
            
    </div>

    <script>
        function midatos(){
            $.get( "{{ url('geo-get') }}", function( data ) {
              
              $('#codDispositivo').html(data.codDispositivo)
              $('#codMovi').html(data.codMovi)
              $('#celdaMovi').html(data.celdaMovi)
              $('#codClaro').html(data.codClaro)
              $('#celdaClaro').html(data.celdaClaro)
              $('#codCnt').html(data.codCnt)
              $('#celdaCnt').html(data.celdaCnt)
              $('#potenciaMovistar').html(data.potenciaMovistar)
              $('#potenciaClaro').html(data.potenciaClaro)
              $('#potenciaCnt').html(data.potenciaCnt)
              $('#tiempoActualizacion').html(data.tiempoActualizacion)
              $('#auxlt').html(data.auxlt)
              $('#auxln').html(data.auxln)
              $('#fecha').html(data.created_at)

            });
        }
        setInterval(midatos, 1000);
    </script>


 <script>
    
    var lat={{ $geo->auxlt}};
    var lng={{ $geo->auxln}};

    var marker;
    var myLatLng = {lat: lat, lng: lng};
    
    function initMap() {
       
       var map = new google.maps.Map(document.getElementById('map'), {
         zoom: 15,
         center: myLatLng
       });
       marker = new google.maps.Marker({
         position: myLatLng,
         map: map,
         title: 'Última posición'
       });
     }
     var marker;
     // every 10 seconds
     setInterval(function(){
       $.get("{{ route('obtenerLatLng') }}",{}, function(json) {
           
           var LatLng = new google.maps.LatLng(json.latitude, json.longitude);
           marker.setPosition(LatLng);
           
       });
     },2000);
     function updateMarker() {
       
     }
  </script>
  <script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD4bcJ39miYRDXIr4ux3484nqQP1XqS9Bw&callback=initMap">
  </script>

  {{--  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZ-OpTnDtdGi7eC8UMkmYAGQ_kOJ21xeM&callback=initMap"></script>  --}}
  
</x-app-layout>
