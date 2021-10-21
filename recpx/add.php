<?php

	session_start();
	include_once('connection.php');

	if(isset($_POST['add'])){
		$database = new Connection();
		$db = $database->open();
		try{
			// hacer uso de una declaración preparada para evitar la inyección de sql
			$stmt = $db->prepare("INSERT INTO donante (nombre, apellido, dni, direccion, cp, sexo, fecha_Nto, telefono) VALUES (:nombre, :apellido, :dni, :direccion, :cp, :sexo,  :fecha_Nto, :telefono)");
			// declaración if-else en la ejecución de nuestra declaración preparada
			$_SESSION['message'] = ( $stmt->execute(array(':nombre' => $_POST['nombre'] , ':apellido' => $_POST['apellido'] ,':dni' => $_POST['dni'], ':direccion' => $_POST['direccion'],  ':cp' => $_POST['cp'], ':sexo' => $_POST['sexo'], ':fecha_Nto' => $_POST['fecha_Nto'], ':telefono' => $_POST['telefono'])) ) ? 'Paciente Agregado Exitosamente' : 'No se cargo al paciente';	
	    
		}
		catch(PDOException $e){
			$_SESSION['message'] = $e->getMessage();
		}

		//cerrar conexión
		$database->close();
	}

	else{
		$_SESSION['message'] = 'Por favor complete';
	}

	header('location: index.php');
	
?>
