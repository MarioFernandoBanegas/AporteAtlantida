<?php
   extract($_POST);	//extraer todos los valores del metodo post del formulario de actualizar
	require('../libs/connection.php');
	$sentencia="UPDATE CAT_ESTADO_VMTOOLS SET NOM_ESTADO_VMTOOL='$user' WHERE ID_ESTADO_VMTOOL='$id'";
	//la variable  $mysqli viene de cnn que lo traigo con el require("connect_db.php");
	$resent=sqlsrv_query($conn,$sentencia);
	if ($resent==null) {
		echo "Error de procesamieno no se han actuaizado los datos";
		echo '<script>alert("ERROR EN PROCESAMIENTO NO SE ACTUALIZARON LOS DATOS")</script> ';
		header("location: ../administracion/vmtools/listavmtools.php");

		echo "<script>location.href='administracion/vmtools/listavmtools.php'</script>";
	}else {
		echo '<script>alert("REGISTRO ACTUALIZADO")</script> ';

		echo "<script>location.href='../administracion/vmtools/listavmtools.php'</script>";
	}
?>
