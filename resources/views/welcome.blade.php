<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  </head>
  <body>
    <h1>Hello, world!</h1>

    
<div class="container">
    <table class="table">
        <thead>
          <tr>
            <th scope="col">codDispositivo</th>
            <th scope="col">codMovistar</th>
            <th scope="col">codClaro</th>
            <th scope="col">codCnt</th>
            <th scope="col">potenciaMovistar</th>
            <th scope="col">potenciaClaro</th>
            <th scope="col">potemciaCnt</th>
            <th scope="col">tiempoActualizacion</th>
            <th scope="col">fecha</th>
          </tr>
        </thead>
        <tbody>
          <tr id="datos">
            <td id="codDispositivo"></td>
            <td id="codMovistar"></td>
            <td id="codClaro"></td>
            <td id="codCnt"></td>
            <td id="potenciaMovistar"></td>
            <td id="potenciaClaro"></td>
            <td id="potemciaCnt"></td>
            <td id="tiempoActualizacion"></td>
            <td id="fecha"></td>
          </tr>
        </tbody>
    </table>
    <div id="ok"></div>
</div>

<script>
    function midatos(){
        $.get( "{{ url('geo-get') }}", function( data ) {
            $('#codDispositivo').html(data.codDispositivo)
            $('#codMovistar').html(data.codMovistar)
            $('#codClaro').html(data.codClaro)
            $('#codCnt').html(data.codCnt)
            $('#potenciaMovistar').html(data.potenciaMovistar)
            $('#potenciaClaro').html(data.potenciaClaro)
            $('#potemciaCnt').html(data.potemciaCnt)
            $('#tiempoActualizacion').html(data.tiempoActualizacion)
            $('#fecha').html(data.updated_at)
          });
    }
    setInterval(midatos, 1000);
</script>
  </body>
</html>