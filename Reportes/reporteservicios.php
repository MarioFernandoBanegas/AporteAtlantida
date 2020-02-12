<?php

	include 'plantillaservicios.php';
	require '../Conexion/conexion.php';
	$query = "SELECT ID_SERVICIO,NOM_SERVICIO,IIF(CRITICO='1','Si','No') CRITICO FROM CAT_SERVICIOS";
	$resultado = sqlsrv_query($conn,$query);

	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();

	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(25,6,'ID',1,0,'C',1);
	$pdf->Cell(130,6,'Nombre Servicio',1,0,'C',1);
	$pdf->Cell(30,6,'Critico',1,1,'C',1);

	$pdf->SetFont('Arial','',10);

	while($row = sqlsrv_fetch_array($resultado))
	{
		$pdf->Cell(25,6,utf8_decode($row['ID_SERVICIO']),1,0,'C');
		$pdf->Cell(130,6,utf8_decode($row['NOM_SERVICIO']),1,0,'C');
		$pdf->Cell(30,6,utf8_decode($row['CRITICO']),1,1,'C');
	}
	$pdf->Output();
?>
