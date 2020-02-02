<?php

require_once "conexion.php";

class ModeloFinanzas
{

    /*=============================================
    CREAR Egreso
    =============================================*/

    public static function mdlIngresarFinanzas($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(descripcion, egreso) VALUES (:descripcion, :egreso)");

        $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $stmt->bindParam(":egreso", $datos["egreso"], PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";

        } else {

            return "error";

        }

        $stmt->close();
        $stmt = null;

    }

    /*=============================================
    MOSTRAR Egresos
    =============================================*/

    public static function mdlMostrarFinanzas($tabla, $item, $valor)
    {

        if ($item != null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item order by id desc");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();

        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla order by id desc");

            $stmt->execute();

            return $stmt->fetchAll();

        }

        $stmt->close();

        $stmt = null;

    }

    /*=============================================
    EDITAR Egreso
    =============================================*/

    public static function mdlEditarFinanzas($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET descripcion = :descripcion, egreso = :egreso WHERE id = :id");

        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
        $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $stmt->bindParam(":egreso", $datos["egreso"], PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";

        } else {

            return "error";

        }

        $stmt->close();
        $stmt = null;

    }

    /*=============================================
    ELIMINAR Egreso
    =============================================*/

    public static function mdlEliminarFinanzas($tabla, $datos)
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
    SUMAR EL TOTAL DE EGRESOS
    =============================================*/

    public static function mdlSumaTotalEgresos($tabla)
    {

        $stmt = Conexion::conectar()->prepare("SELECT SUM(egreso) as egreso FROM $tabla");

        $stmt->execute();

        return $stmt->fetch();

        $stmt->close();

        $stmt = null;

    }

}
