<?php

	session_start();
	include_once('connection.php');

	if(isset($_POST['edit'])){
		$database = new Connection();
		$db = $database->open();
		try{
			$id_donante = $_GET['id_donante'];
			$nombre = $_POST['nombre'];
			$apellido = $_POST['apellido'];
			$dni = $_POST['dni'];
			$sexo = $_POST['sexo']; 
			$direccion = $_POST['direccion'];
			$fecha_nto = $_POST['fecha_nto']; 
			$cp = $_POST['cp'];
			$telefono = $_POST['telefono'];
			

			$sql = "UPDATE donante SET nombre = '$nombre',apellido = '$apellido', dni = '$dni',sexo = '$sexo',direccion = '$direccion',fecha_nto = '$fecha_nto',cp = '$cp'
										,telefono = '$telefono' WHERE id_donante= '$id_donante'";
			// declaración if-else en la ejecución de nuestra consulta
			$_SESSION['message'] = ( $db->exec($sql) ) ? 'Los datos se actualizaron' : 'Ocurrio un error. No se pudo actualizar';


		}
		catch(PDOException $e){
			$_SESSION['message'] = $e->getMessage();
		}

		//cerrar conexión 
		$database->close();
	}
	else{
		$_SESSION['message'] = 'Primero debe llenar el form';
	}

	header('location: index.php');

?>