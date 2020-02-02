<!--=====================================
<?php

?>
======================================-->
<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administrar clientes

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-puzzle-piece"></i> Inicio</a></li>

      <li class="active">Administrar clientes</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCliente">

          Agregar cliente

        </button>

      </div>

      <div class="box-body">

       <table class="table  table-striped dt-responsive tablas" width="100%">

        <thead class="thdark">

         <tr>

           <th style="width:10px">#</th>
           <th>Nombre</th>
           <th>DNI</th>
           <th>Teléfono</th>
           <th>Correo</th>
           <th>Distrito</th>
           <th>Juego de Interes</th>
           <th>Puntos</th>
           <th>Total compras</th>
           <th>Última compra</th>
           <th>Fecha Registro</th>
           <th>Acciones</th>

         </tr>

        </thead>

        <tbody>

        <?php

$item  = null;
$valor = null;

$clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

foreach ($clientes as $key => $value) {

    echo '<tr>

                    <td>' . ($key + 1) . '</td>

                    <td>' . $value["nombre"] . '</td>

                    <td>' . $value["dni"] . '</td>

                    <td>' . $value["telefono"] . '</td>

                    <td>' . $value["correo"] . '</td>

                    <td>' . $value["distrito"] . '</td>

                    <td>' . $value["juego_interes"] . '</td>

                    <td>' . $value["puntos"] . '</td>

                    <td>' . $value["compras_realizadas"] . '</td>

                    <td>' . $value["ultima_compra"] . '</td>

                    <td>' . $value["fecha_registro"] . '</td>

                    <td>

                      <div class="btn-group">

                        <button class="btn btn-warning btnEditarCliente" data-toggle="modal" data-target="#modalEditarCliente" idCliente="' . $value["id"] . '"><i class="fa fa-pencil"></i></button>



                         <button class="btn btn-danger btnEliminarCliente" dni="' . $value["dni"] . '" nombre="' . $value["nombre"] . '"><i class="fa fa-times"></i></button>

                     </div>

                    </td>

                  </tr>';

}

?>

        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR CLIENTE
======================================-->

<div id="modalAgregarCliente" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar cliente</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoCliente" placeholder="Ingresar nombre" 
                required>

              </div>

            </div>

            <!-- ENTRADA PARA EL DOCUMENTO ID -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-vcard"></i></span>

                <input type="number" class="form-control input-lg" name="nuevoDocumentoId" placeholder="Ingresar documento"
                required pattern="[0-9]{8}" 
                title="El DNI debe ser de 8 caracteres"  
                >

              </div>

            </div>

            <!-- ENTRADA PARA EL TELEFONO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-mobile"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar teléfono" data-inputmask="'mask':'(999) 999999999'" data-mask 
                title="Si es teléfono de casa debe contener 7 dígitos y si es celular 9 dígitos" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL EMAIL -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                <input type="correo" class="form-control input-lg" name="nuevoCorreo" placeholder="Ingresar correo" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL DISTRITO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoDistrito" placeholder="Ingresar distrito" 
                required>

              </div>

            </div>

            <!-- ENTRADA PARA EL JUEGO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-gamepad"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoJuego" placeholder="Ingresar juego de interés" required>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cliente</button>

        </div>

      </form>

      <?php

$crearCliente = new ControladorClientes();
$crearCliente->ctrCrearCliente();

?>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR CLIENTE
======================================-->

<div id="modalEditarCliente" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar cliente</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" name="editarCliente" id="editarCliente" required>
                <input type="hidden" id="idCliente" name="idCliente">
              </div>

            </div>

            <!-- ENTRADA PARA EL DOCUMENTO ID -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-vcard"></i></span>

                <input type="text" class="form-control input-lg" name="editarDocumentoId" id="editarDocumentoId" readonly required>

              </div>

            </div>

            <!-- ENTRADA PARA EL TELEFONO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-mobile"></i></span>

                <input type="text" class="form-control input-lg" name="editarTelefono" id="editarTelefono" data-inputmask="'mask':'(999) 999999999'" data-mask required>

              </div>

            </div>

            <!-- ENTRADA PARA EL EMAIL -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                <input type="correo" class="form-control input-lg" name="editarCorreo" id="editarCorreo" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL DISTRITO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>

                <input type="text" class="form-control input-lg" name="editarDistrito" id="editarDistrito" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL JUEGO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-gamepad"></i></span>

                <input type="text" class="form-control input-lg" name="editarJuego" id="editarJuego" required>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cambios</button>

        </div>

      </form>

      <?php

$editarCliente = new ControladorClientes();
$editarCliente->ctrEditarCliente();

?>



    </div>

  </div>

</div>

<?php

$eliminarCliente = new ControladorClientes();
$eliminarCliente->ctrEliminarCliente();

?>