<?php
	
	require '../fpdf/fpdf.php';
	
	class PDF extends FPDF
	{
		function Header()
		{

			$this->Image('../media/logo.png', 10, 5, 40 );

			$this->SetFont('Arial','B',15);
			$this->Cell(40);
			$this->Cell(110,30, 'Reporte Conexiones',0,0,'C');
			$this->Ln(30);

		}
		
		function Footer()
		{
			$this->SetY(-15);
			$this->SetFont('Arial','I', 9);
			$this->Cell(0,10, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C' );
		}	

	}

?>
