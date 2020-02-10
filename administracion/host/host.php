<?php
    session_start();
  include "../../DiseñoFormularios.php";
if (@!$_SESSION['user']) {
  //header("Location:../login.php");
}elseif ($_SESSION['rol']==2) {
  //header("Location:../index.php");
}
?>


<body class="bg-dark" oncontextmenu="return false">
  <div class="container">
    <br>
    <div class="card card-register mx-auto mt-5">
      <div align="center"><a href="../../index.php"><img src="../../media/logo.png" height="50" width="105"></a>
      </div>
      <div class="card-header">Registro de Host</div>
      <div class="card-body">

        <form action="../../procs/script_host.php" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                <label for="exampleInputName">ID Host</label>
                <input style="text-align:center" readonly="readonly" value "<?php error_reporting(0)?>" value="<?php echo $id_aplication?>" type="text" class="form-control" id="id_aplication" name="id_aplication" placeholder="Codigo generado automaticamente">
              </div>

              <div class="col-md-12">
                <label for="exampleInputLastName">Nombre del Host</label>
                <input style="text-align:center" value "<?php error_reporting(0)?>"value="<?php echo $name_host ?>" type="text" class="form-control" id="name_host" name="name_host" placeholder="Ingrese el Nombre del Host" required>
              </div>


            <div class="col-md-12">
              <label for="exampleInputLastName">IP del Host</label>
              <input style="text-align:center" value "<?php error_reporting(0)?>"value="<?php echo $ip_host ?>" type="text" class="form-control" id="ip_host" name="ip_host" placeholder="Ingrese la Ip del Host" required>
            </div>

            <?php //////////////////////////////////////////////////////////////////// ?>
            <div class="col-md-4">
              <div >
              <?php
                $sql = 'SELECT * FROM CAT_CLUSTER ';
                $result = sqlsrv_query($conn,$sql)
               ?>
                <p>Nombre del Cluster:
                <select style="width: 194px" name="cluster" id="cluster">
                  <?php
                    while ($row = sqlsrv_fetch_array($result)) {
                      ?>
                      <option value="<?php echo $row['ID_CLUSTER'] ?>"><?php echo $row['NOM_CLUSTER'];?></option>
                      <?php
                    }
                    ?>
                </select>
                </p>
              </div>
            </div>
            <?php //////////////////////////////////////////////////////////////////// ?>

            </div>

          </div>
          <p>
          <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
          <input type="hidden" name="accion" value="<?php echo $_GET['accion'] ?>">
          <center><input type="submit" value="Guardar" class="btn btn-primary btn-block" ></center>
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
