<?php
	/*-------------------------
	Autor: Darly Martinez
	Mail: darlynmartinezb@gmail.com
	---------------------------*/
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }

	/* Connect To Database*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
	include("funciones.php");
	
	$active_productos="active";
	$active_clientes="";
	$active_usuarios="";	
	$title="Productos | SIBN";
	
	if (isset($_POST['reference']) and isset($_POST['quantity'])){
			$quantity=intval($_POST['quantity']);
			$reference=mysqli_real_escape_string($con,(strip_tags($_POST["reference"],ENT_QUOTES)));
			$id_producto=intval($_GET['id']);
			$user_id=$_SESSION['user_id'];
			$firstname=$_SESSION['firstname'];
			$nota="$firstname agregó $quantity producto(s) al inventario";
			$fecha=date("Y-m-d H:i:s");
			guardar_historial($id_producto,$user_id,$fecha,$nota,$reference,$quantity);
			$update=agregar_stock($id_producto,$quantity);
		if ($update==1){
			$message=1;
		} else {
			$error=1;
		}
	}
	
	if (isset($_POST['reference_remove']) and isset($_POST['quantity_remove'])){
			$quantity=intval($_POST['quantity_remove']);
			$reference=mysqli_real_escape_string($con,(strip_tags($_POST["reference_remove"],ENT_QUOTES)));
			$id_producto=intval($_GET['id']);
			$user_id=$_SESSION['user_id'];
			$firstname=$_SESSION['firstname'];
			$nota="$firstname eliminó $quantity producto(s) del inventario";
			$fecha=date("Y-m-d H:i:s");
			guardar_historial($id_producto,$user_id,$fecha,$nota,$reference,$quantity);
			$update=eliminar_stock($id_producto,$quantity);
		if ($update==1){
			$message=1;
		} else {
			$error=1;
		}
	}
	// Este es el SELECT de la tabla que muestra la informacion anteriormente guardada por el form de agregar productos 
	if (isset($_GET['id'])){
		$id_producto=intval($_GET['id']);
		// $query=mysqli_query($con,"select * from products where id_producto='$id_producto'");
		$query=mysqli_query($con,"SELECT * FROM products
									 INNER JOIN categorias on products.id_categorias = categorias.id_categorias
									 INNER JOIN subcategorias on products.id_subcategorias = subcategorias.id_subcategorias
									 INNER JOIN categoriasespecificas on products.id_categoriasespecificas = categoriasespecificas.id_categoriasespecificas
									 INNER JOIN despachos on products.id_despachos = despachos.id_despachos
									 INNER JOIN condicion on products.id_condicion = condicion.id_condicion
									 INNER JOIN color on products.id_color = color.id_color
									 WHERE id_producto = '$id_producto'");


		$row=mysqli_fetch_array($query);
		$ruta_img=$row['foto'];
	} else {
		die("Producto no existe");
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include("head.php");?>
  </head>
  <body>
	<?php
	include("navbar.php");
	include("modal/agregar_stock.php");
	include("modal/eliminar_stock.php");
	include("modal/editar_productos.php");
	?>
	
	<div class="container">

<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-body">
<div class="row">
<div class="col-sm-4 col-sm-offset-2 text-center">
	<img class="item-img img-responsive" src="img/<?php echo $ruta_img; ?>" alt=""> 
		<br>

<div class="form-group">
<div class="col-sm-2">
	<a href="#" class="btn btn-danger" onclick="eliminar('<?php echo $row['id_producto'];?>')" title="Eliminar"> <i class="glyphicon glyphicon-trash"></i> Eliminar </a>
</div>

<div class="col-sm-8">
	<a href="#myModal2" data-toggle="modal" data-codigo='<?php echo $row['codigo_producto'];?>' data-nombre='<?php echo $row['nombre_producto'];?>' data-categorias='<?php echo $row['id_categorias']?>' data-despachos='<?php echo $row['id_despachos']?>' data-precio='<?php echo $row['precio_producto']?>' data-stock='<?php echo $row['stock'];?>' data-serial='<?php echo $row['serial'];?>' data-numero='<?php echo $row['numero_bien'];?>' data-color='<?php echo $row['id_color'];?>'data-marca='<?php echo $row['marca_producto'];?>' data-modelo='<?php echo $row['modelo_producto'];?>' data-cond='<?php echo $row["id_condicion"];?>' data-resp='<?php echo $row["responsable_entrega"];?>' data-codigoi='<?php echo $row["codigoi"];?>' data-conc='<?php echo $row['concepto_inventario'] ?>' data-codi='<?php echo $row['codigo_inventario'];?>' data-img='<?php echo $row['foto'];?>' data-id='<?php echo $row['id_producto'];?>'  class="btn btn-info" title="Editar"> <i class="glyphicon glyphicon-pencil"></i> Editar  </a>
</div>

<div class=" col-sm-4" style="bottom: 34px;left: 220px;">
	<a href="pdf/reporte_individual.php?id_producto=<?php echo $row['id_producto'];?>" class="btn btn-primary"  
	title= "imprimir"> <i class="glyphicon  glyphicon-print"></i> Reporte  </a>
</div>
				  
</div>
<br><br>
<br>
</div>
			  
<div class="col-sm-4 col-md-5 col-xs-6 text-left">
<div class="row margin-btm-20">
	<table class='table table-bordered'>
		<tr><th class='text-center' colspan=10 >DATOS DEL PRODUCTO</th></tr>

			<tr><td><span class="current-stock">Fecha de Registro</td><td><?php echo $row['fecha_products'];?></span></td></tr>

				<tr><td><span class="current-stock"> Cantidad</span></td><td><?php echo number_format($row['stock']);?></span> Disponible </td></tr>

					<tr><td><span class="current-stock">N° de Bien</td><td><?php echo $row['numero_bien'];?></span> </td></tr>

						<tr><td><span class="current-stock">Especificaciones Técnicas</td><td><?php echo $row['nombre_producto'];?></span></td></tr>

							<tr><td><span class="current-stock">Otras Especificaciones Técnicas</td><td><?php echo $row['concepto_inventario'];?></span> </td></tr>

								<tr><td><span class="current-stock">Categorías</td><td><?php echo $row['categorias'];?></span></td></tr>

									<tr><td><span class="current-stock">Sub-Categorías</td><td><?php echo $row['subcategorias'];?></span></td></tr>

										<tr><td><span class="current-stock">Categorías Especificas</td><td><?php echo $row['categoriasespecificas'];?></span></td></tr>

											<tr><td><span class="current-stock">Marca</td><td><?php echo $row['marca_producto'];?></span></td></tr>

												<tr><td><span class="current-stock">Modelo</td><td><?php echo $row['modelo_producto'];?></span></td></tr>

													<tr><td><span class="current-stock">Cod. Productos</td><td><?php echo $row['codigo_producto'];?></span> </td></tr>

														<tr><td><span class="current-stock">Color</td><td><?php echo $row['nombre_color'];?></span> </td></tr>

															<tr><td><span class="current-stock">N° Serial</td><td><?php echo $row['serial'];?></span> </td></tr>

																<tr><td><span class="current-stock">Ubicación del Bien</td><td><?php echo $row['nombre_despachos'];?></span></td></tr>

																	<tr><td><span class="current-stock">Incorporación</td><td><?php echo $row['responsable_entrega'];?></span> </td></tr>

																		<tr><td><span class="current-stock">Valor de Adquisión</span></td><td>BsF.<?php echo number_format($row['precio_producto']);?></span></td></tr>

																			<tr><td><span class="current-stock">Depreciación Acumulada</td><td><?php echo $row['codigo_producto'];?></span> </td></tr>

																				<tr><td><span class="current-stock">Valor Contable</span></td><td>BsF.<?php echo number_format($row['codigoi']);?></span></td></tr>

																					<tr><td><span class="current-stock">Condición</td><td><?php echo $row['nombre_condicion'];?></span> </td></tr>
					

	
	</table>
</div>
</div>

<div class="col-sm-12 margin-btm-10"></div>
<div class="col-sm-8 col-sm-offset-2 text-left">
<div class="row">
    <?php
		if (isset($message)){
	?>
<div class="alert alert-success alert-dismissible" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<strong>Aviso!</strong> Datos procesados exitosamente.
</div>	
	<?php
		}
			if (isset($error)){
	?>
<div class="alert alert-danger alert-dismissible" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<strong>Error!</strong> No se pudo procesar los datos.
</div>	
	<?php
		}
	?>	

</div>
</div>
</div>
</div>
</div>
<br>
</div>
</div>
</div>
</div>
</div>

	<?php
	include("footer.php");
	?>

	<script type="text/javascript" src="js/productos.js"></script>
	<script src="assets/js/style.js"></script>
	
	
  </body>
</html>
<script>
  $( "#editar_producto" ).submit(function( event ) {
  $('#actualizar_datos').attr("disabled", true);
  
 //var formulario = $(this).serialize();
 var ruta = "ajax/editar_producto.php";
 var formData = new FormData($("#editar_producto")[0]);
	 $.ajax({
			type: "POST",
			url: ruta,
			data: formData,
			contentType: false, // agregado y se coloco en false
            processData: false, // agregado y se coloco en false
			 beforeSend: function(objeto){
				$("#resultados_ajax2").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados_ajax2").html(datos);
			$('#actualizar_datos').attr("disabled", false);
			window.setTimeout(function() {
				$(".alert").fadeTo(500, 0).slideUp(500, function(){
				$(this).remove();});
				location.replace('stock.php');
			}, 500);
		  }
	});
  event.preventDefault();
})


	$('#myModal2').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget) // Button that triggered the modal
		var codigo = button.data('codigo') // Extract info from data-* attributes
		var nombre = button.data('nombre')
		var categorias = button.data('categorias')		
		var categoriasespecificas = button.data('categoriasespecificas')		
		var subcategorias = button.data('subcategorias')		
		var despachos = button.data('despachos')
		var codigoi = button.data('codigoi')
		var precio = button.data('precio')
		var serial = button.data('serial')
		var stock = button.data('stock')
		var numero = button.data('numero')
		var color = button.data('color')
		var marca = button.data('marca')
		var modelo = button.data('modelo')
		var cond = button.data('cond')
		var resp = button.data('resp')
		var conc = button.data('conc')
		var codi = button.data('codi')
		var foto = button.data('img')
		var id = button.data('id')


		var modal = $(this)
		modal.find('.modal-body #mod_codigo').val(codigo)
		modal.find('.modal-body #mod_nombre').val(nombre)
		modal.find('.modal-body #mod_categorias').val(categorias)
		modal.find('.modal-body #mod_categoriasespecificas').val(categoriasespecificas)
		modal.find('.modal-body #mod_subcategorias').val(subcategorias)
		modal.find('.modal-body #mod_despachos').val(despachos)
		modal.find('.modal-body #mod_codigoi').val(codigoi)
		modal.find('.modal-body #mod_precio').val(precio)
		modal.find('.modal-body #mod_serial').val(serial)
		modal.find('.modal-body #mod_stock').val(stock)
		modal.find('.modal-body #mod_numero').val(numero)
		modal.find('.modal-body #mod_color').val(color)
		modal.find('.modal-body #mod_marca').val(marca)
		modal.find('.modal-body #mod_modelo').val(modelo)
		modal.find('.modal-body #mod_condicion').val(cond)
		modal.find('.modal-body #mod_responsable').val(resp)
		modal.find('.modal-body #mod_concepto').val(conc)
		modal.find('.modal-body #mod_codi').val(codi)
		modal.find('.modal-body #mod_foto').val(foto)
		modal.find('.modal-body #mod_id').val(id)
	})
	
	function eliminar (id){
		var q= $("#q").val();
		if (confirm("Realmente deseas eliminar el producto")){	
			location.replace('stock.php?delete='+id);
		}
	}
	
	
</script>
