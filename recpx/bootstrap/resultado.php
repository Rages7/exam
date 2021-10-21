<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Recepcionista</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/custom.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/font-awesome.css">
</head>


<body>
<div class="container">
	<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
  		<a class="navbar-brand" href="../index.html" >Salir</a>
  		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
    		<span class="navbar-toggler-icon"></span>
  		</button>

	  	<div class="collapse navbar-collapse" id="navbarColor02">
		    <ul class="navbar-nav mr-auto">
		      	
		      	
		    </ul>

		    <form class="form-inline my-2 my-lg-0" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
		      <input class="form-control mr-sm-2" placeholder="N° Pedido" type="text" id="campo" name="campo">
		      <button class="btn btn-secondary my-2 my-sm-0" type="submit">Buscar</button>
		    </form>
	  	</div>
	</nav>
	<h1 class="page-header text-center">Resultados</h1>
	<div class="row">
	<div class="col-sm-12">
			
			<a href="index.php" class="btn btn-primary" > Volver</a>
            <?php 
                session_start();
                if(isset($_SESSION['message'])){
                    ?>
                    <div class="alert alert-dismissible alert-success" style="margin-top:20px;">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <?php echo $_SESSION['message']; ?>
                    </div>
                    <?php

                    unset($_SESSION['message']);
                }
            ?>
			<table class="table table-bordered table-striped" style="margin-top:20px;">
				<thead>
					<th>N° Medico</th>
					<th>Fecha</th>
					<th>Dni</th>
					<th>Peso</th>
					
					<th>Temperatura</th>
					<th>Presion</th>
					<th>Anemia</th>
                    <th>Tipo de sangre</th>
					<th>N° de pedido</th>
					
					
					<th>Acción</th>
				</thead>
				<tbody>
					<?php
						// incluye la conexión
						include_once('connection.php');

						$database = new Connection();
    					$db = $database->open();
						
						
						try{
							$where = " ";
	
							if(!empty($_POST))
							{
								$valor = $_POST['campo'];
								if(!empty($valor)){
									$where = "WHERE id_pedido LIKE '%$valor'";
								}
							}

							
							$sql ="SELECT *
							FROM estudios
							inner JOIN profesional
							ON estudios.id_estudios = profesional.id_profesional
							inner JOIN donante
							ON donante.id_donante = profesional.id_profesional $where ";
						    foreach ($db->query($sql) as $row) {
						    	?>
						    	<tr>
								<td><?php echo $row['id_profesional']; ?></td>
								<td><?php echo $row['nombres']," ",$row['apellidos']; ?></td>
								<td><?php echo $row['nombre']," ",$row['apellido']; ?></td>
								<td><?php echo $row['peso']; ?></td>
								<td><?php echo $row['temperatura']; ?></td>
                                <td><?php echo $row['presion']; ?></td>
                                <td><?php echo $row['anemia']; ?></td>
                                <td><?php echo $row['tipo_sangre']; ?></td>
								
								<td><?php echo $row['id_pedido']; ?></td>

									
						    		<td>
									<a href="#addnew<?php echo $row['id_pedido']; ?>" class="btn btn-success btn-sm" data-toggle="modal"><span class="fa fa-edit"></span> Impimir</a>
						    			
									
						    		</td>
						    		<?php include('edit_delete_modal.php'); ?>
						    	</tr>
						    	<?php 
						    }
						}
						catch(PDOException $e){
							echo "There is some problem in connection: " . $e->getMessage();
						}

						//cerrar conexión
						$database->close();

					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php include('add_modal.php'); ?>
<script src="bootstrap/js/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.js"></script>
<script src="bootstrap/js/custom.js"></script>
</body>
</html>
