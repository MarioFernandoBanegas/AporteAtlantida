<?php 

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		include '../libs/connection.php';

		$sql = '';

		if($_POST['accion'] == 'insert')
		{
			$sql = "INSERT INTO vulnera  (IP,Servidor,EstadoRiesgo,SeveridadRiesgo,Protocolo,Puerto,Responsable,AreaResponsable,TipoAmenaza,Solucion,Descripcion,PlanAccion,Evidencias,Observaciones,FechaEstimadaCierre,FechaEstimadaCierreProyecto,NumeroProyecto,activo)  VALUES ('";
			
		}else if($_POST['accion'] == 'update'){
			$sql = 'UPDATE vulnera set IP = ? , Servidor = ? ';
			$sql .= 'WHERE id_vul = ?';
		}
	

		
		$ip = $_POST['ip'];
		$servidor = $_POST['servidor'];
		$estariesgo = $_POST['estariesgo'];
		$severiesgo = $_POST['severiesgo'];
		$protocolo = $_POST['protocolo'];
		$puerto = $_POST['puerto'];
		$responsable = $_POST['responsable'];
		$aresponsable = $_POST['aresponsable'];
		$tipoa = $_POST['tipoa'];
		$solucion = $_POST['solucion'];
		$descripcion = $_POST['descripcion'];
		$paccion = $_POST['paccion'];
		$evidencias = $_POST['evidencias'];
		$observaciones = $_POST['observaciones'];
		$fechaec = $_POST['fechaec'];
		$fechaecp = $_POST['fechaecp'];
		$numerop = $_POST['numerop'];
		$data = $cnn->prepare($sql);
		$data->bind_param('sssssssssssssssss',$ip, $servidor, $estariesgo, $severiesgo, $protocolo, $puerto, $responsable, $aresponsable, $tipoa, $solucion, $descripcion, $paccion, $evidencias,$observaciones,$fechaec,$fechaecp,$numerop);
		$data->execute();
		header('Location: ../index.php'); //redireccion
	}else
	{
		echo "Hola desde la barra de direcciones";
	}

?>