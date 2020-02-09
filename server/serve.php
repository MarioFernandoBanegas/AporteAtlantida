<?php
  session_start();
  include "../header.php";
  if (@!$_SESSION['user']) {
  //header("Location:login.php");
  }elseif ($_SESSION['rol']==2) {
  //header("Location:index.php");
  }
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>SB</title>
  <!-- Bootstrap core CSS-->
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">
  <link rel="shortcut icon" href="../media/favicon.png" />

</head>

<body class="bg-dark" oncontextmenu="return false">
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div align="center"><a href="../index.php"><img src="../media/logo.png" height="50" width="105"></a>
      </div>
      <div class="card-header">Servidores</div>
      <div class="card-body">
        <form action="../procs/script_serve.php" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <div class="form-row">

              <div class="col-md-4">
                <label for="exampleInputLastName">IP_Servidor</label>
                <input style="text-align:center" value "<?php error_reporting(0)?>" value="<?php echo $ipservidor ?>" type="text" class="form-control" id="ipservidor" name="ipservidor" placeholder="-----------" required>
              </div>
              <div class="col-md-4">
                <label for="exampleInputLastName">Nombre</label>
                <input style="text-align:center" value "<?php error_reporting(0)?>" value="<?php echo $nombre ?>" type="text" class="form-control" id="nombre" name="nombre" placeholder="-----------" required>
              </div>
              <div class="col-md-4">
                <label for="exampleInputLastName">Procesadores</label>
                <input onkeypress='return event.charCode >= 48 && event.charCode <= 57' style="text-align:center" value "<?php error_reporting(0)?>" value="<?php echo $cpu ?>" type="text" class="form-control" id="cpu" name="cpu" placeholder="-----------" required>
              </div>
              <div class="col-md-4">
                <label for="exampleInputLastName">RAM</label>
                <input onkeypress='return event.charCode >= 48 && event.charCode <= 57' style="text-align:center" value "<?php error_reporting(0)?>" value="<?php echo $ram ?>" type="text" class="form-control" id="ram" name="ram" placeholder="ingrese la ram en MB" required>
              </div>
              <div class="col-md-4">
                <label for="exampleInputLastName">Espacio Provisionado</label>
                <input onkeypress='return event.charCode >= 48 && event.charCode <= 57' style="text-align:center" value "<?php error_reporting(0)?>" value="<?php echo $e_pro ?>" type="text" class="form-control" id="e_pro" name="e_pro" placeholder="-----------" required>
              </div>
              <div class="col-md-4">
                <label for="exampleInputLastName">Espacio Usado</label>
                <input onkeypress='return event.charCode >= 48 && event.charCode <= 57' style="text-align:center" value "<?php error_reporting(0)?>" value="<?php echo $e_usado ?>" type="text" class="form-control" id="e_usado" name="e_usado" placeholder="-----------" required>
              </div>
              <div class="col-md-4">
                <label for="exampleInputLastName">Estado AV</label>
                <input onkeypress='return event.charCode >= 48 && event.charCode <= 57' style="text-align:center" value "<?php error_reporting(0)?>" value="<?php echo $estadoav ?>" type="text" class="form-control" id="estadoav" name="estadoav" placeholder="-----------" required>
              </div>
              <div class="col-md-4">
                <label for="exampleInputLastName">ID NODO</label>
                <input onkeypress='return event.charCode >= 48 && event.charCode <= 57' style="text-align:center" value "<?php error_reporting(0)?>" value="<?php echo $nodo ?>" type="text" class="form-control" id="nodo" name="nodo" placeholder="-----------" required>
              </div>
              <div class="col-md-4">
              <label for="exampleInputLastName">Fecha de Creacion:</label>
              <input type="date" id="fecha" name="fecha" value="<?php echo date("Y-d-m")?>" min="2000-01-01" max="<?php echo date("Y-d-m")?>" style="width: 194px">
              </div>
              <div class="col-md-4">
              <label for="exampleInputLastName">Ultima Actualizacion:</label>
              <input type="date" id="ultima" name="ultima" value="<?php echo date("Y-d-m")?>" min="2000-01-01" max="<?php echo date("Y-d-m")?>" style="width: 194px">
              </div>

              <?php //////////////////////////////////////////////////////////////////// ?>
              <div class="col-md-4">
                <div >
                <?php
                  $sql = 'SELECT * FROM CAT_TIPOS ';
                  $result = sqlsrv_query($conn,$sql)
                 ?>

                  <p>Tipo:
                  <select style="width: 194px" name="type" id="type">
                    <?php
                      while ($row = sqlsrv_fetch_array($result)) {
                        ?>
                        <option value="<?php echo $row['ID_TIPO'] ?>"><?php echo $row['NOM_TIPO'];?></option>
                        <?php
                      }
                      ?>
                  </select>
                  </p>
                </div>
              </div>
               <?php //////////////////////////////////////////////////////////////////// ?>
              <div class="col-md-4">
                <div >

                <?php
                  $sql = 'SELECT * FROM CAT_ESTADOS ';
                  $result = sqlsrv_query($conn,$sql)
                 ?>
                  <p>ON/OF:
                  <select style="width: 194px" name="power" id="power">
                    <?php
                      while ($row = sqlsrv_fetch_array($result)) {
                        ?>
                        <option value="<?php echo $row['ID_ESTADO'] ?>"><?php echo $row['NOM_ESTADO'];?></option>
                        <?php
                      }
                      ?>
                  </select>
                  </p>
                </div>
              </div>

              <?php //////////////////////////////////////////////////////////////////// ?>
              <div class="col-md-4">
                <div >
                <?php
                  $sql = 'SELECT * FROM CAT_SO ';
                  $result = sqlsrv_query($conn,$sql)
                 ?>
                  <p>OS:
                  <select style="width: 194px" name="os" id="os">
                    <?php
                      while ($row = sqlsrv_fetch_array($result)) {
                        ?>
                        <option value="<?php echo $row['ID_SO'] ?>"><?php echo $row['NOM_SO'];?></option>
                        <?php
                      }
                      ?>
                  </select>
                  </p>
                </div>
              </div>
              <?php //////////////////////////////////////////////////////////////////// ?>
              <div class="col-md-4">
                <div >
                  <p>Dominio:
                    <select style="width: 194px" name="dominio" id="dominio">
                    <option value="0">Si</option>
                    <option value="1">No</option>
                  </select>
                  </p>
                </div>
              </div>
              <?php //////////////////////////////////////////////////////////////////// ?>
              <div class="col-md-4">
                <div >
                <?php
                  $sql = 'SELECT * from CAT_HOSTS';
                  $result = sqlsrv_query($conn,$sql)
                 ?>
                  <p>HOST:
                  <select style="width: 194px" name="host" id="host">
                    <?php
                      while ($row = sqlsrv_fetch_array($result)) {
                        ?>
                        <option value="<?php echo $row['ID_HOST'] ?>"><?php echo $row['IP_HOST'];?></option>
                        <?php
                      }
                      ?>
                  </select>
                  </p>
                </div>
              </div>
              <?php //////////////////////////////////////////////////////////////////// ?>
              <div class="col-md-4">
                <div >
                  <p>PCI:
                  <select style="width: 194px" name="PCI" id="PCI">
                        <option value="0">Si</option>
                        <option value="1">No</option>
                  </select>
                  </p>
                </div>
              </div>

              <?php //////////////////////////////////////////////////////////////////// ?>
              <div class="col-md-4">
                <div >
                <?php
                  $sql = 'SELECT * FROM CAT_RESPONSABLES ';
                  $result = sqlsrv_query($conn,$sql)
                 ?>
                  <p>Responsable:
                  <select style="width: 194px" name="responsable" id="responsable">
                    <?php
                      while ($row = sqlsrv_fetch_array($result)) {
                        ?>
                        <option value="<?php echo $row['ID_ADMINISTRADOR'] ?>"><?php echo $row['NOM_ADMINISTRADOR'];?></option>
                        <?php
                      }
                      ?>
                  </select>
                  </p>
                </div>
              </div>
              <?php //////////////////////////////////////////////////////////////////// ?>
              <div class="col-md-4">
                <div >
                <?php
                  $sql = 'SELECT * FROM CAT_AREAS ';
                  $result = sqlsrv_query($conn,$sql)
                 ?>
                  <p>Zona:
                  <select style="width: 194px" name="zona" id="zona">
                    <?php
                      while ($row = sqlsrv_fetch_array($result)) {
                        ?>
                        <option value="<?php echo $row['ID_AREA'] ?>"><?php echo $row['NOM_AREA'];?></option>
                        <?php
                      }
                      ?>
                  </select>
                  </p>
                </div>
              </div>
              <?php //////////////////////////////////////////////////////////////////// ?>
              <div class="col-md-4">
                <div >
                <?php
                  $sql = 'SELECT * FROM CAT_SERVICIOS ';
                  $result = sqlsrv_query($conn,$sql)
                 ?>
                  <p>Servicio:
                  <select style="width: 194px" name="app" id="app">
                    <?php
                      while ($row = sqlsrv_fetch_array($result)) {
                        ?>
                        <option value="<?php echo $row['ID_SERVICIO'] ?>"><?php echo $row['NOM_SERVICIO'];?></option>
                        <?php
                      }
                      ?>
                  </select>
                  </p>
                </div>
              </div>
              <?php //////////////////////////////////////////////////////////////////// ?>
              <div class="col-md-4">
                <div >
                <?php
                  $sql = 'SELECT * FROM CAT_DBAS ';
                  $result = sqlsrv_query($conn,$sql)
                 ?>
                  <p>Gestor BD:
                  <select style="width: 194px" name="db" id="db">
                    <?php
                      while ($row = sqlsrv_fetch_array($result)) {
                        ?>
                        <option value="<?php echo $row['ID_DBA'] ?>"><?php echo $row['NOM_DBA'];?></option>
                        <?php
                      }
                      ?>
                  </select>
                  </p>
                </div>
              </div>
              <?php //////////////////////////////////////////////////////////////////// ?>
              <div class="col-md-4">
                <div >
                <?php
                  $sql = 'SELECT * FROM CAT_ESTADO_VMTOOLS';
                  $result = sqlsrv_query($conn,$sql)
                 ?>
                  <p>Estado VMTOOL:
                  <select style="width: 194px" name="state" id="state">
                    <?php
                      while ($row = sqlsrv_fetch_array($result)) {
                        ?>
                        <option value="<?php echo $row['ID_ESTADO_VMTOOL'] ?>"><?php echo $row['NOM_ESTADO_VMTOOL'];?></option>
                        <?php
                      }
                      ?>
                  </select>
                  </p>
                </div>
              </div>

              <?php  /*<div class="col-md-6">
                <label for="exampleInputName">Contigencia</label>
                <textarea  maxlength="500" rows="5"  style="text-align:center" value "<?php error_reporting(0)?>"value="<?php echo $contin ?>" type="text" class="form-control" id="contin" name="contin" placeholder="Ingrese la contigencia" required></textarea>
              </div>

              <div class="col-md-6">
                <label for="exampleInputName">Observaciones</label>
                <textarea  maxlength="500" rows="5"  style="text-align:center" value "<?php error_reporting(0)?>"value="<?php echo $observa ?>" type="text" class="form-control" id="observa" name="observa" placeholder="Ingrese la Observacion" required></textarea>
              </div>
            </div>
          </div>
          */?>
        </form>
        <p>
        <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
        <input type="hidden" name="accion" value="<?php echo $_GET['accion'] ?>">
        <center><input type="submit" value="Guardar" class="btn btn-primary btn-block" ></center>
      </p>
      </div>
    </div>

  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
