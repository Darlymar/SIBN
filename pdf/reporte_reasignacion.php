<?php
  extract($_GET);
  include('plantilla_reasignacion.php');
  require('conexion.php');
  
	$query = "SELECT * FROM despachos

			INNER JOIN products on products.id_despachos = despachos.id_despachos

";

  $resultado = $mysqli->query($query);
  
  $pdf = new PDF('L', 'mm', array(600,500));
  $pdf->AliasNbPages();
  $pdf->AddPage();


  $pdf->SetFillColor(232,232,232);
  $pdf->SetFont('Arial','B',12);
  
  $pdf->SetY(70);
  $pdf->SetX(50);
  $pdf->Cell(150,6,utf8_decode('Nombre del Despacho'),1,0,'C',1);
  $pdf->Cell(50,6,utf8_decode('Cedula del Jefe'),1,0,'C',1);
  $pdf->Cell(100,6,utf8_decode('Nombre del Jefe'),1,0,'C',1);
  $pdf->Cell(80,6,utf8_decode('Rango'),1,0,'C',1);
  $pdf->Ln(6);

  while ( $row = $resultado->fetch_assoc() )

  {
    
  $pdf->SetX(50);
  $pdf->Cell(150,6,utf8_decode($row['nombre_despachos']),1,0,'C',0);
  $pdf->Cell(50,6,utf8_decode($row['cedulajd']),1,0,'C',0);  
  $pdf->Cell(100,6,utf8_decode($row['nombrejd']),1,0,'C',0);
  $pdf->Cell(100,6,utf8_decode($row['nombre_producto']),1,0,'C',0);
  $pdf->Cell(100,6,utf8_decode($row['marca_producto']),1,0,'C',0);
  $pdf->Cell(100,6,utf8_decode($row['modelo_producto']),1,0,'C',0);
  $pdf->Cell(80,6,utf8_decode($row['rango']),1,1,'C',0);  
  $pdf->SetY(70);
  $pdf->SetX(80);
  }
  $pdf->SetFont('Arial','',8);


  $pdf->Output();
?>