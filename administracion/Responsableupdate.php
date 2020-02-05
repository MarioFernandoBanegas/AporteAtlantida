<?php
    session_start();
  include "../header.php";
if (@!$_SESSION['user']) {
  //header("Location:../login.php");
}elseif ($_SESSION['rol']==2) {
  //header("Location:../index.php");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
 <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>SB</title>
  <!-- Bootstrap core CSS-->
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">
  <link rel="shortcut icon" href="../media/bac-favicon.ico" />
  <link rel="shortcut icon" href="https://www.baccredomatic.com/sites/all/themes/custom/foundation_bac/bac-favicon.ico" />

</head>
<body oncontextmenu="return false" class="bg-dark">  
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <a href="../index.php"><img src="../media/logo.png" height="80" width="100"></a>
      <div class="card-header">Responsables de Servidores</div>
      <div class="card-body">
      <?php
          extract($_GET);
          $sql="SELECT * FROM responsable WHERE Id_Responsable=$id";
          $ressql=sqlsrv_query($conn,$sql);
          while ($row=sqlsrv_fetch_array ($ressql)){
            $id=$row[0];
            $user=$row[1];        
          }
      ?>
        <form action="../updates/actualizar_responsable.php" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                <label for="exampleInputName">ID_Responsable</label>
                <input  style="text-align:center" readonly="readonly" value="<?php echo $id?>" type="text" class="form-control"  name="id">
              </div>
              <div class="col-md-12">
                <label for="exampleInputLastName">Nombre_Responsable</label>
                <input style="text-align:center"  value="<?php echo $user ?>" type="text" class="form-control" name="user"  required>  
              </div>
            </div>
          </div>
          <p>
          <center><input type="submit" value="Editar" class="btn btn-success btn-block")></center>
        </p>
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