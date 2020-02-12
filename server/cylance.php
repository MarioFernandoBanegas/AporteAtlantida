<?php
  session_start();
  include "../DiseñoGraficasIndex.php";

  /*class Servidores
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

    public function cargaVMWare( $conn ) {
      $sql = "SELECT A.VirtualMachineID, A.IPAddress, A.Name, A.ProcessorCount, A.MemoryConfigured, B.IPAddress, A.TotalStorageSize, A.TotalStorageSizeUsed, A.PowerState, A.GuestName, A.GuestVmWareToolsStatus, A.NodeID, A.GuestDNSName, A.DateCreated
        FROM [10.128.0.33].[swMonitor].[dbo].VIM_VirtualMachines A
        INNER JOIN [10.128.0.33].[swMonitor].[dbo].VIM_VMwareNodes B on a.hostid = b.hostid
        INNER JOIN [10.128.0.33].[swMonitor].[dbo].VIM_VirtualMachineIPAddresses C on a.VirtualMachineID = C.VirtualMachineID
        WHERE C.IPAddress not LIKE 'fe80::%' and C.IPAddress not like '169.%'" ;
      $query = sqlsrv_query( $conn, $sql ) ;
      return $query ;
    }

  }

  $servers = new Servidores() ;
  $CargaSO = $servers->cargaSistOp( $conn );
  $CargaPS = $servers->cargaEncendido( $conn );
  $CargaVM = $servers->cargaVMWare( $conn );
  $CargaVT = $servers->cargaVMTool( $conn );
  $CargaVC = $servers->cargavCenter( $conn );
  $CargaHO = $servers->cargaHosts( $conn );
*/

?>
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="../index.php">Tablero</a>
  </li>
  <li class="breadcrumb-item active">Mi Tablero</li>
</ol>
  <h3>Importar Cylance a la Base de Datos </h3>
  <form name="importa" method="post" action="cylanceupdate.php" enctype="multipart/form-data" >
    <div class="col-xs-4">
      <div class="form-group">
        <input type="file" class="filestyle" data-buttonText="Seleccione archivo" name="excel">
      </div>
    </div>
    <div class="col-xs-4">
      <input class="btn btn-default btn-file" type='submit' name='enviar'  value="Importar"  />
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
<?php //include 'footers.php' ?>
</body>
</html>
