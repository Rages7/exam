<?php

	session_start();
	include_once('connection.php');

	if(isset($_GET['id_donante'])){
		$database = new Connection();
		$db = $database->open();
		try{
			$sql = "DELETE FROM donante WHERE id_donante = '".$_GET['id_donante']."'";
			// declaración if-else en la ejecución de nuestra consulta
			$_SESSION['message'] = ( $db->exec($sql) ) ? 'Datos del paciente eliminado' : 'Ocurrió un error. No se pudo eliminar al Paciente';
		}
		catch(PDOException $e){
			$_SESSION['message'] = $e->getMessage();
		}

		//cerrar conexión
		$database->close();

	}
	else{
		$_SESSION['message'] = 'Seleccione paciente para eliminar';
	}

	header('location: index.php');

?>