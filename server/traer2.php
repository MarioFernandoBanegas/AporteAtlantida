<?php
  session_start();
  include "header.php";

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

<?php //DISEÑO ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Admin-ServersParch</title>
  <!-- Bootstrap core CSS-->
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">
  <link rel="shortcut icon" href="../media/favicon.png" />
</head>
<body class="fixed-nav sticky-footer bg-dark"  id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a href="../index.php"><img src="../media/logo.png" height="35" width="95"></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="../index.php">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Inicio</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Desglose">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseDesglose" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-area-chart"></i>
            <span class="nav-link-text">Desglose Dashboard</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseDesglose">
            <li><a href="../details/crit.php">Críticos</a></li>
            <li><a href="../details/prd.php?clave=PRD">Producción</a></li>
            <li><a href="../details/prd.php?clave=INFA">Nube Privada</a></li>
            <li><a href="../details/prd.php?clave=Monitor">Monitor</a></li>
            <li><a href="../details/prd.php?clave=DEV">Desarrollo / Calidad</a></li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Graficos">
          <a class="nav-link" href="../charts.php">
            <i class="fa fa-fw fa-area-chart"></i>
            <span class="nav-link-text">Graficas</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Servers">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-sitemap"></i>
            <span class="nav-link-text">Servers</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseComponents">
            <li><a href="../server/traer1.php">Cargar de Catálogos</a></li>
            <li><a href="../server/traer2.php">Cargar de Virtual Machines</a></li>
            <li><a href="../server/traer3.php">Cargar de Cylance</a></li>
            <li><a href="../server/serve.php?accion=insert">Registrar Servidor</a></li>
            <li><a href="../ListaServidores.php">Listar Servidores</a></li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Seguridad">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePages" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-wrench"></i>
            <span class="nav-link-text">Vulnerabilidades</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseExamplePages">
            <li><a href="../vulnerabilidad/Mantenimiento.php">Importar Vulnerabilidades</a></li>
            <li><a href="../server/ListavUl.php">Listar vulnerabilidades</a></li>
          </ul>
        </li>
        <li  style="overflow:auto;color:black;" class="nav-item" data-toggle="tooltip" data-placement="right" title="Administracion">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-link"></i>
            <span class="nav-link-text">Administracion</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseMulti">
            <li>
              <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti2">Responsables</a>
              <ul class="sidenav-third-level collapse" id="collapseMulti2">
                <li>
                  <a href="../cats/resp/Responsable.php?accion=insert">Registrar Responsable</a>
                </li>
                <li>
                  <a href="../administracion/ListaResponsables.php">Listar Responsable</a>
                </li>
              </ul>
              <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti3">Estados de Equipo</a>
              <ul class="sidenav-third-level collapse" id="collapseMulti3">
                <li>
                  <a href="../administracion/Power.php?accion=insert">Registrar Estado</a>
                </li>
                <li>
                  <a href="../administracion/ListaEstados.php">Listar Estado</a>
                </li>
              </ul>

              <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti4">Aplicaciones</a>
              <ul class="sidenav-third-level collapse" id="collapseMulti4">
                <li>
                  <a href="../administracion/Aplication.php?accion=insert">Registrar Aplicacion</a>
                </li>
                <li>
                  <a href="../administracion/ListaAplicaciones.php">Listar Aplicaciones</a>
                </li>
              </li>
            </ul>
            <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti5">Sistemas Operativos</a>
            <ul class="sidenav-third-level collapse" id="collapseMulti5">
              <li>
                <a href="../administracion/OS.php?accion=insert">Registrar OS</a>
              </li>
              <li>
                <a href="../administracion/ListaOS.php">Listar OS</a>
              </li>
            </ul>
            <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti6">Zonas</a>
            <ul class="sidenav-third-level collapse" id="collapseMulti6">
              <li>
                <a href="../administracion/Zone.php?accion=insert">Registrar Zona</a>
              </li>
              <li>
                <a href="../administracion/ListaZonas.php">Listar Zona</a>
              </li>
            </ul>
            <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti7">Tipo de Maquina</a>
            <ul class="sidenav-third-level collapse" id="collapseMulti7">
              <li>
                <a href="../administracion/Type.php?accion=insert">Registrar Tipo Maquina</a>
              </li>
              <li>
                <a href="administracion/ListaType.php">Tipos de Maquinas</a>
              </li>
            </ul>
            <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti8">Conexiones</a>
            <ul class="sidenav-third-level collapse" id="collapseMulti8">
              <li>
                <a href="../administracion/conexiones.php?accion=insert">Registrar Tipo Conexion</a>
              </li>
              <li>
                <a href="../administracion/ListaConexion.php">Tipos de Conexion</a>
              </li>
            </ul>
            <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti9">Gestor de BD</a>
            <ul class="sidenav-third-level collapse" id="collapseMulti9">
              <li>
                <a href="../administracion/gestordb.php?accion=insert">Registrar Gestor DB</a>
              </li>
              <li>
                <a href="../administracion/ListaGestor.php">Listar Gestor DB</a>
              </li>
            </ul>
            <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti10">PCI/PESI</a>
            <ul class="sidenav-third-level collapse" id="collapseMulti10">
              <li>
                <a href="../administracion/SAS.php?accion=insert">Registrar PCI/PESI</a>
              </li>
              <li>
                <a href="../administracion/ListaSAS.php">Listar PCI/PESI</a>
              </li>
            </ul>
          </li>
        </ul>
      </li>
    </ul>
    <ul class="navbar-nav sidenav-toggler">
      <li class="nav-item">
        <a class="nav-link text-center" id="sidenavToggler">
          <i class="fa fa-fw fa-angle-left"></i>
        </a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
          <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="content-wrapper">
    <div class="container-fluid">
<?php //FIN DISEÑO ?>


      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.php">Tablero</a>
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
          }

          echo "<br>Se agregaron: " . $nuevo . " servidores" . "<br>";
          echo "Se actualizaron: " . $update . " servidores" . "<br>";
        ?>

        <br>
      </div>

    </div>

    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright© | Infatlán | 2019</small>
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
