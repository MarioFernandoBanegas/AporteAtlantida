<?php require 'Conexion/conexion.php' ?>
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
            <li><a href="Index_Graficas/crit.php">Críticos</a></li>
            <li><a href="Index_Graficas/prd.php?clave=PRD">Producción</a></li>
            <li><a href="Index_Graficas/prd.php?clave=INFA">Nube Privada</a></li>
            <li><a href="Index_Graficas/prd.php?clave=Monitor">Monitor</a></li>
            <li><a href="Index_Graficas/prd.php?clave=DEV">Desarrollo / Calidad</a></li>
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
            <li><a href="server/cylance.php">Cargar de Cylance</a></li>
            <li><a href="administracion/Servidores/serve.php?accion=insert">Registrar Servidor</a></li>
            <li><a href="administracion/Servidores/ListaServidores.php">Listar Servidores</a></li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Seguridad">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePages" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-wrench"></i>
            <span class="nav-link-text">Vulnerabilidades</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseExamplePages">
            <li><a href="vulnerabilidad/Mantenimiento.php">Importar Vulnerabilidades</a></li>
            <li><a href="vulnerabilidad/ListavUl.php">Listar vulnerabilidades</a></li>
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

              <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti4">Aplicaciones</a>
              <ul class="sidenav-third-level collapse" id="collapseMulti4">
                <li>
                  <a href="administracion/Aplicacion/Aplication.php?accion=insert">Registrar Aplicacion</a>
                </li>
                <li>
                  <a href="administracion/Aplicacion/ListaAplicaciones.php">Listar Aplicaciones</a>
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
                <a href="administracion/Cluster/listacluster.php">Tipos de Cluster</a>
              </li>
            </ul>

            <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti9">Host</a>
            <ul class="sidenav-third-level collapse" id="collapseMulti9">
              <li>
                <a href="administracion/host/host.php?accion=insert">Registrar Host</a>
              </li>
              <li>
                <a href="administracion/host/listahost.php">Tipos de Host</a>
              </li>
            </ul>

            <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti10">Servicios</a>
            <ul class="sidenav-third-level collapse" id="collapseMulti10">
              <li>
                <a href="administracion/Servicios/servicio.php?accion=insert">Registrar Servicio</a>
              </li>
              <li>
                <a href="administracion/Servicios/listaservicio.php">Tipos de Servicios</a>
              </li>
            </ul>

            <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti11">Estado VMTools</a>
            <ul class="sidenav-third-level collapse" id="collapseMulti11">
              <li>
                <a href="administracion/vmtools/vmtools.php?accion=insert">Registrar estado VMTools</a>
              </li>
              <li>
                <a href="administracion/vmtools/listavmtools.php">Tipos de VMTools</a>
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
