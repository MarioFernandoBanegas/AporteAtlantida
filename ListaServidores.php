<?php
  session_start();
  include "header.php";
  if (@!$_SESSION['user']) {
    //header("Location:login.php");
  } elseif ($_SESSION['rol']==2) {
    //header("Location:index.php");
  }
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
                  <a href="cats/resp/Responsable.php?accion=insert">Registrar Responsable</a>
                </li>
                <li>
                  <a href="administracion/ListaResponsables.php">Listar Responsable</a>
                </li>
              </ul>
              <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti3">Estados de Equipo</a>
              <ul class="sidenav-third-level collapse" id="collapseMulti3">
                <li>
                  <a href="administracion/Power.php?accion=insert">Registrar Estado</a>
                </li>
                <li>
                  <a href="administracion/ListaEstados.php">Listar Estado</a>
                </li>
              </ul>

              <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti4">Aplicaciones</a>
              <ul class="sidenav-third-level collapse" id="collapseMulti4">
                <li>
                  <a href="administracion/Aplication.php?accion=insert">Registrar Aplicacion</a>
                </li>
                <li>
                  <a href="administracion/ListaAplicaciones.php">Listar Aplicaciones</a>
                </li>
              </li>
            </ul>
            <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti5">Sistemas Operativos</a>
            <ul class="sidenav-third-level collapse" id="collapseMulti5">
              <li>
                <a href="administracion/OS.php?accion=insert">Registrar OS</a>
              </li>
              <li>
                <a href="administracion/ListaOS.php">Listar OS</a>
              </li>
            </ul>
            <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti6">Zonas</a>
            <ul class="sidenav-third-level collapse" id="collapseMulti6">
              <li>
                <a href="administracion/Zone.php?accion=insert">Registrar Zona</a>
              </li>
              <li>
                <a href="administracion/ListaZonas.php">Listar Zona</a>
              </li>
            </ul>
            <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti7">Tipo de Maquina</a>
            <ul class="sidenav-third-level collapse" id="collapseMulti7">
              <li>
                <a href="administracion/Type.php?accion=insert">Registrar Tipo Maquina</a>
              </li>
              <li>
                <a href="administracion/ListaType.php">Tipos de Maquinas</a>
              </li>
            </ul>
            <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti8">Conexiones</a>
            <ul class="sidenav-third-level collapse" id="collapseMulti8">
              <li>
                <a href="administracion/conexiones.php?accion=insert">Registrar Tipo Conexion</a>
              </li>
              <li>
                <a href="administracion/ListaConexion.php">Tipos de Conexion</a>
              </li>
            </ul>
            <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti9">Gestor de BD</a>
            <ul class="sidenav-third-level collapse" id="collapseMulti9">
              <li>
                <a href="administracion/gestordb.php?accion=insert">Registrar Gestor DB</a>
              </li>
              <li>
                <a href="administracion/ListaGestor.php">Listar Gestor DB</a>
              </li>
            </ul>
            <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti10">PCI/PESI</a>
            <ul class="sidenav-third-level collapse" id="collapseMulti10">
              <li>
                <a href="administracion/SAS.php?accion=insert">Registrar PCI/PESI</a>
              </li>
              <li>
                <a href="administracion/ListaSAS.php">Listar PCI/PESI</a>
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
        <li class="breadcrumb-item active">Mi Tablero</li>
        <li class="breadcrumb-item">

      <a href="Reportes/reporteservidores.php" target="_blank">Imprimir</a></li>

      </ol>
      <!-- Icon Cards-->

      <!-- Area Chart Example-->

      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i>Registro Servidores</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>

                  <th>IP</th>
                  <th>Servidor</th>
                  <th>ESTADO</th>
                  <th>ADMINISTRADOR</th>
                  <th>DOMINIO</th>
                  <th>HOST</th>
                  <th>FECHA DE CREACION</th>
                  <th>ULTIMA FECHA DE PARCHADO</th>
                  <th>ESTADO VMTOLL</th>
                  <th>PCI</th>
                  <th>NOMBRE DEL SO</th>
                  <th>NOMBRE DE LA BASE DE DATOS</th>
                  <th>TIPO</th>
                  <th>NOMBRE DEL AREA</th>
                  <th>NOMBRE DEL SERVICIO</th>
                  <TH>NUMERO DE PROCESADORES</TH>
                  <TH>RAM</TH>
                  <th>ALMACENAMIENTO EN USO</th>
                  <th>ALMACENAMIENTO PROVICIONADO</th>
                  <th>ID NODO</th>
                  <TH>ESTADO AV</TH>
                  <th></th>
                  <TH></TH>
                </tr>
              </thead>

              <?php //LISTAR TODA LOS SERVIDORES CORRECTAMENTE
              $sqla = ("SELECT s.IP_SERVIDOR,s.NOM_SERVIDOR,e.NOM_ESTADO,r.NOM_ADMINISTRADOR,iif(s.EN_DOMINIO='0','No','Si') as Dominio,
                h.NOM_HOST,s.FECHA_CREACION,s.ULTIMA_ACTUALIZACION,v.NOM_ESTADO_VMTOOL,iif(s.PCI ='0','No','Si') as PCI,
                o.NOM_SO,d.NOM_DBA,t.NOM_TIPO,a.NOM_AREA,ser.NOM_SERVICIO,s.NO_PROCESADORES,s.RAM,
                s.ALM_ENUSO,s.ALM_PROVISIONADO,s.ID_NODO,s.ESTADO_AV from servidores s
                inner join CAT_ESTADOS e on s.ID_ESTADO = e.ID_ESTADO
                inner join CAT_RESPONSABLES r on s.ID_ADMINISTRADOR = r.ID_ADMINISTRADOR
                inner join CAT_ESTADO_VMTOOLS v on s.ID_ESTADO_VMTOOL = v.ID_ESTADO_VMTOOL
                inner join CAT_SO o on s.ID_SO = o.ID_SO
                inner join CAT_DBAS d on s.ID_DBA = d.ID_DBA
                inner join CAT_TIPOS t on s.ID_TIPO = t.ID_TIPO
                inner join CAT_AREAS a on s.ID_AREA = a.ID_AREA
                inner join CAT_SERVICIOS ser on s.ID_SERVICIO = ser.ID_SERVICIO
                inner join CAT_HOSTS H on s.ID_HOST = H.ID_HOST");
               $query= sqlsrv_query( $conn, $sqla );
              ?>
               <tbody>

               <?php while ($arreglo=sqlsrv_fetch_array($query)){
                ?>
                 <tr>
                  <?php $arreglo[0]?>
                  <td><?php  echo$arreglo[0]?></td>
                  <td><?php  echo$arreglo[1]?></td>
                  <td><?php  echo$arreglo[2]?></td>
                  <td><?php  echo$arreglo[3]?></td>
                  <td><?php  echo$arreglo[4]?></td>
                  <td><?php  echo$arreglo[5]?></td>
                  <td><?php  echo$arreglo[6]->format("Y-m-d");?></td>
                  <td><?php  echo$arreglo[7]->format("Y-m-d");?></td>
                  <td><?php  echo$arreglo[8]?></td>
                  <td><?php  echo$arreglo[9]?></td>
                  <td><?php  echo$arreglo[10]?></td>
                  <td><?php  echo$arreglo[11]?></td>
                  <td><?php  echo$arreglo[12]?></td>
                  <td><?php  echo$arreglo[13]?></td>
                  <td><?php  echo$arreglo[14]?></td>
                  <td><?php  echo$arreglo[15]?></td>
                  <td><?php  echo$arreglo[16]?></td>
                  <td><?php  echo$arreglo[17]?></td>
                  <td><?php  echo$arreglo[18]?></td>
                  <td><?php  echo$arreglo[19]?></td>
                  <td><?php  echo$arreglo[20]?></td>

                  <?php
                  echo "<th><a  title='eliminar' href='ListaServidores.php?id=$arreglo[0]&idborrar=2' onclick=\"return confirm('desea eliminar el regisro?')\"><img src='media/eliminar1.png' text='eliminar' height='40' width='40'  class='img-rounded'/>eliminar</a></th>";
                  ?>
                  <?php
                  echo "<td> <a href='servidorupdate.php?id=$arreglo[0]'><img src='media/editar.png' height='40' width='40'  title='editar' class='img-rounded'>editar</a></td>";
                  ?>
                  <?php
                  extract($_GET);
                if(@$idborrar==2){
                $sqlborrar="DELETE FROM servidores WHERE IP_SERVIDOR='$id'";
                $resborrar=sqlsrv_query($conn,$sqlborrar);
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
          <small>Copyright©|Infatlan|2019</small>
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
    <script src="js/sb-admin-charts.min.js"></script>
  </div>
  <?php include 'footer.php' ?>
</body>

</html>
