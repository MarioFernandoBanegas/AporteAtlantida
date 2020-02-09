<?php
   extract($_POST);	//extraer todos los valores del metodo post del formulario de actualizar
	require('../libs/connection.php');
	$sentencia="UPDATE CAT_CLUSTER SET NOM_CLUSTER='$user',IP_VCENTER='$ip' WHERE ID_CLUSTER='$id'";
	//la variable  $mysqli viene de cnn que lo traigo con el require("connect_db.php");
	$resent=sqlsrv_query($conn,$sentencia);
	if ($resent==null) {
		echo "Error de procesamieno no se han actuaizado los datos";
		echo '<script>alert("ERROR EN PROCESAMIENTO NO SE ACTUALIZARON LOS DATOS")</script> ';
		header("location: ../administracion/Cluster/listacluster.php");

		echo "<script>location.href='administracion/Cluster/listacluster.php'</script>";
	}else {
		echo '<script>alert("REGISTRO ACTUALIZADO")</script> ';

		echo "<script>location.href='../administracion/Cluster/listacluster.php'</script>";
	}
?>
