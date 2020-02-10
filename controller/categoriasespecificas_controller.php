<?php

require_once '../model/categoriasespecificas.php';

echo '<option value="0">Seleccione</option>';

while ( $row = $query->fetch_assoc() )
{
	echo '<option value="' . $row['id_categoriasespecificas']. '">' . $row['categoriasespecificas'] . '</option>' . "\n";
}

 