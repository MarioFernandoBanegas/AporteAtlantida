<?php
	
	include 'plantillaservidores.php';
	require '../libs/connection.php';
	$query = "SELECT s.IP, s.nombre, a.Name_Aplication, r.Nombre_Responsable, p.Name_Power, s.ul_fecha,s.tls, s.hardenizado, o.Name_OS, pc.Name_SAS
			  from servers s inner join aplication a
			  on s.Id_Aplication = a.Id_Aplication 
			  inner join responsable r on s.Id_Responsable = r.Id_Responsable
			  inner join power p on s.Id_Power = p.Id_Power
              inner join os o on s.Id_OS = o.Id_OS
              inner join pci pc on s.Id_SAS= pc.Id_SAS ";
	$resultado = sqlsrv_query($conn,$query);
	
	$pdf = new PDF('L','mm','Legal');
	
	$pdf->AliasNbPages();
	$pdf->AddPage();
	
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(26,6,'IP',1,0,'C',1);
	$pdf->Cell(43,6,'Servidor',1,0,'C',1);
	$pdf->Cell(38,6,'Servicio',1,0,'C',1);
	$pdf->Cell(34,6,'Administrador',1,0,'C',1);
	$pdf->Cell(20,6,'Estado',1,0,'C',1);
	$pdf->Cell(34,6,'Ultimo Reinicio',1,0,'C',1);
	$pdf->Cell(25,6,'TLS',1,0,'C',1);
	$pdf->Cell(22,6,'Hardenin',1,0,'C',1);
	$pdf->Cell(72,6,'OS',1,0,'C',1);
	$pdf->Cell(22,6,'PCI/PESI',1,1,'C',1);

	

	
	
	$pdf->SetFont('Arial','',10);
	
	while($row = sqlsrv_fetch_array($resultado))
	{
		$pdf->Cell(26,6,utf8_decode($row['IP']),1,0,'C');
		$pdf->Cell(43,6,utf8_decode($row['nombre']),1,0,'C');
		$pdf->Cell(38,6,utf8_decode($row['Name_Aplication']),1,0,'C');
		$pdf->Cell(34,6,utf8_decode($row['Nombre_Responsable']),1,0,'C');
		$pdf->Cell(20,6,utf8_decode($row['Name_Power']),1,0,'C');
		$pdf->Cell(34,6,utf8_decode($row['ul_fecha']),1,0,'C');
		$pdf->Cell(25,6,utf8_decode($row['tls']),1,0,'C');
		$pdf->Cell(22,6,utf8_decode($row['hardenizado']),1,0,'C');
		$pdf->Cell(72,6,utf8_decode($row['Name_OS']),1,0,'C');
		$pdf->Cell(22,6,utf8_decode($row['Name_SAS']),1,1,'C');
	
	}
	$pdf->Output();
	
?>