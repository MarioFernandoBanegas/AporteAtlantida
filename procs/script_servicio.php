<?php

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		include '../libs/connection.php';

		$sql = '';


		if($_POST['accion'] == 'insert')
		{
			$name_aplication = $_POST['name_servicio'];
			$critico = $_POST['critico'];
			$sql = "INSERT INTO CAT_SERVICIOS (NOM_SERVICIO,CRITICO) VALUES('$name_aplication','$critico')";
			$recurso = sqlsrv_prepare($conn,$sql);

			if (sqlsrv_execute($recurso)) {
				echo "Agregado correctamente";
				header('Location: ../administracion/Servicios/listaservicio.php'); //redireccion
				# code...
			}else
			echo "Error";
		}



	}else
	{
		echo "Desde la barra de direcciones";
	}

?>
