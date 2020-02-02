	<?php

class ControladorJuegos
{

    /*=============================================
    CREAR JUEGOS
    =============================================*/

    public static function ctrCrearJuego()
    {

        if (isset($_POST["nuevoJuego"])) {

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoJuego"])) {

                $tabla = "juegos";

                $datos = $_POST["nuevoJuego"];

                $respuesta = ModeloJuegos::mdlIngresarJuego($tabla, $datos);

                if ($respuesta == "ok") {

                    echo '<script>

					swal({
						  type: "success",
						  title: "El juego ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "juegos";

									}
								})

					</script>';

                }

            } else {

                echo '<script>

					swal({
						  type: "error",
						  title: "¡La categoría no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "juegos";

							}
						})

			  	</script>';

            }

        }

    }

    /*=============================================
    MOSTRAR JUEGOS
    =============================================*/

    public static function ctrMostrarJuegos($item, $valor)
    {

        $tabla = "juegos";

        $respuesta = ModeloJuegos::mdlMostrarJuegos($tabla, $item, $valor);

        return $respuesta;

    }

    /*=============================================
    EDITAR JUEGO
    =============================================*/

    public static function ctrEditarJuego()
    {

        if (isset($_POST["editarJuego"])) {

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarJuego"])) {

                $tabla = "juegos";

                $datos = array("juego" => $_POST["editarJuego"],
                    "id"                   => $_POST["idJuego"]);

                $respuesta = ModeloJuegos::mdlEditarJuego($tabla, $datos);

                if ($respuesta == "ok") {

                    echo '<script>

					swal({
						  type: "success",
						  title: "El juego ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "juegos";

									}
								})

					</script>';

                }

            } else {

                echo '<script>

					swal({
						  type: "error",
						  title: "¡El juego no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "juegos";

							}
						})

			  	</script>';

            }

        }

    }

    /*=============================================
    BORRAR JUEGO
    =============================================*/

    public static function ctrBorrarJuego()
    {

        if (isset($_GET["idJuego"])) {

            $tabla = "juegos";
            $datos = $_GET["idJuego"];

            $respuesta = ModeloJuegos::mdlBorrarJuego($tabla, $datos);

            if ($respuesta == "ok") {

                echo '<script>

					swal({
						  type: "success",
						  title: "La categoría ha sido borrada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "juegos";

									}
								})

					</script>';
            } else {
                echo '<script>

					swal({
						  type: "error",
						  title: "No se puede borrar, este juego tiene productos asociados",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "juegos";

									}
								})

					</script>';
            }
        }

    }
}