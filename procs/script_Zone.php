<?php

  if($_SERVER['REQUEST_METHOD'] == 'POST')
  {
    include '../libs/connection.php';
    $sql = '';

    if($_POST['accion'] == 'insert')
    {
      $name_zone = $_POST['name_zone'];
      $sql = "INSERT INTO CAT_AREAS (NOM_AREA)VALUES('$name_zone')";
      $recurso = sqlsrv_prepare($conn,$sql);
      if (sqlsrv_execute($recurso)){
        echo "Agregado correctamente";
        header('Location: ../administracion/Zonas/ListaZonas.php'); //redireccion
      }else
      echo "Error";
    }
  }else
  {
    echo "Desde la barra de direcciones";
  }
?>
