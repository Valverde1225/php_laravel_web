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

function humedad_suelo_diaria ($chipinfo_sector,$ano,$mes,$dia) {

 //$resultado=pg_query("SELECT TO_CHAR(fechainfo_sector1,'YYYY-MM-DD'), sen_h_aminfo_sector FROM info_sectores WHERE year('fechainfo_sector1') = '$ano' AND month('fechainfo_sector1') = '$mes' AND day('fechainfo_sector1') = '$dia' AND 'chipinfo_sector'= '$chipinfo_sector'");
 $resultado=pg_query("SELECT extract(epoch FROM fechainfo_sector), sen_h_suinfo_sector FROM info_sectores WHERE date_part('year',fechainfo_sector) = ".$ano." AND date_part('month',fechainfo_sector) = ".$mes." AND date_part('day',fechainfo_sector) = ".$dia." AND chipinfo_sector = '$chipinfo_sector'");
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
    text: 'Humedad Suelo del dia:'
},

subtitle: {
    text: 'Gráfico Humedad Suelo'
},

yAxis: {
    title: {
    text: 'Humedad Suelo'
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
    name: 'Humedad de Suelo',
            data: [<?php
                $chipinfo_sector = $_POST ['chipinfo_sector'];
                $fechainfo_sector = $_POST ['fechainfo_sector'];
                $ano = substr("$fechainfo_sector", 0, 4); // 2017/07/16
                $mes = substr("$fechainfo_sector", 5, 2);
                $dia = substr("$fechainfo_sector", 8, 2);
                humedad_suelo_diaria($chipinfo_sector, $ano , $mes, $dia);
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