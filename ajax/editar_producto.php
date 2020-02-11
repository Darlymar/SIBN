<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado

	/*Inicia validacion del lado del servidor*/
		if (empty($_POST['mod_id'])) {
		$errors[] = "ID vacío";

		}else if (empty($_POST['mod_numero'])){
		$errors[] = "Campo numero de producto vacío";

		}else if (empty($_POST['mod_codigo'])){
		$errors[] = "Campo código de producto vacío";

		} else if (empty($_POST['mod_nombre'])){
		$errors[] = "Campo nombre del producto vacío";

		} else if (empty($_POST['mod_concepto'])){
        $errors[] = "Campo concepto vacío";
        
		} else if(empty($_POST['mod_marca'])){
		$errors[] = "Campo marca vacío";

		} else if(empty($_POST['mod_modelo'])){
		$errors[] = "Campo modelo vacío"; 

		} else if(empty($_POST['mod_color'])){
        $errors[] = "Campo color vacio";
        
        } else if(empty($_POST['mod_serial'])){
		$errors[] = "Campo serial vacío";

		} else if(empty($_POST['mod_responsable'])){
        $errors[] = "Campo Recibido por vacío";
        
        } else if (empty($_POST['mod_precio'])){
        $errors[] = "Campo precio de venta vacío";
        
        }else if (empty($_POST['mod_codigo'])){
		$errors[] = "Campo código de producto vacío";

		} else if (empty($_POST['mod_codigoi'])){
        $errors[] = "Campo código de inventario vacío";
        
        } else if(empty($_POST['mod_condicion'])){
		$errors[] = "Campo condicion vacio";

		} else if (
		!empty($_POST['mod_id']) &&
		!empty($_POST['mod_codigo']) &&
		!empty($_POST['mod_nombre']) &&
        !empty($_POST['mod_concepto']) &&
		!empty($_POST['mod_marca']) &&
		$_POST['mod_despachos']!="" &&
		!empty($_POST['mod_modelo']) &&
		!empty($_POST['mod_color']) &&
		!empty($_POST['mod_serial']) &&
		!empty($_POST['mod_responsable']) &&
        !empty($_POST['mod_precio']) &&
		!empty($_POST['mod_codigo']) &&
		!empty($_POST['mod_condicion']) &&
        !empty($_POST['mod_codigoi'])

		){

//**//
if (isset($_FILES["mod_imagen"]))																							 
{																													 	
   $mensaje = null;																									 
    //  for($x=0; $x<count($_FILES["file"]["name"]); $x++)																 
    // {
        $file = $_FILES["mod_imagen"];// nombre del input type file de la imagen
        $nombre_foto = $file["name"];// captura el nombre de la imagen como tal 
        $tipo = $file["type"]; //indica el tipo de imagen
        $ruta_provisional = $file["tmp_name"]; // carpeta temporal donde se guardará la imagen 
        $size = $file["size"]; // indica tamaño de imagen
        $dimensiones = getimagesize($ruta_provisional); // devuelve el tamaño de la imagen
        $width = $dimensiones[0];
        $height = $dimensiones[1];
		$carpeta = "../img/";
        
		if ($tipo != 'image/jpeg' && $tipo != 'image/jpg' && $tipo != 'image/png' && $tipo != 'image/gif')
        {
            $mensaje .= "<p style='color: red'>Error $nombre_foto, el archivo no es una imagen.</p>";
        }
        else if($size > 1024*1024)
        {
            $mensaje .= "<p style='color: red'>Error $nombre_foto, el tamaño máximo permitido es 1mb</p>";
        }
        else if($width > 3500 || $height > 3500)
        {
            $mensaje .= "<p style='color: red'>Error $nombre_foto, la anchura y la altura máxima permitida es de 3500px</p>";
        }
        else if($width < 100 || $height < 100)
        {
            $mensaje .= "<p style='color: red'>Error $nombre_foto, la anchura y la altura mínima permitida es de 100px</p>";
        }
        else																																
        {																															
            $src = $carpeta.$nombre_foto;																		
            move_uploaded_file($ruta_provisional, $src);
            // echo "<p style='color: blue'>La imagen $nombre_foto ha sido subida con éxito</p>";											
        }																															
    //}																																	
        echo $mensaje;																													
}

//**//

		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos

		// escaping, additionally removing everything that could be (html/javascript-) code
		$codigo=mysqli_real_escape_string($con,(strip_tags($_POST["mod_codigo"],ENT_QUOTES)));
		$numero=mysqli_real_escape_string($con,(strip_tags($_POST["mod_numero"],ENT_QUOTES)));
		$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["mod_nombre"],ENT_QUOTES)));
		$conc=mysqli_real_escape_string($con,(strip_tags($_POST['mod_concepto'], ENT_QUOTES)));
		$marca=mysqli_real_escape_string($con,(strip_tags($_POST['mod_marca'],ENT_QUOTES)));
		$modelo=mysqli_real_escape_string($con,(strip_tags($_POST['mod_modelo'],ENT_QUOTES)));
        $color=mysqli_real_escape_string($con,(strip_tags($_POST["mod_color"],ENT_QUOTES)));
        $serial=mysqli_real_escape_string($con,(strip_tags($_POST["mod_serial"],ENT_QUOTES)));
		$despachos=intval($_POST['mod_despachos']);
		$resp=mysqli_real_escape_string($con,(strip_tags($_POST['mod_responsable'], ENT_QUOTES)));
        $precio_venta=floatval($_POST['mod_precio']);
		$codigo=mysqli_real_escape_string($con,(strip_tags($_POST["mod_codigo"],ENT_QUOTES)));
		$condicion=mysqli_real_escape_string($con,(strip_tags($_POST["mod_condicion"],ENT_QUOTES)));
        $codigoi=mysqli_real_escape_string($con,(strip_tags($_POST["mod_codigoi"],ENT_QUOTES)));
		
		$id_producto=$_POST['mod_id'];


		//Query de actualizacion de datos
		$sql="UPDATE products SET codigo_producto='".$codigo."', nombre_producto='".$nombre."', numero_bien='".$numero."', marca_producto='".$marca."', modelo_producto='".$modelo."', concepto_inventario='".$conc."', id_color='".$color."', serial='".$serial."', id_despachos='".$despachos."', responsable_entrega='".$resp."', precio_producto='".$precio_venta."', codigo_producto='".$codigo."', codigoi='".$codigoi."', id_condicion='".$condicion."', foto='".$nombre_foto."' WHERE id_producto='".$id_producto."'";
		
		$query_update = mysqli_query($con,$sql);
		print_r($sql);

			if ($query_update){
				$messages[] = "Producto ha sido actualizado satisfactoriamente.";
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