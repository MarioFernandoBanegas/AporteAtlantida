<?php

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		include '../libs/connection.php';
		$sql = '';

		if($_POST['accion'] == 'insert')
		{
			$name_responsable = $_POST['name_responsable'];
			$sql = "INSERT INTO CAT_RESPONSABLES (NOM_ADMINISTRADOR)VALUES('$name_responsable')";
			$recurso = sqlsrv_prepare($conn,$sql);
			if (sqlsrv_execute($recurso)) {
				echo "Agregado correctamente";
				header('Location: ../administracion/Responsable/ListaResponsables.php'); //redireccion
			}else
			echo "Error";
		}
	}else
	{
		echo "Desde la barra de direcciones";
	}
?>
