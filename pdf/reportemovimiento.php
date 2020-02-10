<?php
  include('plantilla_reasignacion_global.php');
  require('conexion.php');

  $query = "SELECT * FROM products
  INNER JOIN categorias on products.id_categorias = categorias.id_categorias
  INNER JOIN subcategorias on products.id_subcategorias = subcategorias.id_subcategorias
  INNER JOIN categoriasespecificas on products.id_categoriasespecificas = categoriasespecificas.id_categoriasespecificas
  INNER JOIN color on products.id_color = color.id_color
  INNER JOIN despachos on products.id_despachos = despachos.id_despachos
  INNER JOIN condicion on products.id_condicion = condicion.id_condicion
  INNER JOIN motivo on products.id_motivo = motivo.id_motivo
";
          

  $resultado = $mysqli->query($query);

  $pdf = new PDF('L', 'mm', array(1100,500));
  $pdf->AliasNbPages();
  $pdf->AddPage();

  $pdf->SetFillColor(232,232,232);
  $pdf->SetFont('Arial','B',12);
  $pdf->SetY(150);
  $pdf->SetX(30);
  
  $pdf->Cell(20,8,'Cantidad',1,0,'C',1);
  $pdf->Cell(35,8,'Motivo',1,0,'C',1);
  $pdf->Cell(35,8,utf8_decode('N° Bien'),1,0,'C',1);
  $pdf->Cell(58,8,utf8_decode('Especificaciones Técnicas'),1,0,'C',1);
  $pdf->Cell(68,8,utf8_decode('Otras Especificaciones Técnicas'),1,0,'C',1);
  $pdf->Cell(120,8,utf8_decode('Categoria General'),1,0,'C',1);
  $pdf->Cell(140,8,'Sub-Categorias',1,0,'C',1);
  $pdf->Cell(70,8,utf8_decode('Categorias Especificas'),1,0,'C',1);
  $pdf->Cell(45,8,utf8_decode('Marca'),1,0,'C',1);
  $pdf->Cell(45,8,utf8_decode('Modelo'),1,0,'C',1);
  $pdf->Cell(30,8,utf8_decode('Color'),1,0,'C',1);
  $pdf->Cell(35,8,utf8_decode('N° Serial'),1,0,'C',1);
  $pdf->Cell(130,8,utf8_decode('Ubicacion del Bien '),1,0,'C',1);
  $pdf->Cell(40,8,utf8_decode('Incorporación'),1,0,'C',1);
  $pdf->Cell(45,8,utf8_decode('Valor de Adquisición'),1,0,'C',1);
  $pdf->Cell(53,8,utf8_decode('Depreciación Acumulada'),1,0,'C',1);
  $pdf->Cell(45,8,utf8_decode('Valor Contable'),1,0,'C',1);
  $pdf->Cell(45,8,'Condicion',1,1,'C',1);

  
  while ( $row = $resultado->fetch_assoc() )
  {

  $pdf->SetX(30);
  $pdf->Cell(20,8,utf8_decode($row['stock']),1,0,'C',0);
  $pdf->Cell(35,8,utf8_decode($row['nombre_motivo']),1,0,'C',0);
	$pdf->Cell(35,8,utf8_decode($row['numero_bien']),1,0,'C',0);
	$pdf->Cell(58,8,utf8_decode($row['nombre_producto']),1,0,'C',0);
	$pdf->Cell(68,8,utf8_decode($row['concepto_inventario']),1,0,'C',0);
	$pdf->Cell(120,8,utf8_decode($row['categorias']),1,0,'C',0);
	$pdf->Cell(140,8,utf8_decode($row['subcategorias']),1,0,'C',0);
	$pdf->Cell(70,8,utf8_decode($row['categoriasespecificas']),1,0,'C',0);
	$pdf->Cell(45,8,utf8_decode($row['marca_producto']),1,0,'C',0);
	$pdf->Cell(45,8,utf8_decode($row['modelo_producto']),1,0,'C',0);
	$pdf->Cell(30,8,utf8_decode($row['nombre_color']),1,0,'C',0);
	$pdf->Cell(35,8,utf8_decode($row['serial']),1,0,'C',0);
	$pdf->Cell(130,8,utf8_decode($row['nombre_despachos']),1,0,'C',0);
	$pdf->Cell(40,8,utf8_decode($row['responsable_entrega']),1,0,'C',0);
	$pdf->Cell(45,8,utf8_decode($row['precio_producto']),1,0,'C',0);
	$pdf->Cell(53,8,utf8_decode($row['codigo_producto']),1,0,'C',0);
	$pdf->Cell(45,8,utf8_decode($row['codigoi']),1,0,'C',0);
	$pdf->Cell(45,8,utf8_decode($row['nombre_condicion']),1,1,'C',0);

  }
 

  $pdf->Output();
?>
