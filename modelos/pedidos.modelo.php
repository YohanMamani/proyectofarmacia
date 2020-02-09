<?php

require_once "conexion.php";

class ModeloPedidos{

	/*=============================================
	CREAR pedido
	=============================================*/

	static public function mdlIngresarPedido($tabla, $datos){


		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id,codigo_producto,nombre_producto,cantidad_producto) VALUES (:id, :codigo_producto, :nombre_producto,:cantidad_producto)");
		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);		
		$stmt->bindParam(":codigo_producto", $datos["codigo_producto"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre_producto", $datos["nombre_producto"], PDO::PARAM_STR);
        $stmt->bindParam(":cantidad_producto", $datos["cantidad_producto"], PDO::PARAM_INT);

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

	static public function mdlMostrarPedidos($tabla, $item, $valor){

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