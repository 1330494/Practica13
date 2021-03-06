<?php

#EXTENSIÓN DE CLASES: Los objetos pueden ser extendidos, y pueden heredar propiedades y métodos. Para definir una clase como extensión, debo definir una clase padre, y se utiliza dentro de una clase hija.

require_once "Connector.php";

//heredar la clase DBConnector de Connector.php para poder utilizar "DBConnector" del archivo Connector.php.
// Se extiende cuando se requiere manipuar una funcion, en este caso se va a  manipular la función "conectar" del modelos/Connector.php:
class EquipoData extends DBConnector{

	# METODO PARA REGISTRAR NUEVAS EQUIPOS
	#-------------------------------------
	public static function newEquipoModel($EquipoModel, $tabla_db){

		#prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

		$stmt = DBConnector::connect()->prepare("INSERT INTO $tabla_db (nombre, categoria) VALUES (:nombre, :categoria)");	

		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.

		$stmt->bindParam(":nombre", $EquipoModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":categoria", $EquipoModel["categoria"], PDO::PARAM_INT);

		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}

		$stmt->close();
	}


	# VISTA DE EQUIPOS
	#-------------------------------------

	public static function viewEquiposModel($tabla_db){

		$stmt = DBConnector::connect()->prepare("SELECT * FROM $tabla_db");	
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();

	}

		# VISTA DE EQUIPOS ESPECIFICOS DE UNA DISCIPLINA
	#-------------------------------------

	public static function viewEquiposCategoriaModel($TutorModel, $tabla_db){

		$stmt = DBConnector::connect()->prepare("SELECT * FROM $tabla_db WHERE categoria = :id");
		$stmt->bindParam(":id", $TutorModel, PDO::PARAM_INT);
			
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement. 
		return $stmt->fetchAll();

		$stmt->close();

	}

	# METODO PARA BORRAR UNA EQUIPO
	#------------------------------------
	public static function deleteEquipoModel($EquipoModel, $tabla_db){

		$stmt = DBConnector::connect()->prepare("DELETE FROM $tabla_db WHERE id = :id");
		$stmt->bindParam(":id", $EquipoModel, PDO::PARAM_INT);
		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}
		$stmt->close();
	}

	# METODO PARA DEVOLVER Y EDITAR UNA EQUIPO
	#------------------------------------
	public static function editarEquipoModel($EquipoModel, $tabla_db){

		$stmt = DBConnector::connect()->prepare("SELECT * FROM $tabla_db WHERE id = :id");
		$stmt->bindParam(":id", $EquipoModel, PDO::PARAM_INT);
		if($stmt->execute()){
			return $stmt->fetch();
		}else{
			return "error";
		}
		$stmt->close();
	}

	# METODO PARA ACTUALIZAR UNA EQUIPO
	#------------------------------------
	public static function actualizarEquipoModel($EquipoModel, $tabla_db){

		$stmt = DBConnector::connect()->prepare("UPDATE $tabla_db SET nombre=:nombre, categoria=:categoria  WHERE id = :id");
		$stmt->bindParam(":nombre", $EquipoModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":categoria", $EquipoModel["categoria"], PDO::PARAM_INT);
		$stmt->bindParam(":id", $EquipoModel["id"], PDO::PARAM_INT);
		if($stmt->execute()){
			return "success";
		}else{
			return "error";
		}
		$stmt->close();
	}

}
?>