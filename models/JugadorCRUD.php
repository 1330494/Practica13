<?php

#EXTENSIÓN DE CLASES: Los objetos pueden ser extendidos, y pueden heredar propiedades y métodos. Para definir una clase como extensión, debo definir una clase padre, y se utiliza dentro de una clase hija.

require_once "Connector.php";

//heredar la clase DBConnector de Connector.php para poder utilizar "DBConnector" del archivo Connector.php.
// Se extiende cuando se requiere manipuar una funcion, en este caso se va a  manipular la función "conectar" del modelos/Connector.php:
class JugadorData extends DBConnector{

	# METODO PARA REGISTRAR NUEVO JUGADOR
	#-------------------------------------
	public static function newJugadorModel($JugadorModel, $tabla_db){

		#prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

		$stmt = DBConnector::connect()->prepare("INSERT INTO $tabla_db (numero, nombre, apellidos, equipo) VALUES (:numero, :nombre, :apellidos, :equipo)");	

		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.
		$stmt->bindParam(":numero", $JugadorModel["numero"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $JugadorModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":apellidos", $JugadorModel["apellidos"], PDO::PARAM_STR);
		$stmt->bindParam(":equipo", $JugadorModel["equipo"], PDO::PARAM_INT);

		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}

		$stmt->close();
	}


	# VISTA DE JUGADORES
	#-------------------------------------

	public static function viewJugadoresModel($tabla_db){

		$stmt = DBConnector::connect()->prepare("SELECT * FROM $tabla_db");	
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();

	}

	# VISTA DE JUGADORES ESPECIFICOS DE UN EQUIPO
	#-------------------------------------

	public static function viewJugadoresEquipoModel($TutorModel, $tabla_db){

		$stmt = DBConnector::connect()->prepare("SELECT * FROM $tabla_db WHERE equipo = :equipo");
		$stmt->bindParam(":equipo", $TutorModel, PDO::PARAM_INT);
			
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();

	}


	# METODO PARA BORRAR UN JUGADOR
	#------------------------------------
	public static function deleteJugadorModel($JugadorModel, $tabla_db){

		$stmt = DBConnector::connect()->prepare("DELETE FROM $tabla_db WHERE id = :id");
		$stmt->bindParam(":id", $JugadorModel, PDO::PARAM_INT);
		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}
		$stmt->close();
	}

	# METODO PARA DEVOLVER Y EDITAR UN JUGADOR
	#------------------------------------
	public static function editarJugadorModel($JugadorModel, $tabla_db){

		$stmt = DBConnector::connect()->prepare("SELECT * FROM $tabla_db WHERE id = :id");
		$stmt->bindParam(":id", $JugadorModel, PDO::PARAM_INT);
		if($stmt->execute()){
			return $stmt->fetch();
		}else{
			return "error";
		}
		$stmt->close();
	}

	# METODO PARA ACTUALIZAR UN JUGADOR
	#------------------------------------
	public static function actualizarJugadorModel($JugadorModel, $tabla_db){

		$stmt = DBConnector::connect()->prepare("UPDATE $tabla_db SET numero=:numero, nombre=:nombre, apellidos=:apellidos, equipo=:equipo WHERE id = :id");
		$stmt->bindParam(":numero", $JugadorModel["numero"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre", $JugadorModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":apellidos", $JugadorModel["apellidos"], PDO::PARAM_STR);		
		$stmt->bindParam(":equipo", $JugadorModel["equipo"], PDO::PARAM_INT);
		$stmt->bindParam(":id", $JugadorModel["id"], PDO::PARAM_INT);
		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}
		$stmt->close();
	}

}
?>
