<?php
//session_start();
if(!isset($_SESSION["validar"])){
	echo "<script type='text/javascript'>
    	window.location = 'index.php?action=ingresar';
  	</script>";
}

?>
<div class="row" style="height: 50px;width: 100%;"></div>

<div class="col-md-1"></div>

<div class="col-md-10">	
<style type="text/css">
	a:hover span{
		color:red;
		font-size: 17px;
	}

	a {
		color: black;
	}
</style>
<?php

	$vistaEquipos = new Controlador_MVC();
	$vistaEquipos -> vistaJugadoresController();
	
?>
</div>

<div class="col-md-1"></div>