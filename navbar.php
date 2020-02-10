	<?php
		if (isset($title))
		{
	?>
<nav class="navbar navbar-default ">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

      <a class="navbar-brand" href="#"> <img class="item-img img-responsive" src="img/CICPC_logo verdadero.png" style="width: 50px; height: 50px; margin-top: -13px;" alt="logo" ></a> 
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">


      <li class="<?php if (isset($active_categoria)){echo $active_categoria;}?>" style="left: 315px;"><a href="categorias.php"><i class='glyphicon glyphicon-tags'></i> Despachos</a></li>
      <li class="<?php if (isset($active_productos)){echo $active_productos;}?>" style="left: 335px;"><a href="stock.php"><i class='glyphicon glyphicon-barcode'></i> Control de Inventario</a></li>
      <li class="<?php if (isset($active_reasignacion)){echo $active_reasignacion;}?>" style="left: 355px;"><a href="listado_rea.php"><i class='glyphicon glyphicon-transfer'></i> Reasignación</a></li>

          <li class="<?php if (isset($active_reporte)){echo $active_reporte;}?>" style="left: 375px;">
          <a href="#"data-toggle="dropdown"><i class="glyphicon glyphicon-list"></i> Reportes</a>
            <ul class= "dropdown-menu">
              <li class="<?php if (isset($active_categoria)){echo $active_categoria;}?>"><a href="listado_rep.php">Reporte General</a></li>
              <li class="<?php if (isset($active_categoria)){echo $active_categoria;}?>"><a href="pdf/reportemovimiento.php">Reporte de Movimiento</a></li>

            </ul>
          </li>

		<li class="<?php if (isset($active_usuarios)){echo $active_usuarios;}?>" style="left: 400px;"><a href="usuarios.php"><i  class='glyphicon glyphicon-user'></i> Usuarios</a></li>
       </ul>
      <ul class="nav navbar-nav navbar-right">
		<li><a href="login.php?logout"><i class='glyphicon glyphicon-off'></i> Salir</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
	<?php
		}
	?>