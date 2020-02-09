<meta charset="utf-8"> 
<h1>probando </h1>
<?php
/**
*Autor: Alejandro Esquiva Rodríguez (@alex_esquiva)
*Desarrollado para Geeky Theory
*
*Este archivo estará a la escucha de llamadas procedentes del cliente JAVA
*/
//--Incluimos el archivo en usuarioClass.php
require_once("pedidosClass.php"); 
//Comprobamos si hemos recibido alguna llamada por POST
if(isset($_POST["json"])){
	$json = $_POST["json"];
	$json = urldecode($json);
	$json = str_replace("\\", "",$json);
	$jsonencode = json_decode($_POST["json"],true);

	print_r("JSONN1");

	print_r($_POST["json"]);

	print_r("JSAONN2");
	print_r($jsonencode[0]["nombrefarmacia"]);
	print_r("JSAONN3");
	//--Creamos un objeto de la clase Usuarios
	$userObject = new Pedidos();
	//Insertamos un nuevo usuario en la base de datos
	$userObject->createPedido($jsonencode[0]["nombrelaboratorio"],$jsonencode[0]["nombrefarmacia"],$jsonencode[0]["fechaconfirmacion"],$jsonencode[0]["mensaje"]);
}
?>