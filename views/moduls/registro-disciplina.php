<?php

if(!isset($_SESSION["validar"])){
	echo "<script type='text/javascript'>
    	window.location = 'index.php?action=ingresar';
  	</script>";
}

?>
<div class="row" style="height: 100px;width: 100%;"></div>

<div class="col-md-3"></div>

<div class="col-md-6">	
	<div class="card card-success">
	    <div class="card-header">
	        <h1 class="card-title text-dark"><i class="fa fa-soccer-ball-o fa-spin" style="font-size: 32px;"></i>&nbsp;+ NUEVA DISCIPLINA</h1>
	    </div>
	    <!-- /.card-header -->

	    <!-- form start -->
	    <form role="form" method="POST">
	        <div class="card-body">
	        	
	        	<label>Nombre:</label>
	        	<div class="input-group mb-3">
			        <div class="input-group-prepend">
			          <span class="input-group-text"><i class="fa fa-soccer-ball-o text-success"></i></span>
			        </div>
	              	<input type="text" required class="form-control" id="nombreCategoria"
	               name="nombreCategoria" placeholder="Nombre">
	          	</div>

	 		</div>
	        <!-- /.card-body -->
	        <div class="card-footer">
	           	<center>
	           		<button type="submit" name="GuardarCategoria" class="btn btn-outline-success">
	           			<i class="fa fa-save"></i> Guardar
	           		</button>
	           	</center>
	        </div>
	    </form>

	</div>
</div>

<div class="col-md-3"></div>

<?php
//Enviar los datos al controlador Controlador_MVC (es la clase principal de Controlador.php)
$registro = new Controlador_MVC();
//se invoca la función nuevoGrupoController de la clase MvcController:
$registro -> nuevaCategoriaController();

if(isset($_GET["action"])){
	if($_GET["action"] == "ok"){
		echo "Registro Exitoso";
	}
}

?>