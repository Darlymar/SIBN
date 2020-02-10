<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->

		<div class="modal fade" id="nuevoCliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Agregar nuevo despacho</h4>
		  </div>


		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="guardar_categoria" name="guardar_categoria" onsubmit="setTimeout('document.forms[0].reset()', 200)">
			<div id="resultados_ajax"></div>
			  <div class="form-group">
				<label for="nombre" class="col-sm-3 control-label">Nombre del Despacho</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del despacho" required>
				</div>
			  </div>

			  <div class="form-group">
				<label for="cedulajd" class="col-sm-3 control-label">Cedula del Jefe</label>
				<div class="col-sm-8">
					<input class="form-control" id="cedulajd" name="cedulajd" placeholder="Cedula del jefe de Despacho"  ></input>				  
				</div>
			  </div>	

			  <div class="form-group">
				<label for="nombrejd" class="col-sm-3 control-label">Nombre del Jefe</label>
				<div class="col-sm-8">
					<input class="form-control" id="nombrejd" name="nombrejd" placeholder="Nombre del jefe de Despacho"  ></input>				  
				</div>
			  </div>

			  <div class="form-group">
				<label for="rango" class="col-sm-3 control-label">Rango</label>
				<div class="col-sm-8">
					<input class="form-control" id="rango" name="rango" placeholder="Rango del jefe de Despacho"  ></input>				  
				</div>
			  </div>
	
			   </div>



			   
			 <div class="modal-footer">
			<button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-primary" id="guardar_datos">Guardar datos</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>
			
		
