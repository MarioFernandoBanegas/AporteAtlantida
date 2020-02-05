<?php 

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		include '../libs/connection.php';

		$sql = '';
		

		if($_POST['accion'] == 'insert')
		{
			$name_aplication = $_POST['name_aplication'];
			$sql = "INSERT INTO aplication (Name_Aplication) VALUES('$name_aplication')";
			$recurso = sqlsrv_prepare($conn,$sql);

			if (sqlsrv_execute($recurso)) {
				echo "Agregado correctamente";
				header('Location: ../administracion/ListaAplicaciones.php'); //redireccion
				# code...
			}else
			echo "Error";
		}

		
		
	}else
	{
		echo "Desde la barra de direcciones";
	}

?>

