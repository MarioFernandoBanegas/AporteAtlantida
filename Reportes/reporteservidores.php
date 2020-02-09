<?php

	include 'plantillaservidores.php';
	require '../libs/connection.php';
	$query = "SELECT s.IP_SERVIDOR, s.NOM_SERVIDOR, d.NOM_DBA, r.NOM_ADMINISTRADOR, p.NOM_ESTADO, s.ULTIMA_ACTUALIZACION,
				o.NOM_SO,iif(s.PCI ='0','No','Si') PCI
			  from SERVIDORES s inner join  CAT_DBAS d
			  on s.ID_DBA = d.ID_DBA
			  inner join CAT_RESPONSABLES r on s.ID_ADMINISTRADOR = r.ID_ADMINISTRADOR
			  inner join CAT_ESTADOS p on s.ID_ESTADO = p.ID_ESTADO
              inner join CAT_SO o on s.ID_SO = o.ID_SO ";
	$resultado = sqlsrv_query($conn,$query);

	$pdf = new PDF('L','mm','Legal');

	$pdf->AliasNbPages();
	$pdf->AddPage();

	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(26,6,'IP Servidor',1,0,'C',1);
	$pdf->Cell(55,6,'Nombre Servidor',1,0,'C',1);
	$pdf->Cell(50,6,'Nombre Base de Datos',1,0,'C',1);
	$pdf->Cell(38,6,'Administrador',1,0,'C',1);
	$pdf->Cell(30,6,'Estado',1,0,'C',1);
	$pdf->Cell(50,6,'Ultima Actualizacion',1,0,'C',1);
	$pdf->Cell(60,6,'Sistema Operativo',1,0,'C',1);
	$pdf->Cell(20,6,'PCI',1,1,'C',1);





	$pdf->SetFont('Arial','',9);

	while($row = sqlsrv_fetch_array($resultado))
	{
		$pdf->Cell(26,6,utf8_decode($row['IP_SERVIDOR']),1,0,'C');
		$pdf->Cell(55,6,utf8_decode($row['NOM_SERVIDOR']),1,0,'C');
		$pdf->Cell(50,6,utf8_decode($row['NOM_DBA']),1,0,'C');
		$pdf->Cell(38,6,utf8_decode($row['NOM_ADMINISTRADOR']),1,0,'C');
		$pdf->Cell(30,6,utf8_decode($row['NOM_ESTADO']),1,0,'C');
		$pdf->Cell(50,6,utf8_decode($row['ULTIMA_ACTUALIZACION']->format("Y-d-m")),1,0,'C');
		$pdf->Cell(60,6,utf8_decode($row['NOM_SO']),1,0,'C');
		$pdf->Cell(20,6,utf8_decode($row['PCI']),1,1,'C');

	}
	$pdf->Output();



?>
<!DOCTYPE html>
<html lang="es">
<head>
	<link rel="shortcut icon" href="../media/favicon.ico" />
	<meta charset="UTF-8">
	<title>Reporte Servidores</title>
