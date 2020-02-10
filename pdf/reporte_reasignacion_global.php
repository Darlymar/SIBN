<?php
  include('plantilla_reasignacion_global.php');
  require('conexion.php');

  $query = "SELECT nombre_despachos,nombrejd,cedulajd,rango 
            FROM despachos 
            ORDER BY nombre_despachos";
          

  $resultado = $mysqli->query($query);

  $pdf = new PDF('L', 'mm', array(500,600));
  $pdf->AliasNbPages();
  $pdf->AddPage();

  $pdf->SetFillColor(232,232,232);
  $pdf->SetFont('Arial','B',12);
  $pdf->SetY(75);
  $pdf->SetX(100);
  
  $pdf->Cell(200,6,utf8_decode('Nombre del Despacho'),1,0,'C',1);
  $pdf->Cell(50,6,utf8_decode('Cedula del Jefe'),1,0,'C',1);
  $pdf->Cell(80,6,utf8_decode('Nombre del Jefe'),1,0,'C',1);
  $pdf->Cell(60,6,utf8_decode('Rango'),1,1,'C',1);

  
  while ( $row = $resultado->fetch_assoc() )
  {
   $pdf->SetX(100);
   $pdf->Cell(200,6,utf8_decode($row['nombre_despachos']),1,0,'C',0);  
   $pdf->Cell(50,6,utf8_decode($row['cedulajd']),1,0,'C',0);
   $pdf->Cell(80,6,utf8_decode($row['nombrejd']),1,0,'C',0);
   $pdf->Cell(60,6,utf8_decode($row['rango']),1,1,'C',0);  


  }
  $pdf->SetY(395);
  $pdf->SetX(75);
  $pdf->Cell(375,10,utf8_decode('Haciendo constar que dichos activos se encuentran en óptimas condiciones físicas. Se levanta la presente acta y en señal de conformidad firma'),0,0,'R');
  $pdf->Ln(10);

  $pdf->Cell(355,10,utf8_decode('el funcionario receptor, quedando este responsable del uso, conservación y custodia de estos bienes:'),0,0,'R');
  $pdf->Ln(10);
 
  $pdf->SetY(420);
  $pdf->Cell(307,10,utf8_decode('Recibe Conforme'),0,0,'C');
  $pdf->Ln(10);

  $pdf->SetY(430);
  $pdf->SetX(145);
  $pdf->Cell(946,15,utf8_decode('Nombre y Apellido -------------------------------------------------------------------------------------'),0,0,'L');
  $pdf->Ln(30);

  $pdf->SetY(440);
  $pdf->SetX(147);
  $pdf->Cell(946,10,utf8_decode('C.I. ----------------------------------   Credencial ---------------------------------    Cargo -------------------------------------------------------------------------------------------------------------------------------------------------------------'),0,0,'L');
  $pdf->Ln(30);

  $pdf->SetY(450);
  $pdf->SetX(147);
  $pdf->Cell(946,10,utf8_decode('Firma -------------------------------------------------------------------------------------------------'),0,0,'L');
  $pdf->Ln(10);


  $pdf->SetY(460);
  $pdf->SetX(147);
  $pdf->Cell(846,10,utf8_decode('NOTA: ESTOS EQUIPOS NO PUEDEN SER INCLUIDOS EN SU INVENTARIO, YA QUE PERTENECEN A UN PROYECTO DE LA VICEPRESIDENCIA DE LA REPUBLICA. '),0,0,'L');



  $pdf->SetFont('Arial','',8);


  $pdf->Output();
?>

<?php
  include('plantilla_reasignacion_global.php');
  require('conexion.php');



  $resultado = $mysqli->query($query);

  $pdf = new PDF('L', 'mm', array(1000,500));
  $pdf->AliasNbPages();
  $pdf->AddPage();

  $pdf->SetFillColor(232,232,232);
  $pdf->SetFont('Arial','B',12);
  $pdf->SetX(100);
  $pdf->Cell(30,6,utf8_decode('Cod. Bien'),1,0,'C',1);
  $pdf->Cell(120,6,utf8_decode('Descripcion'),1,0,'C',1);
  $pdf->Cell(120,6,utf8_decode('Reasignado a'),1,0,'C',1);
  $pdf->Cell(35,6,utf8_decode('Precio Unitario'),1,0,'C',1);

  $pdf->Cell(30,6,utf8_decode(''),1,0,'C',0);
  $pdf->Cell(120,6,utf8_decode(''),1,0,'C',0);
  $pdf->Cell(120,6,utf8_decode(''),1,0,'C',0);
  $pdf->Cell(35,6,utf8_decode(''),1,0,'C',0);
 
  $pdf->SetFont('Arial','',8);
  $pdf->Output();
?>