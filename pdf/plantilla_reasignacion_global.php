<?php
require ('fpdf/fpdf.php');

class PDF extends FPDF
{

	function Header()
	{
		$this->Image('../img/logo-Ministerio.jpg', 35,15,30);
		$this->Image('../img/cicpc_logo_trns.png', 875,5,30);

		$this->SetFont('Arial','B',10);

		$this->Cell(30);
		$this->SetX(350);
		$this->Cell(290,10, 'MINISTERIO DEL PODER POPULAR PARA LAS RELACIONES INTERIORES, JUSTICIA Y PAZ',2,0,'C');
		$this->Ln(5);

		$this->Cell(30);
		$this->SetX(350);
		$this->Cell(290,10, utf8_decode('CUERPO DE INVESTIGACIONES CIENTÍFICA, PENALES Y CRIMINALÍSTICAS'),2,0,'C');
		$this->Ln(5);

		$this->Cell(30);
		$this->SetX(350);
		$this->Cell(290,10, utf8_decode('BIENES NACIONALES'),2,0,'C');
		$this->Ln(5);


		$this->Ln(10);
		$this->Cell(30);
		$this->SetX(350);
		$this->Cell(290,10, 'Reporte de Movimientos',2,1,'C');


		
				$this->SetX(30);
				$this->Cell(865,10, 'INVENTARIO DE BIENES PUBLICOS',1,0,'C');
				$this->Cell(40,10, utf8_decode('N° 1/1'),1,0,'C');
				$this->Cell(40,10, 'FECHA: 2020',1,1,'C');

				$this->SetX(30);
				$this->Cell(945,10,'',1,1,'C');

				$this->SetX(30);
				$this->Cell(945,10,'ORGANISMO',1,1,'C');
				$this->SetX(30);
				$this->Cell(40,10,utf8_decode('CÓDIGO'),1,0,'C');
				$this->SetX(70);
				$this->Cell(40,10,'26',1,0,'C');
				$this->SetX(110);
				$this->Cell(865,10,utf8_decode('DENOMINACIÓN: MINISTERIO DEL PODER POPULAR PARA LAS RELACIONES INTERIORES JUSTICIA Y PAZ'),1,1,'I');

				$this->SetX(30);
				$this->Cell(945,10,'UNIDAD ADMINISTRADORA',1,1,'C');
				$this->SetX(30);
				$this->Cell(40,10,utf8_decode('CÓDIGO'),1,0,'C');
				$this->Cell(40,10,'3-169',1,0,'C');
				$this->Cell(865,10,utf8_decode('DENOMINACIÓN: CUERPO DE INVESTIGACIONES CIENTIFICAS PENALES Y CRIMINALISTICAS'),1,1,'I');



				$this->SetX(30);
				$this->Cell(945,10,utf8_decode('DIRECCIÓN DEL DESPACHO'),1,1,'C');
				$this->SetX(30);
				$this->Cell(40,10,utf8_decode('DIRECCIÓN'),1,0,'C');
				$this->Cell(905,10,utf8_decode(' ESQ. ÑO PASTOR A PTE. VICTORIA, EDIF.CICPC, TORRE SUR PISO 6, PARQUE CARABOBO, TLF: 0212-508.44.07'),1,1,'I');

				$this->SetX(30);
				$this->Cell(945,10,'RESPONSABLE PATRIMONIAL',1,1,'C');
				$this->SetX(30);
				$this->Cell(75,10,'NOMBRE Y APELLIDO',1,0,'C');
				$this->Cell(550,10,utf8_decode('ADRIANA AVILAN'),1,0,'C');
				$this->Cell(220,10,'C.I. V-11.930.779',1,0,'C');
				$this->Cell(100,10,utf8_decode('CARGO: JEFA DE LA DIVISIÓN'),1,1,'C');
				$this->SetX(468);
				
		$this->Ln(5);


	}

	function Footer()
	{
		$this->SetY(-15);
		$this->SetFont('Arial','I', 8);
		$this->Cell(0,10, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
	}

}
?>