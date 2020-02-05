<?php

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		include '../libs/connection.php';
		$sql = '';

		if($_POST['accion'] == 'insert')
		{
			$sql1="SELECT top 1 ID_SERVIDOR   from SERVIDORES order by ID_SERVIDOR desc";
			$result = sqlsrv_query($conn,$sql1);
			$row = sqlsrv_fetch_array($result);
			$variable=$row['ID_SERVIDOR'] +1;

			$id_servidor= $variable;
			$stateVMTOOL = $_POST['state'];//$_POST['state'];
			$os = $_POST['os'];
			$responsable = $_POST['responsable'];
			$host = $_POST['host'];
			$db = $_POST['db'];
			$type = $_POST['type'];
			$zona = $_POST['zona'];
			$app = $_POST['app'];
			$power = $_POST['power'];
			$ipservidor = $_POST['ipservidor'];
			$nombre = $_POST['nombre'];
			$cpu = $_POST['cpu'];
			$ram = $_POST['ram'];
			$e_pro = $_POST['e_pro'];
			$e_usado = $_POST['e_usado'];
			$pci = $_POST['pci'];
			//Dominio
			//NODO
			//Fecha de Creacion
			//Ultima Actualizacion
			//Estado AV

			$sql = "INSERT INTO SERVIDORES (ID_SERVIDOR,ID_ESTADO_VMTOOL, ID_SO, ID_ADMINISTRADOR, ID_HOST, ID_DBA, ID_TIPO, ID_AREA, ID_SERVICIO, ID_ESTADO, IP_SERVIDOR, NOM_SERVIDOR,NO_PROCESADORES, RAM,ALM_PROVISIONADO, ALM_ENUSO,PCI)
			VALUES('$id_servidor','$stateVMTOOL','$os','$responsable','$host','$db','$type','$zona','$app','$power','$ipservidor','$nombre','$cpu','$ram','$e_pro','$e_usado','$pci')";
			$recurso = sqlsrv_prepare($conn,$sql);
			if ( sqlsrv_execute($recurso) ) {
				echo "Agregado correctamente";
				header('Location: ../ListaServidores.php'); //redireccion
			}else
			echo "Error";
		}
	}else
	{
		echo "Desde la barra de direcciones";
	}

?>
