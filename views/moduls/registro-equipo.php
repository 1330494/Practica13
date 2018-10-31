<?php

if(!$_SESSION["validar"]){
	echo "<script type='text/javascript'>
    window.location = 'index.php?action=ingresar';
  </script>";
}

?>
<div class="row" style="height: 100px;width: 100%;"></div>

<div class="col-md-4"></div>

<div class="col-md-4">	
	<div class="card card-info">
	    <div class="card-header">
	        <h3 class="card-title"><i class="fa fa-street-view" style="font-size: 32px;"></i>&nbsp;+ NUEVO EQUIPO</h3>
	    </div>
	    <!-- /.card-header -->

	    <!-- form start -->
	    <form role="form" method="POST">
	        <div class="card-body">

	        	<label>Nombre:</label>	        	
			    <div class="input-group mb-3">
			        <div class="input-group-prepend">
			          	<span class="input-group-text"><i class="fa fa-street-view text-info"></i></span>
			        </div>
	              	<input type="text" required class="form-control" id="nombreEquipo"
	               name="nombreEquipo" placeholder="Nombre">
	          	</div>

	          	<label>Disciplina:</label>
		        <div class="input-group mb-3">
			        <div class="input-group-prepend">
			          <span class="input-group-text"><i class="fa fa-soccer-ball-o fa-spin"></i></span>
			        </div>
                	<select id="disciplinaEquipo" name="disciplinaEquipo" class="form-control" required>
                  	<?php 
                    $categorias = CategoriaData::viewCategoriasModel("categorias");;
                    echo '<option value="" disabled selected >Selecciona categoria</option>';
                    foreach ($categorias as $categoria) {
                      	echo '<option value="'.$categoria['id'].'" >'.$categoria['nombre'].'</option>';
                    }
                   	?>
                	</select>
          		</div>

	 		</div>
	        <!-- /.card-body -->
	        <div class="card-footer">
	           	<center>
	           		<button type="submit" name="GuardarEquipo" class="btn btn-outline-info">
	           			<i class="fa fa-save"></i> Guardar
	           		</button>
	           	</center>
	        </div>
	    </form>

	</div>
</div>

<div class="col-md-4"></div>

<?php
//Enviar los datos al controlador Controlador_MVC (es la clase principal de Controlador.php)
$registro = new Controlador_MVC();
//se invoca la función nuevoGrupoController de la clase MvcController:
$registro -> nuevoEquipoController();

if(isset($_GET["action"])){
	if($_GET["action"] == "ok"){
		echo "Registro Exitoso";
	}
}

?>