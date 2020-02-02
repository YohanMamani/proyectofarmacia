<?php

require_once "conexion.php";

class ModeloProductos
{

    /*============================================
    FROM EXCEL TO PRODUCTOS
    ============================================*/
    public static function mdlExcelProductos()
    {

        $stmt = Conexion::conectar()->prepare("SELECT juego FROM excel");
        $stmt->execute();

        $juegos = $stmt->fetchAll();

        foreach ($juegos as $juego) {
            $stmt = Conexion::conectar()->prepare("SELECT id FROM juegos where juego = :juego");
            $stmt->bindParam(":juego", $juego["juego"], PDO::PARAM_STR);
            $stmt->execute();
            $n = count($stmt->fetchAll());

            if ($n == 0) {
                $stmt = Conexion::conectar()->prepare("INSERT INTO juegos(juego) VALUES(:juego)");
                $stmt->bindParam(":juego", $juego["juego"], PDO::PARAM_STR);
                $stmt->execute();
            }
        }

        $stmt = Conexion::conectar()->prepare("INSERT INTO productos(id_juego, codigo, descripcion, stock, precio_compra, precio_venta)
		SELECT j.id, ex.Codigo, ex.Descripcion, ex.Cantidad, ex.Costo
			, ex.Precio
		FROM excel ex INNER JOIN juegos j ON (ex.Juego = j.juego)
		ON DUPLICATE KEY UPDATE id_juego = j.id, descripcion = ex.Descripcion, stock = ex.Cantidad, precio_compra = ex.Costo,
			precio_venta = ex.Precio");
        $stmt->execute();
    }

    /*=============================================
    AGREGAR LISTA PRODUCTOS
    =============================================*/
    public static function mdlAgregarListaProductos($tabla, $inputFileName)
    {

        $error_products = array();

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla");
        $stmt->execute();

        $objPHPExcel = PHPExcel_IOFactory::load($inputFileName); //LINK DEL ARCHIVO EXCEL

        $objPHPExcel->setActiveSheetIndex(0); //SE SITUA AL INICIO

        $numRows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow(); // CUENTA CUANTAS FILAS HAY

        for ($i = 2; $i <= $numRows; $i++) {
            //LEE UNO POR UNO

            $codigo      = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue();
            $descripcion = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue();
            $juego       = $objPHPExcel->getActiveSheet()->getCell('C' . $i)->getCalculatedValue();
            $precio      = $objPHPExcel->getActiveSheet()->getCell('D' . $i)->getCalculatedValue();
            $costo       = $objPHPExcel->getActiveSheet()->getCell('E' . $i)->getCalculatedValue();
            $cantidad    = $objPHPExcel->getActiveSheet()->getCell('F' . $i)->getCalculatedValue();

            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla values('$codigo','$descripcion','$juego','$precio','$costo','$cantidad')");

            if ($stmt->execute()) {
            } else {
                array_push($error_products, $i);
            }
        }

        ModeloProductos::mdlExcelProductos();

        return $error_products;

        $stmt->close();
        $stmt = null;
    }

    /*=============================================
    MOSTRAR PRODUCTOS
    =============================================*/
    public static function mdlMostrarProductos($tabla, $item, $valor)
    {

        if ($item != null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id DESC");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();

        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

            $stmt->execute();

            return $stmt->fetchAll();

        }

        $stmt->close();

        $stmt = null;

    }

    /*=============================================
    REGISTRO DE PRODUCTO
    =============================================*/
    public static function mdlIngresarProducto($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_juego, codigo, descripcion, stock, precio_compra, precio_venta) VALUES (:id_juego, :codigo, :descripcion, :stock, :precio_compra, :precio_venta)");

        $stmt->bindParam(":id_juego", $datos["id_juego"], PDO::PARAM_INT);
        $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
        $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
        $stmt->bindParam(":precio_compra", $datos["precio_compra"], PDO::PARAM_STR);
        $stmt->bindParam(":precio_venta", $datos["precio_venta"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";

        } else {

            return "error";

        }

        $stmt->close();
        $stmt = null;

    }

    /*=============================================
    EDITAR PRODUCTO
    =============================================*/
    public static function mdlEditarProducto($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_juego = :id_juego, descripcion = :descripcion, stock = :stock, precio_compra = :precio_compra, precio_venta = :precio_venta WHERE codigo = :codigo");

        $stmt->bindParam(":id_juego", $datos["id_juego"], PDO::PARAM_INT);
        $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
        $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
        $stmt->bindParam(":precio_compra", $datos["precio_compra"], PDO::PARAM_STR);
        $stmt->bindParam(":precio_venta", $datos["precio_venta"], PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";

        } else {

            return "error";

        }

        $stmt->close();
        $stmt = null;

    }

    /*=============================================
    BORRAR PRODUCTO
    =============================================*/

    public static function mdlEliminarProducto($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

        $stmt->bindParam(":id", $datos, PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "ok";

        } else {

            return "error";

        }

        $stmt->close();

        $stmt = null;

    }

    /*=============================================
    ACTUALIZAR PRODUCTO
    =============================================*/

    public static function mdlActualizarProducto($tabla, $item1, $valor1, $valor)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE id = :id");

        $stmt->bindParam(":" . $item1, $valor1, PDO::PARAM_STR);
        $stmt->bindParam(":id", $valor, PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";

        } else {

            return "error";

        }

        $stmt->close();

        $stmt = null;

    }
}
