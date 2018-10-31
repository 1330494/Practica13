<?php 

class Pages{
	
	public static function linksModel($links){

		if($links == "ver-jugadores" || $links == "ver-usuarios"  || $links == "ver-equipos"
			|| $links == "ver-disciplinas" || $links == "registro-jugador" || $links == "registro-equipo" 
			|| $links == "registro-usuario" || $links == "registro-disciplina" || $links == "eliminar-disciplina" 
			|| $links == "eliminar-usuario" || $links == "eliminar-jugador" || $links == "eliminar-equipo" 
			|| $links == "editar-jugador" || $links == "editar-disciplina"
			|| $links == "editar-usuario" || $links == "editar-equipo" || $links == "jugador"
			|| $links == "salir" || $links == "equipo" || $links == "disciplina")
		{
			$module =  "views/moduls/".$links.".php";
		}else if($links == "ingresar"){
			$module =  "views/moduls/ingresar.php";
		}else if($links == "ok"){
			$module =  "views/moduls/inicio.php?";
		}else if($links == "fallo"){
			$module =  "views/moduls/ingresar.php";
		}else{
			$module =  "views/moduls/inicio.php";
		}
		return $module; 
	}
}

?>