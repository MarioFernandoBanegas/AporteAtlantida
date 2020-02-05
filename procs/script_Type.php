<?php 

  if($_SERVER['REQUEST_METHOD'] == 'POST')
  {
    include '../libs/connection.php';
    $sql = '';

    if($_POST['accion'] == 'insert')
    {
      $name_type = $_POST['name_type'];
      $sql = "INSERT INTO type (Name_Type)VALUES('$name_type')";
      $recurso = sqlsrv_prepare($conn,$sql);
      if (sqlsrv_execute($recurso)){
        echo "Agregado correctamente";
        header('Location: ../administracion/ListaType.php'); //redireccion
    }else
    echo "Error";
  }
  }else
  {
    echo "Desde la barra de direcciones";
  }
?>