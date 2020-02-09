<?php

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		include '../libs/connection.php';

		$sql = '';


		if($_POST['accion'] == 'insert')
		{
			$name_aplication = $_POST['name_cluster'];
			$ip = $_POST['ip'];
			$sql = "INSERT INTO CAT_CLUSTER (NOM_CLUSTER,IP_VCENTER) VALUES('$name_aplication','$ip')";
			$recurso = sqlsrv_prepare($conn,$sql);

			if (sqlsrv_execute($recurso)) {
				echo "Agregado correctamente";
				header('Location: ../administracion/Cluster/listacluster.php'); //redireccion
				# code...
			}else
			echo "Error";
		}



	}else
	{
		echo "Desde la barra de direcciones";
	}

?>
