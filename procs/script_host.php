<?php

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		include '../libs/connection.php';

		$sql = '';


		if($_POST['accion'] == 'insert')
		{
			$name_aplication = $_POST['name_host'];
			$cluster = $_POST['cluster'];
			$name_host = $_POST['name_host'];
			$ip_host = $_POST['ip_host'];
			$sql = "INSERT INTO CAT_HOSTS (ID_CLUSTER,NOM_HOST,IP_HOST) VALUES('$cluster','$name_host','$ip_host')";
			$recurso = sqlsrv_prepare($conn,$sql);

			if (sqlsrv_execute($recurso)) {
				echo "Agregado correctamente";
				header('Location: ../administracion/host/listahost.php'); //redireccion
				# code...
			}else
			echo "Error";
		}



	}else
	{
		echo "Desde la barra de direcciones";
	}

?>
