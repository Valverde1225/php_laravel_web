<!DOCTYPE html>
<html>
<head>
 <title>Respuesta MySQL</title>
 <meta charset="UTF-8">
</head>
<body>
<?php
// detalles de la conexion
$conn_string = "host=localhost port=5432 dbname=agrinodb user=agrino password=123456 options='--client_encoding=UTF8'";
 
// establecemos una conexion con el servidor postgresSQL
$dbconn = pg_connect($conn_string);

pg_query("SET NAMES 'utf8'");

function litros_diarios ($chipinfo_sector,$ano,$mes,$dia) {

 //$resultado=pg_query("SELECT TO_CHAR(fechainfo_sector1,'YYYY-MM-DD'), sen_h_aminfo_sector FROM info_sectores WHERE year('fechainfo_sector1') = '$ano' AND month('fechainfo_sector1') = '$mes' AND day('fechainfo_sector1') = '$dia' AND 'chipinfo_sector'= '$chipinfo_sector'");
 $resultado=pg_query("SELECT extract(epoch FROM fechainfo_sector), sen_lhinfo_sector FROM info_sectores WHERE date_part('year',fechainfo_sector) = ".$ano." AND date_part('month',fechainfo_sector) = ".$mes." AND date_part('day',fechainfo_sector) = ".$dia." AND chipinfo_sector = '$chipinfo_sector'");
 //$resultado=pg_query("SELECT TO_TIMESTAMP(fechainfo_sector,'YYYYMMDD') FROM info_sectores WHERE date_part('year',fechainfo_sector) = ".$ano." and date_part('month',fechainfo_sector) = ".$mes." and date_part('day',fechainfo_sector) = ".$dia." and chipinfo_sector= '$chipinfo_sector'");
 while ($row=pg_fetch_array($resultado))
 {
  echo "[";
  echo ($row[0]*1000)-18000000; //le resto 3 horas = 10800000 mill
  echo ",";
  echo $row[1];
  echo "],";
 }

}
?>


<div id="container1" style="width: 100%; height: 400px;"></div>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 




<script>

Highcharts.chart('container1', {

title: {
    text: 'Litros de Agua consumidos del dia:'
},

subtitle: {
    text: 'Gráfico Litros de Agua consumidos'
},

yAxis: {
    title: {
    text: 'Litros de Agua consumidos'
    }
    },
xAxis: {
        type: 'datetime',         
    },
legend: {
    layout: 'vertical',
    align: 'right',
    verticalAlign: 'middle'
},



series: [{
    name: 'Litros',
            data: [<?php
                $chipinfo_sector = $_POST ['chipinfo_sector'];
                $fechainfo_sector = $_POST ['fechainfo_sector'];
                $ano = substr("$fechainfo_sector", 0, 4); // 2017/07/16
                $mes = substr("$fechainfo_sector", 5, 2);
                $dia = substr("$fechainfo_sector", 8, 2);
                litros_diarios($chipinfo_sector, $ano , $mes, $dia);
             ?>]
}],

responsive: {
    rules: [{
        condition: {
            maxWidth: 500
        },
        chartOptions: {
            legend: {
                layout: 'horizontal',
                align: 'center',
                verticalAlign: 'bottom'
            }
        }
    }]
}

}); 




</script>
</body>
</html>