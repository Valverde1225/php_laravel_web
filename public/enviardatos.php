<?php


	// detalles de la conexion
	$conn_string = "host=localhost port=5432 dbname=agrinodb user=agrino password=123456 options='--client_encoding=UTF8'";
 
	// establecemos una conexion con el servidor postgresSQL
	$dbconn = pg_connect($conn_string);
 
	// Revisamos el estado de la conexion en caso de errores. 
	if(!$dbconn) {
		echo "Error: No se ha podido conectar a la base de datos\n";
	} else {
		echo "Conexion exitosa\n";
	}
	
		$chipid = $_POST ['chipid'];
		$temperatura = $_POST ['temperatura'];
		$humedadsuelo = $_POST ['humedadsuelo'];
		$humedadambiente = $_POST ['humedadambiente'];
		$litros = $_POST ['litros'];
		
		
		$query = "INSERT INTO public.info_sectores(
	 chipinfo_sector, sen_h_aminfo_sector, sen_h_suinfo_sector, sen_t_aminfo_sector, sen_lhinfo_sector, idtipo_plantainfo_sector, idpersonainfo_sector, fechainfo_sector)
	VALUES ( '$chipid', '$humedadambiente', '$humedadsuelo','$temperatura', '$litros', 1, 1, CURRENT_TIMESTAMP)";
		// Ejecutamos la consulta (se devolver true o false):
		$result=pg_query($dbconn,$query);

        //return pg_query( $conn_string, $sql );
		
// Close connection
pg_close($dbconn);



?>