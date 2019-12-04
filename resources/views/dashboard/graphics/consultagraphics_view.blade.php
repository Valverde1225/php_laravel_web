@extends('dashboard.layout')

@section('content')

<?php
// detalles de la conexion
$conn_string = "host=localhost port=5432 dbname=agrinodb user=agrino password=123456 options='--client_encoding=UTF8'";
 
// establecemos una conexion con el servidor postgresSQL
$dbconn = pg_connect($conn_string);

//$conexion = mysql_connect("localhost", "root", "root");
pg_query("SET NAMES 'utf8'");

$resultado = pg_query("SELECT DISTINCT chipinfo_sector FROM info_sectores WHERE '1'");

?>

<div class="col-6">
        <h4 class="m-0 font-weight-bold text-primary btn-icon-split align-bottom">Gráfico Historico Humedad Ambiente</h4>
      </div>

      <br/>
        <form action="{{route('dashboard::graphics.respuestagraphics_view')}}" method="POST">
        {{ csrf_field() }}
        <select class="form-control" name="chipinfo_sector">
          <?php
            while ($row=pg_fetch_array($resultado))
              {
              echo "<option>";
                echo $row[0];
                echo "</option>";
              }
            pg_close($dbconn);
          ?>
          </select>
          <br/>
          <input class="form-control" type="date" name="fechainfo_sector" required>
          <br/>
          <button type="submit" class="btn btn-success btn-lg float-right">Enviar</button>

        </form>


@stop
