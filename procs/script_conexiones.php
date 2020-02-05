<?php 

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		include '../libs/connection.php';
		$sql = '';

		if($_POST['accion'] == 'insert')
		{
			$name_connection_state = $_POST['name_connection_state'];
			$sql = "INSERT INTO connection (Name_Connection_state)VALUES('$name_connection_state')";
      		$recurso = sqlsrv_prepare($conn,$sql);
      		if (sqlsrv_execute($recurso)){
       			echo "Agregado correctamente";
				header('Location: ../administracion/ListaConexion.php'); //redireccion
			}else
			echo "Error";
		}
	}else
	{
		echo "Desde la barra de direcciones";
	}

?>