<?php
	include('plantilla.php');
	require('conexion.php');

	$query = "SELECT * FROM products
			INNER JOIN categorias on products.id_categorias = categorias.id_categorias
			INNER JOIN subcategorias on products.id_subcategorias = subcategorias.id_subcategorias
			INNER JOIN categoriasespecificas on products.id_categoriasespecificas = categoriasespecificas.id_categoriasespecificas
			INNER JOIN color on products.id_color = color.id_color
			INNER JOIN despachos on products.id_despachos = despachos.id_despachos
			INNER JOIN condicion on products.id_condicion = condicion.id_condicion
";
					

	$resultado = $mysqli->query($query);

	$pdf = new PDF('L', 'mm', array(1000,500));
	$pdf->AliasNbPages();
	$pdf->AddPage();

	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);

	$pdf->SetY(150);
	$pdf->SetX(5);
	$pdf->Cell(25,6,utf8_decode('Cantidad'),1,0,'C',1);
	$pdf->Cell(35,6,utf8_decode('N° de Bien'),1,0,'C',1);
	$pdf->Cell(55,6,utf8_decode('Especificaciones Técnicas'),1,0,'C',1);
	$pdf->Cell(55,6,utf8_decode('Otras Esp. Téc'),1,0,'C',1);
	$pdf->Cell(55,6,utf8_decode('Categorias'),1,0,'C',1);
	$pdf->Cell(55,6,utf8_decode('Sub-Categorias'),1,0,'C',1);
	$pdf->Cell(55,6,utf8_decode('Categorias Especificas'),1,0,'C',1);
	$pdf->Cell(40,6,utf8_decode('Marca'),1,0,'C',1);
	$pdf->Cell(40,6,utf8_decode('Modelo'),1,0,'C',1);
	$pdf->Cell(40,6,utf8_decode('Cod. Productos'),1,0,'C',1);
	$pdf->Cell(30,6,utf8_decode('Color'),1,0,'C',1);
	$pdf->Cell(30,6,utf8_decode('N° Serial'),1,0,'C',1);
	$pdf->Cell(55,6,utf8_decode('Ubicación del Bien'),1,0,'C',1);
	$pdf->Cell(40,6,utf8_decode('Incorporación'),1,0,'C',1);
	$pdf->Cell(40,6,utf8_decode('Valor de Adquisión'),1,0,'C',1);
	$pdf->Cell(55,6,utf8_decode('Depreciación Acumulada'),1,0,'C',1);
	$pdf->Cell(40,6,utf8_decode('Valor Contable'),1,0,'C',1);
	$pdf->Cell(30,6,utf8_decode('Condición'),1,0,'C',1);

	
	while ( $row = $resultado->fetch_assoc() )

	{

    $pdf->SetY(156);  
    $pdf->SetX(5);
    $pdf->MultiCell(25,6,utf8_decode($row['stock']),1);
    $pdf->SetY(156);  
    $pdf->SetX(30);
    $pdf->MultiCell(35,6,utf8_decode($row['numero_bien']),1);
    $pdf->SetY(156);  
    $pdf->SetX(65);
    $pdf->MultiCell(55,6,utf8_decode($row['nombre_producto']),1);
    $pdf->SetY(156);  
    $pdf->SetX(120);
    $pdf->MultiCell(55,6,utf8_decode($row['concepto_inventario']),1);
    $pdf->SetY(156);  
    $pdf->SetX(175);
    $pdf->MultiCell(55,6,utf8_decode($row['categorias']),1);
    $pdf->SetY(156); 
    $pdf->SetX(230);
    $pdf->MultiCell(55,6,utf8_decode($row['subcategorias']),1); 
    $pdf->SetY(156); 
    $pdf->SetX(285);
    $pdf->MultiCell(55,6,utf8_decode($row['categoriasespecificas']),1); 
    $pdf->SetY(156); 
    $pdf->SetX(340);
    $pdf->MultiCell(40,6,utf8_decode($row['marca_producto']),1); 
    $pdf->SetY(156); 
    $pdf->SetX(380);
    $pdf->MultiCell(40,6,utf8_decode($row['modelo_producto']),1); 
    $pdf->SetY(156); 
    $pdf->SetX(420);
    $pdf->MultiCell(40,6,utf8_decode($row['codigo_producto']),1); 
    $pdf->SetY(156); 
    $pdf->SetX(460);
    $pdf->MultiCell(30,6,utf8_decode($row['nombre_color']),1); 
    $pdf->SetY(156); 
    $pdf->SetX(490);
    $pdf->MultiCell(30,6,utf8_decode($row['serial']),1); 
    $pdf->SetY(156); 
    $pdf->SetX(520);
    $pdf->MultiCell(55,6,utf8_decode($row['nombre_despachos']),1); 
    $pdf->SetY(156); 
    $pdf->SetX(575);
    $pdf->MultiCell(40,6,utf8_decode($row['responsable_entrega']),1); 
    $pdf->SetY(156); 
    $pdf->SetX(615);
    $pdf->MultiCell(40,6,utf8_decode($row['precio_producto']),1); 
    $pdf->SetY(156); 
    $pdf->SetX(655);
    $pdf->MultiCell(55,6,utf8_decode($row['codigo_producto']),1); 
    $pdf->SetY(156); 
    $pdf->SetX(710);
    $pdf->MultiCell(40,6,utf8_decode($row['codigoi']),1); 
    $pdf->SetY(156); 
    $pdf->SetX(750); 
    $pdf->MultiCell(30,6,utf8_decode($row['nombre_condicion']),1); 
	}
	


	$pdf->Output();
?>