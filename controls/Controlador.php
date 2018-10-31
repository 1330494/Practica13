<?php 

/**
* Clase controlador que permite la funcionabilidad del sistema 
* por medio de MVC.
*/
class Controlador_MVC
{
	// Metodo que permite mostrar la plantilla de la pagina
	public function showPage()
	{
		include "views/template.php";
	}

	// Metodo que permite el control de los enlaces y las vistas finales.
	public function linksController()
	{
		if(isset( $_GET['action'])){ // Se obtiene el valor de la variable action
			$enlaces = $_GET['action'];		
		}else{ // De lo contrario se le asigna el valor index
			$enlaces = "index";
		}

		// Obtenemos la respuesta del modelo
		$respuesta = Pages::linksModel($enlaces); 

		include $respuesta;
	}

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/* Controlador para INICIO +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	public function DataBaseTablesCounterController()
	{
		$usuarios = UsuarioData::viewUsuariosModel("usuarios");
		$jugadores = JugadorData::viewJugadoresModel("jugadores");
		$equipos = EquipoData::viewEquiposModel("equipos");
		$categorias = CategoriaData::viewCategoriasModel("categorias");

		$counter = array(
				'usuarios'=>count($usuarios),
				'jugadores'=>count($jugadores),
				'equipos'=>count($equipos),
				'categorias'=>count($categorias)
			);

		return $counter;
	}

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/* Controlador para la Sesion ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	public function SessionController()
	{
		if(isset($_POST["SubmitUsuario"])){
			$datosController = array( 
				"usuario"=>$_POST["usuarioIngreso"], 
				"password"=>$_POST["passwordIngreso"]
			);			
			$this->ingresoUsuarioController($datosController);			
		}
	}

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/* Controlador para USUARIOS +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

	# BORRAR USUARIO
	#------------------------------------
	public function deleteUsuarioController(){
		// Obtenemos el ID del usuario a borrar
		if(isset($_GET["idUsuario"])){
			$datosController = $_GET["idUsuario"];
			// Mandamos los datos al modelo del usuario a eliminar
			$respuesta = UsuarioData::deleteUsuarioModel($datosController, "usuarios");
			// Si se realiza el proceso con exito
			if($respuesta == "success"){
				// Direccionamos a la vista de usuarios
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=ver-usuarios';
			  	</script>";
			}
		}
	}

	# REGISTRO DE USUARIO
	#------------------------------------
	public function nuevoUsuarioController(){

		if(isset($_POST["GuardarUsuario"])){
			//Recibe a traves del método POST el name (html) de username y password, se almacenan los datos en una variable de tipo array con sus respectivas propiedades (username, password):
			$datosController = array( 
				"usuario"=>$_POST['usuario'],
				"password"=>$_POST['password1']
			);

			//Se le dice al modelo models/UsuarioCrud.php (UsuarioData::registroUsuarioModel),que en la clase "UsuarioData", la funcion "registroUsuarioModel" reciba en sus 2 parametros los valores "$datosController" y el nombre de la tabla a conectarnos la cual es "usuarios":
			$respuesta = UsuarioData::newUsuarioModel($datosController, "usuarios");

			//se imprime la respuesta en la vista 
			if($respuesta == "success"){
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=registro-usuario&resp=ok';
			  	</script>";
			}
			else{
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=inicio';
			  	</script>";
			}
		}
	}

	# VISTA DE USUARIOS
	#------------------------------------

	public function vistaUsuariosController(){

		$respuesta = UsuarioData::viewUsuariosModel("usuarios");

		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		echo '
		<div class="card card-dark">

        <div class="card-header">
            <h3 class="card-title"><i class="fa fa-users" style="font-size:32px;">&nbsp;</i>USUARIOS</h3>
        </div>

		<div class="card-body p-1">
			<div id="categorias_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
				<div class="row">
              		<div class="col-sm-12 col-md-6">
              			<div class="dataTables_length" id="categorias_length">
              				<label>Mostrar 
              					<select name="categorias_length" aria-controls="tabla-usuarios" class="form-control form-control-sm">
              					<option value="10">10</option>
              					<option value="25">25</option>
              					<option value="50">50</option>
              					<option value="100">100</option>
              					</select> registros.
              				</label>
              			</div>
              		</div>
              		<div class="col-sm-12 col-md-6">
              			<div id="example1_filter" class="dataTables_filter">
              			<label>Buscar:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="tabla-usuarios"></label>
              			</div>
              		</div> 
            	</div>

				<table id="tabla-usuarios" class="table table-striped table-bordered dataTable">
					<thead>
						<tr>
							<th class="sorting_asc" tabindex="0" aria-controls="tabla-categorias" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: auto;">Id</th>
							<th class="sorting_asc" tabindex="0" aria-controls="tabla-categorias" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: auto;">Usuario</th>
							<th class="sorting_asc" tabindex="0" aria-controls="tabla-categorias" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: auto;">Password</th>
							<th>Editar</th>
							<th>Eliminar</th>
						</tr>
					</thead>
					<tbody>';
					foreach($respuesta as $usuario){
					echo'<tr>
						<td><span class="badge badge-dark">'.$usuario["id"].'</span></td>
						<td>'.$usuario["usuario"].'</td>
						<td>'.crypt($usuario["password"],'YYL').'</td>
						<td><a href="index.php?action=editar-usuario&idUsuario='.$usuario["id"].'"><i class="fa fa-gear fa-spin text-info" style="font-size:25px;"></i></a></td>
						<td><a href="index.php?action=eliminar-usuario&idUsuario='.$usuario["id"].'"><i class="fa fa-trash-o text-danger" style="font-size:25px;"></i></a></td>
						</tr>
					';
					}
					echo '</tbody>
				</table>
			</div>
		</div>

		<div class="card-footer">
			<a class="btn btn-outline-dark" href="index.php?action=registro-usuario">
	        	<i class="fa fa-user-plus"></i> Nuevo Usuario
	    	</a>
		</div>

		</div>';
	}

	#INGRESO DE USUARIO
	#------------------------------------
	public function ingresoUsuarioController($datosController)
	{
			$respuesta = UsuarioData::ingresoUsuarioModel($datosController, "usuarios");
			//Valiación de la respuesta del modelo para ver si es un Usuario correcto.
			if($respuesta["usuario"] == $datosController["usuario"] && $respuesta["password"] == $datosController["password"]){
				//session_start();
				// Se crea la sesion
				$_SESSION['user'] = $respuesta['id'];
				$_SESSION["validar"] = true;
				$_SESSION["password"] = $respuesta["password"];
				
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=inicio';
			  	</script>";
			}else{
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=fallo';
			  	</script>";
			}
	}

	#EDITAR USUARIO
	#------------------------------------

	public function editarUsuarioController(){

		$datosController = $_GET["idUsuario"];
		$respuesta = UsuarioData::editarUsuarioModel($datosController, "usuarios");

		echo'

		<div class="card card-dark">
    		<div class="card-header">
        		<h1 class="card-title"><i class="fa fa-user" style="font-size:36px;">&nbsp; </i> EDITAR USUARIO</h1>
    		</div>
    		<!-- /.card-header -->

    		<!-- form start -->
    		<form role="form" method="POST">
    			<input type="hidden" name="pwUser" id="pwUser" value="'.$respuesta['password'].'">
    			<input type="hidden" name="idUser" id="idUser" value="'.$respuesta['id'].'">
        		<div class="card-body">
        			
        			<div class="input-group mb-3">
				        <div class="input-group-prepend">
				          <span class="input-group-text"><i class="fa fa-user"></i></span>
				        </div>
              			<input type="text" value="'.$respuesta["usuario"].'" name="usuarioEditar" required class="form-control">
					</div>

					<div class="input-group mb-3">
				        <div class="input-group-prepend">
				          <span class="input-group-text"><i class="fa fa-key"></i></span>
				        </div>
              			<input type="password" id="PW1" name="password1Editar" placeholder="Nueva contraseña" class="form-control">
					</div>

					<div class="input-group mb-3">
				        <div class="input-group-prepend">
				          <span class="input-group-text"><i class="fa fa-key"></i></span>
				        </div>
              			<input type="password" id="PW2" name=password2Editar" placeholder="Confirmar contraseña" class="form-control">
					</div>
					<script type="text/javascript">
						document.getElementById("PW2").onchange = function(e){
							var PW1 = document.getElementById("PW1");
							if(this.value){
								this.required = "required";
								document.getElementById("oldPassword").required = "required";
								PW1.required = "required";
							}else{
								document.getElementById("oldPassword").required = false;
								this.required = false;
								PW1.required = false;
							}
							if(this.value != PW1.value ){
								alert("Contraseñas no coinciden.");
								PW1.focus();
								this.value = "";
							}
						};
					</script>

					<div class="input-group mb-3">
				        <div class="input-group-prepend">
				          <span class="input-group-text"><i class="fa fa-key"></i></span>
				        </div>
              			<input type="password" id="oldPassword" name="oldPassword" placeholder="Contraseña anterior" class="form-control">
					</div>
					<script type="text/javascript">
						document.getElementById("oldPassword").onchange = function(e){
							var id = document.getElementById("pwUser");
							if(this.value != id.value ){
								alert("Error a confirmar contraseña anterior.");
								this.focus();
								this.value = "";
							}
						};
					</script>

 				</div>
        		<!-- /.card-body -->
        		<div class="card-footer">
           			<center><button type="submit" name="UsuarioEditar" class="btn btn-light">Actualizar</button></center>
        		</div>
    		</form>
		</div>';

	}

	#ACTUALIZAR USUARIO
	#------------------------------------
	public function actualizarUsuarioController(){

		if(isset($_POST["UsuarioEditar"])){

			$datosController = array();

			if (isset($_POST['password1Editar']) && $_POST['password1Editar']) {
				$datosController = array( 
					"usuario"=>$_POST["usuarioEditar"],
			        "password"=>$_POST["password1Editar"],
			        "id"=>$_POST['idUser']
			    );
			}else{
				$datosController = array( 
					"usuario"=>$_POST["usuarioEditar"],
			        "password"=>$_POST["pwUser"],
			        "id"=>$_POST['idUser']
			    );
			}
			
			$respuesta = UsuarioData::actualizarUsuarioModel($datosController, "usuarios");

			if($respuesta == "success"){
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=ver-usuarios';
			  	</script>";
			}else{
				echo "error";
			}
		}
	}	

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/* Controlador para Equipos   +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

	# BORRAR EQUIPO
	#------------------------------------
	public function deleteEquipoController(){
		// Obtenemos el ID del aquipo a borrar
		if(isset($_GET["idEquipo"])){
			$datosController = $_GET["idEquipo"];
			// Mandamos los datos al modelo del carrera a eliminar
			$respuesta = EquipoData::deleteEquipoModel($datosController, "equipos");
			// Si se realiza el proceso con exito
			if($respuesta == "success"){
				// Direccionamos a la vista de Equipos
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=ver-equipos';
			  	</script>";
			}
		}
	}

	# VISTA DE EQUIPOS
	#------------------------------------

	public function vistaEquiposController(){

		$respuesta = EquipoData::viewEquiposModel("equipos");
		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		echo '
		<div class="card card-info">

        <div class="card-header">
            <h3 class="card-title"><i class="fa fa-street-view" style="font-size:36px;"></i> EQUIPOS</h3>
        </div>

		<div class="card-body p-1">
			<div id="categorias_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
				<div class="row">
              		<div class="col-sm-12 col-md-6">
              			<div class="dataTables_length" id="categorias_length">
              				<label>Mostrar 
              					<select name="categorias_length" aria-controls="tabla-equipos" class="form-control form-control-sm">
              					<option value="10">10</option>
              					<option value="25">25</option>
              					<option value="50">50</option>
              					<option value="100">100</option>
              					</select> registros.
              				</label>
              			</div>
              		</div>
              		<div class="col-sm-12 col-md-6">
              			<div id="example1_filter" class="dataTables_filter">
              			<label>Buscar:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="tabla-equipos"></label>
              			</div>
              		</div> 
            	</div>

				<table id="tabla-equipos" class="table table-striped table-bordered dataTable">
					<thead>
						<tr>
							<th class="sorting_asc" tabindex="0" aria-controls="tabla-categorias" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: auto;">Id</th>
							<th class="sorting_asc" tabindex="0" aria-controls="tabla-categorias" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: auto;">Nombre</th>
							<th class="sorting_asc" tabindex="0" aria-controls="tabla-categorias" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: auto;">Disciplina</th>
							<th>Ver</th>
							<th>Editar</th>
							<th>Eliminar</th>
						</tr>
					</thead>
					<tbody>';
					foreach($respuesta as $equipo){
					$disciplina = CategoriaData::editarCategoriaModel($equipo['categoria'],'categorias');
					echo'<tr>
						<td> <span class="badge badge-info">'.$equipo["id"].'</span></td>
						<td>'.$equipo["nombre"].'</td>
						<td>'.$disciplina["nombre"].'</td>
						<td><a href="index.php?action=equipo&idEquipo='.$equipo["id"].'"><i class="fa fa-eye text-info" style="font-size:25px;"></i></a></td>
						<td><a href="index.php?action=editar-equipo&idEquipo='.$equipo["id"].'"><i class="fa fa-gear fa-spin text-info" style="font-size:25px;"></i></a></td>
						<td><a href="index.php?action=eliminar-equipo&idEquipo='.$equipo["id"].'"><i class="fa fa-trash-o text-danger" style="font-size:25px;"></i></a></td>
					</tr>';
					}
					echo '</tbody>
				</table>
			</div>
		</div>
		<div class="card-footer">
			<a class="btn btn-outline-info" href="index.php?action=registro-equipo">
	        	<i class="fa fa-street-view"></i> + Nuevo Equipo
	    	</a>
	    </div>
		</div>';
	}

	# REGISTRO DE EQUIPO
	#------------------------------------
	public function nuevoEquipoController(){

		if(isset($_POST["GuardarEquipo"])){
			//Recibe a traves del método POST el name (html) el nombre y la categoria, y se almacenan los datos en una variable de tipo array con sus respectivas propiedades (nombre, categoria):
			$datosController = array(
				"nombre"=>$_POST['nombreEquipo'],
				"categoria"=>$_POST['disciplinaEquipo']
			);

			//Se le dice al modelo models/crud.php (EquipoData::newEquipoModel),que en la clase "EquipoData", la funcion "newEquipoModel" reciba en sus 2 parametros los valores "$datosController" y el nombre de la tabla a conectarnos la cual es "equipos":
			$respuesta = EquipoData::newEquipoModel($datosController, "equipos");

			//se imprime la respuesta en la vista 
			if($respuesta == "success"){
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=ver-equipos';
			  	</script>";
			}
			else{
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=inicio';
			  	</script>";
			}
		}

	}

	#EDITAR EQUIPO
	#------------------------------------

	public function editarEquipoController(){

		$datosController = $_GET["idEquipo"];
		$respuesta = EquipoData::editarEquipoModel($datosController, "equipos");
		$disciplinas = CategoriaData::viewCategoriasModel("categorias");

		echo'
		<div class="card card-info">
    		<div class="card-header">
        		<h1 class="card-title"><i class="fa fa-street-view"></i> EDITAR EQUIPO</h1>
    		</div>
    		<!-- /.card-header -->

    		<!-- form start -->
    		<form role="form" method="POST">
        		<div class="card-body">

        			<label>ID:</label>
        			<div class="input-group mb-3">
				        <div class="input-group-prepend">
				          <span class="input-group-text"><i class="fa fa-hashtag text-info"></i></span>
				        </div>
              			<input type="text" value="'.$respuesta["id"].'" placeholder="Identificador" name="idEquipoEditar" readonly required class="form-control">
					</div>

					<label>Nombre:</label>
					<div class="input-group mb-3">
				        <div class="input-group-prepend">
				          <span class="input-group-text"><i class="fa fa-street-view text-info"></i></span>
				        </div>
              			<input type="text" id="nombreEquipoEditar" placeholder="Nombre" name="nombreEquipoEditar" required class="form-control" value="'.$respuesta['nombre'].'">
					</div>

					<label>Nombre:</label>
					<div class="input-group mb-3">
				        <div class="input-group-prepend">
				          <span class="input-group-text"><i class="fa fa-soccer-ball-o fa-spin text-info"></i></span>
				        </div>
						<select name="disciplinaEquipoEditar" required class="form-control">';
					  		foreach ($disciplinas as $disciplina) {
					  			if($disciplina['id']==$respuesta['categoria']){
					  				echo "<option value='".$disciplina['id']."' selected>".$disciplina['nombre']."</option>";
					  			}else{
					  				echo "<option value='".$disciplina['id']."'>".$disciplina['nombre']."</option>";
					  			}
					  		}
        echo ' 			</select>
        			</div>

 				</div>
        		<!-- /.card-body -->
        		<div class="card-footer">
           			<center>
           				<button type="submit" name="EquipoEditar" class="btn btn-outline-info">
           					Actualizar <i class="fa fa-refresh fa-spin"></i>
           				</button>
           			</center>
        		</div>
    		</form>
		</div>';

	}

	#ACTUALIZAR EQUIPO
	#------------------------------------
	public function actualizarEquipoController(){

		if(isset($_POST["EquipoEditar"])){

			$datosController = array( 
				"id"=>$_POST["idEquipoEditar"],
		        "nombre"=>$_POST["nombreEquipoEditar"],
		        "categoria"=>$_POST["disciplinaEquipoEditar"]
		    );
			
			$respuesta = EquipoData::actualizarEquipoModel($datosController, "equipos");

			if($respuesta == "success"){
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=ver-equipos';
			  	</script>";
			}else{
				echo "error";
			}
		}
	}

	# VER JUGADORES ESPECIFICOS DE UN EQUIPO
	#------------------------------------

	public function vistaJugadoresEquipoController(){

		$datosController = $_GET["idEquipo"];
		$respuesta = EquipoData::editarEquipoModel($datosController, "equipos");
		$jugadores = JugadorData::viewJugadoresEquipoModel($respuesta['id'], "jugadores");

		echo'
		<div class="card card-info">
    		<div class="card-header">
        		<h1 class="card-title"><i class="fa fa-street-view"></i>EQUIPO '.strtoupper($respuesta['nombre']).'</h1>
    		</div>
    		<!-- /.card-header -->
    			<h1></h1>
    			<h1 class="text-info text-center"><i class="fa fa-users" style="font-size:50px;"></i> Jugadores</h1>
   
        		<div class="card-body">
        		<table class="table table-striped table-bordered">
	        		<thead>
	        			<tr>
							<th class="sorting_asc" tabindex="0" aria-controls="tabla-categorias" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: auto;">ID</th>
							<th class="sorting_asc" tabindex="0" aria-controls="tabla-categorias" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: auto;">Numero</th>
							<th class="sorting_asc" tabindex="0" aria-controls="tabla-categorias" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: auto;">Nombre</th>
							<th>Ver</th>
						</tr>
	        		<thead>
        			<thead>
        			';
        			foreach ($jugadores as $jugador) {
        				echo "
        					<tr>
        						<td><span class='badge badge-info'>".$jugador['id']."</span></td>
        						<td><span class='badge badge-dark'>".$jugador['numero']."</span></td>
        						<td>".$jugador['nombre'].' '.$jugador['apellidos']."</td>
        						<td><a href='index.php?action=jugador&idJugador=".$jugador['id']."'><i class='fa fa-eye' style='font-size:25px;'></i></a></td>
        					</tr>
        				";
        			}
        			//print_r($jugadores);
		echo '		</thead>
				</table>
 				</div>
        		<!-- /.card-body -->        		
    		</form>
		</div>';

	}

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/* Controlador para JUGADORES  +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

	# BORRAR JUGADOR
	#------------------------------------
	public function deleteJugadorController(){
		// Obtenemos el ID del alumno a borrar
		if(isset($_GET["idJugador"])){
			$datosController = $_GET["idJugador"];
			// Mandamos los datos al modelo del jugador a eliminar
			$respuesta = JugadorData::deleteJugadorModel($datosController, "jugadores");
			// Si se realiza el proceso con exito
			if($respuesta == "success"){
				// Direccionamos a la vista de jugadores
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=ver-jugadores';
			  	</script>";
			}
		}
	}

	# VISTA DE JUGADORES
	#------------------------------------

	public function vistaJugadoresController(){

		$respuesta = JugadorData::viewJugadoresModel("jugadores");
		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		echo '
		<div class="card card-warning">

        <div class="card-header">
            <h1 class="card-title"><i class="fa fa-users" style="font-size:36px;">&nbsp;</i>JUGADORES</h1>
        </div>

		<div class="card-body p-1">
			<div id="categorias_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
				<div class="row">
              		<div class="col-sm-12 col-md-6">
              			<div class="dataTables_length" id="categorias_length">
              				<label>Mostrar 
              					<select name="categorias_length" aria-controls="tabla-jugadores" class="form-control form-control-sm">
              					<option value="10">10</option>
              					<option value="25">25</option>
              					<option value="50">50</option>
              					<option value="100">100</option>
              					</select> registros.
              				</label>
              			</div>
              		</div>
              		<div class="col-sm-12 col-md-6">
              			<div id="example1_filter" class="dataTables_filter">
              			<label>Buscar:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="tabla-jugadores"></label>
              			</div>
              		</div> 
            	</div>
				<table id="tabla-jugadores" class="table table-striped table-bordered dataTable">
					<thead>
						<tr>
							<th class="sorting_asc" tabindex="0" aria-controls="tabla-categorias" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: auto;">ID</th>
							<th class="sorting_asc" tabindex="0" aria-controls="tabla-categorias" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: auto;">Número</th>
							<th class="sorting_asc" tabindex="0" aria-controls="tabla-categorias" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: auto;">Nombre</th>
							<th class="sorting_asc" tabindex="0" aria-controls="tabla-categorias" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: auto;">Apellidos</th>
							<th class="sorting_asc" tabindex="0" aria-controls="tabla-categorias" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: auto;">Equipo</th>
							<th>Editar</th>
							<th>Eliminar</th>
						</tr>
					</thead>
					<tbody>';
					foreach($respuesta as $jugador){
					$equipo = EquipoData::editarEquipoModel($jugador["equipo"],"equipos");
					echo'
					<tr>
						<td> <span class="badge badge-warning">'.$jugador["id"].'</span></td>
						<td> <span style="font-size:16px;" class="badge badge-dark">'.$jugador["numero"].'</span></td>
						<td>'.$jugador["nombre"].'</td>
						<td>'.$jugador["apellidos"].'</td>
						<td><a href="index.php?action=equipo&idEquipo='.$equipo["id"].'"><span>'.$equipo["nombre"].'</span></a></td>
						<td><a href="index.php?action=editar-jugador&idJugador='.$jugador["id"].'"><i class="fa fa-gear fa-spin text-info" style="font-size:25px;"></i></a></td>
						<td><a href="index.php?action=eliminar-jugador&idJugador='.$jugador["id"].'"><i class="fa fa-trash-o text-danger" style="font-size:25px;"></i></a></td>				
					</tr>';

					}
					echo '</tbody>
				</table>
			</div>
		</div>

		<div class="card-footer">
			<a class="btn btn-outline-warning" href="index.php?action=registro-jugador">
        		<i class="fa fa-user-plus"></i> Nuevo Jugador
    		</a>
		</div>

		</div>';
	}

	# REGISTRO DE JUGADOR
	#------------------------------------
	public function nuevoJugadorController(){

		if(isset($_POST["GuardarJugador"])){
			//Recibe a traves del método POST el name (html) el nombre y se almacenan los datos en una variable de tipo array con sus respectivas propiedades (nombre):
			$datosController = array(
				"numero"=>$_POST['numero'],
				"nombre"=>$_POST['nombre'],
				"apellidos"=>$_POST['apellidos'],
				"equipo"=>$_POST['equipo']);

			//Se le dice al modelo models/crud.php (JugadorData::newJugadorModel),que en la clase "JugadorData", la funcion "newGrupoModel" reciba en sus 2 parametros los valores "$datosController" y el nombre de la tabla a conectarnos la cual es "usuarios":
			$respuesta = JugadorData::newJugadorModel($datosController, "jugadores");

			//se imprime la respuesta en la vista 
			if($respuesta == "success"){
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=ver-jugadores';
			  	</script>";
			}
			else{
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=inicio';
			  	</script>";
			}
		}

	}

	# EDITAR JUGADOR
	#------------------------------------

	public function editarJugadorController(){

		$datosController = $_GET["idJugador"];
		$respuesta = JugadorData::editarJugadorModel($datosController, "jugadores");
		$equipos = EquipoData::viewEquiposModel("equipos");
		echo'

		<div class="card card-warning">
    		<div class="card-header">
        		<h1 class="card-title"><i class="fa fa-user" style="font-size:36px;">&nbsp; </i> EDITAR JUGADOR</h1>
    		</div>
    		<!-- /.card-header -->

    		<!-- form start -->
    		<form role="form" method="POST">    			
        		<div class="card-body">
        			
        			<label>ID:</label>
        			<div class="input-group mb-3">
				        <div class="input-group-prepend">
				          <span class="input-group-text"><i class="fa fa-key text-warning"></i></span>
				        </div>
              			<input type="text" readonly value="'.$respuesta["id"].'" name="idJugadorEditar" class="form-control">
					</div>

					<label>Número:</label>
					<div class="input-group mb-3">
				        <div class="input-group-prepend">
				          <span class="input-group-text"><i class="fa fa-hashtag text-warning"></i></span>
				        </div>
              			<input type="text" value="'.$respuesta["numero"].'" name="numeroJugadorEditar" required class="form-control">
					</div>

					<label>Nombre:</label>
					<div class="input-group mb-3">
				        <div class="input-group-prepend">
				          <span class="input-group-text"><i class="fa fa-user text-warning"></i></span>
				        </div>
              			<input type="text" value="'.$respuesta["nombre"].'" name="nombreJugadorEditar" required class="form-control">
					</div>

					<label>Apellidos:</label>
					<div class="input-group mb-3">
				        <div class="input-group-prepend">
				          <span class="input-group-text"><i class="fa fa-user text-warning"></i></span>
				        </div>
              			<input type="text" value="'.$respuesta["apellidos"].'" name="apellidosJugadorEditar" required class="form-control">
					</div>

					<label>Equipo:</label>
					<div class="input-group mb-3">
				        <div class="input-group-prepend">
				          <span class="input-group-text"><i class="fa fa-soccer-ball-o fa-spin text-dark"></i></span>
				        </div>
              			<select name="equipoJugadorEditar" required class="form-control">';
				  		foreach ($equipos as $equipo) {
				  			if($equipo['id']==$respuesta['equipo']){
				  				echo "<option value='".$equipo['id']."' selected>".$equipo['nombre']."</option>";
				  			}else{
				  				echo "<option value='".$equipo['id']."'>".$equipo['nombre']."</option>";
				  			}
				  		}
        echo ' 			</select>
					</div>

 				</div>
        		<!-- /.card-body -->
        		<div class="card-footer">
           			<center><button type="submit" name="JugadorEditar" class="btn btn-outline-warning">Actualizar <i class="fa fa-refresh fa-spin"></i></button></center>
        		</div>
    		</form>
		</div>';

	}

	# ACTUALIZAR JUGADOR
	#------------------------------------
	public function actualizarJugadorController(){

		if(isset($_POST["JugadorEditar"])){

			$datosController = array( 
				"numero"=>$_POST["numeroJugadorEditar"],
		        "nombre"=>$_POST["nombreJugadorEditar"],
		        "apellidos"=>$_POST["apellidosJugadorEditar"],
		        "equipo"=>$_POST["equipoJugadorEditar"],
		        "id"=>$_POST["idJugadorEditar"]
		    );
			
			$respuesta = JugadorData::actualizarJugadorModel($datosController, "jugadores");

			if($respuesta == "success"){
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=ver-jugadores';
			  	</script>";
			}else{
				echo "error";
			}
		}
	}

	# VER JUGADOR
	#------------------------------------
	public function vistaJugadorController(){

		$datosController = $_GET["idJugador"];
		$jugador = JugadorData::editarJugadorModel($datosController, "jugadores");
		$equipo = EquipoData::editarEquipoModel($jugador['equipo'],"equipos");
		echo'

		<div class="card card-warning">
    		<div class="card-header">
        		<h1 class="card-title"><i class="fa fa-user" style="font-size:36px;">&nbsp; </i> JUGADOR</h1>
    		</div>
    		<!-- /.card-header -->

        		<div class="card-body">
        			
        			<div class="input-group mb-3">
				        <div class="input-group-prepend">
				          <span class="input-group-text"><i class="text-warning">ID</i></span>
				        </div>
              			<input type="text" readonly value="'.$jugador["id"].'" class="form-control">
					</div>

					<div class="input-group mb-3">
				        <div class="input-group-prepend">
				          <span class="input-group-text"><i class="fa fa-hashtag text-warning"></i></span>
				        </div>
              			<input type="text" readonly value="'.$jugador["numero"].'" class="form-control">
					</div>

					<div class="input-group mb-3">
				        <div class="input-group-prepend">
				          <span class="input-group-text"><i class="fa fa-user text-warning"></i></span>
				        </div>
              			<input type="text" readonly value="'.$jugador["nombre"].' '.$jugador["apellidos"].'" class="form-control">
					</div>
					

					<div class="input-group mb-3">
				        <div class="input-group-prepend">
				          <span class="input-group-text"><i class="fa fa-soccer-ball-o fa-spin"></i></span>
				        </div>
              			<input type="text" readonly value="'.$equipo["nombre"].'"  class="form-control">
					</div>
				

 				</div>
        		<!-- /.card-body -->
        		<div class="card-footer">
           			<center><a href="index.php?action=editar-jugador&idJugador='.$jugador["id"].'" class="btn btn-outline-warning"><i class="fa fa-edit"></i> Editar</a></center>
        		</div>
		</div>';
	}

	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/* Controlador para DISCIPLINAS DEPORTIVAS +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/


	# BORRAR DISCIPLINA
	#------------------------------------
	public function deleteCategoriaController(){
		// Obtenemos el ID del usuario a borrar
		if(isset($_GET["idDisciplina"])){
			$datosController = $_GET["idDisciplina"];
			// Mandamos los datos al modelo del usuario a eliminar
			$respuesta = CategoriaData::deleteCategoriaModel($datosController, "categorias");
			// Si se realiza el proceso con exito
			if($respuesta == "success"){
				// Direccionamos a la vista de disciplinas
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=ver-disciplinas';
			  	</script>";
			}
		}
	}

	# REGISTRO DE UNA NUEVA DISCIPLINA
	#------------------------------------
	public function nuevaCategoriaController(){

		if(isset($_POST["GuardarCategoria"])){
			//Recibe a traves del método POST el name (html) el nombre y se almacenan los datos en una variable de tipo array con sus respectivas propiedades (nombre):
			$datosController = array(
				"nombre"=>$_POST['nombreCategoria']
			);

			//Se le dice al modelo models/crud.php (CategoriaData::newEquipoModel),que en la clase "CategoriaData", la funcion "newCategoriaModel" reciba en sus 2 parametros los valores "$datosController" y el nombre de la tabla a conectarnos la cual es "usuarios":
			$respuesta = CategoriaData::newCategoriaModel($datosController, "categorias");

			//se imprime la respuesta en la vista 
			if($respuesta == "success"){
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=ver-disciplinas';
			  	</script>";
			}
			else{
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=inicio';
			  	</script>";
			}
		}

	}

	# VISTA DE DISCIPLINAS
	#------------------------------------

	public function vistaCategoriasController(){

		$respuesta = CategoriaData::viewCategoriasModel("categorias");
		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		echo '
		<div class="card card-success">

        <div class="card-header">
            <h1 class="card-title text-dark"><i class="fa fa-soccer-ball-o fa-spin" style="font-size:26px;"></i> DISCIPLINAS</h1>
        </div>

		<div class="card-body p-1">
			<div id="categorias_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
				<div class="row">
	              		<div class="col-sm-12 col-md-6">
	              			<div class="dataTables_length" id="categorias_length">
	              				<label>Mostrar 
	              					<select name="categorias_length" aria-controls="tabla-categorias" class="form-control form-control-sm">
	              					<option value="10">10</option>
	              					<option value="25">25</option>
	              					<option value="50">50</option>
	              					<option value="100">100</option>
	              					</select> registros.
	              				</label>
	              			</div>
	              		</div>
	              		<div class="col-sm-12 col-md-6">
	              			<div id="example1_filter" class="dataTables_filter">
	              			<label>Buscar:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="tabla-categorias"></label>
	              			</div>
	              		</div> 
	            </div>
				<table id="tabla-categorias" class="table table-bordered table-striped dataTable">
					<thead>
						<tr>
							<th class="sorting_asc" tabindex="0" aria-controls="tabla-categorias" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: auto;">ID</th>
							<th class="sorting_asc" tabindex="0" aria-controls="tabla-categorias" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: auto;">Nombre</th>
							<th>Ver</th>
							<th>Editar</th>
							<th>Eliminar</th>
						</tr>
					</thead>
					<tbody>';
					foreach($respuesta as $disciplina){
					echo'
					<tr>
						<td> <span class="badge badge-success">'.$disciplina["id"].'</span></td>
						<td>'.$disciplina["nombre"].'</td>
						<td><a href="index.php?action=disciplina&idDisciplina='.$disciplina["id"].'"><i class="fa fa-eye text-info" style="font-size:25px;"></i></a></td>
						<td><a href="index.php?action=editar-disciplina&idDisciplina='.$disciplina["id"].'"><i class="fa fa-gear fa-spin text-info" style="font-size:25px;"></i></a></td>
						<td><a href="index.php?action=eliminar-disciplina&idDisciplina='.$disciplina["id"].'"><i class="fa fa-trash-o text-danger" style="font-size:25px;"></i></a></td>				
					</tr>';

					}
					echo '</tbody>
				</table>
			</div>
		</div>

		<div class="card-footer">
			<a class="btn btn-outline-success" href="index.php?action=registro-disciplina">
        		<i class="fa fa-soccer-ball-o fa-spin text-dark"></i> Nueva Disciplina
    		</a>
		</div>

		</div>';
	}

	#EDITAR DISCIPLINAS
	#------------------------------------

	public function editarCategoriaController(){

		$datosController = $_GET["idDisciplina"];
		$respuesta = CategoriaData::editarCategoriaModel($datosController, "categorias");

		echo'

		<div class="card card-success">
    		<div class="card-header">
        		<h3 class="card-title text-dark"><i class="fa fa-soccer-ball-o fa-spin" style="font-size:36px;"></i> EDITAR DISCIPLINA</h3>
    		</div>
    		<!-- /.card-header -->

    		<!-- form start -->
    		<form role="form" method="POST">
        		<div class="card-body">
        			
        			<label>ID:</label>
        			<div class="input-group mb-3">
				        <div class="input-group-prepend">
				          <span class="input-group-text"><i class="fa fa-hashtag text-success"></i></span>
				        </div>
              			<input type="text" value="'.$respuesta["id"].'" placeholder="Identificador" name="idDisciplinaEditar" readonly required class="form-control">
					</div>

					<label>Nombre:</label>
					<div class="input-group mb-3">
				        <div class="input-group-prepend">
				          <span class="input-group-text"><i class="fa fa-edit text-success"></i></span>
				        </div>
              			<input type="text" id="nombreDisciplinaEditar" placeholder="Nombre" name="nombreDisciplinaEditar" required class="form-control" value="'.$respuesta['nombre'].'">
					</div>					

 				</div>
        		<!-- /.card-body -->
        		<div class="card-footer">
           			<center><button type="submit" name="DisciplinaEditar" class="btn btn-outline-success">Actualizar <i class="fa fa-refresh fa-spin"></i></button></center>
        		</div>
    		</form>
		</div>';

	}

	#ACTUALIZAR DISCIPLINAS
	#------------------------------------
	public function actualizarCategoriaController(){

		if(isset($_POST["DisciplinaEditar"])){

			$datosController = array( "id"=>$_POST["idDisciplinaEditar"],
							        "nombre"=>$_POST["nombreDisciplinaEditar"]);
			
			$respuesta = CategoriaData::actualizarCategoriaModel($datosController, "categorias");

			if($respuesta == "success"){
				echo "<script type='text/javascript'>
			    	window.location = 'index.php?action=ver-disciplinas';
			  	</script>";
			}else{
				echo "error";
			}
		}
	}

	# VER EQUIPOS ESPECIFICOS DE UNA DISCIPLINA
	#------------------------------------

	public function vistaEquiposDisciplinaController(){

		$datosController = $_GET["idDisciplina"];
		$respuesta = CategoriaData::editarCategoriaModel($datosController, "categorias");
		$equipos = EquipoData::viewEquiposCategoriaModel($respuesta['id'], "equipos");

		echo'
		<div class="card card-success">			
    		<div class="card-header">    			
        		<h1 class="card-title"><i class="fa fa-soccer-ball-o fa-spin"></i> DISCIPLINA - '.strtoupper($respuesta['nombre']).'</h1>
    		</div>
    		<!-- /.card-header -->
    			<h1></h1>
    			<h1 class="text-success text-center"><i class="fa fa-street-view" style="font-size:50px;"></i> Equipos</h1>
   
        		<div class="card-body">
        		<table class="table table-striped table-bordered">
	        		<thead>
	        			<tr>
							<th class="sorting_asc" tabindex="0" aria-controls="tabla-categorias" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: auto;">ID</th>
							<th class="sorting_asc" tabindex="0" aria-controls="tabla-categorias" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: auto;">Nombre</th>
							<th class="sorting_asc" tabindex="0" aria-controls="tabla-categorias" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: auto;">Jugadores</th>
							<th>Ver</th>
						</tr>
	        		<thead>
        			<thead>
        			';
        			foreach ($equipos as $equipo) { 
        				$total_jugadores = count(JugadorData::viewJugadoresEquipoModel( $equipo['id'], "jugadores"));
        				echo "
        					<tr>
        						<td><span class='badge badge-success'>".$equipo['id']."</span></td>
        						<td>".$equipo['nombre']."</td>
        						<td>".$total_jugadores."</td>
        						<td>
        							<a href='index.php?action=equipo&idEquipo=".$equipo['id']."'> 
        								<i class='fa fa-eye' style='font-size:25px;'></i>
        							</a>
        						</td>
        					</tr>
        				";
        			}
        			//print_r($jugadores);
		echo '		</thead>
				</table>
 				</div>
        		<!-- /.card-body -->        		
    		</form>
		</div>';

	}

}
?>
