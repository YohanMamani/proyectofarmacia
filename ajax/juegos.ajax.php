<?php

require_once "../controladores/juegos.controlador.php";
require_once "../modelos/juegos.modelo.php";

class AjaxJuegos{

	/*=============================================
	EDITAR JUEGO
	=============================================*/	

	public $idJuego;

	public function ajaxEditarJuego(){

		$item = "id";
		$valor = $this->idJuego;

		$respuesta = ControladorJuegos::ctrMostrarJuegos($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR JUEGO
=============================================*/	
if(isset($_POST["idJuego"])){

	$juego = new AjaxJuegos();
	$juego -> idJuego = $_POST["idJuego"];
	$juego -> ajaxEditarJuego();
}
