<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['nombre'])) {
		   $errors[] = "Nombre vacío";

		} else if (empty($_POST['nombrejd'])){
			$errors[] = "Nombre del jefe del producto vacío"; 
			
		} else if (empty($_POST['cedulajd'])){
			$errors[] = "Cedula del producto vacío";  	
			
		} else if (empty($_POST['rango'])){
			$errors[] = "Rango del producto vacío";  

        } else if (!empty($_POST['nombre'])){
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));
		$nombrejd=mysqli_real_escape_string($con,(strip_tags($_POST["nombrejd"],ENT_QUOTES)));
		$cedulajd=mysqli_real_escape_string($con,(strip_tags($_POST["cedulajd"],ENT_QUOTES)));
		$rango=mysqli_real_escape_string($con,(strip_tags($_POST["rango"],ENT_QUOTES)));


		$fecha=date("Y-m-d H:i:s");
		$sql="INSERT INTO despachos (nombre_despachos, fecha_despachos, nombrejd, cedulajd, rango) VALUES ('$nombre','$fecha','$nombrejd','$cedulajd','$rango')";
		$query_new_insert = mysqli_query($con,$sql);
			if ($query_new_insert){
				$messages[] = "El Despacho ha sido ingresado satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			}
		} else {
			$errors []= "Error desconocido.";
		}
		
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>