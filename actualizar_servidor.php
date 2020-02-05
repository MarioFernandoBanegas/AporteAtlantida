<?php
/*
   extract($_POST);	//extraer todos los valores del metodo post del formulario de actualizar
	require('libs/connection.php');
	$sentencia="UPDATE servers SET IP='$user', nombre= '$a1', procesadores='$a2', ram='$a3', host='$a4', hora_servicio='$a5', ul_fecha='$a6', tls='$a7', hardenizado='$a8', espacio_pro='$a9', espacio_usado='$a10', dns='$a11', Id_Type='$a12', Id_SAS='$a14', Id_Power='$a16',
	Id_OS='$a18', Id_Responsable='$a20', Id_Zone='$a22', Id_Aplication= '$a24', Id_Dbserver='$a26', Id_Connection_state='$a28', contingencia='$a30', observaciones='$a31' WHERE id='$id'";
  ?>
  <?php
	$resent=sqlsrv_query($conn,$sentencia);
	if ($resent==null) {
		echo "Error de procesamieno no se han actuaizado los datos";
		echo '<script>alert("ERROR EN PROCESAMIENTO NO SE ACTUALIZARON LOS DATOS")</script> ';
		header("location: ListaServidores.php");

		echo "<script>location.href='ListaServidores.php'</script>";
	}else {
		echo '<script>alert("REGISTRO ACTUALIZADO")</script> ';

		echo "<script>location.href='ListaServidores.php'</script>";
	}*/
?>
<?php

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		include 'libs/connection.php';
		$sql = '';

		if($_POST['accion'] == 'insert')
		{

			$id_servidor= $_POST['id'];
			$stateVMTOOL = $_POST['a25'];
			/*$os = $_POST['os'];
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
			$pci = $_POST['pci'];*/
			//Dominio
			//NODO
			//Fecha de Creacion
			//Ultima Actualizacion
			//Estado AV

			$sql = "UPDATE SERVIDORES set ID_ESTADO_VMTOOL='$stateVMTOOL' where IP_SERVIDOR = '$id_servidor'";
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
