<?php

require_once "conexion.php";

class ModeloJuegos{

	/*=============================================
	CREAR JUEGO
	=============================================*/

	static public function mdlIngresarJuego($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(juego) VALUES (:juego)");

		$stmt->bindParam(":juego", $datos, PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{
			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR JUEGOS
	=============================================*/

	static public function mdlMostrarJuegos($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	EDITAR JUEGO
	=============================================*/

	static public function mdlEditarJuego($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET juego = :juego WHERE id = :id");

		$stmt -> bindParam(":juego", $datos["juego"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	BORRAR JUEGO
	=============================================*/

	static public function mdlBorrarJuego($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{
			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

}