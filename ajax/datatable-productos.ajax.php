<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/juegos.controlador.php";
require_once "../modelos/juegos.modelo.php";

class TablaProductos
{

    /*=============================================
    MOSTRAR LA TABLA DE PRODUCTOS
    =============================================*/

    public function mostrarTablaProductos()
    {

        $item  = null;
        $valor = null;

        $productos = ControladorProductos::ctrMostrarProductos($item, $valor);

        $n = count($productos);

        if ($n == 0) {
            $datosJson = '{
                  "data": []
            }';
        } else {
            $datosJson = '{
                "data": [';

            for ($i = 0; $i < $n; $i++) {

                /*=============================================
                TRAEMOS LA JUEGOS
                =============================================*/

                $item  = "id";
                $valor = $productos[$i]["id_juego"];

                $juegos = ControladorJuegos::ctrMostrarJuegos($item, $valor);

                /*=============================================
                STOCK
                =============================================*/

                if ($productos[$i]["stock"] <= 5) {

                    $stock = "<button class='btn btn-danger'>" . $productos[$i]["stock"] . "</button>";

                } else if ($productos[$i]["stock"] > 5 && $productos[$i]["stock"] <= 10) {

                    $stock = "<button class='btn btn-warning'>" . $productos[$i]["stock"] . "</button>";

                } else {

                    $stock = "<button class='btn btn-success'>" . $productos[$i]["stock"] . "</button>";

                }

                /*=============================================
                TRAEMOS LAS ACCIONES
                =============================================*/

                $botones = "<div class='btn-group'><button class='btn btn-warning btnEditarProducto' idProducto='" . $productos[$i]["id"] . "' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarProducto' descripcion='" . $productos[$i]["descripcion"] . "' idProducto='" . $productos[$i]["id"] . "' codigo='" . $productos[$i]["codigo"] . "'><i class='fa fa-times'></i></button></div>";

                $datosJson .= '[
                    "' . ($i + 1) . '",
                    "' . $juegos["juego"] . '",
                    "' . $productos[$i]["codigo"] . '",
                    "' . $productos[$i]["descripcion"] . '",
                    "' . $stock . '",
                    "' . $productos[$i]["precio_compra"] . '",
                    "' . $productos[$i]["precio_venta"] . '",
                    "' . $productos[$i]["fecha"] . '",
                    "' . $botones . '"
                 ],';

            }

            $datosJson = substr($datosJson, 0, -1);

            $datosJson .= ']
            }';
        }

        echo $datosJson;

    }

}

/*=============================================
ACTIVAR TABLA DE PRODUCTOS
=============================================*/
$activarProductos = new TablaProductos();
$activarProductos->mostrarTablaProductos();