<?php
session_start();
include "../DiseñoGraficasIndex.php";
if (@!$_SESSION['user']) {
  //header("Location:../login.php");
}elseif ($_SESSION['rol']==2) {
  //header("Location:../index.php");
}
?>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="../index.php">Tablero</a>
        </li>
        <li class="breadcrumb-item active">Mi Tablero</li>
      </ol>
        <h3>Cargar e importar archivo excel a Base de Datos </h3>
        <form name="importa" method="post" action="" enctype="multipart/form-data" >
          <div class="col-xs-4">
            <div class="form-group">
              <input type="file" class="filestyle" data-buttonText="Seleccione archivo" name="excel">
            </div>
          </div>
          <div class="col-xs-4">
            <input class="btn btn-default btn-file" type='submit' name='enviar' onclick="return confirm('Esta seguro de subir la BD?')"  value="Importar"  />
          </div>
          <input type="hidden" value="upload" name="action" />
          <input type="hidden" value="usuarios" name="mod">
          <input type="hidden" value="masiva" name="acc">
        </form>
      </div>
    </div>
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright©| Infatlán |2020</small>
        </div>
      </div>
    </footer>
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Cerrar Sesion?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Esta seguro que quiere salir?.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="../desconectar.php">Logout</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->

    <script src="../vendor/datatables/jquery.dataTables.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="../js/sb-admin-datatables.min.js"></script>

  </div>
  <?php include 'footers.php' ?>
</body>
</html>






































<?php /*
<!DOCTYPE html>
<html>
<head>
  <title>Sistema Guardar Excel en MySQL</title>
  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
<link rel="stylesheet" href="css/styles.css" >

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <script type="text/javascript" src="js/filestyle.min.js"> </script>

</head>
<body>

<div class="container">
  <div class="row">
    <div style="border: 1px solid #ccc; height: 42px; background:#f1f3f5 ">
    <nav class="dropdownmenu">
  <ul>
    <li><a href="index.php">Inicio</a></li>
    <li><a href="Mantenimiento.php">Nueva vulnerabilidad</a></li>
    <li><a href="Mantenimientos.php">Ver Registros</a></li>
    <li><a href="desconectar.php">cerrar sesion</a></li>

    <li></li>
    <li></li>
  </ul>

</nav></div>
*/?>
