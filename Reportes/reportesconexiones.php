<?php
	
	include 'plantillaconexiones.php';
	require '../libs/connection.php';
	$query = "SELECT * FROM connection ";
	$resultado = sqlsrv_query($conn,$query);
	
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(70,6,'ID',1,0,'C',1);
	$pdf->Cell(120,6,'Conexion',1,1,'C',1);

	
	
	$pdf->SetFont('Arial','',10);
	
	while($row = sqlsrv_fetch_array($resultado)))
	{
		$pdf->Cell(70,6,utf8_decode($row['Id_Connection_state']),1,0,'C');
		$pdf->Cell(120,6,utf8_decode($row['Name_Connection_state']),1,1,'C');
	}
	$pdf->Output();
	
?>