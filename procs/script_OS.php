<?php

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		include '../libs/connection.php';
		$sql = '';

		if($_POST['accion'] == 'insert')
		{
			$name_os = $_POST['name_os'];
			$sql = "INSERT INTO CAT_SO (NOM_SO)VALUES('$name_os')";
			$recurso = sqlsrv_prepare($conn,$sql);
			if (sqlsrv_execute($recurso)) {
				echo "Agregado correctamente";
				header('Location: ../administracion/SO/ListaOS.php'); //redireccion
			}else
			echo "Error";
		}
	}else
	{
		echo "Desde la barra de direcciones";
	}

?>
