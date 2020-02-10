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
      <div class="card-header">Registro Tipos de Maquinas</div>
      <div class="card-body">
        <form action="../../procs/script_Type.php" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                <label for="exampleInputName">ID_Tipo</label>
                <input  style="text-align:center" readonly="readonly" value "<?php error_reporting(0)?>" value="<?php echo $id_type ?>" type="text" class="form-control" id="id_os" name="id_type" placeholder="Codigo generado automaticamente">
              </div>
              <div class="col-md-12">
                <label for="exampleInputLastName">Tipo Maquina</label>
                <input style="text-align:center" value "<?php error_reporting(0)?>"value="<?php echo $name_type ?>" type="text" class="form-control" id="name_type" name="name_type" placeholder="Ingrese el tipo" required>
              </div>
            </div>
          </div>
          <p>
          <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
          <input type="hidden" name="accion" value="<?php echo $_GET['accion'] ?>">
          <center><input type="submit" value="Guardar " class="btn btn-primary btn-block" ></center>
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
