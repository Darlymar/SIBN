<?php
$mysqli = new mysqli("localhost", "root", "", "bd_sibn");

if(mysqli_connect_errno()){
	echo "Conexion fallida :", mysqli_connect_error();
	exit();
}
?>