<?php

if(!isset($_SESSION["validar"])){
	header("Location: index.php?action=ingresar");
	exit();
}

?>
<div class="row" style="height: 50px;width: 100%;"></div>

<div class="col-md-2"></div>

<div class="col-md-8">			
<?php

	$vistaEquipos = new Controlador_MVC();
	$vistaEquipos -> vistaEquiposController();

	if(isset($_GET["action"])){

	if($_GET["action"] == "cambio"){
		echo "Cambio Exitoso";
	}
}
?>
</div>

<div class="col-md-2"></div>