<?php

    $ar=fopen("archivo.txt" , "a") or die ("hay un error");

    $cantidad=$_REQUEST['stock'];
    $num_bien=$_REQUEST['numero'];
    $espec_tec=$_REQUEST['nombre'];
	$otras_espec_tec=$_REQUEST['concepto'];
	$categoria=$_REQUEST['estado'];
	$sub_cat=$_REQUEST['subcategoria'];
	$marca=$_REQUEST['marca'];
	$modelo=$_REQUEST['modelo'];
	$color=$_REQUEST['motivo'];
	$num_serial=$_REQUEST['serial'];
	$ubic_bien=$_REQUEST['despachos'];
	$incorporacion=$_REQUEST['responsable'];
	$valor_adq=$_REQUEST['precio'];
	$drep_acum=$_REQUEST['codigo'];
	$valor_cont=$_REQUEST['codigoi'];
	$condicion=$_REQUEST['condicion'];
	
    fwrite($ar , $cantidad);
    fwrite($ar , "\n");
    fwrite($ar , $num_bien);
    fwrite($ar , "\n");
    fwrite($ar , $espec_tec);
    fwrite($ar , "\n");
	fwrite($ar , $otras_espec_tec);
    fwrite($ar , "\n");
    fwrite($ar , $categoria);
    fwrite($ar , "\n");
	fwrite($ar , $sub_cat);
    fwrite($ar , "\n");
	fwrite($ar , $marca);
    fwrite($ar , "\n");
	fwrite($ar , $modelo);
    fwrite($ar , "\n");
	fwrite($ar , $color);
    fwrite($ar , "\n");
	fwrite($ar , $num_serial);
    fwrite($ar , "\n");
	fwrite($ar , $ubic_bien);
    fwrite($ar , "\n");
	fwrite($ar , $incorporacion);
    fwrite($ar , "\n");
	fwrite($ar , $valor_adq);
    fwrite($ar , "\n");
	fwrite($ar , $drep_acum);
    fwrite($ar , "\n");
	fwrite($ar , $valor_cont);
    fwrite($ar , "\n");
	fwrite($ar , $condicion);
    fwrite($ar , "\n");
	echo "se logro";
?>