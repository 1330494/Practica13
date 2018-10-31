<?php
//session_start();
if(!isset($_SESSION["validar"])){
	echo "<script type='text/javascript'>
    	window.location = 'index.php?action=ingresar';
  	</script>";
}

?>
<div class="row" style="height: 50px;width: 100%;"></div>

<div class="col-md-4"></div>

<div class="col-md-4">
	<div class="card card-warning">
	    <div class="card-header">
	        <h3 class="card-title"><i class="fa fa-user-plus" style="font-size: 36px;"></i> NUEVO JUGADOR</h3>
	    </div>
	    <!-- /.card-header -->

	    <!-- form start -->
	    <form role="form" method="POST">
	        <div class="card-body">
	 			<label>Número:</label>
	 			<div class="input-group mb-3">
			        <div class="input-group-prepend">
			          <span class="input-group-text"><i class="fa fa-hashtag text-warning"></i></span>
			        </div>
		            <input type="number" required class="form-control" id="numero" name="numero" placeholder="Numero"  min="1" max="99">
		        </div>
		        <label>Nombre(s):</label>
		 		<div class="input-group mb-3">
			        <div class="input-group-prepend">
			          <span class="input-group-text"><i class="fa fa-user text-warning"></i></span>
			        </div>
		            <input type="text" required class="form-control" id="nombre" placeholder="Nombre(s)" name="nombre" placeholder="Nombre(s)">
		        </div>
		        <label>Apellidos:</label>
		        <div class="input-group mb-3">
			        <div class="input-group-prepend">
			          <span class="input-group-text"><i class="fa fa-user text-warning"></i></span>
			        </div>
		            <input type="text" required class="form-control" placeholder="Apellidos" id="apellidos" name="apellidos" placeholder="Apellidos">
		        </div>
		        <label>Equipo:</label>
		        <div class="input-group mb-3">
			        <div class="input-group-prepend">
			          <span class="input-group-text"><i class="fa fa-street-view text-warning"></i></span>
			        </div>
                	<select id="equipo" name="equipo" class="form-control" required>
                  	<?php 
                    $equipos = EquipoData::viewEquiposModel("equipos");;
                    echo '<option value="" disabled selected >Selecciona una equipo</option>';
                    foreach ($equipos as $equipo) {
                      	echo '<option value="'.$equipo['id'].'" >'.$equipo['nombre'].'</option>';
                    }
                   	?>
                	</select>
          		</div>

	 		</div>
	        <!-- /.card-body -->
	        
	        <div class="card-footer">
	           	<center>
	           		<button type="submit" name="GuardarJugador" class="btn btn-outline-warning">
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
//se invoca la función nuevoAlumnoController de la clase MvcController:
$registro -> nuevoJugadorController();

if(isset($_GET["action"])){

	if($_GET["action"] == "ok"){

		echo "Registro Exitoso";
	
	}

}

?>
