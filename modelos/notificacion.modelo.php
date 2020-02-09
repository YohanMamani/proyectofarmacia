<?php

require_once "conexion.php";

class ModeloNotificaciones{


	/*=============================================
	MOSTRAR JUEGOS
	=============================================*/

	static public function mdlMostrarNotificaciones($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id desc");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id desc");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}


	/*=============================================
	Numero de pedidos
	=============================================*/


	public static function numerofilaspedidos($tabla)
	{

        $stmt = Conexion::conectar()->prepare("SELECT SUM(egreso) as egreso FROM $tabla");

        $stmt->execute();

        return $stmt->fetch();

        $stmt->close();

        $stmt = null;

	}
	
	/*=============================================
    BORRAR TABLA PEDIDO
    =============================================*/

    public static function mdlEliminarPedido($tabla)
    {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla");

        if ($stmt->execute()) {

            return "ok";

        } else {

            return "error";

        }

        $stmt->close();

        $stmt = null;

    }

}