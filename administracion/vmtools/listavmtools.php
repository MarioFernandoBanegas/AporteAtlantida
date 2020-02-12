<?php
  session_start();
  include "../../DiseñoAdministracionIndex.php";
  if (@!$_SESSION['user']) {
  //header("Location:../login.php");
  }elseif ($_SESSION['rol']==2) {
  //header("Location:../index.php");
  }
?>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="../../index.php">Tablero</a>
        </li>
        <li class="breadcrumb-item active">Mi Tablero</li>
        <li class="breadcrumb-item">
      <a href="../../Reportes/reportevmtools.php" target="_blank">Imprimir</a></li>
      </ol>
      <!-- Icon Cards-->

      <!-- Area Chart Example-->

      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i>Registro de Estados del VMtools</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>VMTool</th>
                  <th>Eliminar</th>
                  <th>Editar</th>
                </tr>
              </thead>
              <?php
               $sqla = ("SELECT * FROM CAT_ESTADO_VMTOOLS");
               $query= sqlsrv_query($conn,$sqla)
              ?>

              <tbody>

               <?php while ($arreglo=sqlsrv_fetch_array($query)){
                ?>
                <tr>
                <td><?php echo $arreglo[0];?></td>
                <td><?php echo $arreglo[1];?></td>
                <?php
                 echo "<th><a  title='eliminar' href='listavmtools.php?id=$arreglo[0]&idborrar=2' onclick=\"return confirm('desea eliminar el regisro?')\"><img src='../../media/eliminar1.png' text='eliminar' height='40' width='40'  class='img-rounded'/>eliminar</a></th>";
                 ?>
                 <?php
                 echo "<td> <a href='vmtoolsupdate.php?id=$arreglo[0]'><img src='../../media/editar.png' height='40' width='40'  title='editar' class='img-rounded'>editar</a></td>";
                 ?>
                 <?php
                 extract($_GET);
                  if(@$idborrar==2){
                  $sqlborrar="DELETE FROM CAT_ESTADO_VMTOOLS WHERE ID_ESTADO_VMTOOL=$id";
                  $resborrar=sqlsrv_query($conn,$sqlborrar);
                  echo '<script>alert("REGISTRO ELIMINADO")</script> ';
                  echo "<script>location.href='listavmtools.php'</script>";
                  }
                  ?>
                  <?php
              }
              ?>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer small text-muted"></div>
      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright© | Infatlán | 2020</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
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
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->

    <script src="../../vendor/datatables/jquery.dataTables.js"></script>
    <script src="../../vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="../../js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="../../js/sb-admin-datatables.min.js"></script>

  </div>
  <?php //include '../../footer.php' ?>
</body>

</html>
