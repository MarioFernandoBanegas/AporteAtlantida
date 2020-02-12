<?php

	include 'plantillacluster.php';
	require '../Conexion/conexion.php';
	$query = "SELECT * FROM CAT_CLUSTER ";
	$resultado = sqlsrv_query($conn,$query);

	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();

	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(20,6,'ID',1,0,'C',1);
	$pdf->Cell(80,6,'Cluster',1,0,'C',1);
	$pdf->Cell(80,6,'IP VCenter',1,1,'C',1);

	$pdf->SetFont('Arial','',10);

	while($row = sqlsrv_fetch_array($resultado))
	{
		$pdf->Cell(20,6,utf8_decode($row['ID_CLUSTER']),1,0,'C');
		$pdf->Cell(80,6,utf8_decode($row['NOM_CLUSTER']),1,0,'C');
		$pdf->Cell(80,6,utf8_decode($row['IP_VCENTER']),1,1,'C');
	}
	$pdf->Output();
?>
