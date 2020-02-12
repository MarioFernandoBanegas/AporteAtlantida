<?php
  session_start();
  include "../DiseñoGraficasIndex.php";

  class Servidores
  {

    public function cargaSistOp( $conn ) {
      $sql = "SELECT DISTINCT GuestName FROM [10.128.0.33].[swMonitor].[dbo].VIM_VirtualMachines ORDER BY GuestName" ;
      $query = sqlsrv_query( $conn, $sql ) ;
      return $query ;
    }

    public function cargaEncendido ( $conn ) {
      $sql = "SELECT DISTINCT PowerState FROM [10.128.0.33].[swMonitor].[dbo].VIM_VirtualMachines ORDER BY PowerState" ;
      $query = sqlsrv_query( $conn, $sql ) ;
      return $query ;
    }

    public function cargaVMTool ( $conn ) {
      $sql = "SELECT DISTINCT GuestVmWareToolsStatus FROM [10.128.0.33].[swMonitor].[dbo].VIM_VirtualMachines ORDER BY GuestVmWareToolsStatus" ;
      $query = sqlsrv_query( $conn, $sql ) ;
      return $query ;
    }

    public function cargavCenter ( $conn ) {
      $sql = "SELECT ClusterID, Name FROM [10.128.0.33].[swMonitor].[dbo].[VIM_Clusters]" ;
      $query = sqlsrv_query( $conn, $sql ) ;
      return $query ;
    }

    public function cargaHosts ( $conn ) {
      $sql = "SELECT HostID, ClusterID, HostName, IPAddress FROM [10.128.0.33].[swMonitor].[dbo].[VIM_Hosts]" ;
      $query = sqlsrv_query( $conn, $sql ) ;
      return $query ;
    }

  }

  $servers = new Servidores() ;
  $CargaSO = $servers->cargaSistOp( $conn );
  $CargaPS = $servers->cargaEncendido( $conn );
  $CargaVT = $servers->cargaVMTool( $conn );
  $CargaVC = $servers->cargavCenter( $conn );

  $CargaHO = $servers->cargaHosts( $conn );


?>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="../index.php">Tablero</a>
        </li>
        <li class="breadcrumb-item active">Carga desde vMan</li>
      </ol>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Carga de Catálogos Generales</a>
        </li>
      </ol>

      <!-- Example DataTables Card-->

      <div class="row">
        Cargando Sistemas Operativos
        <?php
          if ( !$CargaSO === false ) {
            while ( $row = sqlsrv_fetch_array( $CargaSO ) ) {
              $sqla = ("SELECT COUNT ( 1 ) FROM CAT_SO WHERE NOM_SO = '" . $row[0] . "'" );
              $query= sqlsrv_query($conn, $sqla);
              $val = sqlsrv_fetch_array( $query );
              if (  $val[0] <> 1 ) {
                $sqla = ("SELECT MAX ( ID_SO ) FROM CAT_SO" );
                $query= sqlsrv_query($conn, $sqla);
                $val1 = sqlsrv_fetch_array( $query );
                $valor = $val1[0] + 1 ;
                $sqla = ("INSERT INTO CAT_SO ( ID_SO, NOM_SO ) VALUES ( " . $valor . ", '" . $row[0] ."' )" );
                $query= sqlsrv_query($conn, $sqla);
              }
            }
          }
        ?>
        <br>
        Cargando Estados
        <?php
          if ( !$CargaPS === false ) {
            while ( $row = sqlsrv_fetch_array( $CargaPS ) ) {
              $sqla = ("SELECT COUNT ( 1 ) FROM CAT_ESTADOS WHERE NOM_ESTADO = '" . $row[0] . "'" );
              $query= sqlsrv_query($conn, $sqla);
              $val = sqlsrv_fetch_array( $query );
              if (  $val[0] <> 1 ) {
                $sqla = ("SELECT MAX ( ID_ESTADO ) FROM CAT_ESTADOS" );
                $query= sqlsrv_query($conn, $sqla);
                $val1 = sqlsrv_fetch_array( $query );
                $valor = $val1[0] + 1 ;
                $sqla = ("INSERT INTO CAT_ESTADOS ( ID_ESTADO, NOM_ESTADO ) VALUES ( " . $valor . ", '" . $row[0] ."' )" );
                $query= sqlsrv_query($conn, $sqla);
              }
            }
          }
        ?>
        <br>
        Cargando VMTools
        <?php
          if ( !$CargaVT === false ) {
            while ( $row = sqlsrv_fetch_array( $CargaVT ) ) {
              $sqla = ("SELECT COUNT ( 1 ) FROM CAT_ESTADO_VMTOOLS WHERE NOM_ESTADO_VMTOOL = '" . $row[0] . "'" );
              $query= sqlsrv_query($conn, $sqla);
              $val = sqlsrv_fetch_array( $query );
              if (  $val[0] <> 1 ) {
                $sqla = ("SELECT MAX ( ID_ESTADO_VMTOOL ) FROM CAT_ESTADO_VMTOOLS" );
                $query= sqlsrv_query($conn, $sqla);
                $val1 = sqlsrv_fetch_array( $query );
                $valor = $val1[0] + 1 ;
                $sqla = ("INSERT INTO CAT_ESTADO_VMTOOLS ( ID_ESTADO_VMTOOL, NOM_ESTADO_VMTOOL ) VALUES ( " . $valor . ", '" . $row[0] ."' )" );
                $query= sqlsrv_query($conn, $sqla);
              }
            }
          }
        ?>
        <br>
        Cargando vCenter
        <?php
          if ( !$CargaVC === false ) {
            while ( $row = sqlsrv_fetch_array( $CargaVC ) ) {
              $sqla = ("SELECT COUNT ( 1 ) FROM CAT_CLUSTER WHERE NOM_CLUSTER = '" . $row[1] . "'" );
              $query= sqlsrv_query($conn, $sqla);
              $val = sqlsrv_fetch_array( $query );
              if (  $val[0] <> 1 ) {
                $sqla = ("INSERT INTO CAT_CLUSTER ( ID_CLUSTER, NOM_CLUSTER ) VALUES ( " . $row[0] . ", '" . $row[1] . "' )" );
                $query= sqlsrv_query($conn, $sqla);
              }
            }
          }
        ?>
        <br>
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
            <a class="btn btn-primary" href="desconectar.php">Logout</a>
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
    <script src="../vendor/chart.js/Chart.min.js"></script>
    <script src="../vendor/datatables/jquery.dataTables.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="../js/sb-admin-datatables.min.js"></script>

    <script src="../js/sb-admin-charts.js"></script>
    <script src="../js/sb-charts.js"></script>

  </div>
  <?php //include 'footer.php' ?>
</body>

</html>
