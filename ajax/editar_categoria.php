<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['mod_id'])) {
           $errors[] = "ID vacío";
        }else if (empty($_POST['mod_nombre'])) {
		   $errors[] = "Nombre vacío";
		}else if (empty($_POST['rango'])) {
			$errors[] = "Rango vacío";

        }  else if (
			!empty($_POST['mod_id']) &&
			!empty($_POST['mod_nombre']) &&
			!empty($_POST['nombrejd']) &&
			!empty($_POST['rango'])


			
		){
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["mod_nombre"],ENT_QUOTES)));
		$nombrejd=mysqli_real_escape_string($con,(strip_tags($_POST["nombrejd"],ENT_QUOTES)));

		$cedulajd=mysqli_real_escape_string($con,(strip_tags($_POST["cedulajd"],ENT_QUOTES)));
		$rango=mysqli_real_escape_string($con,(strip_tags($_POST["rango"],ENT_QUOTES)));
		
		$id_despachos=intval($_POST['mod_id']);
		$sql="UPDATE despachos SET nombre_despachos='".$nombre."', nombrejd='".$nombrejd."', cedulajd='".$cedulajd."',  rango='".$rango."' WHERE id_despachos='".$id_despachos."'";
		$query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "Categoría ha sido actualizada satisfactoriamente.";
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