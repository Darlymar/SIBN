<?php
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
		
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['serial'])) {
    $errors[] = "Serial del producto vacío";
              
		} else if (empty($_POST['codigo'])){
		$errors[] = "Codigo del producto vacío";  

		} else if (empty($_POST['nombre'])){
		$errors[] = "Nombre del producto vacío";

		} else if (empty($_POST['marca'])){
		$errors[] = "Marca del producto vacío";	

		} else if (empty($_POST['modelo'])){
		$errors[] = "Modelo del producto vacío";

		} else if (empty($_POST['numero'])){
		$errors[] = "Número de bien del producto vacío";

		} else if (empty($_POST['condicion'])){
		$errors[] = "Condición del producto vacío";
	

	} else if (empty($_POST['color'])){
		$errors[] = "Color del inventario vacío";	

		} else if (empty($_POST['responsable'])){
		$errors[] = "Responsable del producto vacío";

		} else if (empty($_POST['concepto'])){
		$errors[] = "Concepto del inventario vacío";

		} else if ($_POST['stock']==""){
		$errors[] = "Stock del producto vacío";

		} else if (empty($_POST['precio'])){
		$errors[] = "Precio de venta vacío";

		} else if (
		!empty($_POST['serial']) &&
		!empty($_POST['codigo']) &&
		!empty($_POST['codigoi']) &&
		!empty($_POST['nombre']) &&
		!empty($_POST['marca']) &&
		!empty($_POST['modelo']) &&
		!empty($_POST['numero']) &&
		!empty($_POST['condicion']) &&
		!empty($_POST['responsable']) &&
		!empty($_POST['concepto']) &&
		$_POST['stock']!="" &&
		!empty($_POST['precio']) 
){

if (isset($_FILES["file"]))																							 
{																													 	
   $mensaje = null;																									 
    //  for($x=0; $x<count($_FILES["file"]["name"]); $x++)																 
    // {
        $file = $_FILES["file"];// nombre del input type file de la imagen
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
        else if($size > 8192*8192)
        {
            $mensaje .= "<p style='color: red'>Error $nombre_foto, el tamaño máximo permitido es 8mb</p>";
        }
        else if($width > 10000 || $height > 10000)
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

		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		include("../funciones.php");

		// escaping, additionally removing everything that could be (html/javascript-) code

		$serial=mysqli_real_escape_string($con,(strip_tags($_POST["serial"],ENT_QUOTES)));
		$codigo=mysqli_real_escape_string($con,(strip_tags($_POST["codigo"],ENT_QUOTES)));
		$codigoi=mysqli_real_escape_string($con,(strip_tags($_POST['codigoi'],ENT_QUOTES)));
		$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));
		$marca=mysqli_real_escape_string($con,(strip_tags($_POST["marca"],ENT_QUOTES)));
		$modelo=mysqli_real_escape_string($con,(strip_tags($_POST["modelo"],ENT_QUOTES)));
		$numero=mysqli_real_escape_string($con,(strip_tags($_POST["numero"],ENT_QUOTES)));
		$stock=intval($_POST['stock']);
		$id_despachos=intval($_POST['despachos']);
		$id_categorias=intval($_POST['categorias']);
		$id_categoriasespecificas=intval($_POST['categoriasespecificas']);
		$id_subcategorias=intval($_POST['subcategorias']);
		// $id_area=intval($_POST['area']);
		$condicion=mysqli_real_escape_string($con,(strip_tags($_POST["condicion"],ENT_QUOTES)));
		$motivo=intval($_POST['motivo']);
		$color=intval($_POST['color']);
		$responsable=mysqli_real_escape_string($con,(strip_tags($_POST["responsable"],ENT_QUOTES)));
		
		$concepto=mysqli_real_escape_string($con,(strip_tags($_POST["concepto"],ENT_QUOTES)));
		// $id_rango=intval($_POST['rango']);
		// $id_cargo=intval($_POST['cargo']);
		$precio_venta=floatval($_POST['precio']);
		$fecha=date("Y-m-d H:i:s");


		 $sql="INSERT INTO products ( serial, codigo_producto, nombre_producto, marca_producto, modelo_producto, numero_bien, fecha_products, precio_producto, stock, id_categorias, id_categoriasespecificas, id_subcategorias, id_despachos, id_condicion, id_motivo, id_color, responsable_entrega, concepto_inventario, codigoi, foto) VALUES ('$serial','$codigo','$nombre','$marca','$modelo','$numero','$fecha','$precio_venta', '$stock','$id_categorias','$id_categoriasespecificas','$id_subcategorias','$id_despachos','$condicion','$motivo','$color','$responsable','$concepto', '$codigoi', '$nombre_foto')";




		// $sql="INSERT INTO products (foto) VALUES ('$nombre_foto')";

		 $query_new_insert = mysqli_query($con,$sql);
			


			if ($query_new_insert){
				$messages[] = "Producto ha sido ingresado satisfactoriamente.";
				$id_producto=get_row('products','id_producto', 'serial', $serial);
				$user_id=$_SESSION['user_id'];
				$firstname=$_SESSION['firstname'];
				$nota="$firstname agregó $stock producto(s) al inventario";
				echo guardar_historial($id_producto,$user_id,$fecha,$nota,$codigo,$stock);
				
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			}
		} 
		   else {
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