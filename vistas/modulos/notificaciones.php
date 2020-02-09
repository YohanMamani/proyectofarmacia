<div class="content-wrapper">

  <section class="content-header">
    <center>    <h1>

Notificaciones de Pedidos

</h1></center>



  </section>



  <section class="content">

    <div class="box">

      <div class="box-body">

       
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nombre Laboratorio</th>
      <th scope="col">Mensaje</th>
      <th scope="col">Fecha</th>
    </tr>
  </thead>
  <tbody>
    <?php

$item = null;

$valor = null;

$notificaciones = ControladorProductos::ctrMostrarNotificaciones($item, $valor);



foreach ($notificaciones as $key => $value) {

    $id = $value["id"];
    echo '<tr>
                  <th scope="row">' . $id . '</th>';

    echo '<td>' . $value["nombrelaboratorio"] . '</td>
                  <td>' . $value["mensaje"] . '</td>
                  <td>' . $value["fechaconfirmacion"] . '</td>                  

                </tr>';

}

?>
  </tbody>
</table>

      </div>

    </div>

  </section>

</div>
