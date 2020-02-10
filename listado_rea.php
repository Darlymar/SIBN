<?php
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }

	/* Connect To Database*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
	
	$active_reasignacion="active";
	$title="Reportes | División de Bienes Publicos";
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
		<div style="background:#0079a3" class="panel-heading">
		    <div class="btn-group pull-right"><a href="pdf/reporte_reasignacion_global.php">
				<button type='button' style="background:#00b3b3" class="btn btn-primary" data-toggle="modal" data-target="#nuevoProducto">
					<span class="glyphicon glyphicon-print" ></span> Imprimir</button></a>
			</div>

			<h4><i class='glyphicon glyphicon-search'></i> Reasignaciones</h4>
		</div>

		<div class="panel-body">
		
			<?php
			include("modal/registro_productos.php");
			include("modal/editar_productos.php");
			?>
			<form class="form-horizontal" role="form" id="datos">
				
						
				<div class="row">
					 <div class='col-md-4'>
						<label>Filtrar por N° de Bien o Reasignado</label>
						<input type="text" class="form-control" id="q" placeholder="Serial o nombre del producto" onkeyup='load(1);'>
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
	<script type="text/javascript" src="js/reasignacion.js"></script>
  </body>
</html>
