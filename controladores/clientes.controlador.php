<?php

class ControladorClientes{

	/*=============================================
	CREAR CLIENTES
	=============================================*/

	static public function ctrCrearCliente(){

		if(isset($_POST["nuevoCliente"])){

			if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoCliente"]) &&
			   preg_match('/^[0-9]{8}+$/', $_POST["nuevoDocumentoId"]) &&
			   preg_match('/^[()\-0-9 ]{7,9}+$/', $_POST["nuevoTelefono"]) &&
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["nuevoCorreo"]) &&
			   preg_match('/^[#\.\-a-zA-Z]{3,40}+$/', $_POST["nuevoDistrito"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoJuego"])

			){

			   	$tabla = "clientes";

			   	$datos = array("nombre"=>$_POST["nuevoCliente"],
					           "dni"=>$_POST["nuevoDocumentoId"],
					           "telefono"=>$_POST["nuevoTelefono"],
					       	   "correo"=>$_POST["nuevoCorreo"],
					           "distrito"=>$_POST["nuevoDistrito"],
					           "juego_interes"=>$_POST["nuevoJuego"]);

				$respuesta = ModeloClientes::mdlIngresarCliente($tabla, $datos);
				

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El cliente ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "clientes";

									}
								})

					</script>';

				}
				elseif($respuesta == "correo"){
					echo'<script>

					swal({
						  type: "error",
						  title: "El correo debe ser único",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "clientes";

									}
								})

					</script>';
				} else{
					echo'<script>

					swal({
						  type: "error",
						  title: "El número de DNI debe ser unico",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "crear-venta";

									}
								})

					</script>';
					
				}
				
				   

			}else{


				echo'<script>

					swal({
						  type: "error",
						  title: "¡El cliente no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

								window.location = "clientes";
							}
						})

			  	</script>';



			}

		}

	}

	/*=============================================
	CREAR CLIENTES RAPIDO
	=============================================*/

	static public function ctrCrearClienteR(){

		if(isset($_POST["nuevoCliente"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoCliente"]) &&
			   preg_match('/^[0-9]+$/', $_POST["nuevoDocumentoId"])){

			   	$tabla = "clientes";

			   	$datos = array("nombre"=>$_POST["nuevoCliente"],
					           "dni"=>$_POST["nuevoDocumentoId"]);

			   	$respuesta = ModeloClientes::mdlIngresarClienteR($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El cliente ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "crear-venta";

									}
								})

					</script>';

				}
				else{
					echo'<script>

					swal({
						  type: "error",
						  title: "El número de DNI debe ser unico",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "crear-venta";

									}
								})

					</script>';
				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El cliente no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

								window.location = "crear-venta";
							}
						})

			  	</script>';



			}

		}

	}

	/*=============================================
	MOSTRAR CLIENTES
	=============================================*/

	static public function ctrMostrarClientes($item, $valor){

		$tabla = "clientes";

		$respuesta = ModeloClientes::mdlMostrarClientes($tabla, $item, $valor);

		return $respuesta;

	}
	
	/*=============================================
	EDITAR CLIENTE
	=============================================*/

	static public function ctrEditarCliente(){

		if(isset($_POST["editarCliente"])){

			if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCliente"]) &&
			   preg_match('/^[0-9]+$/', $_POST["editarDocumentoId"]) &&
			   preg_match('/^[()\-0-9]{7,9}+$/', $_POST["editarTelefono"])  &&
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["editarCorreo"]) &&
			   preg_match('/^[#\.\-a-zA-Z]+$/', $_POST["editarDistrito"]) &&
			   preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarJuego"])

			  ){

			   	$tabla = "clientes";

			   	$datos = array("id"=>$_POST["idCliente"],
			   				   "nombre"=>$_POST["editarCliente"],
					           "dni"=>$_POST["editarDocumentoId"],
					           "telefono"=>$_POST["editarTelefono"],
					       	   "correo"=>$_POST["editarCorreo"],
					           "distrito"=>$_POST["editarDistrito"],
					           "juego_interes"=>$_POST["editarJuego"]);

			   	$respuesta = ModeloClientes::mdlEditarCliente($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El cliente ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "clientes";

									}
								})

					</script>';

				}else{
					if($respuesta == "correo"){
						echo'<script>
	
						swal({
							  type: "error",
							  title: "El correo debe ser único",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {
	
										window.location = "clientes";
	
										}
									})
	
						</script>';
					}
				}
			
			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El cliente no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							}
						})

			  	</script>';



			}

		}

	}

	/*=============================================
	ELIMINAR CLIENTE
	=============================================*/

	static public function ctrEliminarCliente(){



		if(isset($_GET["dni"])){



			$tabla ="clientes";
			$datos = $_GET["dni"];

			$respuesta = ModeloClientes::mdlEliminarCliente($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El cliente ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  }).then(function(result){
								if (result.value) {

								window.location = "clientes";

								}
							})

				</script>';

			}		
			else{
				echo'<script>

					swal({
						  type: "error",
						  title: "No se puede borrar, este cliente tiene asociado ventas",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "clientes";

									}
								})

					</script>';
			}

		}

	}

}