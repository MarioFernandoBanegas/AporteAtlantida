<?php
  session_start();
  include "../DiseñoGraficasIndex.php";
  if (@!$_SESSION['user']) {
  //header("Location:login.php");
  }elseif ($_SESSION['rol']==2) {
  //header("Location:index.php");
  }
?>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="../index.php">Tablero</a>
        </li>
        <li class="breadcrumb-item active">Mi Tablero</li>
      </ol>
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i>Registro Vulnerabilidades</div>
        <div class="card-body">
          <div class="table-responsive">
            <table  WIDTH="900%" class="table table-bordered" id="dataTable" width="900%" cellspacing="0">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>IP</th>
                  <th>Servidor</th>
                  <th>Estado del riesgo</th>
                  <th>Severidad del Riesgo</th>
                  <th>Protocolo</th>
                  <th>Puerto</th>
                  <th>Responsable</th>
                  <th>Area Responsable</th>
                  <th>Tipo de amenaza</th>
                  <th>Solucion</th>
                  <th>Descripcion</th>
                  <th>Plan de Accion</th>
                  <th>Evidencias</th>
                  <th>Observaciones</th>
                  <th>Fecha estimada de cierre</th>
                  <th>Fecha estimada de cierre (Proyecto)</th>
                  <th>Numero de proyecto</th>
                  <TH>Eliminar</TH>
                </tr>
              </thead>
                <?php
                $sqla = ("SELECT * FROM vulnera");
                $query= sqlsrv_query($conn,$sqla)
                ?>
              <tbody>
               <?php while ($arreglo=sqlsrv_fetch_array($query)){
                ?>
                  <tr>
                  <td><?php echo$arreglo[0]?></td>
                  <td><?php echo$arreglo[1]?></td>
                  <td><?php echo$arreglo[2]?></td>
                  <td><?php echo$arreglo[3]?></td>
                  <td><?php echo$arreglo[4]?></td>
                  <td><?php echo$arreglo[5]?></td>
                  <td><?php echo$arreglo[6]?></td>
                  <td><?php echo$arreglo[7]?></td>
                  <td><?php echo$arreglo[8]?></td>
                  <td><?php echo$arreglo[9]?></td>
                  <td><?php echo$arreglo[10]?></td>
                  <td><?php echo$arreglo[11]?></td>
                  <td><?php echo$arreglo[12]?></td>
                  <td><?php echo$arreglo[13]?></td>
                  <td><?php echo$arreglo[14]?></td>
                  <td><?php echo$arreglo[15]->format('d/m/Y');?></td>
                  <td><?php echo$arreglo[16]->format('d/m/Y');?></td>
                  <td><?php echo$arreglo[17]?></td>
                  <?php
                  echo "<th> <a title='eliminar' href='ListaVul.php?id=$arreglo[0]&idborrar=2' onclick=\"return confirm('desea eliminar el regisro?')\"><img src='../media/eliminar1.png' text='eliminar' height='30' width='30'  class='img-rounded'/>eliminar</a></th>";
                  ?>
                  <?php
                    extract($_GET);
                    if(@$idborrar==2){
                    $sqlborrar="DELETE FROM vulnera WHERE id_vul=$id";
                    $resborrar=sqlsrv_query($conn,$sqlborrar);
                    echo '<script>alert("REGISTRO ELIMINADO")</script> ';
                    echo "<script>location.href='ListaVul.php'</script>";
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
  <?php //include '../footer.php' ?>
</body>
</html>
