<?php 
	include("../libs/connection.php") ;
	include("headers.php");
	date_default_timezone_set("America/Tegucigalpa");
	
	//<!-- FORMULARIO PARA ESTE EJERCICIO -->

	//<!-- PROCESO DE CARGA Y PROCESAMIENTO DEL EXCEL-->
	extract( $_POST );
	if (isset( $_POST['action'] ) ) {
		$action = $_POST['action'];
	}

	if ( isset( $action ) == "upload" ) {

		//cargamos el fichero
		$archivo = $_FILES['excel']['name'];
		$tipo = $_FILES['excel']['type'];

		echo "0000000000 nombre: " . $archivo . " -- tipo: " . $tipo . "<br>";

		$destino = "cop_".$archivo;//Le agregamos un prefijo para identificarlo el archivo cargado

		if ( copy($_FILES['excel']['tmp_name'], $destino) ) echo "Archivo Cargado Con Éxito";
		else echo "Error Al Cargar el Archivo";

	if (file_exists ("cop_".$archivo)){ 
		/** Llamamos las clases necesarias PHPEcel */
		require('../Classes/PHPExcel.php');
		require_once('../Classes/PHPExcel/IOFactory.php');
		require('../Classes/PHPExcel/Reader/Excel2007.php');					
	// Cargando la hoja de excel
		$objReader = new PHPExcel_Reader_Excel2007();
		$objPHPExcel = $objReader->load("cop_".$archivo);
		$objFecha = new PHPExcel_Shared_Date();       
	// Asignamon la hoja de excel activa
		$objPHPExcel->setActiveSheetIndex(0);

	// Importante - conexión con la base de datos 

	// Rellenamos el arreglo con los datos  del archivo xlsx que ha sido subido

		$columnas = $objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();
		$filas = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();

		echo "Numero de filas: " . $filas . "<br>" ;

	//Creamos un array con todos los datos del Excel importado
		for ($i=2;$i<=$filas;$i++){
			$_DATOS_EXCEL[$i]['IP'] = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
			$_DATOS_EXCEL[$i]['Servidor'] = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
			$_DATOS_EXCEL[$i]['Estado del riesgo'] = $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
			$_DATOS_EXCEL[$i]['Severidad del Riesgo'] = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
			$_DATOS_EXCEL[$i]['Protocolo'] = $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
			$_DATOS_EXCEL[$i]['Puerto'] = $objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue();
			$_DATOS_EXCEL[$i]['Responsable'] = $objPHPExcel->getActiveSheet()->getCell('G'.$i)->getCalculatedValue();
			$_DATOS_EXCEL[$i]['Area Responsable'] = $objPHPExcel->getActiveSheet()->getCell('H'.$i)->getCalculatedValue();
			$_DATOS_EXCEL[$i]['Tipo de amenaza'] = $objPHPExcel->getActiveSheet()->getCell('I'.$i)->getCalculatedValue();
			$_DATOS_EXCEL[$i]['solucion'] = $objPHPExcel->getActiveSheet()->getCell('J'.$i)->getCalculatedValue();
			$_DATOS_EXCEL[$i]['Descripcion'] = $objPHPExcel->getActiveSheet()->getCell('K'.$i)->getCalculatedValue();
			$_DATOS_EXCEL[$i]['Plan de Accón'] = $objPHPExcel->getActiveSheet()->getCell('L'.$i)->getCalculatedValue();
			$_DATOS_EXCEL[$i]['Evidencias'] = $objPHPExcel->getActiveSheet()->getCell('M'.$i)->getCalculatedValue();
			$_DATOS_EXCEL[$i]['Observaciones'] = $objPHPExcel->getActiveSheet()->getCell('N'.$i)->getCalculatedValue();
			$_DATOS_EXCEL[$i]['Fecha estimada de cierre'] = $objPHPExcel->getActiveSheet()->getCell('O'.$i)->getCalculatedValue();
			$_DATOS_EXCEL[$i]['Fecha estidama de cierre(Proyecto)'] = $objPHPExcel->getActiveSheet()->getCell('P'.$i)->getCalculatedValue();
			$_DATOS_EXCEL[$i]['Número de proyecto'] = $objPHPExcel->getActiveSheet()->getCell('Q'.$i)->getCalculatedValue();


			$_DATOS_EXCEL[$i]['activo'] = 1;
		}		
		$errores=0;


		foreach($_DATOS_EXCEL as $campo => $valor){
			$sql = "INSERT INTO vulnera  (IP,Servidor,EstadoRiesgo,SeveridadRiesgo,Protocolo,Puerto,Responsable,AreaResponsable,TipoAmenaza,Solucion,Descripcion,PlanAccion,Evidencias,Observaciones,FechaEstimadaCierre,FechaEstimadaCierreProyecto,NumeroProyecto,activo)  VALUES ('";
			foreach ($valor as $campo2 => $valor2){
				$campo2 == "activo" ? $sql.= $valor2."');" : $sql.= $valor2."','";
			}

			$result = sqlsrv_query($conn,$sql);
			if (!$result){ echo "Error al insertar registro ".$campo;$errores+=1;}
		}	
						/////////////////////////////////////////////////////////////////////////	
		echo "<hr> <div class='col-xs-12'>
		<div class='form-group'>";
		echo "<strong><center>ARCHIVO IMPORTADO CON EXITO, EN TOTAL $campo REGISTROS Y $errores ERRORES</center></strong>";
		echo "</div>
		</div>  ";
								//Borramos el archivo que esta en el servidor con el prefijo cop_
		unlink($destino);

	}
						//si por algun motivo no cargo el archivo cop_ 
	else{
		echo "Primero debes cargar el archivo con extencion .xlsx";
	}
	}
?>
<?php 
if (isset($action)) {
	$filas = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
}
if (isset($filas)) {
	$columnas = $objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();
}
if (isset($filas)) {
	$filas = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
}


include ("footers.php");
?>
