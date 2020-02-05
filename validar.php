<?php
	session_start();
	include "header.php";
	@$username=$_POST['mail'];
	@$pass=$_POST['pass'];

	$sql2=sqlsrv_query($conn,"SELECT * FROM login WHERE email='$username'");
	if($f2=sqlsrv_fetch_array($sql2,SQLSRV_FETCH_ASSOC)){
		if($pass==$f2['pasadmin']){
			$_SESSION['id']=$f2['id'];
			$_SESSION['user']=$f2['user'];
			$_SESSION['rol']=$f2['rol'];

			echo '<script>alert("BIENVENIDO ADMINISTRADOR")</script> ';
			echo "<script>location.href='index.php'</script>";
		}
	}

	$sql=sqlsrv_query($conn,"SELECT * FROM login WHERE email='$username'");
	if($f=sqlsrv_fetch_array($sql,SQLSRV_FETCH_ASSOC)){
		if($pass==$f['password']){
			$_SESSION['id']=$f['id'];
			$_SESSION['user']=$f['user'];
			$_SESSION['rol']=$f['rol'];

			header("Location: login.php");
		}else{
			echo '<script>alert("CONTRASEÑA INCORRECTA")</script> ';
		
			echo "<script>location.href='login.php'</script>";
		}
	}else{
		
		echo '<script>alert("ESTE USUARIO NO EXISTE, PORFAVOR COMUNIQUESE CON EL ADMINISTRADOR")</script> ';
		
		echo "<script>location.href='login.php'</script>";	
	}
?>