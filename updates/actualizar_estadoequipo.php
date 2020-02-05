<?php


   extract($_POST);	//extraer todos los valores del metodo post del formulario de actualizar
	require('../libs/connection.php');
	$sentencia="UPDATE power SET Name_Power='$user' WHERE Id_Power='$id'";
	//la variable  $mysqli viene de connect_db que lo traigo con el require("connect_db.php");
	$resent=sqlsrv_query($conn,$sentencia);
	if ($resent==null) {
		echo "Error de procesamieno no se han actuaizado los datos";
		echo '<script>alert("ERROR EN PROCESAMIENTO NO SE ACTUALIZARON LOS DATOS")</script> ';
		header("location: ../administracion/ListaEstados.php");
		
		echo "<script>location.href='administracion/ListaEstados.php'</script>";
	}else {
		echo '<script>alert("REGISTRO ACTUALIZADO")</script> ';
		
		echo "<script>location.href='../administracion/ListaEstados.php'</script>";

		
	}
?>