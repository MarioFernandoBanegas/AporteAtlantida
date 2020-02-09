<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		include 'libs/connection.php';
		$sql = '';

		if($_POST['accion'] == 'insert')
		{
			$id_servidor= $_POST['id'];
			$user = $_POST['user'];
			$procesadores = $_POST['a14'];
			$ram = $_POST['a15'];
			$espacio = $_POST['a16'];
			$usado = $_POST['a17'];
			$estadoAv = $_POST['a19'];
			$id_nodo = $_POST['a18'];
			$creacion = $_POST['fecha'];
			$ultima = $_POST['ultima'];
			$tipo = $_POST['a31'];
			$estado = $_POST['a21'];
			$so = $_POST['a27'];
			$dominio = $_POST['a3'];
			$host = $_POST['a37'];
			$pci = $_POST['pcii'];
			$responsable = $_POST['a23'];
			$zona = $_POST['a33'];
			$servicio = $_POST['a35'];
			$gestor = $_POST['a29'];
			$stateVMTOOL = $_POST['a25'];

			$sql = "UPDATE SERVIDORES set NOM_SERVIDOR='$user',ID_ESTADO='$estado',ID_ADMINISTRADOR='$responsable',EN_DOMINIO='$dominio',
			ID_HOST='$host',FECHA_CREACION='$creacion',ULTIMA_ACTUALIZACION='$ultima',ID_ESTADO_VMTOOL='$stateVMTOOL',PCI='$pci',ID_SO='$so',
			ID_DBA='$gestor',ID_TIPO='$tipo',ID_AREA='$zona',ID_SERVICIO='$servicio',NO_PROCESADORES='$procesadores',RAM='$ram',
			ALM_ENUSO='$usado',ALM_PROVISIONADO='$espacio',
			ID_NODO='$id_nodo',ESTADO_AV='$estadoAv' WHERE IP_SERVIDOR='$id_servidor'";
			$recurso = sqlsrv_prepare($conn,$sql);
			if ( sqlsrv_execute($recurso) ) {
				echo "Agregado correctamente";
				header('Location: ListaServidores.php'); //redireccion
			}else
			echo "Error";
		}
		else {
			echo "Error2";
		}
	}else
	{
		echo "Desde la barra de direcciones";
	}
?>
