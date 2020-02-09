<?php
include 'modelos/notificacion.modelo.php';

class ControladorProductos
{

    

    /*=============================================
    CREAR PEDIDO
    =============================================*/

    public static function ctrCrearPedido()
    {

        if (isset($_POST["aceptar"])) {

            $tablape ="pedidos";

			$pedidos=ModeloPedidos::mdlMostrarPedidos($tablape,null,null);

			$numpedidos = count($pedidos);

            echo "AQUIIIIIIIIIII" +$numpedidos;

            $url = 'http://localhost:8081/recepcionar/probando';

            //create a new cURL resource
            $ch = curl_init($url);

            //setup request to send json via POST
            
            foreach ($pedidos as $key => $value) {
            $pedidosss[] = array(
                            "Producto" => $value["nombre_producto"],
                            "cantidad" => $value["cantidad_producto"]
                );
            }

            $data = array(
                "farmacia" => "INKAFARMA",
                "RUC"    => "244654524165",
                "Pedidos" => $pedidosss,
                "fechaSolicitud" => date("Y-m-d H:i:s")
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

            
                            if($numpedidos==0){
                                $respuesta =="fake";
                            }else{
                                $respuesta = "ok";
                            }

                                echo "AQUIEEEE" + $respuesta + " Y " + $numpedidos;
                            if ($respuesta == "ok") {
            
                                echo '<script>
            
                                    swal({
                                          type: "success",
                                          title: "El pedido ha sido enviado correctamente",
                                          showConfirmButton: true,
                                          confirmButtonText: "Cerrar"
                                          }).then(function(result){
                                                    if (result.value) {
            
                                                    window.location = "productos";
            
                                                    }
                                                })
            
                                    </script>';
            
                            } else {
                                echo '<script>
            
                                    swal({
                                        type: "error",
                                        title: "No hay productos a solicitar",
                                        showConfirmButton: true,
                                        confirmButtonText: "Cerrar"
                                    }).then(function(result){
                                        if (result.value) {
            
                                            window.location = "productos";
            
                                        }
                                    })
            
                                  </script>';
                            }
            
             

        }

    }


    /*=============================================
    MOSTRAR PRODUCTOS
    =============================================*/
    public static function ctrMostrarProductos($item, $valor)
    {

        $tabla = "productos";

        $respuesta = ModeloProductos::mdlMostrarProductos($tabla, $item, $valor);

        return $respuesta;

    }

    /*=============================================
    MOSTRAR Pedidos
    =============================================*/
    public static function ctrMostrarNotificaciones($item, $valor)
    {

        $tabla = "notificaciones";

        $respuesta = ModeloNotificaciones::mdlMostrarNotificaciones($tabla, $item, $valor);

        return $respuesta;

    }







    /*=============================================
    AGREGAR LISTA DE PRODUCTOS
    =============================================*/
    public static function ctrAgregarListaProductos()
    {

        if (isset($_FILES["nuevoExcel"])) {
            $inputFileName = $_FILES["nuevoExcel"]["tmp_name"];

            $tabla = "excel";

            $array = ModeloProductos::mdlAgregarListaProductos($tabla, $inputFileName);

            if (empty($array)) {
                echo '<script>

						swal({
							  type: "success",
							  title: "La lista de productos ha sido guardada correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "productos";

										}
									})

						</script>';
            } else {
                $string = implode(',', $array);
                echo '<script>

					swal({
						  type: "error",
						  title: "Las siguientes filas no se pudieron ingresar: ' . $string . ',
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "productos";

							}
						})

			  	</script>';
            }
        }
    }

    /*=============================================
    CREAR PRODUCTO
    =============================================*/

    public static function ctrCrearProducto()
    {

        if (isset($_POST["nuevaDescripcion"])) {

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaDescripcion"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoCodigo"]) &&
                preg_match('/^[0-9]+$/', $_POST["nuevoStock"]) &&
                preg_match('/^[0-9.]+$/', $_POST["nuevoPrecioCompra"]) &&
                preg_match('/^[0-9.]+$/', $_POST["nuevoPrecioVenta"])
            ) {

                $tabla = "productos";

                $datos = array("id_juego" => $_POST["nuevoJuego"],
                    "codigo"                  => $_POST["nuevoCodigo"],
                    "descripcion"             => $_POST["nuevaDescripcion"],
                    "stock"                   => $_POST["nuevoStock"],
                    "precio_compra"           => $_POST["nuevoPrecioCompra"],
                    "precio_venta"            => $_POST["nuevoPrecioVenta"],
                    "valor_puntos"            => $_POST["nuevoValorPunto"]);

                $respuesta = ModeloProductos::mdlIngresarProducto($tabla, $datos);

                if ($respuesta == "ok") {

                    echo '<script>

						swal({
							  type: "success",
							  title: "El producto ha sido guardado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "productos";

										}
									})

						</script>';

                } else {
                    echo '<script>

						swal({
							type: "error",
							title: "El código debe ser único",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
						}).then(function(result){
							if (result.value) {

								window.location = "productos";

							}
						})

			  		</script>';
                }

            } else {

                echo '<script>

					swal({
						  type: "error",
						  title: "¡El producto no puede ir con los campos vacíos o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "productos";

							}
						})

			  	</script>';
            }
        }

    }

    /*=============================================
    EDITAR PRODUCTO
    =============================================*/

    public static function ctrEditarProducto()
    {

        if (isset($_POST["editarDescripcion"])) {

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDescripcion"]) &&
                preg_match('/^[0-9]+$/', $_POST["editarStock"]) &&
                preg_match('/^[0-9.]+$/', $_POST["editarPrecioCompra"]) &&
                preg_match('/^[0-9.]+$/', $_POST["editarPrecioVenta"])) {

                $tabla = "productos";

                $datos = array("id_juego" => $_POST["editarJuego"],
                    "codigo"                  => $_POST["editarCodigo"],
                    "descripcion"             => $_POST["editarDescripcion"],
                    "stock"                   => $_POST["editarStock"],
                    "precio_compra"           => $_POST["editarPrecioCompra"],
                    "precio_venta"            => $_POST["editarPrecioVenta"],
                    "valor_puntos"            => $_POST["editarValorPunto"]);

                $respuesta = ModeloProductos::mdlEditarProducto($tabla, $datos);

                if ($respuesta == "ok") {

                    echo '<script>

						swal({
							  type: "success",
							  title: "El producto ha sido editado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "productos";

										}
									})

						</script>';

                }

            } else {

                echo '<script>

					swal({
						  type: "error",
						  title: "¡El producto no puede ir con los campos vacíos o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "productos";

							}
						})

			  	</script>';
            }
        }

    }

    /*=============================================
    BORRAR PRODUCTO
    =============================================*/
    public static function ctrEliminarProducto()
    {

        if (isset($_GET["idProducto"])) {

            $tabla = "productos";
            $datos = $_GET["idProducto"];

            if ($_GET["imagen"] != "" && $_GET["imagen"] != "vistas/img/productos/default/anonymous.png") {

                unlink($_GET["imagen"]);
                rmdir('vistas/img/productos/' . $_GET["codigo"]);

            }

            $totalProductos = ControladorVentas::ctrTotalProductos(count($productos));
            if ($totalProductos[$datos] != 0) {
                $respuesta = "error";
            } else {
                $respuesta = ModeloProductos::mdlEliminarProducto($tabla, $datos);
            }

            if ($respuesta == "ok") {

                echo '<script>

				swal({
					  type: "success",
					  title: "El producto ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "productos";

								}
							})

				</script>';

            } else {
                echo '<script>

					swal({
						  type: "error",
						  title: "No se puede borrar, este producto tiene ventas asociadas",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "productos";

									}
								})

					</script>';
            }
        }

    }

}
