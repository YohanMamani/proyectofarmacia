/*=============================================
EDITAR JUEGO
=============================================*/
$(".tablas").on("click", ".btnEditarEgreso", function(){

	var idEgreso = $(this).attr("idEgreso");

	var datos = new FormData();
	datos.append("idEgreso", idEgreso);

	$.ajax({
		url: "ajax/finanzas.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

     		$("#editarDescripcion").val(respuesta["descripcion"]);
     		$("#editarEgreso").val(respuesta["egreso"]);
     		$("#idEgreso").val(respuesta["id"]);

     	}

	})


})

/*=============================================
ELIMINAR EGRESO
=============================================*/
$(".tablas").on("click", ".btnEliminarEgreso", function(){

	 var idEgreso = $(this).attr("idEgreso");

	 swal({
	 	title: '¿Está seguro de borrar el egreso?',
	 	text: "¡Si no lo está puede cancelar la acción!",
	 	type: 'warning',
	 	showCancelButton: true,
	 	confirmButtonColor: '#3085d6',
	 	cancelButtonColor: '#d33',
	 	cancelButtonText: 'Cancelar',
	 	confirmButtonText: 'Si, borrar egreso!'
	 }).then(function(result){

	 	if(result.value){

	 		window.location = "index.php?ruta=finanzas&idEgreso="+idEgreso;

	 	}

	 })

})