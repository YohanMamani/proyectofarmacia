<?php

require_once "../controladores/finanzas.controlador.php";
require_once "../modelos/finanzas.modelo.php";

class AjaxFinanzas
{

    /*=============================================
    EDITAR EGRESO
    =============================================*/

    public $idEgreso;

    public function ajaxEditarEgreso()
    {

        $item  = "id";
        $valor = $this->idEgreso;

        $respuesta = ControladorFinanzas::ctrMostrarFinanzas($item, $valor);

        echo json_encode($respuesta);

    }
}

/*=============================================
EDITAR EGRESO
=============================================*/
if (isset($_POST["idEgreso"])) {

    $editarEgreso           = new AjaxFinanzas();
    $editarEgreso->idEgreso = $_POST["idEgreso"];
    $editarEgreso->ajaxEditarEgreso();
}
