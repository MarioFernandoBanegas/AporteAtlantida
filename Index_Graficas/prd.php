<?php
  session_start();
  include "../DiseñoGraficasIndex.php";

  class Servidores
  {

    public function listado ( $conn, $cual ) {
      $sqla = ("SELECT a.IP_SERVIDOR, a.NOM_SERVIDOR, c.NOM_ADMINISTRADOR, d.NOM_SO, e.NOM_ESTADO, a.ID_NODO, a.EN_DOMINIO, a.ESTADO_AV, d.FAMILIA_SO, a.ID_ESTADO_VMTOOL
        FROM SERVIDORES a
        inner join CAT_RESPONSABLES c on a.ID_ADMINISTRADOR = c.ID_ADMINISTRADOR
        inner join CAT_SO d on a.ID_SO = d.ID_SO
        inner join CAT_ESTADOS e on a.ID_ESTADO = e.ID_ESTADO
        inner join CAT_HOSTS f ON a.ID_HOST = f.ID_HOST
        inner join CAT_CLUSTER g ON  f.ID_CLUSTER = g.ID_CLUSTER
        where g.nom_cluster like '%" . $cual . "%'
        ");
      $query= sqlsrv_query($conn, $sqla);
      return $query ;
    }

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

    public function ultimo_parche( $conn, $cual ) {
      $sql = "SELECT t1.id_servidor, datediff( month, t2.mxdate, getdate() ) as fec_par
        from servidores t1
        inner join ( select max(fecha_parchado) mxdate, id_servidor
                        from parchado
                        group by id_servidor ) t2 on t1.id_servidor = t2.id_servidor
        inner join CAT_HOSTS b ON t1.ID_HOST = b.ID_HOST
        inner join CAT_CLUSTER c ON  b.ID_CLUSTER = c.ID_CLUSTER
        WHERE c.nom_cluster like '%" . $cual . "%'
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
        where id_estado = 2 and d.nom_cluster like '%" . $cual . "%' " ;
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

    public function top_20( $conn, $cual ) {
      $sql = "SELECT count(*) as conteo, a.ip FROM vulnera a
        inner join SERVIDORES b on a.ip = b.IP_SERVIDOR
        inner join CAT_HOSTS c ON b.ID_HOST = c.ID_HOST
        inner join CAT_CLUSTER d ON  c.ID_CLUSTER = d.ID_CLUSTER
        where d.nom_cluster like '%" . $cual . "%'
        GROUP  BY a.ip
        ORDER BY conteo desc" ;
      $query = sqlsrv_query( $conn, $sql ) ;
      return $query;
    }

    public function con_av( $conn, $cual ) {
      $sql = "SELECT count( * )
        from SERVIDORES a
        inner join CAT_HOSTS c ON a.ID_HOST = c.ID_HOST
        inner join CAT_CLUSTER d ON  c.ID_CLUSTER = d.ID_CLUSTER
        inner join CAT_SERVICIOS g ON a.ID_SERVICIO = g.ID_SERVICIO
        where a.ESTADO_AV = 2 and d.nom_cluster like '%" . $cual . "%' " ;
      $query = sqlsrv_query( $conn, $sql ) ;
      $val = sqlsrv_fetch_array ( $query ) ;
      return $val[0];
    }

    public function con_avoff( $conn, $cual ) {
      $sql = "SELECT count( * )
        from SERVIDORES a
        inner join CAT_HOSTS c ON a.ID_HOST = c.ID_HOST
        inner join CAT_CLUSTER d ON  c.ID_CLUSTER = d.ID_CLUSTER
        inner join CAT_SERVICIOS g ON a.ID_SERVICIO = g.ID_SERVICIO
        where a.ESTADO_AV = 1 and d.nom_cluster like '%" . $cual . "%' " ;
      $query = sqlsrv_query( $conn, $sql ) ;
      $val = sqlsrv_fetch_array ( $query ) ;
      return $val[0];
    }

  }

  $servers = new Servidores() ;

  $aquien = $_GET["clave"];

  $listaServer = $servers-> listado( $conn, $aquien );

  $enDominioPRD = $servers->en_dominio( $conn, $aquien );
  $sinDominioPRD = $servers->sin_dominio( $conn, $aquien );
  $noLinuxPRD = $servers->no_linux( $conn, $aquien );
  $noWindowsPRD = $servers->no_windows( $conn, $aquien );
  $VMTOkPRD = $servers->vmtools_ok( $conn, $aquien );
  $VMTRevPRD = $servers->vmtools_revisar( $conn, $aquien );
  $EncendidoPRD = $servers->srv_encendido( $conn, $aquien );
  $ApagadoPRD = $servers->srv_apagado( $conn, $aquien );
  $MonitoreoPRD = $servers->en_solar( $conn, $aquien );
  $top20PRD = $servers->top_20( $conn, $aquien );
  $conAV = $servers->con_av( $conn, $aquien );
  $conAVOff = $servers->con_avoff( $conn, $aquien );

  $ultimoParche = $servers->ultimo_parche( $conn, $aquien );
  $sistemaOperativo = $servers->sistOp( $conn );

  $VMTRevisarPRD = 0 ;
  if ( !$VMTRevPRD === false ) {
    while ( $row = sqlsrv_fetch_array( $VMTRevPRD ) ) {
      $VMTRevisarPRD += $row[1] ;
    }
  }

  $sinDominioPRD -= $noLinuxPRD ;
  $SinMonitoPRD = $EncendidoPRD + $ApagadoPRD - $MonitoreoPRD ;
  $sinAV = $EncendidoPRD + $ApagadoPRD - $conAVOff - $conAV ;

  $uno = 0 ;
  $dos = 0 ;
  $tres = 0 ;
  $cuatro = 0 ;
  $mas = 0 ;

  if ( !$top20PRD === false ) {
    for ( $i = 0; $i < 20; $i++) {
      $row = sqlsrv_fetch_array( $top20PRD );
      $top1[$i]=['conteo'];
      $top2[$i]=['IP'];
    }
  }
?>

<?php //DISEÑO ?>

<?php //FIN DISEÑO ?>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a>
            <?php
              if ( $aquien == 'PRD' ) {
                echo 'vCenter Producción' ;
              } elseif ( $aquien == 'Monitor' ) {
                echo 'vCenter Monitor' ;
              } elseif ( $aquien == 'DEV' ) {
                echo 'vCenter Desarrollo / Calidad' ;
              } elseif ( $aquien == 'INFA') {
                echo 'vCenter Nube Privada' ;
              }

            ?>

          </a>
        </li>
      </ol>
      <h3><? php echo " - " . $aquien ; ?></h3>
      <div class="row">
        <div class="col-lg-3">
          <div class="card mb-3">
            <div class="card-header">
              <h6>Por Sistema Operativo</h6>
            </div>
            <div class="card-body">
              <canvas id="SistOperPRD" width="50" height="50"></canvas>
            </div>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="card mb-3">
            <div class="card-header">
              <h6>En Dominio</h6>
            </div>
            <div class="card-body">
                <canvas id="DominioPRD" width="50" height="50"></canvas>
            </div>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="card mb-3">
            <div class="card-header">
              <h6>Estado de VMTools</h6>
            </div>
            <div class="card-body">
                <canvas id="VMToolsPRD" width="50" height="50"></canvas>
            </div>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="card mb-3">
            <div class="card-header">
              <h6>Energizados</h6>
            </div>
            <div class="card-body">
                <canvas id="PowerPRD" width="50" height="50"></canvas>
            </div>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="card mb-3">
            <div class="card-header">
              <h6>Solarwinds</h6>
            </div>
            <div class="card-body">
                <canvas id="SolarPRD" width="50" height="50"></canvas>
            </div>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="card mb-3">
            <div class="card-header">
              <h6>Antivirus</h6>
            </div>
            <div class="card-body">
                <canvas id="AVPRD" width="50" height="50"></canvas>
            </div>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="card mb-3">
            <div class="card-header">
              <h6>Respaldos</h6>
            </div>
            <div class="card-body">
                <canvas id="BackupPRD" width="50" height="50"></canvas>
            </div>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="card mb-3">
            <div class="card-header">
              <h6>Parchado</h6>
            </div>
            <div class="card-body">
                <canvas id="BackupPRD" width="50" height="50"></canvas>
            </div>
          </div>
        </div>
      </div>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a>Vulnerabilidades</a>
        </li>
      </ol>
      <div class="row">
        <div class="col-lg-6">
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
          </div>

        </div>
        <div class="col-lg-6">
          <div class="card mb-3">
            <div class="card-header">
              <h6>Top 15 servidores vulnerables</h6>
            </div>
            <div class="card-body">
                <canvas id="Top20Servers" width="50" height="50"></canvas>
            </div>
          </div>
        </div>

      </div>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a>Listado de Servidores</a>
        </li>
      </ol>
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> </div>
          <div class="card-body">
            <div class="table-responsive">
              <?php
                if ( $listaServer ) {
              ?>
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th style="visibility: hidden">ID</th>
                  <th>IP</th>
                  <th>Nombre</th>
                  <th>Responsable</th>
                  <th>Sistema Operativo</th>
                  <th>Estado</th>
                  <th>Monitoreado</th>
                  <th>En Dominio</th>
                  <th>Antivirus</th>
                  <th>Familia S.O.</th>
                  <th>Estado VMTools</th>
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
                    <td><?php echo $arreglo['NOM_ADMINISTRADOR']?></td>
                    <td><?php echo $arreglo['NOM_SO']?></td>
                    <td><?php echo $arreglo['NOM_ESTADO']?></td>
                    <td><?php if( $arreglo['ID_NODO'] == 0 ) echo "NoSolar"; else echo "Solarwinds" ; ?></td>
                    <td><?php if( $arreglo['EN_DOMINIO'] == 0 ) echo "DominioNo"; else echo "DominioSi" ; ?></td>
                    <td><?php if( $arreglo['ESTADO_AV'] == 1 ) echo "Offline"; elseif ( $arreglo[8] == 2 ) echo "Online" ; else echo "NoAV" ; ?></td>
                    <td><?php echo$arreglo['FAMILIA_SO']?></td>
                    <td><?php if ( $arreglo['ID_ESTADO_VMTOOL'] == 3 ) echo "VMToolsOK"; else echo "VMToolsRev";  ?></td>
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
            }
            ?>
          </div>
        </div>
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
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="../vendor/chart.js/Chart.min.js"></script>
    <script src="../vendor/datatables/jquery.dataTables.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="../js/sb-admin-datatables.min.js"></script>

    <script src="../js/sb-admin-charts.js"></script>
    <script src="../js/sb-charts.js"></script>

    <script>
      var ctx = document.getElementById('Parchado');
      var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
              labels: ['1 mes', '2 meses', '3 meses', '4-6 meses', '6+ meses'],
              datasets: [{
                  label: 'No. Servidores',
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
            label: 'No. Servidores',
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

    <script>      <!--  Servidores Antivirus Produccion -->
      var ctx = document.getElementById('AVPRD');
      // For a pie chart
      var myPieChart = new Chart(ctx, {
          type: 'pie',
          data: {
            labels: ['AV OK', 'AV Revisar', 'Sin AV'],
            datasets: [{
              data: [
                <?php
                  echo $conAV . ',' . $conAVOff . ',' . $sinAV ;
                ?>
                ],
              backgroundColor: [
                'rgba(66, 217, 61, 0.2)',
                'rgba(255, 235, 120  , 0.2)',
                'rgba(255, 99, 132, 0.2)',
                ],
              borderColor: [
                'rgba(66, 217, 61, 1)',
                'rgba(225, 212, 139 , 1)',
                'rgba(255, 99, 132, 1)',
                ],
              borderWidth: 1
            }]
          },
          options: {
            responsive: true
          }
      });
    </script>

    <script>
      var ctx = document.getElementById('Top20Servers');
      var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
              labels: [
                <?php
                  for ( $i = 14; $i >= 0; $i--) {
                    echo "'" . $top2[$i] . "', " ;
                  }
                ?>
              ],
              datasets: [{
                  label: 'No. Vulnerabilidades',
                  data: [
                    <?php
                      for ( $i = 14; $i >= 0; $i--) {
                        echo "'" . $top1[$i] . "', " ;
                      }
                    ?>
                  ],
                  backgroundColor: [
                      'rgba(255, 99, 132, 0.2)',
                      'rgba(255, 99, 132, 0.2)',
                      'rgba(255, 99, 132, 0.2)',
                      'rgba(255, 99, 132, 0.2)',
                      'rgba(255, 99, 132, 0.2)',
                      'rgba(255, 99, 132, 0.2)',
                      'rgba(255, 99, 132, 0.2)',
                      'rgba(255, 99, 132, 0.2)',
                      'rgba(255, 99, 132, 0.2)',
                      'rgba(255, 99, 132, 0.2)',
                      'rgba(255, 99, 132, 0.2)',
                      'rgba(255, 99, 132, 0.2)',
                      'rgba(255, 99, 132, 0.2)',
                      'rgba(255, 99, 132, 0.2)',
                      'rgba(255, 99, 132, 0.2)'

                  ],
                  borderColor: [
                      'rgba(255, 99, 132, 1)',
                      'rgba(255, 99, 132, 1)',
                      'rgba(255, 99, 132, 1)',
                      'rgba(255, 99, 132, 1)',
                      'rgba(255, 99, 132, 1)',
                      'rgba(255, 99, 132, 1)',
                      'rgba(255, 99, 132, 1)',
                      'rgba(255, 99, 132, 1)',
                      'rgba(255, 99, 132, 1)',
                      'rgba(255, 99, 132, 1)',
                      'rgba(255, 99, 132, 1)',
                      'rgba(255, 99, 132, 1)',
                      'rgba(255, 99, 132, 1)',
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


  </div>
  <?php //include 'footer.php' ?>
</body>

</html>
