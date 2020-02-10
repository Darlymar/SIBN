<?php
	include('plantilla.php');
	require('conexion.php');

	$query = "SELECT e.estado, m.id_municipio, m.municipio FROM t_municipio AS m INNER JOIN t_estado AS e ON m.id_estado=e.id_estado";

	$resultado = $mysqli->query($query);

	$pdf = new PDF('L', 'mm', array(1000,500));
	$pdf->AliasNbPages();
	$pdf->AddPage();

	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(20,6,'Cantidad',1,0,'C',1);
	$pdf->Cell(30,6,'Serial',1,0,'C',1);
	$pdf->Cell(25,6,utf8_decode('Código'),1,0,'C',1);
	$pdf->Cell(70,6,'Nombre',1,0,'C',1);
	$pdf->Cell(30,6,'Modelo',1,0,'C',1);
	$pdf->Cell(30,6,'Marca',1,0,'C',1);
	$pdf->Cell(40,6,utf8_decode('Categoría'),1,0,'C',1);
	$pdf->Cell(70,6,utf8_decode('Área'),1,0,'C',1);
	$pdf->Cell(70,6,utf8_decode('N° Bien'),1,0,'C',1);
	$pdf->Cell(70,6,'Motivo',1,0,'C',1);
	$pdf->Cell(70,6,utf8_decode('Condición'),1,0,'C',1);
	$pdf->Cell(70,6,'Responsable',1,0,'C',1);
	$pdf->Cell(70,6,utf8_decode('Asignación'),1,0,'C',1);
	$pdf->Cell(70,6,'Rango',1,0,'C',1);
	$pdf->Cell(70,6,'Cargo',1,0,'C',1);
	$pdf->Cell(70,6,'Concepto',1,0,'C',1);
	$pdf->Cell(70,6,'Precio',1,1,'C',1);

	

	$pdf->Cell(20,6,utf8_decode(''),1,0,'C',0);
	$pdf->Cell(30,6,utf8_decode(''),1,0,'C',0);
	$pdf->Cell(25,6,utf8_decode(''),1,0,'C',0);
	$pdf->Cell(70,6,utf8_decode(''),1,0,'C',0);
	$pdf->Cell(30,6,utf8_decode(''),1,0,'C',0);
	$pdf->Cell(30,6,utf8_decode(''),1,0,'C',0);
	$pdf->Cell(40,6,utf8_decode(''),1,0,'C',0);
	$pdf->Cell(70,6,utf8_decode(''),1,0,'C',0);
	$pdf->Cell(70,6,utf8_decode(''),1,0,'C',0);
	$pdf->Cell(70,6,utf8_decode(''),1,0,'C',0);
	$pdf->Cell(70,6,utf8_decode(''),1,0,'C',0);
	$pdf->Cell(70,6,utf8_decode(''),1,0,'C',0);
	$pdf->Cell(70,6,utf8_decode(''),1,0,'C',0);
	$pdf->Cell(70,6,utf8_decode(''),1,0,'C',0);
	$pdf->Cell(70,6,utf8_decode(''),1,0,'C',0);
	$pdf->Cell(70,6,utf8_decode(''),1,0,'C',0);
	$pdf->Cell(70,6,utf8_decode(''),1,1,'C',0);	



	$pdf->SetFont('Arial','',8);

	// while ($row = $resultado->fetch_assoc())
	// {
	// 	$pdf->Cell(70,6,utf8_decode($row['estado']),1,0,'C');
	// 	$pdf->Cell(20,6,($row['id_municipio']),1,0,'C');
	// 	$pdf->Cell(70,6,utf8_decode($row['municipio']),1,0,'C');			
	// }
	$pdf->Output();
?>