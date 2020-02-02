/*=============================================
EDITAR JUEGO
=============================================*/
$(".tablas").on("click", ".btnEditarJuego", function(){

	var idJuego = $(this).attr("idJuego");

	var datos = new FormData();
	datos.append("idJuego", idJuego);

	$.ajax({
		url: "ajax/juegos.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

     		$("#editarJuego").val(respuesta["juego"]);
     		$("#idJuego").val(respuesta["id"]);

     	}

	})


})

/*=============================================
ELIMINAR JUEGO
=============================================*/
$(".tablas").on("click", ".btnEliminarJuego", function(){

	 var idJuego = $(this).attr("idJuego");

	 swal({
	 	title: '¿Está seguro de borrar el juego?',
	 	text: "¡Si no lo está puede cancelar la acción!",
	 	type: 'warning',
	 	showCancelButton: true,
	 	confirmButtonColor: '#3085d6',
	 	cancelButtonColor: '#d33',
	 	cancelButtonText: 'Cancelar',
	 	confirmButtonText: 'Si, borrar juego!'
	 }).then(function(result){

	 	if(result.value){

	 		window.location = "index.php?ruta=juegos&idJuego="+idJuego;

	 	}

	 })

})