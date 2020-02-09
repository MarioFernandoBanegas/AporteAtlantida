<?php
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
      <div class="card-header">Resgistro Hosts</div>
      <div class="card-body">

    <?php
      extract($_GET);
      $sql=" SELECT h.ID_HOST,c.NOM_CLUSTER,H.NOM_HOST,H.IP_HOST FROM CAT_HOSTS h inner join CAT_CLUSTER c on h.ID_CLUSTER = c.ID_CLUSTER
      WHERE h.ID_HOST='$id'";
    //la variable  $mysqli viene de connect_db que lo traigo con el require("connect_db.php");
      $ressql=sqlsrv_query($conn,$sql);
      while ($row=sqlsrv_fetch_array ($ressql)){
          $id=$row[0];
          $Nombre_cluster=$row[1];
          $nom_host=$row[2];
          $ip_host=$row[3];
          $a1=['ID_CLUSTER'];
          $a2=['NOM_CLUSTER'];
        ;
        }
    ?>

        <form action="../../updates/actualizar_host.php" method="post" enctype="multipart/form-data">

          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                <label for="exampleInputName">ID Host</label>
                <input  style="text-align:center" readonly="readonly" value="<?php echo $id?>" type="text" class="form-control"  name="id">
              </div>
              <!-- ************************************************************* -->
              <div class="col-md-4">
              <div >
                 <?php
                  $sql = 'SELECT ID_CLUSTER, NOM_CLUSTER FROM CAT_CLUSTER ';
                  $result = sqlsrv_query($conn,$sql)
                 ?>
                <p>Cluster:
                  <select style="width: 170px" name="a2" id="a1">

                      <?php while($row=sqlsrv_fetch_array($result)){
                        ?>
                      <option value="<?php echo $row['ID_CLUSTER']?>"<?php if($row['NOM_CLUSTER']==$Nombre_cluster) {echo "selected";} ?>><?php echo $row['NOM_CLUSTER'];?></option>
                     <?php
                   }
                   ?>
                  </select>
                </p>
                </div>
              </div>
              <!-- ************************************************************* -->
              <div class="col-md-12">
                <label for="exampleInputLastName">Nombre Host</label>
                <input style="text-align:center"  value="<?php echo $nom_host ?>" type="text" class="form-control" name="nom_host"  required>
              </div>

              <div class="col-md-12">
                <label for="exampleInputLastName">IP del Host</label>
                <input style="text-align:center"  value="<?php echo $ip_host ?>" type="text" class="form-control" name="ip_host"  required>

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
