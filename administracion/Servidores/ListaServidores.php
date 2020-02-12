<?php
  session_start();
  include "../../DiseñoAdministracionIndex.php";
  if (@!$_SESSION['user']) {
    //header("Location:login.php");
  } elseif ($_SESSION['rol']==2) {
    //header("Location:index.php");
  }
?>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="../../index.php">Tablero</a>

        </li>
        <li class="breadcrumb-item active">Mi Tablero</li>
        <li class="breadcrumb-item">

      <a href="../../Reportes/reporteservidores.php" target="_blank">Imprimir</a></li>

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
                  echo "<th><a  title='eliminar' href='ListaServidores.php?id=$arreglo[0]&idborrar=2' onclick=\"return confirm('desea eliminar el regisro?')\"><img src='../../media/eliminar1.png' text='eliminar' height='40' width='40'  class='img-rounded'/>eliminar</a></th>";
                  ?>
                  <?php
                  echo "<td> <a href='servidorupdate.php?id=$arreglo[0]'><img src='../../media/editar.png' height='40' width='40'  title='editar' class='img-rounded'>editar</a></td>";
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
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="../../vendor/chart.js/Chart.min.js"></script>
    <script src="../../vendor/datatables/jquery.dataTables.js"></script>
    <script src="../../vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="../../js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="../../js/sb-admin-datatables.min.js"></script>
    <script src="../../js/sb-admin-charts.min.js"></script>
  </div>
  <?php //include 'footer.php' ?>
</body>

</html>
