<?php 

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		include '../libs/connection.php';
		$sql = '';

		if($_POST['accion'] == 'insert')
		{
			$name_server = $_POST['name_server'];
			$sql = "INSERT INTO db_server (Name_server)VALUES('$name_server')";
      		$recurso = sqlsrv_prepare($conn,$sql);
			if (sqlsrv_execute($recurso)) {
				echo "Agregado correctamente";
				header('Location: ../administracion/ListaGestor.php'); //redireccion
			}else
			echo "Error";
		}	
	}else
	{
		echo "Desde la barra de direcciones";
	}
?>