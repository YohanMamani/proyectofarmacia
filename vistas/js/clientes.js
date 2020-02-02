/*=============================================
EDITAR CLIENTE
=============================================*/
$(".tablas").on("click", ".btnEditarCliente", function() {

    var idCliente = $(this).attr("idCliente");

    var datos = new FormData();
    datos.append("idCliente", idCliente);

    $.ajax({

        url: "ajax/clientes.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {

            $("#idCliente").val(respuesta["id"]);
            $("#editarDocumentoId").val(respuesta["dni"]);
            $("#editarCliente").val(respuesta["nombre"]);
            $("#editarTelefono").val(respuesta["telefono"]);
            $("#editarCorreo").val(respuesta["correo"]);
            $("#editarDistrito").val(respuesta["distrito"]);
            $("#editarJuego").val(respuesta["juego_interes"]);

        }

    })

})

/*=============================================
ELIMINAR CLIENTE
=============================================*/
$(".tablas").on("click", ".btnEliminarCliente", function() {

    var dniCliente = $(this).attr("dni");
    var nombreCliente = $(this).attr("nombre");


    swal({
        title: '¿Está seguro de eliminar al cliente ' + nombreCliente + '?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar cliente!'
    }).then(function(result) {
        if (result.value) {

            window.location = "index.php?ruta=clientes&dni=" + dniCliente;
        }

    })

})