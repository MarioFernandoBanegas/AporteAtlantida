<?php

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		include '../libs/connection.php';

		$sql = '';


		if($_POST['accion'] == 'insert')
		{
			$name_power = $_POST['name_power'];
			$sql = "INSERT INTO CAT_ESTADOS (NOM_ESTADO)VALUES('$name_power')";
			$recurso = sqlsrv_prepare($conn,$sql);

			if (sqlsrv_execute($recurso)) {
				echo "Agregado correctamente";
				header('Location: ../administracion/Estados_Equipo/ListaEstados.php'); //redireccion
				# code...
			}else
			echo "Error";
		}



	}else
	{
		echo "Desde la barra de direcciones";
	}

?>
