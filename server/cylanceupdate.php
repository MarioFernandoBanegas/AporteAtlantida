
<?php
error_reporting(0);
	include("../Conexion/conexion.php") ;
  include("../DiseñoGraficasIndex.php");
  date_default_timezone_set("America/Tegucigalpa");
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
    <?php

    extract( $_POST );


      //$archivo = '../Cylance/Cylance.xlsx' ;
      $archivo = $_FILES['excel']['name'];
      $tipo = $_FILES['excel']['type'];

      //$tipo = 'application/vnd.ms-excel';

      $destino = '../Cylance/Cylance copy.xlsx' ;

      if ( isset( $action ) == "upload" ) {
        if ( copy($_FILES['excel']['tmp_name'], $destino)) {
          require('../Classes/PHPExcel.php');
          require_once('../Classes/PHPExcel/IOFactory.php');
          require('../Classes/PHPExcel/Reader/Excel2007.php');
        // Cargando la hoja de excel
          $objReader = new PHPExcel_Reader_Excel2007();
          $objPHPExcel = $objReader->load("$destino");
          $objFecha = new PHPExcel_Shared_Date();
        // Asignamon la hoja de excel activa
          $objPHPExcel->setActiveSheetIndex(0);

          $columnas = $objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();
          $filas = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();

          echo "Servidores Actualizados " . $filas . "<br>";
          for ($i=2;$i<=$filas;$i++){
            $_DATOS_EXCEL[$i]['IP'] = $objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue();
            $_DATOS_EXCEL[$i]['Servidor'] = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
            $_DATOS_EXCEL[$i]['Estado'] = $objPHPExcel->getActiveSheet()->getCell('K'.$i)->getCalculatedValue();
          }

          foreach($_DATOS_EXCEL as $campo ) {
            if ( $campo["Estado"] == "Online" ) $EstadoAV = 2; else $EstadoAV = 1 ;
            $sql = "UPDATE SERVIDORES SET ESTADO_AV = " . $EstadoAV . " WHERE IP_SERVIDOR = '" . $campo['IP'] . "'" ;
            $result = sqlsrv_query($conn,$sql);
            echo $sql . "<br>" ;
          }



        }
        else {
          echo "Error al cargar el archivo";
        }

      }
      else {
        echo "";
      }

      ?>
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
