}<?php
    session_start();
  include "../../header.php";
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
  <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="../../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="../../css/sb-admin.css" rel="stylesheet">
  <link rel="shortcut icon" href="../../media/bac-favicon.ico" />

</head>
<body oncontextmenu="return false" class="bg-dark">
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div align="center"><a href="../../index.php"><img src="../../media/logo.png" height="50" width="105"></a>
      </div>
      <div class="card-header">Resgistro Clusters</div>
      <div class="card-body">

    <?php
      extract($_GET);
      $sql="SELECT * FROM CAT_CLUSTER WHERE ID_CLUSTER=$id";
    //la variable  $mysqli viene de connect_db que lo traigo con el require("connect_db.php");
      $ressql=sqlsrv_query($conn,$sql);
      while ($row=sqlsrv_fetch_array ($ressql)){
          $id=$row[0];
          $user=$row[1];
          $ip=$row[2];
        ;
        }
    ?>

        <form action="../../updates/actualizar_cluster.php" method="post" enctype="multipart/form-data">

          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                <label for="exampleInputName">ID Cluster</label>
                <input  style="text-align:center" readonly="readonly" value="<?php echo $id?>" type="text" class="form-control"  name="id">
              </div>
              <div class="col-md-12">
                <label for="exampleInputLastName">Nombre Clusters</label>
                <input style="text-align:center"  value="<?php echo $user ?>" type="text" class="form-control" name="user"  required>
                <label for="exampleInputLastName">IP del VCenter</label>
                <input style="text-align:center"  value="<?php echo $ip ?>" type="text" class="form-control" name="ip"  required>

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
  <script src="../../vendor/jquery/jquery.min.js"></script>
  <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
