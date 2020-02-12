<?php
    session_start();
  include "../../DiseñoFormularios.php";
if (@!$_SESSION['user']) {
  //header("Location:../login.php");
}elseif ($_SESSION['rol']==2) {
  //header("Location:../index.php");
}
?>

      <div class="card-header">Registro de Estados de VMTools</div>
      <div class="card-body">

        <form action="../../procs/script_vmtools.php" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                <label for="exampleInputName">ID VMTool</label>
                <input style="text-align:center" readonly="readonly" value "<?php error_reporting(0)?>" value="<?php echo $id_aplication?>" type="text" class="form-control" id="id_aplication" name="id_aplication" placeholder="Codigo generado automaticamente">
              </div>
              <div class="col-md-12">
                <label for="exampleInputLastName">Nombre del Estado VMTools</label>
                <input style="text-align:center" value "<?php error_reporting(0)?>"value="<?php echo $name_estado ?>" type="text" class="form-control" id="name_estado" name="name_estado" placeholder="Ingrese el Nombre" required>

              </div>

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
