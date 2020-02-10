<?php

require_once '../model/categorias.php';

echo '<option value="0">Seleccione</option>';

while ( $row = $query->fetch_assoc() )
{
	echo '<option value="'. $row['id_categorias'] . '">' . $row['categorias'] . '</option>' . "\n";
}
