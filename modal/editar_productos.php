<?php
		if (isset($con))
		{
	?>

	
	<!-- Modal -->
	<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Editar Producto</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="editar_producto" name="editar_producto" enctype="multipart/form-data">
			<div id="resultados_ajax2"></div>

			<div class="form-group">
				<label for="mod_numero" class="col-sm-3 control-label">N° Bien</label>
				<div class="col-sm-8">
				  <input class="form-control" id="mod_numero" name="mod_numero" required></input>
				</div>
			  </div>


			  <div class="form-group">
				<label for="mod_nombre" class="col-sm-3 control-label">Especificaciones Técnicas</label>
				<div class="col-sm-8">
				  <input class="form-control" id="mod_nombre" name="mod_nombre" required></input>
				</div>
			  </div>

			  <div class="form-group">
				<label for="mod_concepto" class="col-sm-3 control-label">Otras Especificaciones Técnicas</label>
				<div class="col-sm-8">
				  <input class="form-control" id="mod_concepto" name="mod_concepto" placeholder="Concepto del Inventario" required>
				</div>
			  </div>

			  <div class="form-group">
				<label for="mod_marca" class="col-sm-3 control-label">Marca</label>
				<div class="col-sm-8">
				  <input class="form-control" id="mod_marca" name="mod_marca" required></input>
				</div>
			  </div>



			   <div class="form-group">
				<label for="mod_modelo" class="col-sm-3 control-label">Modelo</label>
				<div class="col-sm-8">
				  <input class="form-control" id="mod_modelo" name="mod_modelo" required></input>
				</div>
			  </div>


			  <div class="form-group">
				<label for="mod_color" class="col-sm-3 control-label">Color</label>
				<div class="col-sm-8">
					<select class='form-control' name='mod_color' id='mod_color' required>
						<option value="">Selecciona una categoría</option>
							<?php 
							$query_color=mysqli_query($con,"select * from color order by nombre_color");
							while($rw=mysqli_fetch_array($query_color))	{
								?>
							<option value="<?php echo $rw['id_color'];?>"><?php echo $rw['nombre_color'];?></option>			
								<?php
							}
							?>
					</select>			  
				</div>
			  </div>
			  

			  <div class="form-group">
				<label for="mod_serial" class="col-sm-3 control-label">Serial</label>
				<div class="col-sm-8">
				  <input class="form-control" id="mod_serial" name="mod_serial" required></input>
				</div>
			</div>

			<div class="form-group">
				<label for="mod_despachos" class="col-sm-3 control-label">Ubicación del Bien</label>
				<div class="col-sm-8">
					<select class='form-control' name='mod_despachos' id='mod_despachos' required>
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
			  </div>

			  <div class="form-group">
				<label for="mod_responsable" class="col-sm-3 control-label">Incorporación</label>
				<div class="col-sm-8">
				  <input class="form-control" id="mod_responsable" name="mod_responsable" required></input>
				</div>
			  </div>	

			  <div class="form-group">
				<label for="mod_precio" class="col-sm-3 control-label">Valor de Adquisición</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="mod_precio" name="mod_precio" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8">
				</div>
			  </div>

			  <div class="form-group">
				<label for="mod_codigo" class="col-sm-3 control-label">Depreciación Acumulada</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="mod_codigo" name="mod_codigo" required>
					<input type="hidden" name="mod_id" id="mod_id"> 
				</div>
			  </div>

			  <div class="form-group">
				<label for="mod_codigoi" class="col-sm-3 control-label">Valor Contable</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="mod_codigoi" name="mod_codigoi" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8">
				</div>
			  </div>


			  <div class="form-group">
				<label for="mod_condicion" class="col-sm-3 control-label">Condición</label>
				<div class="col-sm-8">
					<select class='form-control' name='mod_condicion' id='mod_condicion' required>
						<option value="">Seleccione una condición</option>
							<?php 
							$query_condicion=mysqli_query($con,"select * from condicion order by nombre_condicion");
							while($rw=mysqli_fetch_array($query_condicion))	{
								?>
							<option value="<?php echo $rw['id_condicion'];?>"><?php echo $rw['nombre_condicion'];?></option>			
								<?php
							}
							?>
					</select>			  
				</div>
			  </div>

			<!-- Imagen del producto -->
			<div class="form-group">
			<label for="mod_imagen" class="col-sm-3 control-label">Imagen</label>
			<div class="col-sm-8">
			<div class="fileinput fileinput-new input-group" data-provides="fileinput">
			<div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
			<span class="input-group-addon btn btn-default btn-file" style="padding-bottom: 2px;"><span class="fileinput-new"></span><span class="fileinput-exists"></span>
			<input name="mod_imagen" id="mod_imagen" type="file"></span>
			
					</div>
					<input class="form-control" id="mod_foto" name="mod_foto">
				</div>
			</div>


			


		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-primary" id="actualizar_datos">Actualizar datos</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/style.js"></script>
	<?php
		}
	?>