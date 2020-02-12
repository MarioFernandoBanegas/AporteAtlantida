<?php
    session_start();
    include "../../DiseñoFormularios.php";
if (@!$_SESSION['user']) {
  header("Location:login.php");
}elseif ($_SESSION['rol']==2) {
  header("Location:index.php");
}
?>

      <div class="card-header">Servidores</div>
      <div class="card-body">

    <?php
    extract($_GET);
    $sql="SELECT s.IP_SERVIDOR,s.NOM_SERVIDOR,e.NOM_ESTADO,r.NOM_ADMINISTRADOR,iif(s.EN_DOMINIO='0','No','Si') as Dominio,
      h.NOM_HOST,s.FECHA_CREACION,s.ULTIMA_ACTUALIZACION,v.NOM_ESTADO_VMTOOL,iif(s.PCI ='0','No','Si') as PCI,
      o.NOM_SO,d.NOM_DBA,t.NOM_TIPO,a.NOM_AREA,ser.NOM_SERVICIO,s.NO_PROCESADORES,s.RAM,
      s.ALM_ENUSO,s.ALM_PROVISIONADO,s.ID_NODO,S.ESTADO_AV from servidores s
      inner join CAT_ESTADOS e on s.ID_ESTADO = e.ID_ESTADO
      inner join CAT_RESPONSABLES r on s.ID_ADMINISTRADOR = r.ID_ADMINISTRADOR
      inner join CAT_ESTADO_VMTOOLS v on s.ID_ESTADO_VMTOOL = v.ID_ESTADO_VMTOOL
      inner join CAT_SO o on s.ID_SO = o.ID_SO
      inner join CAT_DBAS d on s.ID_DBA = d.ID_DBA
      inner join CAT_TIPOS t on s.ID_TIPO = t.ID_TIPO
      inner join CAT_AREAS a on s.ID_AREA = a.ID_AREA
      inner join CAT_SERVICIOS ser on s.ID_SERVICIO = ser.ID_SERVICIO
      inner join CAT_HOSTS H on s.ID_HOST = H.ID_HOST WHERE s.IP_SERVIDOR='$id'";
    $ressql=sqlsrv_query($conn,$sql);
    while ($row=sqlsrv_fetch_array($ressql)){
          $id=$row[0];
          $user=$row[1];
          $a1 =$row[2];
          $a2 =$row[3];
          $a3 =$row[4];
          $a4 =$row[5];
          $a5 =$row[6];
          $a6 =$row[7];
          $a7 =$row[8];
          $a8 =$row[9];
          $a9 =$row[10];
          $a10 =$row[11];
          $a11 =$row[12];
          $a12 =$row[13];
          $a13 =$row[14];
          $a14 =$row[15];
          $a15 =$row[16];
          $a16 =$row[17];
          $a17 =$row[18];
          $a18 =$row[19];
          $a19 =$row[20];
          $a20 =['ID_ESTADO'];
          $a21 =['NOM_ESTADO'];
          $a22 =['ID_ADMINISTRADOR'];
          $a23 =['NOM_ADMINISTRADOR'];
          $a24 =['ID_ESTADO_VMTOOL'];
          $a25 =['NOM_ESTADO_VMTOOL'];
          $a26 =['ID_SO'];
          $a27 =['ID_NOM'];
          $a28 =['ID_DBA'];
          $a29 =['NOM_DBA'];
          $a30 =['ID_TIPO'];
          $a31 =['NOM_TIPO'];
          $a32 =['ID_AREA'];
          $a33 =['NOM_AREA'];
          $a34 =['ID_SERVICIO'];
          $a35 =['NOM_SERVICIO'];
          $a36 =['ID_HOST'];
          $a37 =['NOM_HOST'];
        }



    ?>
        <form action="actualizar_servidor.php" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <div class="form-row">

              <div class="col-md-4">
                <label for="exampleInputLastName">IP_Servidor</label>
                <input style="text-align:center" value="<?php echo $id ?>" readonly="readonly" type="text" class="form-control" name="id" required>

              </div>

              <div class="col-md-4">
                <label for="exampleInputLastName">Nombre_Servidor</label>
                <input style="text-align:center" value="<?php echo $user ?>" type="text" class="form-control"  name="user" required>

              </div>

              <div class="col-md-4">
                <label onkeypress='return event.charCode >= 48 && event.charCode <= 57' for="exampleInputLastName">Numero de Procesadores</label>
                <input style="text-align:center" value="<?php echo $a14 ?>" type="text" class="form-control" name="a14" required>

              </div>
              <div class="col-md-4">
                <label onkeypress='return event.charCode >= 48 && event.charCode <= 57' for="exampleInputLastName">RAM</label>
                <input style="text-align:center" value="<?php echo $a15 ?>" type="text" class="form-control" name="a15" required>

              </div>

              <div class="col-md-4">
                <label onkeypress='return event.charCode >= 48 && event.charCode <= 57' for="exampleInputLastName">Espacio Provisionado</label>
                <input style="text-align:center" value="<?php echo $a16 ?>" type="text" class="form-control" name="a16" required>

              </div>

              <div class="col-md-4">
                <label onkeypress='return event.charCode >= 48 && event.charCode <= 57' for="exampleInputLastName">Espacio Usado</label>
                <input style="text-align:center" value="<?php echo $a17 ?>" type="text" class="form-control" name="a17" required>
              </div>
              <div class="col-md-4">
                <label onkeypress='return event.charCode >= 48 && event.charCode <= 57' for="exampleInputLastName">Estado AV</label>
                <input style="text-align:center" value="<?php echo $a19 ?>" type="text" class="form-control" name="a19" required>
              </div>
              <div class="col-md-4">
                <label onkeypress='return event.charCode >= 48 && event.charCode <= 57' for="exampleInputLastName">ID NODO</label>
                <input style="text-align:center" value="<?php echo $a18 ?>" type="text" class="form-control" name="a18" required>
              </div>
              <div class="col-md-4">
              <label for="exampleInputLastName">Fecha de Creacion:</label>
              <input type="date" id="fecha" name="fecha" value="<?php echo $a5->format("Y-d-m")?>" min="2000-01-01" max="<?php echo date("Y-d-m")?>" style="width: 194px">
              </div>
              <div class="col-md-4">
              <label for="exampleInputLastName">Ultima Actualizacion:</label>
              <input type="date" id="ultima" name="ultima" value="<?php echo $a6->format("Y-d-m")?>" min="2000-01-01" max="<?php echo date("Y-d-m")?>" style="width: 194px">
              </div>

              <!-- ************************************************************* -->
              <div class="col-md-4">
              <div >
                 <?php
                  $sql = 'SELECT ID_TIPO, NOM_TIPO FROM CAT_TIPOS ';
                  $result = sqlsrv_query($conn,$sql)
                 ?>
                <p>Tipo:
                  <select style="width: 170px" name="a31" id="a30">

                      <?php while($row=sqlsrv_fetch_array($result)){
                        ?>
                      <option value="<?php echo $row['ID_TIPO']?>"<?php if($row['NOM_TIPO']==$a11) {echo "selected";} ?>><?php echo $row['NOM_TIPO'];?></option>
                     <?php
                   }
                   ?>
                  </select>
                </p>
                </div>
              </div>
              <!-- ************************************************************* -->


              <div class="col-md-4">
              <div >
                 <?php
                  $sql = 'SELECT ID_ESTADO, NOM_ESTADO FROM CAT_ESTADOS ';
                  $result = sqlsrv_query($conn,$sql)
                 ?>
                <p>ON/OF:
                  <select style="width: 170px" name="a21" id="a20">

                      <?php while($row=sqlsrv_fetch_array($result)){
                        ?>
                      <option value="<?php echo $row['ID_ESTADO']?>"<?php if($row['NOM_ESTADO']==$a1) {echo "selected";} ?>><?php echo $row['NOM_ESTADO'];?></option>
                     <?php
                   }
                   ?>
                  </select>
                </p>
                </div>
              </div>
              <!-- ************************************************************* -->
              <div class="col-md-4">
              <div >
                 <?php
                  $sql = 'SELECT ID_SO, NOM_SO FROM CAT_SO ';
                  $result = sqlsrv_query($conn,$sql)
                 ?>
                <p>SO:
                  <select style="width: 170px" name="a27" id="a26">

                      <?php while($row=sqlsrv_fetch_array($result)){
                        ?>
                      <option value="<?php echo $row['ID_SO']?>"<?php if($row['NOM_SO']==$a9) {echo "selected";} ?>><?php echo $row['NOM_SO'];?></option>
                     <?php
                   }
                   ?>
                  </select>
                </p>
                </div>
              </div>
              <!-- ************************************************************* -->
              <div class="col-md-4">
              <div >
                <p>Dominio:
                  <select style="width: 170px" name="a3" id="a3">
                      <option value="1"<?php if($a3=="Si") {echo "selected";} ?>>Si</option>
                      <option value="0"<?php if($a3=="No") {echo "selected";} ?>>No</option>
                  </select>
                </p>
                </div>
              </div>
              <!-- ************************************************************* -->
              <div class="col-md-4">
              <div >
                 <?php
                  $sql = 'SELECT ID_HOST, NOM_HOST FROM CAT_HOSTS';
                  $result = sqlsrv_query($conn,$sql)
                 ?>
                <p>HOST:
                  <select style="width: 170px" name="a37" id="a36">

                      <?php while($row=sqlsrv_fetch_array($result)){
                        ?>
                      <option value="<?php echo $row['ID_HOST']?>"<?php if($row['NOM_HOST']==$a4) {echo "selected";} ?>><?php echo $row['NOM_HOST'];?></option>
                     <?php
                   }
                   ?>
                  </select>
                </p>
                </div>
              </div>
              <!-- ************************************************************* -->
              <div class="col-md-4">
              <div >
                <p>PCI:
                  <select style="width: 170px" name="pcii" id="pcii">
                      <option value="1"<?php if($a8=="Si") echo "selected" ?>> Si </option>
                      <option value="0"<?php if($a8=="No") echo "selected" ?>> No </option>
                  </select>
                </p>
                </div>
              </div>
              <!-- ************************************************************* -->
              <div class="col-md-4">
              <div >
                 <?php
                  $sql = 'SELECT ID_ADMINISTRADOR, NOM_ADMINISTRADOR FROM CAT_RESPONSABLES';
                  $result = sqlsrv_query($conn,$sql)
                 ?>
                <p>RESPONSABLE:
                  <select style="width: 170px" name="a23" id="a22">

                      <?php while($row=sqlsrv_fetch_array($result)){
                        ?>
                      <option value="<?php echo $row['ID_ADMINISTRADOR']?>"<?php if($row['NOM_ADMINISTRADOR']==$a2) {echo "selected";} ?>><?php echo $row['NOM_ADMINISTRADOR'];?></option>
                     <?php
                   }
                   ?>
                  </select>
                </p>
                </div>
              </div>
              <!-- ************************************************************* -->
              <div class="col-md-4">
              <div >
                 <?php
                  $sql = 'SELECT ID_AREA, NOM_AREA FROM CAT_AREAS';
                  $result = sqlsrv_query($conn,$sql)
                 ?>
                <p>Zona:
                  <select style="width: 170px" name="a33" id="a32">

                      <?php while($row=sqlsrv_fetch_array($result)){
                        ?>
                      <option value="<?php echo $row['ID_AREA']?>"<?php if($row['NOM_AREA']==$a12) {echo "selected";} ?>><?php echo $row['NOM_AREA'];?></option>
                     <?php
                   }
                   ?>
                  </select>
                </p>
                </div>
              </div>
              <!-- ************************************************************* -->
              <div class="col-md-4">
              <div >
                 <?php
                  $sql = 'SELECT ID_SERVICIO, NOM_SERVICIO FROM CAT_SERVICIOS';
                  $result = sqlsrv_query($conn,$sql)
                 ?>
                <p>Servicio:
                  <select style="width: 170px" name="a35" id="a34">

                      <?php while($row=sqlsrv_fetch_array($result)){
                        ?>
                      <option value="<?php echo $row['ID_SERVICIO']?>"<?php if($row['NOM_SERVICIO']==$a13) {echo "selected";} ?>><?php echo $row['NOM_SERVICIO'];?></option>
                     <?php
                   }
                   ?>
                  </select>
                </p>
                </div>
              </div>
              <!-- ************************************************************* -->
              <div class="col-md-4">
              <div >
                 <?php
                  $sql = 'SELECT ID_DBA, NOM_DBA FROM CAT_DBAS';
                  $result = sqlsrv_query($conn,$sql)
                 ?>
                <p>Gestor BD:
                  <select style="width: 170px" name="a29" id="a28">

                      <?php while($row=sqlsrv_fetch_array($result)){
                        ?>
                      <option value="<?php echo $row['ID_DBA']?>"<?php if($row['NOM_DBA']==$a10) {echo "selected";} ?>><?php echo $row['NOM_DBA'];?></option>
                     <?php
                   }
                   ?>
                  </select>
                </p>
                </div>
              </div>
              <!-- ************************************************************* -->
              <div class="col-md-4">
              <div >
                 <?php
                  $sql = 'SELECT ID_ESTADO_VMTOOL, NOM_ESTADO_VMTOOL FROM CAT_ESTADO_VMTOOLS';
                  $result = sqlsrv_query($conn,$sql)
                 ?>
                <p>Estado VMTOOL:
                  <select style="width: 170px" name="a25" id="a24">

                      <?php while($row=sqlsrv_fetch_array($result)){
                        ?>
                      <option value="<?php echo $row['ID_ESTADO_VMTOOL']?>"<?php if($row['NOM_ESTADO_VMTOOL']==$a7) {echo "selected";} ?>><?php echo $row['NOM_ESTADO_VMTOOL'];?></option>
                     <?php
                   }
                   ?>
                  </select>
                </p>
                </div>
              </div>

            </div>
          </div>
          <p>
          <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
          <input type="hidden" name="accion" value="insert">
          <center><input onclick="return confirm('desea actualizar el registro?')" type="submit" value="Editar" class="btn btn-success btn-block" ></center>
        </p>
        </form>

      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
