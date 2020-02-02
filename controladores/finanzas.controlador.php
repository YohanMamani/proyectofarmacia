<?php

class ControladorFinanzas
{

    /*=============================================
    CREAR Egreso
    =============================================*/

    public static function ctrCrearFinanzas()
    {

        if (isset($_POST["nuevoEgreso"])) {

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoDescripcion"]) &&
                preg_match('/^[0-9.]+$/', $_POST["nuevoEgreso"])

            ) {

                $tabla = "finanzas";

                $datos = array("descripcion" => $_POST["nuevoDescripcion"],
                    "egreso"                     => $_POST["nuevoEgreso"],
                );

                $respuesta = ModeloFinanzas::mdlIngresarFinanzas($tabla, $datos);

                if ($respuesta == "ok") {

                    echo '<script>

                    swal({
                          type: "success",
                          title: "El Egreso ha sido guardado correctamente",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar"
                          }).then(function(result){
                                    if (result.value) {

                                    window.location = "finanzas";

                                    }
                                })

                    </script>';

                } else {
                    echo '<script>

                    swal({
                          type: "error",
                          title: "El número de ID debe ser único",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar"
                          }).then(function(result){
                                    if (result.value) {

                                    window.location = "finanzas";

                                    }
                                })

                    </script>';
                }

            } else {

                echo '<script>

                    swal({
                          type: "error",
                          title: "¡La descripcion no puede ir vacío o llevar caracteres especiales!",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar"
                          }).then(function(result){
                            if (result.value) {

                                window.location = "finanzas";
                            }
                        })

                </script>';

            }

        }

    }

    /*=============================================
    MOSTRAR Egresos
    =============================================*/

    public static function ctrMostrarFinanzas($item, $valor)
    {

        $tabla = "finanzas";

        $respuesta = ModeloFinanzas::mdlMostrarFinanzas($tabla, $item, $valor);

        return $respuesta;

    }

    /*=============================================
    EDITAR Egreso
    =============================================*/

    public static function ctrEditarFinanzas()
    {

        if (isset($_POST["editarEgreso"])) {

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDescripcion"]) &&
                preg_match('/^[0-9.]+$/', $_POST["editarEgreso"])

            ) {

                $tabla = "finanzas";

                $datos = array("id" => $_POST["idEgreso"],
                    "descripcion"       => $_POST["editarDescripcion"],
                    "egreso"            => $_POST["editarEgreso"],
                );

                $respuesta = ModeloFinanzas::mdlEditarFinanzas($tabla, $datos);

                if ($respuesta == "ok") {

                    echo '<script>

                    swal({
                          type: "success",
                          title: "El egreso ha sido cambiado correctamente",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar"
                          }).then(function(result){
                                    if (result.value) {

                                    window.location = "finanzas";

                                    }
                                })

                    </script>';

                }

            } else {

                echo '<script>

                    swal({
                          type: "error",
                          title: "¡El egreso no puede ir vacío o llevar caracteres especiales!",
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
    SUMAR EL TOTAL DE EGRESOS
    =============================================*/

    public function ctrSumaTotalEgresos()
    {

        $tabla = "finanzas";

        $respuesta = ModeloFinanzas::mdlSumaTotalEgresos($tabla);

        return $respuesta;

    }

    /*=============================================
    ELIMINAR Egreso
    =============================================*/

    public static function ctrEliminarFinanzas()
    {

        if (isset($_GET["idEgreso"])) {

            $tabla = "finanzas";
            $datos = $_GET["idEgreso"];

            $respuesta = ModeloFinanzas::mdlEliminarFinanzas($tabla, $datos);

            if ($respuesta == "ok") {

                echo '<script>

                swal({
                      type: "success",
                      title: "El egreso ha sido borrado correctamente",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar",
                      }).then(function(result){
                                if (result.value) {

                                window.location = "finanzas";

                                }
                            })

                </script>';

            } else {
                echo '<script>

                    swal({
                          type: "error",
                          title: "No se puede borrar",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar"
                          }).then(function(result){
                                    if (result.value) {

                                    window.location = "finanzas";

                                    }
                                })

                    </script>';
            }

        }

    }

}
