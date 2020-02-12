<?php
    session_start();
  include "../../DiseñoFormularios.php";
if (@!$_SESSION['user']) {
  //header("Location:../login.php");
}elseif ($_SESSION['rol']==2) {
  //header("Location:../index.php");
}
?>

      <div class="card-header">Registro Zonas</div>
      <div class="card-body">
      <?php
        extract($_GET);
        $sql="SELECT * FROM CAT_AREAS WHERE ID_AREA=$id";
        $ressql=sqlsrv_query($conn,$sql);
        while ($row=sqlsrv_fetch_array($ressql)){
          $id=$row[0];
          $user=$row[1];
        }
      ?>
      <form action="../../updates/actualizar_zona.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <div class="form-row">
            <div class="col-md-12">
                <label for="exampleInputName">ID_Zona</label>
                <input  style="text-align:center" readonly="readonly" value="<?php echo $id?>" type="text" class="form-control"  name="id">
            </div>
            <div class="col-md-12">
                <label for="exampleInputLastName">Nombre_Zona</label>
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
  <script src="../../vendor/jquery/jquery.min.js"></script>
  <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>
</body>
</html>
