<?php 

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		include '../libs/connection.php';
		$sql = '';

		if($_POST['accion'] == 'insert')
		{
			$name_sas = $_POST['name_sas'];
			$sql = "INSERT INTO  pci (Name_SAS)VALUES('$name_sas')";
     		$recurso = sqlsrv_prepare($conn,$sql);
			if (sqlsrv_execute($recurso)) {
				echo "Agregado correctamente";
				header('Location: ../administracion/ListaSAS.php'); //redireccion
			}else
			echo "Error";
		}
	}else
	{
		echo "Desde la barra de direcciones";
	}
?>