<?php
require ('fpdf/fpdf.php');

class PDF extends FPDF
{

	function Header()
	{
		$this->Image('../img/logo-Ministerio.jpg', 10,15,30);
		$this->Image('../img/cicpc_logo_trns.png', 170,5,30);

		$this->SetFont('Arial','B',10);

		$this->Ln(15);
		$this->SetX(100);
		$this->Cell(15,10,utf8_decode ('ACTA DE BIENES PÚBLICOS'),0,0,'C');

		

		$this->Ln(15);
		$this->SetX(100);
		$this->Cell(15,10,utf8_decode ('Reporte del Producto'),2,1,'C');

		$this->SetY(10);
		$this->SetX(58);
		$this->Cell(40,100,date('d/m/Y'),0,0,'L');	
		


				$this->SetY(55);
				$this->SetX(15);
				$this->Cell(50,10,utf8_decode('En la ciudad de Caracas,                     se llevó a cabo por parte de la división de públicos la entrega de los'),0,0,'L');
			
				$this->SetY(60);
				$this->SetX(10);
				$this->Cell(10,10,utf8_decode('bienes muebles que se especifican a continuación.'),0,0,'L');
				
				$this->SetY(245);
				$this->SetX(10);
				$this->Cell(946,10,utf8_decode('Nombre y Apellido: ____________________________________________          C.I: _______________'),0,0,'L');
				
				$this->SetY(255);
				$this->SetX(10);
				$this->Cell(946,10,utf8_decode('Credencial: ___________    Cargo: ___________________________________'),0,0,'L');
				
				$this->SetY(265);
				$this->SetX(10);
				$this->Cell(946,10,utf8_decode('Firma: ___________________________'),0,0,'L');
			
				$this->SetY(265);
				$this->SetX(90);
				$this->Cell(146,10,utf8_decode('Nota: ________________________________________________'),0,0,'L');
			
				
	}


	function Footer()
	{
		$this->SetY(-15);
		$this->SetFont('Arial','I', 8);
		$this->Cell(0,10, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
	}

}
?>