<?php

	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	//Archivo de funciones PHP
	include("../funciones.php");

	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		 // $id_categoria =intval($_REQUEST['id_categoria']);
		 $aColumns = array('nombre_despachos','nombrejd', 'id_despachos', 'rango');//Columnas de busqueda
		 $sTable = "despachos";
		 $sWhere = "";
		
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		
		$sWhere.=" order by id_despachos desc";
		
		include 'pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 10; //how much records you want to show
		$adjacents  = 4; //gap between pages after number of adjacents
		$offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './categorias.php';
		//main query to fetch the data
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);
		//loop through fetched data
		if ($numrows>0){
			
			?>
			  <div class="table-responsive">
			  	<!--  <a class="thumbnail" href="categorias.php?id=<?php echo $id_despachos;?>"> -->
			  <table class="table">
				<tr  class="success">
					<th>Nombre del Despacho</th>
					<th>Cedula del Jefe</th>
					<th>Nombre del Jefe</th>
					<th>Rango</th>
					<th>Acción</th>
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
						$nombred=$row['nombre_despachos'];
						$cedulajd=$row['cedulajd'];
						$nombrejd=$row['nombrejd'];
						$rango=$row['rango'];
					?>
					<tr>
						<td><?php echo $nombred; ?></td>
						<td><?php echo $cedulajd; ?></td>
						<td><?php echo $nombrejd; ?></td>
						<td><?php echo $rango; ?></td>

						<td><a href="pdf/reporte_reasignacion.php?id_despachos=<?php echo $row ['id_despachos']?>"><button type='button' class='btn btn-default btn-primary' title="Reporte Individual por despachos "><span class='glyphicon glyphicon-print' aria-hidden='true' value='repor'></span></button></a>

						
						</td>

					</tr>
					<?php
				}
				?>
				
			  </table>
			</div>
				<?php
				$nums=1;
				while ($row=mysqli_fetch_array($query)){
						$id_despachos=$row['id_despachos'];
						$nombred=$row['nombre_despachos'];
						$nombrejd=$row['nombrejd'];
						$cedulajd=$row['cedulajd'];
						$rango=$row['rango'];
					?>
					
			

					<?php
					if ($nums%6==0){
						echo "<div class='clearfix'></div>";
					}
					$nums++;
				}
				?>
				<div class="clearfix"></div>
				<div class='row text-center'>
					<div ><?php
					 echo paginate($reload, $page, $total_pages, $adjacents);
					?></div>
				</div>
			
			<?php
		}
	}
?>
