<?php
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }

	/* Connect To Database*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
	
	$active_productos="active";
	$title="Inventario | División de Bienes Publicos";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include("head.php");?>
  </head>
  <body>
	<?php
	include("navbar.php");
	?>
	
    <div class="container">
	<div class="panel panel-primary">
		<div class="panel-heading">
		    <div class="btn-group pull-right">
				<button type='button' class="btn btn-success" data-toggle="modal" data-target="#nuevoProducto"><span class="glyphicon glyphicon-plus" ></span> Nuevo Producto</button>
			</div>
			<h4><i class='glyphicon glyphicon-search'></i> Consulta de Inventario</h4>
		</div>
		<div class="panel-body">
		
			
			
			<?php
			include("modal/registro_productos.php");
			include("modal/editar_productos.php");
			?>
			<form class="form-horizontal" role="form" id="datos">
				
						
				<div class="row">
					<div class='col-md-4'>
						<label>Filtrar por serial o nombre</label>
						<input type="text" class="form-control" id="q" placeholder="Serial o nombre del producto" onkeyup='load(1);'>
					</div>
					
					<div class='col-md-4'>
						<label>Filtrar por Despachos</label>
						<select class='form-control' name='id_despachos' id='id_despachos' onchange="load(1);">
							<option value="">Seleccione un Despacho</option>
							<?php 
							$query_despachos=mysqli_query($con,"select * from despachos order by nombre_despachos");
							while($rw=mysqli_fetch_array($query_despachos))	{
							?>
							<option value="<?php echo $rw['id_despachos'];?>"><?php echo $rw['nombre_despachos'];?></option>			
								<?php
							}
							?>
						</select>
					</div>
					<div class='col-md-12 text-center'>
						<span id="loader"></span>
					</div>
				</div>
				<hr>
				<div class='row-fluid'>
					<div id="resultados"></div><!-- Carga los datos ajax -->
				</div>	
				<div class='row'>
					<div class='outer_div'></div><!-- Carga los datos ajax -->
				</div>
			</form>
				
			
  </div>
</div>
		 
	</div>
	<hr>
	<?php
	include("footer.php");
	?>
	<script type="text/javascript" src="js/productos.js"></script>
  </body>
</html>
<script>
function eliminar (id){
		var q= $("#q").val();
		var id_despachos= $("#id_despachos").val();
		$.ajax({
			type: "GET",
			url: "./ajax/buscar_productos.php",
			data: "id="+id,"q":q+"id_despachos="+id_despachos,
			 beforeSend: function(objeto){
				$("#resultados").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados").html(datos);
			load(1);
			}
		});
	}
		
	$(document).ready(function(){
			
		<?php 
			if (isset($_GET['delete'])){
		?>
			eliminar(<?php echo intval($_GET['delete'])?>);	
		<?php
			}
		
		?>	
	});
		
$( "#guardar_producto" ).submit(function( event ) {
  $('#guardar_datos').attr("disabled", true);
  
    var parametros = $(this).serialize();
 	var ruta = "ajax/nuevo_producto.php";
 	var formData = new FormData($("#guardar_producto")[0]);// agregado

	 $.ajax({
			type: "POST",
			url: ruta,
			data: formData,
			contentType: false, // agregado y se coloco en false
            processData: false, // agregado y se coloco en false
			 beforeSend: function(objeto){
				$("#resultados_ajax_productos").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#resultados_ajax_productos").html(datos);
			$('#guardar_datos').attr("disabled", false);
			load(1);
		  }
	});
  event.preventDefault();
})

</script>