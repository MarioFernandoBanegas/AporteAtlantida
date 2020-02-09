<?php

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		include '../libs/connection.php';

		$sql = '';


		if($_POST['accion'] == 'insert')
		{
			$name_aplication = $_POST['name_estado'];
			$sql = "INSERT INTO CAT_ESTADO_VMTOOLS (NOM_ESTADO_VMTOOL) VALUES('$name_aplication')";
			$recurso = sqlsrv_prepare($conn,$sql);

			if (sqlsrv_execute($recurso)) {
				echo "Agregado correctamente";
				header('Location: ../administracion/vmtools/listavmtools.php'); //redireccion
				# code...
			}else
			echo "Error";
		}



	}else
	{
		echo "Desde la barra de direcciones";
	}

?>
