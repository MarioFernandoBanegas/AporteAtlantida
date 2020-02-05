<?php
session_start();
include "../header.php";
if (@!$_SESSION['user']) {
  //header("Location:../login.php");
}elseif ($_SESSION['rol']==2) {
  //header("Location:../index.php");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>  <!-- Bootstrap core CSS-->

 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 <meta name="description" content="">
 <meta name="author" content="">
 <title>Admin-ServersParch</title> 
 <!-- Bootstrap core CSS-->
 <link rel="stylesheet" href="../css/styles.css" >
 <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
 <!-- Custom fonts for this template-->
 <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
 <!-- Page level plugin CSS-->
 <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
 <!-- Custom styles for this template-->
 <link href="../css/sb-admin.css" rel="stylesheet">
 <link rel="shortcut icon" href="../media/favicon.ico" />
 
</head>
<body class="fixed-nav sticky-footer bg-dark" oncontextmenu="return false" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a href="../index.php"><img src="../media/logo.png" height="25" width="80"></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="../index.php">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Graficos">
          <a class="nav-link" href="../charts.php">
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
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tablass">
          <a class="nav-link" href="../tables.php">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text">Servers</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseComponents">
            <li><a href="server/traer.php">Cargar de VMan</a></li>
            <li><a href="server/serve.php?accion=insert">Registrar Servidor</a></li>
          </ul>
        </li>


        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Servers">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-sitemap"></i>
            <span class="nav-link-text">Servers</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseComponents">
            <li>
              <a href="../server/serve.php?accion=insert">Registrar Servidor</a>
            </li>
            
            <li>
              <a href="../ListaServidores.php">Listar Servidor</a>
            </li>
          </ul>
        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Vulnerabilidades">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponentss" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-file "></i>
            <span class="nav-link-text">Vulnerabilidades</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseComponentss">
            <li>
              <a href="Mantenimiento.php">Importar Vulnerabilidades</a>
            </li>

            <li>
              <a href="../server/ListavUl.php">Listar vulnerabilidades</a>
            </li>
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
                  <a href="../administracion/Responsable.php?accion=insert">Registrar Responsable</a>
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
                <a href="../administracion/ListaType.php">Tipos de Maquinas</a>
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
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="../index.php">Tablero</a>
        </li>
        <li class="breadcrumb-item active">Mi Tablero</li>
      </ol>
      <!-- Icon Cards-->
      <div style="border: 1px solid #ccc; height: 42px; background:#f1f3f5 ">
        <nav class="dropdownmenu">
          <ul>
            <li><a href="Mantenimiento.php">Nueva vulnerabilidad</a></li>
            <li><a href="../server/ListaVul.php">Ver Registros</a></li>
            <li></li>
            <li></li>
          </ul>
        </nav></div>
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
          <small>Copyright©| Infatlán |2019</small>
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