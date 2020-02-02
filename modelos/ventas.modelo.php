<?php

require_once "conexion.php";

class ModeloVentas
{

    /*=============================================
    MOSTRAR VENTAS
    =============================================*/

    public static function mdlMostrarVentas($tabla, $item, $valor)
    {

        if ($item != null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id ASC");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();

        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id ASC");

            $stmt->execute();

            return $stmt->fetchAll();

        }

        $stmt->close();

        $stmt = null;

    }

    /*=============================================
    REGISTRO DE VENTA
    =============================================*/

    public static function mdlIngresarVenta($tabla, $datos)
    {
        print_r($datos);
        #echo '<script type="text/javascript">alert("MODELO: '.array_keys($datos).'");</script>';

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo, dni_cli, id_vendedor, productos, total, descuento, metodo_pago) VALUES (:codigo, :dni_cli, :id_vendedor, :productos, :total, :descuento, :metodo_pago)");

        $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
        $stmt->bindParam(":dni_cli", $datos["dni_cli"], PDO::PARAM_INT);
        $stmt->bindParam(":id_vendedor", $datos["id_vendedor"], PDO::PARAM_INT);
        $stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
        $stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
        $stmt->bindParam(":descuento", $datos["descuento"], PDO::PARAM_STR);


        $stmt->bindParam(":metodo_pago", $datos["metodo_pago"], PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";

        } else {

            return "error";

        }

        $stmt->close();
        $stmt = null;

    }

    /*=============================================
    EDITAR VENTA
    =============================================*/

    public static function mdlEditarVenta($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET  dni_cli = :dni_cli, id_vendedor = :id_vendedor, productos = :productos, total= :total, metodo_pago = :metodo_pago WHERE codigo = :codigo");

        $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
        $stmt->bindParam(":dni_cli", $datos["dni_cli"], PDO::PARAM_INT);
        $stmt->bindParam(":id_vendedor", $datos["id_vendedor"], PDO::PARAM_INT);
        $stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
        $stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
        $stmt->bindParam(":metodo_pago", $datos["metodo_pago"], PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";

        } else {

            return "error";

        }

        $stmt->close();
        $stmt = null;

    }

    /*=============================================
    ELIMINAR VENTA
    =============================================*/

    public static function mdlEliminarVenta($tabla, $datos)
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
    RANGO FECHAS
    =============================================*/

    public static function mdlRangoFechasVentas($tabla, $fechaInicial, $fechaFinal)
    {

        if ($fechaInicial == null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id ASC");

            $stmt->execute();

            return $stmt->fetchAll();

        } else if ($fechaInicial == $fechaFinal) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha like '%$fechaFinal%'");

            $stmt->bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetchAll();

        } else {

            $fechaActual = new DateTime();
            $fechaActual->add(new DateInterval("P1D"));
            $fechaActualMasUno = $fechaActual->format("Y-m-d");

            $fechaFinal2 = new DateTime($fechaFinal);
            $fechaFinal2->add(new DateInterval("P1D"));
            $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

            if ($fechaFinalMasUno == $fechaActualMasUno) {

                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

            } else {

                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

            }

            $stmt->execute();

            return $stmt->fetchAll();

        }

    }

    /*=============================================
    SUMAR EL TOTAL DE VENTAS
    =============================================*/

    public static function mdlSumaTotalVentas($tabla)
    {

        $stmt = Conexion::conectar()->prepare("SELECT SUM(total) as total FROM $tabla WHERE metodo_pago = 'Efectivo'");

        $stmt->execute();

        return $stmt->fetch();

        $stmt->close();

        $stmt = null;

    }

    /*=============================================
    REGISTRAR BOLETA
    =============================================*/

    public static function mdlRegistrarBoleta($datos)
    {
        $tabla = "boletas";

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_venta) VALUES (:id_venta)");

        $stmt->bindParam(":id_venta", $datos, PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "ok";

        } else {

            return "error";

        }

        $stmt->close();
        $stmt = null;

    }

    /*===========================================
    DAR CANTIDAD EN PRODUCTOS TOTAL VENDIDOS
    ============================================*/
    public static function mdlTotalProductos($countProductos)
    {

        $result = array_fill(1, $countProductos + 1, 0);

        $ventas = ModeloVentas::mdlMostrarVentas("ventas", null, null);

        for ($i = 0; $i < count($ventas); $i++) {

            $json = $ventas[$i]["productos"];

            $data = json_decode($json, true);

            foreach ($data as $key => $val) {

                $result[$val['id']] = $result[$val['id']] + $val['total'];
            }
        }

        return $result;

    }
}
