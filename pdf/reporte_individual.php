<?php
  extract($_GET);
  include('plantilla_individual.php');
  require('conexion.php');
  
    $id_pro = $_GET['id_producto'];
    $query = "SELECT * FROM products
    INNER JOIN categorias on products.id_categorias = categorias.id_categorias
    INNER JOIN subcategorias on products.id_subcategorias = subcategorias.id_subcategorias
    INNER JOIN categoriasespecificas on products.id_categoriasespecificas = categoriasespecificas.id_categoriasespecificas
    INNER JOIN color on products.id_color = color.id_color
    INNER JOIN despachos on products.id_despachos = despachos.id_despachos
    INNER JOIN condicion on products.id_condicion = condicion.id_condicion
    WHERE id_producto = $id_pro"; 

       

  $resultado = $mysqli->query($query);
  $pdf = new PDF();
  $pdf->AliasNbPages();
  $pdf->AddPage();


  $pdf->SetFillColor(232,232,232);
  $pdf->SetFont('Arial','B',12);
  
  $pdf->SetY(117);
  $pdf->SetX(14);
  $pdf->Cell(47,6,utf8_decode('Fecha del Registro'),1,0,'C',1);
  $pdf->Cell(32,6,utf8_decode('Cantidad'),1,0,'C',1);
  $pdf->Cell(42,6,utf8_decode('N° de Bien'),1,0,'C',1);
  $pdf->Cell(62,6,utf8_decode('Especificaciones Técnicas'),1,0,'C',1);

  $pdf->SetY(135);
  $pdf->SetX(14);
  $pdf->Cell(65,6,utf8_decode('Categorias'),1,0,'C',1);
  $pdf->Cell(65,6,utf8_decode('Sub-Categorias'),1,0,'C',1);
  $pdf->Cell(54,6,utf8_decode('Categorias Especificas'),1,0,'C',1);

  $pdf->SetY(168);
  $pdf->SetX(14);
  $pdf->Cell(40,6,utf8_decode('Marca'),1,0,'C',1);
  $pdf->Cell(40,6,utf8_decode('Modelo'),1,0,'C',1);
  $pdf->Cell(40,6,utf8_decode('Cod. Productos'),1,0,'C',1);
  $pdf->Cell(30,6,utf8_decode('Color'),1,0,'C',1);
  $pdf->Cell(35,6,utf8_decode('N° Serial'),1,0,'C',1);

  $pdf->SetY(190);
  $pdf->SetX(14);
  $pdf->Cell(54,6,utf8_decode('Ubicación del Bien'),1,0,'C',1);
  $pdf->Cell(39,6,utf8_decode('Incorporación'),1,0,'C',1);
  $pdf->Cell(39,6,utf8_decode('Valor de Adquisión'),1,0,'C',1);
  $pdf->Cell(54,6,utf8_decode('Depreciación Acumulada'),1,0,'C',1);

  $pdf->SetY(220);
  $pdf->SetX(14);
  $pdf->Cell(85,6,utf8_decode('Otras Especificaciones Tecnicas'),1,0,'C',1);
  $pdf->Cell(55,6,utf8_decode('Valor Contable'),1,0,'C',1);
  $pdf->Cell(45,6,utf8_decode('Condición'),1,0,'C',1);
  
  $pdf->Ln(6);
  while ( $row = $resultado->fetch_assoc() )
  {

// Aqui empieza el 1 modulo

    $pdf->SetY(123);  
    $pdf->SetX(14);
    $pdf->MultiCell(47,6,utf8_decode($row['fecha_products']),1);

    $pdf->SetY(123);  
    $pdf->SetX(61);
    $pdf->MultiCell(32,6,utf8_decode($row['stock']),1);

    $pdf->SetY(123);  
    $pdf->SetX(93);
    $pdf->MultiCell(42,6,utf8_decode($row['numero_bien']),1);

    $pdf->SetY(123);  
    $pdf->SetX(135);
    $pdf->MultiCell(62,6,utf8_decode($row['nombre_producto']),1);

// Aqui termina el 1 modulo

// Aqui empieza el 2 modulo

    $pdf->SetY(141);  
    $pdf->SetX(14);
    $pdf->MultiCell(65,6,utf8_decode($row['categorias']),1);

    $pdf->SetY(141); 
    $pdf->SetX(79);
    $pdf->MultiCell(65,6,utf8_decode($row['subcategorias']),1); 

    $pdf->SetY(141); 
    $pdf->SetX(144);
    $pdf->MultiCell(54,6,utf8_decode($row['categoriasespecificas']),1); 

// Aqui termina el 2 modulo

// Aqui empieza el 3 modulo

    $pdf->SetY(174); 
    $pdf->SetX(14);
    $pdf->MultiCell(40,6,utf8_decode($row['marca_producto']),1); 

    $pdf->SetY(174); 
    $pdf->SetX(54);
    $pdf->MultiCell(40,6,utf8_decode($row['modelo_producto']),1); 

    $pdf->SetY(174); 
    $pdf->SetX(94);
    $pdf->MultiCell(40,6,utf8_decode($row['codigo_producto']),1); 

    $pdf->SetY(174); 
    $pdf->SetX(134);
    $pdf->MultiCell(30,6,utf8_decode($row['nombre_color']),1); 

    $pdf->SetY(174); 
    $pdf->SetX(164);
    $pdf->MultiCell(35,6,utf8_decode($row['serial']),1); 

// Aqui termina el 3 modulo

// Aqui empieza el 4 modulo

    $pdf->SetY(196); 
    $pdf->SetX(14);
    $pdf->MultiCell(54,6,utf8_decode($row['nombre_despachos']),1); 

    $pdf->SetY(196); 
    $pdf->SetX(68);
    $pdf->MultiCell(39,6,utf8_decode($row['responsable_entrega']),1); 

    $pdf->SetY(196); 
    $pdf->SetX(107);
    $pdf->MultiCell(39,6,utf8_decode($row['precio_producto']),1); 

    $pdf->SetY(196); 
    $pdf->SetX(146);
    $pdf->MultiCell(54,6,utf8_decode($row['precio_producto']),1); 

    // Aqui termina el 4 modulo

// Aqui empieza el 5 modulo

    $pdf->SetY(226); 
    $pdf->SetX(14);
    $pdf->MultiCell(85,6,utf8_decode($row['concepto_inventario']),1); 

    $pdf->SetY(226); 
    $pdf->SetX(99);
    $pdf->MultiCell(55,6,utf8_decode($row['codigoi']),1); 

    $pdf->SetY(226); 
    $pdf->SetX(154); 
    $pdf->MultiCell(45,6,utf8_decode($row['nombre_condicion']),1); 

    // Aqui termina el 5 modulo   

  $pdf->SetY(70);
  $pdf->SetX(85);
  $pdf->Cell(45,45, $pdf->Image('../img/'.$row['foto'], $pdf->getx(), $pdf->GetY(),45,45),1); 
  }
  $pdf->SetFont('Arial','',8);


 

  $pdf->Output();

?>