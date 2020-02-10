<?php

$categoriasespecificas = $_POST['subcategorias'];
$conexion = mysqli_connect("127.0.0.1","root","","bd_sibn");
$conexion->set_charset('utf8');
$query = $conexion->query("SELECT * FROM categoriasespecificas WHERE id_subcategorias = $categoriasespecificas");

?>