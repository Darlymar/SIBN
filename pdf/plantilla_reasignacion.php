<?php
require ('fpdf/fpdf.php');

class PDF extends FPDF
{

	function Header()
	{
		$this->Image('../img/logo-Ministerio.jpg', 35,15,30);
		$this->Image('../img/cicpc_logo_trns.png', 480,5,30);

		$this->SetFont('Arial','B',10);

		$this->Cell(30);
		$this->SetX(100);
		$this->Cell(290,10,utf8_decode ('ACTA DE REASIGNACIÓN DE BIENES NACIONALES'),0,0,'C');
		$this->SetX(178);
		$this->Cell(40,100,date('d/m/Y'),0,0,'L');	
		$this->Ln(5);

		$this->Ln(10);
		$this->Cell(30);
		$this->SetX(100);
		$this->Cell(290,10,utf8_decode ('Reporte de Reasignación'),2,1,'C');
		$this->Ln(20);

				$this->SetX(135);
				$this->Cell(865,10,utf8_decode('En la ciudad de Caracas,                     se llevó a cabo por parte de la división de sistemas la entrega de los bienes muebles que se especifican a continuación'),0,0,'L');
				
				$this->Ln(10);
				

				
				$this->SetY(300);
				$this->SetX(80);
				$this->Cell(420,10,utf8_decode('Haciendo constar que dichos activos se encuentran en óptimas condiciones físicas. Se levanta la presente acta y en señal de conformidad firma el funcionario receptor, quedando este responsable del uso, conservación y custodia de estos bienes: '),0,0,'R');
				$this->Ln(15);
				$this->Cell(175,10,utf8_decode('Recibe Conforme'),0,0,'C');
				$this->Ln(10);
				$this->SetX(82);
				$this->Cell(946,10,utf8_decode('Nombre y Apellido -------------------------------------------------------------------------------------'),0,0,'L');
				$this->Ln(30);
				$this->SetX(82);
				$this->Cell(946,10,utf8_decode('C.I. ----------------------------------   Credencial ---------------------------------    Cargo -------------------------------------------------------------------------------------------------------------------------------------------------------------'),0,0,'L');
				$this->Ln(30);
				$this->SetX(82);
				$this->Cell(946,10,utf8_decode('Firma -------------------------------------------------------------------------------------------------'),0,0,'L');
				$this->Ln(30);
				$this->SetX(82);
				$this->Cell(846,10,utf8_decode('NOTA: ESTOS EQUIPOS NO PUEDEN SER INCLUIDOS EN SU INVENTARIO, YA QUE PERTENECEN A UN PROYECTO DE LA VICEPRESIDENCIA DE LA REPUBLICA. '),0,0,'L');

	}

	function Footer()
	{
		$this->SetY(-15);
		$this->SetFont('Arial','I', 8);
		$this->Cell(0,10, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
	}

}
?>