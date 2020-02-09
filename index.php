<?php
  session_start();
  include "header.php";
  date_default_timezone_set("America/Tegucigalpa");

   class Servidores
  {

//FUNCION PARA LA TABLA
    public function listado ( $conn ) {
      $sqla = ("SELECT s.IP_SERVIDOR, s.NOM_SERVIDOR, s.ULTIMA_ACTUALIZACION, r.NOM_ADMINISTRADOR, o.NOM_AREA, a.NOM_SERVICIO
        FROM SERVIDORES s
        inner join CAT_SERVICIOS a on s.ID_SERVICIO = a.ID_SERVICIO
        inner join CAT_RESPONSABLES r on s.ID_ADMINISTRADOR = r.ID_ADMINISTRADOR
        inner join CAT_AREAS o on s.ID_AREA = o.ID_AREA");
      $query= sqlsrv_query($conn, $sqla);
      return $query ;
    }
//FIN FUNCION PARA LA TABLA

//FUNCIONES PARA LOS GRAFICOS
    public function en_dominio( $conn, $cual ) {
      $sql = "SELECT count ( 1 ) FROM servidores a
        inner join CAT_HOSTS b ON a.ID_HOST = b.ID_HOST
        inner join CAT_CLUSTER c ON  b.ID_CLUSTER = c.ID_CLUSTER
        WHERE en_dominio = 1 and c.nom_cluster like '%" . $cual . "%'" ;
      $query = sqlsrv_query( $conn, $sql ) ;
      $val = sqlsrv_fetch_array ( $query ) ;
      return $val[0] ;
    }

    public function sin_dominio( $conn, $cual ) {
      $sql = "SELECT count ( 1 ) FROM servidores a
        inner join CAT_HOSTS b ON a.ID_HOST = b.ID_HOST
        inner join CAT_CLUSTER c ON  b.ID_CLUSTER = c.ID_CLUSTER
        WHERE en_dominio = 0 and c.nom_cluster like '%" . $cual . "%'" ;
      $query = sqlsrv_query( $conn, $sql ) ;
      $val = sqlsrv_fetch_array ( $query ) ;
      return $val[0] ;
    }

    public function ultimo_parche( $conn ) {
      $sql = "SELECT t1.id_servidor, datediff( month, t2.mxdate, getdate() ) as fec_par
        from servidores t1
        inner join ( select max(fecha_parchado) mxdate, id_servidor
                        from parchado
                        group by id_servidor ) t2 on t1.id_servidor = t2.id_servidor
        order by id_servidor" ;
      $query = sqlsrv_query( $conn, $sql ) ;
      return $query ;
    }

    public function sistOp( $conn ) {
      $sql = "SELECT A.FAMILIA_SO, count( * ) AS conteo FROM cat_so a
        inner join servidores b on a.id_so = b.id_so
        group by familia_so" ;
      $query = sqlsrv_query( $conn, $sql ) ;
      return $query ;
    }

    public function no_linux( $conn, $cual ) {
      $sql = "SELECT A.FAMILIA_SO, count( * ) AS conteo FROM cat_so a
        inner join servidores b on a.id_so = b.id_so
        inner join cat_hosts c on b.id_host = c.Id_host
        inner join cat_cluster d on c.id_cluster = d.id_cluster
        where a.familia_so = 'Linux' and d.nom_cluster like '%" . $cual . "%'
        group by familia_so" ;
      $query = sqlsrv_query( $conn, $sql ) ;
      $val = sqlsrv_fetch_array ( $query ) ;
      return $val[1] ;
    }

    public function no_windows( $conn, $cual ) {
      $sql = "SELECT A.FAMILIA_SO, count( * ) AS conteo FROM cat_so a
        inner join servidores b on a.id_so = b.id_so
        inner join cat_hosts c on b.id_host = c.Id_host
        inner join cat_cluster d on c.id_cluster = d.id_cluster
        where a.familia_so = 'Windows' and d.nom_cluster like '%" . $cual . "%'
        GROUP by familia_so" ;
      $query = sqlsrv_query( $conn, $sql ) ;
      $val = sqlsrv_fetch_array ( $query ) ;
      return $val[1] ;
    }

    public function vmtools_ok( $conn, $cual ) {
      $sql = "SELECT a.id_estado_vmtool, count( * ) from servidores a
        inner join cat_estado_vmtools b on a.id_estado_vmtool = b.id_estado_vmtool
        inner join CAT_HOSTS c ON a.ID_HOST = c.ID_HOST
        inner join CAT_CLUSTER d ON  c.ID_CLUSTER = d.ID_CLUSTER
        where b.nom_estado_vmtool = 'toolsOK' and d.nom_cluster like '%" . $cual . "%'
        group by a.id_estado_vmtool" ;
      $query = sqlsrv_query( $conn, $sql ) ;
      $val = sqlsrv_fetch_array ( $query ) ;
      return $val[1] ;
    }

    public function vmtools_revisar( $conn, $cual ) {
      $sql = "SELECT a.id_estado_vmtool, count( * ) from servidores a
        inner join cat_estado_vmtools b on a.id_estado_vmtool = b.id_estado_vmtool
        inner join CAT_HOSTS c ON a.ID_HOST = c.ID_HOST
        inner join CAT_CLUSTER d ON  c.ID_CLUSTER = d.ID_CLUSTER
        where b.nom_estado_vmtool <> 'toolsOK' and d.nom_cluster like '%" . $cual . "%'
        group by a.id_estado_vmtool" ;
      $query = sqlsrv_query( $conn, $sql ) ;
      return $query ;
    }

    public function srv_encendido( $conn, $cual ) {
      $sql = "SELECT count( * )
        from SERVIDORES a
        inner join CAT_HOSTS c ON a.ID_HOST = c.ID_HOST
        inner join CAT_CLUSTER d ON  c.ID_CLUSTER = d.ID_CLUSTER
        where id_estado = 2 and d.nom_cluster like '%" . $cual . "%'" ;
      $query = sqlsrv_query( $conn, $sql ) ;
      $val = sqlsrv_fetch_array ( $query ) ;
      return $val[0];
    }

    public function srv_apagado( $conn, $cual ) {
      $sql = "SELECT count( * )
        from SERVIDORES a
        inner join CAT_HOSTS c ON a.ID_HOST = c.ID_HOST
        inner join CAT_CLUSTER d ON  c.ID_CLUSTER = d.ID_CLUSTER
        where id_estado <> 2 and d.nom_cluster like '%" . $cual . "%'" ;
      $query = sqlsrv_query( $conn, $sql ) ;
      $val = sqlsrv_fetch_array ( $query ) ;
      return $val[0];
    }

    public function en_solar( $conn, $cual ) {
      $sql = "SELECT count( * )
        from SERVIDORES a
        inner join CAT_HOSTS c ON a.ID_HOST = c.ID_HOST
        inner join CAT_CLUSTER d ON  c.ID_CLUSTER = d.ID_CLUSTER
        where id_nodo <> 0 and d.nom_cluster like '%" . $cual . "%'" ;
      $query = sqlsrv_query( $conn, $sql ) ;
      $val = sqlsrv_fetch_array ( $query ) ;
      return $val[0];
    }
//FIN FUNCION PARA GRAFICOS
  }

  //FUNCION PARA LA TABLA
    $sql = "SELECT s.IP_SERVIDOR, s.NOM_SERVIDOR, s.ULTIMA_ACTUALIZACION, r.NOM_ADMINISTRADOR, o.NOM_AREA, a.NOM_SERVICIO
    FROM SERVIDORES s
    inner join CAT_SERVICIOS a on s.ID_SERVICIO = a.ID_SERVICIO
    inner join CAT_RESPONSABLES r on s.ID_ADMINISTRADOR = r.ID_ADMINISTRADOR
    inner join CAT_AREAS o on s.ID_AREA = o.ID_AREA";
    $params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $stmt = sqlsrv_query( $conn, $sql , $params, $options );
    $contador= sqlsrv_num_rows( $stmt );
  //FIN FUNCION PARA LA TABLA


//APUNTADORES
  $servers = new Servidores() ;
  $listaServer = $servers-> listado( $conn );

  $enDominioPRD = $servers->en_dominio( $conn, 'PRD' );
  $enDominioNUB = $servers->en_dominio( $conn, 'INFA' );
  $enDominioMON = $servers->en_dominio( $conn, 'Monitor' );
  $enDominioDEV = $servers->en_dominio( $conn, 'DEV' );
  $sinDominioPRD = $servers->sin_dominio( $conn, 'PRD' );
  $sinDominioNUB = $servers->sin_dominio( $conn, 'INFA' );
  $sinDominioMON = $servers->sin_dominio( $conn, 'Monitor' );
  $sinDominioDEV = $servers->sin_dominio( $conn, 'DEV' );

  $noLinuxPRD = $servers->no_linux( $conn, 'PRD' );
  $noLinuxNUB = $servers->no_linux( $conn, 'INFA' );
  $noLinuxMON = $servers->no_linux( $conn, 'Monitor' );
  $noLinuxDEV = $servers->no_linux( $conn, 'DEV' );
  $noWindowsPRD = $servers->no_windows( $conn, 'PRD' );
  $noWindowsNUB = $servers->no_windows( $conn, 'INFA' );
  $noWindowsMON = $servers->no_windows( $conn, 'Monitor' );
  $noWindowsDEV = $servers->no_windows( $conn, 'DEV' );

  $VMTOkPRD = $servers->vmtools_ok( $conn, 'PRD' );
  $VMTOkNUB = $servers->vmtools_ok( $conn, 'INFA' );
  $VMTOkMON = $servers->vmtools_ok( $conn, 'Monitor' );
  $VMTOkDEV = $servers->vmtools_ok( $conn, 'DEV' );
  $VMTRevPRD = $servers->vmtools_revisar( $conn, 'PRD' );
  $VMTRevNUB = $servers->vmtools_revisar( $conn, 'INFA' );
  $VMTRevMON = $servers->vmtools_revisar( $conn, 'Monitor' );
  $VMTRevDEV = $servers->vmtools_revisar( $conn, 'DEV' );

  $EncendidoPRD = $servers->srv_encendido( $conn, 'PRD' );
  $EncendidoNUB = $servers->srv_encendido( $conn, 'INFA' );
  $EncendidoMON = $servers->srv_encendido( $conn, 'Monitor' );
  $EncendidoDEV = $servers->srv_encendido( $conn, 'DEV' );
  $ApagadoPRD = $servers->srv_apagado( $conn, 'PRD' );
  $ApagadoNUB = $servers->srv_apagado( $conn, 'INFA' );
  $ApagadoMON = $servers->srv_apagado( $conn, 'Monitor' );
  $ApagadoDEV = $servers->srv_apagado( $conn, 'DEV' );

  $MonitoreoPRD = $servers->en_solar( $conn, 'PRD' );
  $MonitoreoNUB = $servers->en_solar( $conn, 'INFA' );
  $MonitoreoMON = $servers->en_solar( $conn, 'Monitor' );
  $MonitoreoDEV = $servers->en_solar( $conn, 'INFA' );

  //FIN APUNTADORES
  $SinMonitoNUB = $EncendidoNUB + $ApagadoNUB - $MonitoreoNUB ;
  $SinMonitoPRD = $EncendidoPRD + $ApagadoPRD - $MonitoreoPRD ;
  $SinMonitoMON = $EncendidoMON + $ApagadoMON - $MonitoreoMON ;
  $SinMonitoDEV = $EncendidoDEV + $ApagadoDEV - $MonitoreoDEV ;


  $ultimoParche = $servers->ultimo_parche( $conn );
  $sistemaOperativo = $servers->sistOp( $conn );


  $VMTRevisarPRD = 0 ;
  if ( !$VMTRevPRD === false ) {
    while ( $row = sqlsrv_fetch_array( $VMTRevPRD ) ) {
      $VMTRevisarPRD += $row[1] ;
    }
  }
  $VMTRevisarNUB = 0 ;
  if ( !$VMTRevNUB === false ) {
    while ( $row = sqlsrv_fetch_array( $VMTRevNUB ) ) {
      $VMTRevisarNUB += $row[1] ;
    }
  }
  $VMTRevisarMON = 0 ;
  if ( !$VMTRevMON === false ) {
    while ( $row = sqlsrv_fetch_array( $VMTRevMON ) ) {
      $VMTRevisarMON += $row[1] ;
    }
  }
  $VMTRevisarDEV = 0 ;
  if ( !$VMTRevDEV === false ) {
    while ( $row = sqlsrv_fetch_array( $VMTRevDEV ) ) {
      $VMTRevisarDEV += $row[1] ;
    }
  }

  $sinDominioPRD -= $noLinuxPRD ;
  $sinDominioNUB -= $noLinuxNUB ;
  $sinDominioMON -= $noLinuxMON ;
  $sinDominioDEV -= $noLinuxDEV ;

  $uno = 0 ;
  $dos = 0 ;
  $tres = 0 ;
  $cuatro = 0 ;
  $mas = 0 ;

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
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <link rel="shortcut icon" href="media/favicon.png" />
</head>
<body class="fixed-nav sticky-footer bg-dark"  id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a href="index.php"><img src="media/logo.png" height="35" width="95"></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="index.php">
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
            <li><a href="details/crit.php">Críticos</a></li>
            <li><a href="details/prd.php?clave=PRD">Producción</a></li>
            <li><a href="details/prd.php?clave=INFA">Nube Privada</a></li>
            <li><a href="details/prd.php?clave=Monitor">Monitor</a></li>
            <li><a href="details/prd.php?clave=DEV">Desarrollo / Calidad</a></li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Graficos">
          <a class="nav-link" href="charts.php">
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
            <li><a href="server/traer1.php">Cargar de Catálogos</a></li>
            <li><a href="server/traer2.php">Cargar de Virtual Machines</a></li>
            <li><a href="server/traer3.php">Cargar de Cylance</a></li>
            <li><a href="server/serve.php?accion=insert">Registrar Servidor</a></li>
            <li><a href="ListaServidores.php">Listar Servidores</a></li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Seguridad">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePages" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-wrench"></i>
            <span class="nav-link-text">Vulnerabilidades</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseExamplePages">
            <li><a href="vulnerabilidad/Mantenimiento.php">Importar Vulnerabilidades</a></li>
            <li><a href="server/ListavUl.php">Listar vulnerabilidades</a></li>
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
                  <a href="administracion/Responsable/Responsable.php?accion=insert">Registrar Responsable</a>
                </li>
                <li>
                  <a href="administracion/Responsable/ListaResponsables.php">Listar Responsable</a>
                </li>
              </ul>
              <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti3">Estados de Equipo</a>
              <ul class="sidenav-third-level collapse" id="collapseMulti3">
                <li>
                  <a href="administracion/Estados_Equipo/Power.php?accion=insert">Registrar Estado</a>
                </li>
                <li>
                  <a href="administracion/Estados_Equipo/ListaEstados.php">Listar Estado</a>
                </li>
              </ul>

              <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti4">Gestor DB</a>
              <ul class="sidenav-third-level collapse" id="collapseMulti4">
                <li>
                  <a href="administracion/Aplicacion/Aplication.php?accion=insert">Registrar Gestor DB</a>
                </li>
                <li>
                  <a href="administracion/Aplicacion/ListaAplicaciones.php">Listar Gestor DB</a>
                </li>
              </li>
            </ul>
            <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti5">Sistemas Operativos</a>
            <ul class="sidenav-third-level collapse" id="collapseMulti5">
              <li>
                <a href="administracion/SO/OS.php?accion=insert">Registrar OS</a>
              </li>
              <li>
                <a href="administracion/SO/ListaOS.php">Listar OS</a>
              </li>
            </ul>
            <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti6">Zonas</a>
            <ul class="sidenav-third-level collapse" id="collapseMulti6">
              <li>
                <a href="administracion/Zonas/Zone.php?accion=insert">Registrar Zona</a>
              </li>
              <li>
                <a href="administracion/Zonas/ListaZonas.php">Listar Zona</a>
              </li>
            </ul>
            <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti7">Tipo de Maquina</a>
            <ul class="sidenav-third-level collapse" id="collapseMulti7">
              <li>
                <a href="administracion/Tipo/Type.php?accion=insert">Registrar Tipo Maquina</a>
              </li>
              <li>
                <a href="administracion/Tipo/ListaType.php">Tipos de Maquinas</a>
              </li>
            </ul>
            <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti8">Cluster</a>
            <ul class="sidenav-third-level collapse" id="collapseMulti8">
              <li>
                <a href="administracion/Cluster/cluster.php?accion=insert">Registrar Cluster</a>
              </li>
              <li>
                <a href="administracion/Cluster/listacluster.php">Tipos Cluster</a>
              </li>
            </ul>
            <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti9">VMTools</a>
            <ul class="sidenav-third-level collapse" id="collapseMulti9">
              <li>
                <a href="administracion/vmtools/vmtools.php?accion=insert">Registrar Estado VMTools</a>
              </li>
              <li>
                <a href="administracion/vmtools/listarvmtools.php">Tipos de Estado VMTools</a>
              </li>
            </ul>
            <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti10">Host</a>
            <ul class="sidenav-third-level collapse" id="collapseMulti10">
              <li>
                <a href="administracion/host/host.php?accion=insert">Registrar un Host</a>
              </li>
              <li>
                <a href="administracion/host/listarhost.php">Tipos de Host</a>
              </li>
            </ul>
            <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti11">Servicios</a>
            <ul class="sidenav-third-level collapse" id="collapseMulti11">
              <li>
                <a href="administracion/host/host.php?accion=insert">Registrar un Servicio</a>
              </li>
              <li>
                <a href="administracion/host/listarhost.php">Tipos de Servicios</a>
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

<?php //GRAFICAS ?>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a>vCenter Producción</a>
        </li>
      </ol>
      <div class="row">
        <div class="col-lg-2">
          <div class="card mb-3">
            <div class="card-header">
              <h6>Por Sistema Operativo</h6>
            </div>
            <div class="card-body">
              <canvas id="SistOperPRD" width="50" height="50"></canvas>
            </div>
            <div class="card-footer">
            </div>
          </div>
        </div>
        <div class="col-lg-2">
          <div class="card mb-3">
            <div class="card-header">
              <h6>En Dominio</h6>
            </div>
            <div class="card-body">
                <canvas id="DominioPRD" width="50" height="50"></canvas>
            </div>
            <div class="card-footer">
            </div>
          </div>
        </div>
        <div class="col-lg-2">
          <div class="card mb-3">
            <div class="card-header">
              <h6>Estado de VMTools</h6>
            </div>
            <div class="card-body">
                <canvas id="VMToolsPRD" width="50" height="50"></canvas>
            </div>
            <div class="card-footer">
            </div>
          </div>
        </div>
        <div class="col-lg-2">
          <div class="card mb-3">
            <div class="card-header">
              <h6>Energizados</h6>
            </div>
            <div class="card-body">
                <canvas id="PowerPRD" width="50" height="50"></canvas>
            </div>
            <div class="card-footer">
            </div>
          </div>
        </div>
        <div class="col-lg-2">
          <div class="card mb-3">
            <div class="card-header">
              <h6>Solarwinds</h6>
            </div>
            <div class="card-body">
                <canvas id="SolarPRD" width="50" height="50"></canvas>
            </div>
            <div class="card-footer">
            </div>
          </div>
        </div>
      </div>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a>vCenter Nube Privada</a>
        </li>
      </ol>
      <div class="row">
        <div class="col-lg-2">
          <div class="card mb-3">
            <div class="card-header">
              <h6>Por Sistema Operativo</h6>
            </div>
            <div class="card-body">
              <canvas id="SistOperNUB" width="50" height="50"></canvas>
            </div>
            <div class="card-footer">
            </div>
          </div>
        </div>
        <div class="col-lg-2">
          <div class="card mb-3">
            <div class="card-header">
              <h6>En Dominio</h6>
            </div>
            <div class="card-body">
                <canvas id="DominioNUB" width="50" height="50"></canvas>
            </div>
            <div class="card-footer">
            </div>
          </div>
        </div>
        <div class="col-lg-2">
          <div class="card mb-3">
            <div class="card-header">
              <h6>Estado de VMTools</h6>
            </div>
            <div class="card-body">
                <canvas id="VMToolsNUB" width="50" height="50"></canvas>
            </div>
            <div class="card-footer">
            </div>
          </div>
        </div>
        <div class="col-lg-2">
          <div class="card mb-3">
            <div class="card-header">
              <h6>Energizados</h6>
            </div>
            <div class="card-body">
                <canvas id="PowerNUB" width="50" height="50"></canvas>
            </div>
            <div class="card-footer">
            </div>
          </div>
        </div>
        <div class="col-lg-2">
          <div class="card mb-3">
            <div class="card-header">
              <h6>Solarwinds</h6>
            </div>
            <div class="card-body">
                <canvas id="SolarNUB" width="50" height="50"></canvas>
            </div>
            <div class="card-footer">
            </div>
          </div>
        </div>
      </div>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a>vCenter Monitor</a>
        </li>
      </ol>

      <div class="row">
        <div class="col-lg-2">
          <div class="card mb-3">
            <div class="card-header">
              <h6>Por Sistema Operativo</h6>
            </div>
            <div class="card-body">
              <canvas id="SistOperMON" width="50" height="50"></canvas>
            </div>
            <div class="card-footer">
            </div>
          </div>
        </div>
        <div class="col-lg-2">
          <div class="card mb-3">
            <div class="card-header">
              <h6>En Dominio</h6>
            </div>
            <div class="card-body">
              <canvas id="DominioMON" width="50" height="50"></canvas>
            </div>
            <div class="card-footer">
            </div>
          </div>
        </div>
        <div class="col-lg-2">
          <div class="card mb-3">
            <div class="card-header">
              <h6>Estado de VMTools</h6>
            </div>
            <div class="card-body">
              <canvas id="VMToolsMON" width="50" height="50"></canvas>
            </div>
            <div class="card-footer">
            </div>
          </div>
        </div>
        <div class="col-lg-2">
          <div class="card mb-3">
            <div class="card-header">
              <h6>Energizados</h6>
            </div>
            <div class="card-body">
              <canvas id="PowerMON" width="50" height="50"></canvas>
            </div>
            <div class="card-footer">
            </div>
          </div>
        </div>
        <div class="col-lg-2">
          <div class="card mb-3">
            <div class="card-header">
              <h6>Solarwinds</h6>
            </div>
            <div class="card-body">
                <canvas id="SolarMON" width="50" height="50"></canvas>
            </div>
            <div class="card-footer">
            </div>
          </div>
        </div>
      </div>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a>vCenter Desarrollo</a>
        </li>
      </ol>

      <div class="row">
        <div class="col-lg-2">
          <div class="card mb-3">
            <div class="card-header">
              <h6>Por Sistema Operativo</h6>
            </div>
            <div class="card-body">
              <canvas id="SistOperDEV" width="50" height="50"></canvas>
            </div>
            <div class="card-footer">
            </div>
          </div>
        </div>
        <div class="col-lg-2">
          <div class="card mb-3">
            <div class="card-header">
              <h6>En Dominio</h6>
            </div>
            <div class="card-body">
              <canvas id="DominioDEV" width="50" height="50"></canvas>
            </div>
            <div class="card-footer">
            </div>
          </div>
        </div>
        <div class="col-lg-2">
          <div class="card mb-3">
            <div class="card-header">
              <h6>Estado de VMTools</h6>
            </div>
            <div class="card-body">
              <canvas id="VMToolsDEV" width="50" height="50"></canvas>
            </div>
            <div class="card-footer">
            </div>
          </div>
        </div>
        <div class="col-lg-2">
          <div class="card mb-3">
            <div class="card-header">
              <h6>Energizados</h6>
            </div>
            <div class="card-body">
              <canvas id="PowerDEV" width="50" height="50"></canvas>
            </div>
            <div class="card-footer">
            </div>
          </div>
        </div>
        <div class="col-lg-2">
          <div class="card mb-3">
            <div class="card-header">
              <h6>Solarwinds</h6>
            </div>
            <div class="card-body">
                <canvas id="SolarDEV" width="50" height="50"></canvas>
            </div>
            <div class="card-footer">
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-3">
          <div class="card mb-3">
            <div class="card-header">
              Parchado de Servidores
            </div>
            <div class="card-body">
              <?php
              if ( !$ultimoParche === false ) {
                while ( $row = sqlsrv_fetch_array( $ultimoParche ) ) {
                  if ( $row['fec_par'] == 1 ) {
                    $uno++ ;
                  } elseif ( $row['fec_par'] == 2 ) {
                    $dos++ ;
                  } elseif ( $row['fec_par'] == 3 ) {
                    $tres++ ;
                  }  elseif ( $row['fec_par'] > 3 and $row['fec_par'] < 7 ) {
                    $cuatro++ ;
                  } else $mas++ ;
                }
              }
              ?>
                <canvas id="Parchado" width="50" height="50"></canvas>
            </div>
            <div class="card-footer">

            </div>
          </div>
        </div>

      </div>
<?php //FIN GRAFICAS ?>

      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Registro de Servidores</div>
          <div class="card-body">
            <div class="table-responsive">
              <?php
                  if ($contador> 0 ) {
              ?>
              <table class="table table-bordered table-striped " id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th style="visibility: hidden">ID</th>
                  <th>IP</th>
                  <th>Servidor</th>
                  <th>Ultima Fecha Parchado</th>
                  <th>Responsable</th>
                  <th>Area</th>
                  <th>Servicio</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  while ( $arreglo = sqlsrv_fetch_array( $listaServer ) ) {
                  ?>
                  <tr>
                    <td style='visibility: hidden'><?php echo$arreglo[0]?></td>
                    <td><?php echo $arreglo['IP_SERVIDOR']?></td>
                    <td><?php echo $arreglo['NOM_SERVIDOR']?></td>
                    <td><?php echo $arreglo['ULTIMA_ACTUALIZACION']->format("Y-m-d");?></td>
                    <td><?php echo $arreglo['NOM_ADMINISTRADOR']?></td>
                    <td><?php echo $arreglo['NOM_AREA']?></td>
                    <td><?php echo $arreglo['NOM_SERVICIO']?></td>
                    <?php
                    extract($_GET);
                    if(@$idborrar==2){
                      $sqlborrar="DELETE FROM servidores WHERE id=$id";
                      $resborrar=mysqli_query($cnn,$sqlborrar);
                      echo '<script>alert("REGISTRO ELIMINADO")</script> ';
                      echo "<script>location.href='ListaServidores.php'</script>";
                    }
                    ?>
                    <?php
                  }
                  ?>
                </tr>
              </tbody>
            </table>
            <?php
            } else {
              ?>
              <div class="alert alert-warning alert-dismissable">
                <h4>Aviso!!!</h4> No hay datos para mostrar
              </div>
              <?php
            }
            ?>
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
            <a class="btn btn-primary" href="desconectar.php">Logout</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>

    <script src="js/sb-admin-charts.js"></script>
    <script src="js/sb-charts.js"></script>

    <script>
      var ctx = document.getElementById('Parchado');
      var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
              labels: ['1 mes', '2 meses', '3 meses', '4-6 meses', '6+ meses'],
              datasets: [{
                  label: '',
                  data: [
                    <?php
                      echo $uno . "," . $dos . "," . $tres . "," . $cuatro . "," . $mas ;
                    ?>
                  ],
                  backgroundColor: [
                      'rgba(115, 249, 119, 0.2)',
                      'rgba(115, 249, 119, 0.2)',
                      'rgba(233, 233, 48, 0.2)',
                      'rgba(255, 99, 132, 0.2)',
                      'rgba(255, 99, 132, 0.2)'

                  ],
                  borderColor: [
                      'rgba(115, 249, 119, 1)',
                      'rgba(115, 249, 119, 1)',
                      'rgba(233, 233, 48, 1)',
                      'rgba(255, 99, 132, 1)',
                      'rgba(255, 99, 132, 1)'

                  ],
                  borderWidth: 1
              }]
          },
          options: {
              scales: {
                  yAxes: [{
                      ticks: {
                          beginAtZero: true
                      }
                  }]
              }
          }
      });
    </script>

    <script>      <!--  Servidores en Dominio Produccion -->
      var ctx = document.getElementById('DominioPRD');
      // For a pie chart
      var myPieChart = new Chart(ctx, {
          type: 'pie',
          data: {
            labels: ['Fuera Dominio', 'En Dominio', 'No Aplica'],
            datasets: [{
              data: [
                <?php
                  echo $sinDominioPRD . ',' . $enDominioPRD . "," . $noLinuxPRD ;
                ?>
                ],
              backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(66, 217, 61, 0.2)',
                'rgba(156, 156, 156, 0.2)'
                ],
              borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(66, 217, 61, 1)',
                'rgba(156, 156, 156, 1)'],
              borderWidth: 1
            }]
          },
          options: {
            responsive: true
          }
      });
    </script>

    <script>      <!--  Servidores en Dominio Nube Privada -->
      var ctx = document.getElementById('DominioNUB');
      // For a pie chart
      var myPieChart = new Chart(ctx, {
          type: 'pie',
          data: {
            labels: ['Fuera Dominio', 'En Dominio', 'No Aplica'],
            datasets: [{
              data: [
                <?php
                  echo $sinDominioNUB . ',' . $enDominioNUB . "," . $noLinuxNUB ;
                ?>
                ],
              backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(66, 217, 61, 0.2)',
                'rgba(156, 156, 156, 0.2)'
                ],
              borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(66, 217, 61, 1)',
                'rgba(156, 156, 156, 1)'],
              borderWidth: 1
            }]
          },
          options: {
            responsive: true
          }
      });
    </script>

    <script>      <!--  Servidores en Dominio Monitor -->
      var ctx = document.getElementById('DominioMON');
      // For a pie chart
      var myPieChart = new Chart(ctx, {
          type: 'pie',
          data: {
            labels: ['Fuera Dominio', 'En Dominio', 'No Aplica'],
            datasets: [{
              data: [
                <?php
                  echo $sinDominioMON . ',' . $enDominioMON . "," . $noLinuxMON ;
                ?>
                ],
              backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(66, 217, 61, 0.2)',
                'rgba(156, 156, 156, 0.2)'
                ],
              borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(66, 217, 61, 1)',
                'rgba(156, 156, 156, 1)'],
              borderWidth: 1
            }]
          },
          options: {
            responsive: true
          }
      });
    </script>

    <script>      <!--  Servidores en Dominio Desarrollo -->
      var ctx = document.getElementById('DominioDEV');
      // For a pie chart
      var myPieChart = new Chart(ctx, {
          type: 'pie',
          data: {
            labels: ['Fuera Dominio', 'En Dominio', 'No Aplica'],
            datasets: [{
              data: [
                <?php
                  echo $sinDominioDEV . ',' . $enDominioDEV . "," . $noLinuxDEV ;
                ?>
                ],
              backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(66, 217, 61, 0.2)',
                'rgba(156, 156, 156, 0.2)'
                ],
              borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(66, 217, 61, 1)',
                'rgba(156, 156, 156, 1)'],
              borderWidth: 1
            }]
          },
          options: {
            responsive: true
          }
      });
    </script>

    <script>      <!--  Servidores por SO Produccion -->
      var ctx = document.getElementById('SistOperPRD');
      // For a pie chart
      var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: [
          'Linux', 'Windows'
          ],
          datasets: [{
            label: '',
            data: [
            <?php
            echo $noLinuxPRD . ',' . $noWindowsPRD ;
            ?>
            ],
            backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(153, 102, 255, 0.2)'
            ],
            borderColor: [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)'
            ],
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true
              }
            }]
          }
        }
      });
    </script>

    <script>      <!--  Servidores por SO Nube Privada -->
      var ctx = document.getElementById('SistOperNUB');
      // For a pie chart
      var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: [
          'Linux', 'Windows'
          ],
          datasets: [{
            label: '',
            data: [
            <?php
            echo $noLinuxNUB . ',' . $noWindowsNUB;
            ?>
            ],
            backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(153, 102, 255, 0.2)'
            ],
            borderColor: [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)'
            ],
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true
              }
            }]
          }
        }
      });
    </script>

    <script>      <!--  Servidores por SO Monitor -->
      var ctx = document.getElementById('SistOperMON');
      // For a pie chart
      var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: [
          'Linux', 'Windows'
          ],
          datasets: [{
            label: '',
            data: [
            <?php
            echo $noLinuxMON . ',' . $noWindowsMON ;
            ?>
            ],
            backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(153, 102, 255, 0.2)'
            ],
            borderColor: [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)'
            ],
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true
              }
            }]
          }
        }
      });
    </script>

    <script>      <!--  Servidores por SO Desarrollo -->
      var ctx = document.getElementById('SistOperDEV');
      // For a pie chart
      var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: [
          'Linux', 'Windows'
          ],
          datasets: [{
            label: '',
            data: [
            <?php
            echo $noLinuxDEV . ',' . $noWindowsDEV ;
            ?>
            ],
            backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(153, 102, 255, 0.2)'
            ],
            borderColor: [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)'
            ],
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true
              }
            }]
          }
        }
      });
    </script>

    <script>      <!--  Servidores por VMWareTools Produccion -->
      var ctx = document.getElementById('VMToolsPRD');
      // For a pie chart
      var myPieChart = new Chart(ctx, {
          type: 'pie',
          data: {
            labels: ['OK', 'Revisar'],
            datasets: [{
              data: [
                <?php
                  echo $VMTOkPRD . ',' . $VMTRevisarPRD ;
                ?>
                ],
              backgroundColor: [
                'rgba(66, 217, 61, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(156, 156, 156, 0.2)'
                ],
              borderColor: [
                'rgba(66, 217, 61, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(156, 156, 156, 1)'],
              borderWidth: 1
            }]
          },
          options: {
            responsive: true
          }
      });
    </script>

    <script >     <!--  Servidores por VMWareTools Nube Privada -->
      var ctx = document.getElementById('VMToolsNUB');
      // For a pie chart
      var myPieChart = new Chart(ctx, {
          type: 'pie',
          data: {
            labels: ['OK', 'Revisar'],
            datasets: [{
              data: [
                <?php
                  echo $VMTOkNUB . ',' . $VMTRevisarNUB ;
                ?>
                ],
              backgroundColor: [
                'rgba(66, 217, 61, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(156, 156, 156, 0.2)'
                ],
              borderColor: [
                'rgba(66, 217, 61, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(156, 156, 156, 1)'],
              borderWidth: 1
            }]
          },
          options: {
            responsive: true
          }
      });
    </script>

    <script >     <!--  Servidores por VMWareTools Monitor -->
      var ctx = document.getElementById('VMToolsMON');
      // For a pie chart
      var myPieChart = new Chart(ctx, {
          type: 'pie',
          data: {
            labels: ['OK', 'Revisar'],
            datasets: [{
              data: [
                <?php
                  echo $VMTOkMON . ',' . $VMTRevisarMON ;
                ?>
                ],
              backgroundColor: [
                'rgba(66, 217, 61, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(156, 156, 156, 0.2)'
                ],
              borderColor: [
                'rgba(66, 217, 61, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(156, 156, 156, 1)'],
              borderWidth: 1
            }]
          },
          options: {
            responsive: true
          }
      });
    </script>

    <script >     <!--  Servidores por VMWareTools Desarrollo -->
      var ctx = document.getElementById('VMToolsDEV');
      // For a pie chart
      var myPieChart = new Chart(ctx, {
          type: 'pie',
          data: {
            labels: ['OK', 'Revisar'],
            datasets: [{
              data: [
                <?php
                  echo $VMTOkDEV . ',' . $VMTRevisarDEV ;
                ?>
                ],
              backgroundColor: [
                'rgba(66, 217, 61, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(156, 156, 156, 0.2)'
                ],
              borderColor: [
                'rgba(66, 217, 61, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(156, 156, 156, 1)'],
              borderWidth: 1
            }]
          },
          options: {
            responsive: true
          }
      });
    </script>

    <script>      <!--  Servidores Encendidos Produccion -->
      var ctx = document.getElementById('PowerPRD');
      // For a pie chart
      var myPieChart = new Chart(ctx, {
          type: 'pie',
          data: {
            labels: ['Encendido', 'Apagado'],
            datasets: [{
              data: [
                <?php
                  echo $EncendidoPRD . ',' . $ApagadoPRD ;
                ?>
                ],
              backgroundColor: [
                'rgba(66, 217, 61, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(156, 156, 156, 0.2)'
                ],
              borderColor: [
                'rgba(66, 217, 61, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(156, 156, 156, 1)'],
              borderWidth: 1
            }]
          },
          options: {
            responsive: true
          }
      });
    </script>

    <script >     <!--  Servidores Encendidos Nube Privada -->
      var ctx = document.getElementById('PowerNUB');
      // For a pie chart
      var myPieChart = new Chart(ctx, {
          type: 'pie',
          data: {
            labels: ['Encendido', 'Apagado'],
            datasets: [{
              data: [
                <?php
                  echo $EncendidoNUB . ',' . $ApagadoNUB ;
                ?>
                ],
              backgroundColor: [
                'rgba(66, 217, 61, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(156, 156, 156, 0.2)'
                ],
              borderColor: [
                'rgba(66, 217, 61, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(156, 156, 156, 1)'],
              borderWidth: 1
            }]
          },
          options: {
            responsive: true
          }
      });
    </script>

    <script >     <!--  Servidores Encendidos Monitor -->
      var ctx = document.getElementById('PowerMON');
      // For a pie chart
      var myPieChart = new Chart(ctx, {
          type: 'pie',
          data: {
            labels: ['Encendido', 'Apagado'],
            datasets: [{
              data: [
                <?php
                  echo $EncendidoMON . ',' . $ApagadoMON ;
                ?>
                ],
              backgroundColor: [
                'rgba(66, 217, 61, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(156, 156, 156, 0.2)'
                ],
              borderColor: [
                'rgba(66, 217, 61, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(156, 156, 156, 1)'],
              borderWidth: 1
            }]
          },
          options: {
            responsive: true
          }
      });
    </script>

    <script >     <!--  Servidores Encendidos Desarrollo -->
      var ctx = document.getElementById('PowerDEV');
      // For a pie chart
      var myPieChart = new Chart(ctx, {
          type: 'pie',
          data: {
            labels: ['Encendido', 'Apagado'],
            datasets: [{
              data: [
                <?php
                  echo $EncendidoDEV . ',' . $ApagadoDEV ;
                ?>
                ],
              backgroundColor: [
                'rgba(66, 217, 61, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(156, 156, 156, 0.2)'
                ],
              borderColor: [
                'rgba(66, 217, 61, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(156, 156, 156, 1)'],
              borderWidth: 1
            }]
          },
          options: {
            responsive: true
          }
      });
    </script>

    <script>      <!--  Servidores Monitoreo Produccion -->
      var ctx = document.getElementById('SolarPRD');
      // For a pie chart
      var myPieChart = new Chart(ctx, {
          type: 'pie',
          data: {
            labels: ['En Monitoreo', 'Sin Monitoreo'],
            datasets: [{
              data: [
                <?php
                  echo $MonitoreoPRD . ',' . $SinMonitoPRD ;
                ?>
                ],
              backgroundColor: [
                'rgba(66, 217, 61, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(156, 156, 156, 0.2)'
                ],
              borderColor: [
                'rgba(66, 217, 61, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(156, 156, 156, 1)'],
              borderWidth: 1
            }]
          },
          options: {
            responsive: true
          }
      });
    </script>

    <script>      <!--  Servidores Monitoreo Nube Privada  -->
      var ctx = document.getElementById('SolarNUB');
      // For a pie chart
      var myPieChart = new Chart(ctx, {
          type: 'pie',
          data: {
            labels: ['En Monitoreo', 'Sin Monitoreo'],
            datasets: [{
              data: [
                <?php
                  echo $MonitoreoNUB . ',' . $SinMonitoNUB ;
                ?>
                ],
              backgroundColor: [
                'rgba(66, 217, 61, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(156, 156, 156, 0.2)'
                ],
              borderColor: [
                'rgba(66, 217, 61, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(156, 156, 156, 1)'],
              borderWidth: 1
            }]
          },
          options: {
            responsive: true
          }
      });
    </script>

    <script>      <!--  Servidores Monitoreo Nube Privada  -->
      var ctx = document.getElementById('SolarMON');
      // For a pie chart
      var myPieChart = new Chart(ctx, {
          type: 'pie',
          data: {
            labels: ['En Monitoreo', 'Sin Monitoreo'],
            datasets: [{
              data: [
                <?php
                  echo $MonitoreoMON . ',' . $SinMonitoMON ;
                ?>
                ],
              backgroundColor: [
                'rgba(66, 217, 61, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(156, 156, 156, 0.2)'
                ],
              borderColor: [
                'rgba(66, 217, 61, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(156, 156, 156, 1)'],
              borderWidth: 1
            }]
          },
          options: {
            responsive: true
          }
      });
    </script>

    <script>      <!--  Servidores Monitoreo Nube Privada  -->
      var ctx = document.getElementById('SolarDEV');
      // For a pie chart
      var myPieChart = new Chart(ctx, {
          type: 'pie',
          data: {
            labels: ['En Monitoreo', 'Sin Monitoreo'],
            datasets: [{
              data: [
                <?php
                  echo $MonitoreoDEV . ',' . $SinMonitoDEV ;
                ?>
                ],
              backgroundColor: [
                'rgba(66, 217, 61, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(156, 156, 156, 0.2)'
                ],
              borderColor: [
                'rgba(66, 217, 61, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(156, 156, 156, 1)'],
              borderWidth: 1
            }]
          },
          options: {
            responsive: true
          }
      });
    </script>


  </div>
  <?php include 'footer.php' ?>
</body>

</html>
