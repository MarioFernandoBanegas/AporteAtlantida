<?php
    session_start();
  include "../../DiseñoFormularios.php";
if (@!$_SESSION['user']) {
  //header("Location:../login.php");
}elseif ($_SESSION['rol']==2) {
  //header("Location:../index.php");
}
?>

<body oncontextmenu="return false" class="bg-dark">
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <a href="../../index.php"><img src="../../media/logo.png" height="80" width="100"></a>
      <div class="card-header">Responsables de Servidores</div>
      <div class="card-body">
      <?php
          extract($_GET);
          $sql="SELECT * FROM CAT_SERVICIOS WHERE ID_SERVICIO=$id";
          $ressql=sqlsrv_query($conn,$sql);
          while ($row=sqlsrv_fetch_array ($ressql)){
            $id=$row[0];
            $user=$row[1];
            $critico=$row[2];
          }
      ?>
        <form action="../../updates/actualizar_servicio.php" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                <label for="exampleInputName">ID Servicio</label>
                <input  style="text-align:center" readonly="readonly" value="<?php echo $id?>" type="text" class="form-control"  name="id">
              </div>
              <div class="col-md-12">
                <label for="exampleInputLastName">Nombre Servicio</label>
                <input style="text-align:center"  value="<?php echo $user ?>" type="text" class="form-control" name="user"  required>
              </div>
              <?php //////////////////////////////////////////////////////////////////// ?>
              <div class="col-md-4">
                <div >
                  <p>Critico:
                  <select style="width: 194px" name="critico" id="critico">
                    <option value="1" <?php if($critico=='1') {echo "selected";} ?>>Si</option>
                    <option value="0" <?php if($critico=='0') {echo "selected";} ?>>No</option>
                  </select>
                  </p>
                </div>
              </div>
              <?php //////////////////////////////////////////////////////////////////// ?>
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
