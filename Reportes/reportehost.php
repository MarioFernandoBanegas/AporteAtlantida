<?php

	include 'plantillahost.php';
	require '../Conexion/conexion.php';
	$query = "SELECT h.ID_HOST,c.NOM_CLUSTER as CLUSTER,H.NOM_HOST,H.IP_HOST,H.ID_HOST FROM CAT_HOSTS h
		inner join CAT_CLUSTER c on h.ID_CLUSTER = c.ID_CLUSTER ";
	$resultado = sqlsrv_query($conn,$query);

	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();

	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(20,6,'ID',1,0,'C',1);
	$pdf->Cell(55,6,'Cluster',1,0,'C',1);
	$pdf->Cell(55,6,'Nombre Host',1,0,'C',1);
	$pdf->Cell(55,6,'IP Host',1,1,'C',1);

	$pdf->SetFont('Arial','',10);

	while($row = sqlsrv_fetch_array($resultado))
	{
		$pdf->Cell(20,6,utf8_decode($row['ID_HOST']),1,0,'C');
		$pdf->Cell(55,6,utf8_decode($row['CLUSTER']),1,0,'C');
		$pdf->Cell(55,6,utf8_decode($row['NOM_HOST']),1,0,'C');
		$pdf->Cell(55,6,utf8_decode($row['IP_HOST']),1,1,'C');
	}
	$pdf->Output();
?>
