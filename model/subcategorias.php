<?php

$categorias = $_POST['categorias'];
$conexion = mysqli_connect("127.0.0.1","root","","bd_sibn");
$conexion->set_charset('utf8');
$query = $conexion->query("SELECT * FROM subcategorias WHERE id_categorias = $categorias");

?>