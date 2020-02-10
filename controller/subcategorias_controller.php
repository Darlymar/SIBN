<?php

require_once '../model/subcategorias.php';

echo '<option value="0">Seleccione</option>';

while ( $row = $query->fetch_assoc() )
{
	echo '<option value="' . $row['id_subcategorias']. '">' . $row['subcategorias'] . '</option>' . "\n";
}