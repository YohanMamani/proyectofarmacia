<?php


class ControladorVentas{

	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function ctrMostrarVentas($item, $valor){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	CREAR VENTA
	=============================================*/

	static public function ctrCrearVenta(){
		include 'modelos/pedidos.modelo.php';

		if(isset($_POST["nuevaVenta"])){

			/*=============================================
			ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK Y AUMENTAR LAS VENTAS DE LOS PRODUCTOS
			=============================================*/

			if($_POST["nuevoTotalVenta"] <= 0){

					echo'<script>

				swal({
					  type: "error",
					  title: "La venta no se ejecuta si no hay productos",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "ventas";

								}
							})

				</script>';

				return;
			}

			$listaProductos = json_decode($_POST["listaProductos"], true);

			$totalProductosComprados = array();
			$puntosacumulados=0;

			foreach ($listaProductos as $key => $value) {

			   array_push($totalProductosComprados, $value["cantidad"]);
				
			   $tablaProductos = "productos";

			    $item = "id";
			    $valor = $value["id"];
			    $orden = "id";
				$item3 = "descripcion";
			    $traerProductos = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);
				
				$traerProducts = ModeloProductos::mdlMostrarProductos($tablaProductos, $item3, $value["descripcion"]);

				$item1b = "stock";
				$valor1b = $value["stock"];
				$codigox = $traerProducts["codigo"];
				$stockmax =$traerProducts["stock_maximo"] + 1;
				$cantidadnecesaria = $stockmax - $traerProducts["stock"];


				echo $cantidadnecesaria;

				if ($valor1b <= 5) {
	
					$datosp = array("id"=>$value["id"],
					"codigo_producto"=>$codigox,
					"nombre_producto"=>$value["descripcion"],
					"cantidad_producto"=>$cantidadnecesaria
				);


				$tablap = "pedidos";
				$existepedido = ModeloPedidos::mdlMostrarPedidos($tablap,"codigo_producto",$codigox);

				if($existepedido == null){
					$ingresarpedido = ModeloPedidos::mdlIngresarPedido($tablap,$datosp);
				}
				
				} 


				$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);
				
			}

			$tablaClientes = "clientes";

			$item = "id";
			$valor = $_POST["seleccionarCliente"];

			$traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $item, $valor);

			$item1a = "compras_realizadas";
			$valor1a = array_sum($totalProductosComprados) + $traerCliente["compras_realizadas"];

			$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valor);

			
			//PUNTOS
			$item1p = "puntos";
			$puntosacumulados=$_POST["nuevoTotalVenta"];
			
			$valor1p = $puntosacumulados + $traerCliente["puntos"];
			
			$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1p, $valor1p, $valor);
			

			$item1b = "ultima_compra";

			date_default_timezone_set('America/Bogota');

			$fecha = date('Y-m-d');
			$hora = date('H:i:s');
			$valor1b = $fecha.' '.$hora;

			$fechaCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1b, $valor1b, $valor);

			/*=============================================
			GUARDAR LA COMPRA
			=============================================*/	

			$tabla = "ventas";


			$datos = array("descuento"=>$_POST["descuento"],
						   "id_vendedor"=>$_POST["idVendedor"],
						   "dni_cli"=>$_POST["seleccionarCliente"],
						   "codigo"=>$_POST["nuevaVenta"],
						   "productos"=>$_POST["listaProductos"],
						   "total"=>$_POST["nuevoTotalVenta"],
						   "metodo_pago"=>$_POST["listaMetodoPago"]);
			
			$respuesta = ModeloVentas::mdlIngresarVenta($tabla, $datos);
			$respuesta2 = 10; //aca tengo que llamar a la base de datos
			
			$tablape ="pedidos";

			$pedidos=ModeloPedidos::mdlMostrarPedidos($tablape,null,null);

			$numpedidos = count($pedidos);

			if($numpedidos >= 10 ){

				echo "ENTRO A SOLICITUD";

				$url = 'http://localhost:8081/recepcionarpedidos/probando';

				//create a new cURL resource
				$ch = curl_init($url);

				//setup request to send json via POST
				
				foreach ($pedidos as $key => $value) {
				$pedidosss[] = array(
								"nombreproducto" => $value["nombre_producto"],
								"cantidad" => $value["cantidad_producto"]
					);
				}

				date_default_timezone_set('America/Bogota');

				$fecha = date('Y-m-d');
				$hora = date('H:i:s');
	
				$fechaActual = $fecha.' '.$hora;

				$data = array(
					"nombre" => "INKAFARMA",
					"ruc"    => "244654524165",
					"productos" => $pedidosss,
					//"fecha" => date("Y-m-d H:i:s"),
					"fecha" => $fechaActual
				);
				
				


				$payload = json_encode(array($data));

				//attach encoded JSON string to the POST fields
				curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

				//set the content type to application/json
				curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

				//return response instead of outputting
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

				//execute the POST request
				$result = curl_exec($ch);

				//close cURL resource
				curl_close($ch);	



				$eliminartabla = ModeloPedidos::mdlEliminarPedido("pedidos");

			}

			if($respuesta == "ok"){

				echo'<script>

				localStorage.removeItem("rango");

				swal({
					  type: "success",
					  title: "La venta ha sido guardada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

									window.location = "ventas";


								}
							})

				</script>';

			}

		}

	}

	/*=============================================
	EDITAR VENTA
	=============================================*/

	static public function ctrEditarVenta(){

		if(isset($_POST["editarVenta"])){


			if($_POST["nuevoTotalVenta"] == 0){

				echo'<script>

				swal({
					type: "error",
					title: "La venta no se ejecuta si no hay productos",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"
					}).then(function(result){
								if (result.value) {

								window.location = "ventas";

								}
							})

				</script>';

				return;
			}

			/*=============================================
			FORMATEAR TABLA DE PRODUCTOS Y LA DE CLIENTES
			=============================================*/
			$tabla = "ventas";

			$item = "codigo";
			$valor = $_POST["editarVenta"];

			$traerVenta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

			
			/*=============================================
			REVISAR SI VIENE PRODUCTOS EDITADOS
			=============================================*/

			if($_POST["listaProductos"] == ""){

				$listaProductos = $traerVenta["productos"];
				$cambioProducto = false;


			}else{

				$listaProductos = $_POST["listaProductos"];

				$cambioProducto = true;
			}

			if($cambioProducto){


				

				$productos =  json_decode($traerVenta["productos"], true);

				$totalProductosComprados = array();

				foreach ($productos as $key => $value) {

					array_push($totalProductosComprados, $value["cantidad"]);
					
					$tablaProductos = "productos";

					$item = "id";
					$valor = $value["id"];
					$orden = "id";

					$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);

					$item1b = "stock";
					$valor1b = $value["cantidad"] + $traerProducto["stock"];

					$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);

				}

				$tablaClientes = "clientes";

				$itemCliente = "id";
				$valorCliente = NULL;

				$traerCliente = NULL;

				$item1a = "compras";
				$valor1a = $traerCliente["compras"] - array_sum($totalProductosComprados);

				//$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valorCliente);

				/*=============================================
				ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK Y AUMENTAR LAS VENTAS DE LOS PRODUCTOS
				=============================================*/

				$listaProductos_2 = json_decode($listaProductos, true);

				$totalProductosComprados_2 = array();

				foreach ($listaProductos_2 as $key => $value) {

					array_push($totalProductosComprados_2, $value["cantidad"]);
					
					$tablaProductos_2 = "productos";

					$item_2 = "id";
					$valor_2 = $value["id"];
					$orden = "id";

					$traerProducto_2 = ModeloProductos::mdlMostrarProductos($tablaProductos_2, $item_2, $valor_2, $orden);

					$item1b_2 = "stock";
					$valor1b_2 = $value["stock"];

					$nuevoStock_2 = ModeloProductos::mdlActualizarProducto($tablaProductos_2, $item1b_2, $valor1b_2, $valor_2);

				}

				$tablaClientes_2 = "clientes";

				$item_2 = "id";
				$valor_2 = NULL;

				$traerCliente_2 = NULL;

				$item1a_2 = "compras";
				$valor1a_2 = array_sum($totalProductosComprados_2) + $traerCliente_2["compras"];

				//$comprasCliente_2 = ModeloClientes::mdlActualizarCliente($tablaClientes_2, $item1a_2, $valor1a_2, $valor_2);

				$item1b_2 = "ultima_compra";

				date_default_timezone_set('America/Bogota');

				$fecha = date('Y-m-d');
				$hora = date('H:i:s');
				$valor1b_2 = $fecha.' '.$hora;

				$fechaCliente_2 = ModeloClientes::mdlActualizarCliente($tablaClientes_2, $item1b_2, $valor1b_2, $valor_2);

			}

			/*=============================================
			GUARDAR CAMBIOS DE LA COMPRA
			=============================================*/	

			$datos = array("id_vendedor"=>$_POST["idVendedor"],
						   "dni_cli"=>$_POST["clienteId"],
						   "codigo"=>$_POST["editarVenta"],
						   "productos"=>$listaProductos,
						   "descuento"=>$_POST["descuento"],
						   "total"=>$_POST["nuevoTotalVenta"],
						   "metodo_pago"=>$_POST["listaMetodoPago"]);


			

			$respuesta = ModeloVentas::mdlEditarVenta($tabla, $datos);


			if($respuesta == "ok"){

				echo'<script>

				localStorage.removeItem("rango");

				swal({
					  type: "success",
					  title: "La venta ha sido editada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then((result) => {
								if (result.value) {

								window.location = "ventas";

								}
							})

				</script>';

			}
			else{
				echo '<script>alert("Fuckx2");</script>';
			}
		}

	}


	/*=============================================
	ELIMINAR VENTA
	=============================================*/

	static public function ctrEliminarVenta(){

		if(isset($_GET["idVenta"])){

			$tabla = "ventas";

			$item = "id";
			$valor = $_GET["idVenta"];

			$traerVenta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

			/*=============================================
			ACTUALIZAR FECHA ÚLTIMA COMPRA
			=============================================*/

			$tablaClientes = "clientes";

			$itemVentas = null;
			$valorVentas = null;

			$traerVentas = ModeloVentas::mdlMostrarVentas($tabla, $itemVentas, $valorVentas);

			$guardarFechas = array();

			foreach ($traerVentas as $key => $value) {
				
				if($value["dni_cli"] == $traerVenta["dni_cli"]){

					array_push($guardarFechas, $value["fecha"]);

				}

			}

			if(count($guardarFechas) > 1){

				if($traerVenta["fecha"] > $guardarFechas[count($guardarFechas)-2]){

					$item = "ultima_compra";
					$valor = $guardarFechas[count($guardarFechas)-2];
					$valorIdCliente = $traerVenta["dni_cli"];

					//$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);

				}else{

					$item = "ultima_compra";
					$valor = $guardarFechas[count($guardarFechas)-1];
					$valorIdCliente = $traerVenta["dni_cli"];

					//$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);

				}


			}else{

				$item = "ultima_compra";
				$valor = "0000-00-00 00:00:00";
				$valorIdCliente = $traerVenta["dni_cli"];

				//$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);

			}

			/*=============================================
			FORMATEAR TABLA DE PRODUCTOS Y LA DE CLIENTES
			=============================================*/

			$productos =  json_decode($traerVenta["productos"], true);

			$totalProductosComprados = array();

			foreach ($productos as $key => $value) {

				array_push($totalProductosComprados, $value["cantidad"]);
				
				$tablaProductos = "productos";

				$item = "id";
				$valor = $value["id"];
				$orden = "id";

				$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);

				//$item1a = "ventas";
				//$valor1a = $traerProducto["ventas"] - $value["cantidad"];

				//$nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

				$item1b = "stock";
				$valor1b = $value["cantidad"] + $traerProducto["stock"];

				$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);

			}

			$tablaClientes = "clientes";

			$itemCliente = "id";
			$valorCliente = $traerVenta["dni_cli"];

			$traerCliente = NULL;

			$item1a = "compras";
			$valor1a = $traerCliente["compras"] - array_sum($totalProductosComprados);

			$comprasCliente = NULL;

			/*=============================================
			ELIMINAR VENTA
			=============================================*/

			$respuesta = ModeloVentas::mdlEliminarVenta($tabla, $_GET["idVenta"]);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "La venta ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "ventas";

								}
							})

				</script>';

			}		
		}

	}

	/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function ctrRangoFechasVentas($fechaInicial, $fechaFinal){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlRangoFechasVentas($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;
		
	}

	/*=============================================
	DESCARGAR EXCEL
	=============================================*/

	public function ctrDescargarReporte(){

		if(isset($_GET["reporte"])){

			$tabla = "ventas";

			if(isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"])){

				$ventas = ModeloVentas::mdlRangoFechasVentas($tabla, $_GET["fechaInicial"], $_GET["fechaFinal"]);

			}else{

				$item = null;
				$valor = null;

				$ventas = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

			}


			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

			$Name = $_GET["reporte"].'.xls';

			header('Expires: 0');
			header('Cache-control: private');
			header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
			header("Cache-Control: cache, must-revalidate"); 
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: no-cache"); 
			header('Content-Disposition: attachment; filename="'.$Name.'"');
			header("Content-Transfer-Encoding: binary");

			echo utf8_decode("<table border='0'> 

					<tr> 
					<td style='font-weight:bold; border:1px solid #eee;'>CÓDIGO</td> 
					<td style='font-weight:bold; border:1px solid #eee;'>CLIENTE</td>
					<td style='font-weight:bold; border:1px solid #eee;'>VENDEDOR</td>
					<td style='font-weight:bold; border:1px solid #eee;'>CANTIDAD</td>
					<td style='font-weight:bold; border:1px solid #eee;'>PRODUCTOS</td>	
					<td style='font-weight:bold; border:1px solid #eee;'>TOTAL</td>		
					<td style='font-weight:bold; border:1px solid #eee;'>METODO DE PAGO</td	
					<td style='font-weight:bold; border:1px solid #eee;'>FECHA</td>		
					</tr>");

			foreach ($ventas as $row => $item){

				$cliente = ControladorClientes::ctrMostrarClientes("id", $item["dni_cli"]);
				$vendedor = ControladorUsuarios::ctrMostrarUsuarios("dni", $item["id_vendedor"]);

			 echo utf8_decode("<tr>
			 			<td style='border:1px solid #eee;'>".$item["codigo"]."</td> 
			 			<td style='border:1px solid #eee;'>".$cliente["nombre"]."</td>
			 			<td style='border:1px solid #eee;'>".$vendedor["nombre"]."</td>
			 			<td style='border:1px solid #eee;'>");

			 	$productos =  json_decode($item["productos"], true);

			 	foreach ($productos as $key => $valueProductos) {
			 			
			 			echo utf8_decode($valueProductos["cantidad"]."<br>");
			 		}

			 	echo utf8_decode("</td><td style='border:1px solid #eee;'>");	

		 		foreach ($productos as $key => $valueProductos) {
			 			
		 			echo utf8_decode($valueProductos["descripcion"]."<br>");
		 		
		 		}

		 		echo utf8_decode("</td>
					<td style='border:1px solid #eee;'>S/. ".number_format($item["total"],2)."</td>
					<td style='border:1px solid #eee;'>".$item["metodo_pago"]."</td>
					<td style='border:1px solid #eee;'>".substr($item["fecha"],0,10)."</td>		
		 			</tr>");


			}


			echo "</table>";

		}

	}


	/*=============================================
	SUMA TOTAL VENTAS
	=============================================*/

	public function ctrSumaTotalVentas(){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlSumaTotalVentas($tabla);

		return $respuesta;

	}

	/*===========================================
	DAR CANTIDAD EN PRODUCTOS TOTAL VENDIDOS
	============================================*/
	static public function ctrTotalProductos($countProductos){
		$respuesta = ModeloVentas::mdlTotalProductos($countProductos);
		
		return $respuesta;
	}
}