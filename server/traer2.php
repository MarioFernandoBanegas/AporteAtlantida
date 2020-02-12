<?php
  session_start();
  include "../DiseñoGraficasIndex.php";

  class Servidores
  {
    public function cargaVMWare( $conn ) {
      $sql = "SELECT A.VirtualMachineID, A.IPAddress, A.Name, A.ProcessorCount, A.MemoryConfigured, B.IPAddress, A.TotalStorageSize, A.TotalStorageSizeUsed, A.PowerState, A.GuestName, A.GuestVmWareToolsStatus, A.NodeID, A.GuestDNSName, A.DateCreated
        FROM [10.128.0.33].[swMonitor].[dbo].VIM_VirtualMachines A
        INNER JOIN [10.128.0.33].[swMonitor].[dbo].VIM_VMwareNodes B on a.hostid = b.hostid" ;
      $query = sqlsrv_query( $conn, $sql ) ;
      return $query ;
    }
  }
  $servers = new Servidores() ;
  $CargaVM = $servers->cargaVMWare( $conn );

?>


      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="../index.php">Tablero</a>
        </li>
        <li class="breadcrumb-item active">Carga desde vMan</li>
      </ol>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Carga de Máquinas Virtuales</a>
        </li>
      </ol>

      <!-- Example DataTables Card-->

      <div class="row">
        Cargar Servidores
        <?php
          if ( !$CargaVM === false ) {
            $nuevo = 0;
            $update = 0;
            while ( $row = sqlsrv_fetch_array( $CargaVM ) ) {
              $sqla = ("SELECT COUNT ( 1 ) FROM SERVIDORES WHERE ID_SERVIDOR = '" . $row[0] . "'" );
              $query= sqlsrv_query( $conn, $sqla );
              $val = sqlsrv_fetch_array( $query );
              $sqla = ("SELECT ID_ESTADO FROM CAT_ESTADOS WHERE NOM_ESTADO = '" .  $row[8] . "'" );
              $query= sqlsrv_query($conn, $sqla);
              $val1 = sqlsrv_fetch_array( $query );
              $EstadoPS = $val1[0];
              $sqla = ("SELECT ID_SO FROM CAT_SO WHERE NOM_SO = '" .  $row[9] . "'" );
              $query= sqlsrv_query($conn, $sqla);
              $val1 = sqlsrv_fetch_array( $query );
              $EstadoSO = $val1[0];
              $sqla = ("SELECT ID_ESTADO_VMTOOL FROM CAT_ESTADO_VMTOOLS WHERE NOM_ESTADO_VMTOOL = '" .  $row[10] . "'" );
              $query= sqlsrv_query($conn, $sqla);
              $val1 = sqlsrv_fetch_array( $query );
              $EstadoVT = $val1[0];
              $sqla = ("SELECT ID_HOST FROM CAT_HOSTS WHERE IP_HOST = '" .  $row[5] . "'" );
              $query= sqlsrv_query($conn, $sqla);
              $val1 = sqlsrv_fetch_array( $query );
              $EstadoIP = $val1[0];
              $pp = strpos( $row[12], 'Bancat.hn' );
              if ( $pp == false ) {
                $pp = strpos( $row[12], 'acresa.hn' );
              } elseif ( $pp == false ) {
                $pp = strpos( $row[12], 'AFP2003' );
              } elseif ( $pp == false ) $pp = 0;
              if ( empty($pp) ) $pp = 0 ;
              if ( $pp > 0 ) $enDom = 1; else $enDom = 0;
              $date = date('Y-m-d H:i:s');

              $fc = $row[13]->format('Y-m-d H:i:s');

              if ( empty( $row[11] ) ) { $sw = 0; } else { $sw = $row[11]; }

              if (  $val[0] <> 1 ) {
                $sqla = ("INSERT INTO SERVIDORES ( ID_SERVIDOR, IP_SERVIDOR, NOM_SERVIDOR, NO_PROCESADORES, RAM, ID_HOST, ALM_PROVISIONADO, ALM_ENUSO, ID_ESTADO, ID_SO, ID_ESTADO_VMTOOL, ID_NODO, EN_DOMINIO, FECHA_CREACION, ULTIMA_ACTUALIZACION, ESTADO_AV ) VALUES ( " . $row[0] . ", '" . $row[1] . "', '" . $row[2] . "', " . $row[3] . ", " . $row[4] . ", " . $EstadoIP  . ", " . $row[6] . ", " . $row[7] . ", " . $EstadoPS . ", " . $EstadoSO . ", " . $EstadoVT . ", " . $sw . ", " . $enDom . ", '" . $fc . "', '" . $date . "', 0 )" );
                $query= sqlsrv_query($conn, $sqla);
                //echo $sqla . "<br>";
                $nuevo++ ;
              } else {
                $sqla = ("UPDATE SERVIDORES SET IP_SERVIDOR = '" . $row[1] . "', NOM_SERVIDOR = '" . $row[2] . "', NO_PROCESADORES = " . $row[3] . ", RAM = " . $row[4] . ", ID_HOST = '" . $EstadoIP  . "', ALM_PROVISIONADO = " . $row[6] . ", ALM_ENUSO = " . $row[7] . ", ID_ESTADO = " . $EstadoPS . ", ID_SO = " . $EstadoSO . ", ID_ESTADO_VMTOOL = " . $EstadoVT . ", ID_NODO = " . $sw . ", EN_DOMINIO = " . $enDom . ", FECHA_CREACION = '" . $fc . "', ULTIMA_ACTUALIZACION = '" . $date . "' WHERE ID_SERVIDOR = " . $row[0]  );
                $query= sqlsrv_query($conn, $sqla);
                //echo $sqla . "<br>";
                $update++;
              }
            }
            echo "<br>Se agregaron: " . $nuevo . " servidores" . "<br>";
            echo "Se actualizaron: " . $update . " servidores" . "<br>";
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
  <?php include 'footer.php' ?>
</body>

</html>
