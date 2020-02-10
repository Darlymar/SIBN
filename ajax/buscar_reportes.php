<?php

	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	//Archivo de funciones PHP
	include("../funciones.php");

	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	// if (isset($_GET['id'])){
	// 	$id_producto=intval($_GET['id']);
	// 	if ($delete1=mysqli_query($con,"DELETE FROM products WHERE id_producto='".$id_producto."'")){
	// 	?>


	 		<!-- <div class="alert alert-primary alert-dismissible" role="alert"> -->
	 		  <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
	 		  <!-- <strong>Aviso!</strong> Datos eliminados exitosamente. -->
	 		<!-- </div> -->
	 		<?php 
	// 	}else {
	// 		?>
	 		<!-- <div class="alert alert-danger alert-dismissible" role="alert"> -->
	 		  <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
	 		  <!-- <strong>Error!</strong> Lo siento algo ha salido mal intenta nuevamente. -->
	 		<!-- </div> -->
	 		<?php
			
	// 	}
		
	// }
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		 // $id_categoria =intval($_REQUEST['id_categoria']);
		 $aColumns = array('codigo_producto ', 'nombre_producto');//Columnas de busqueda
		 $sTable = "products";
		 $sWhere = "";
		
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		
		// if ($id_categoria>0){
		// 	$sWhere .=" and id_categoria='$id_categoria'";
		// }
		$sWhere.=" order by id_producto desc";

		
		include 'pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 8; //how much records you want to show
		$adjacents  = 4; //gap between pages after number of adjacents
		$offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './productos.php';
		//main query to fetch the data
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);
		//loop through fetched data
		if ($numrows>0){
			
			?>
			  <div class="table-responsive">
			  <table class="table">
				<tr  class="success">
					<th>Cantidad</th>
					<th>Cod Producto</th>
					<th>N° de Bien</th>
					<th>Descripción</th>
	
					<th>Concepto</th>
		
	
					
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
						$can=$row['stock'];
						$cod=$row['codigo_producto'];
						$num=$row['numero_bien'];
						$nom=$row['nombre_producto'];

						$conI=$row['concepto_inventario'];
						$pre=$row['precio_producto'];
	
						
					?>
					<tr>
						<td><?php echo $can; ?></td>
						<td><?php echo $cod; ?></td>
						<td><?php echo $num; ?></td>
						<td><?php echo $nom; ?></td>
			
						<td><?php echo $conI; ?></td>
		
			
					</tr>
					<?php
				}
				?>
				
			  </table>
			</div>
				<?php
				$nums=1;
				while ($row=mysqli_fetch_array($query)){
						$id_producto=$row['id_producto'];
						$id_serial=$row['serial'];
						$nombre_producto=$row['nombre_producto'];
						$stock=$row['stock'];
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
