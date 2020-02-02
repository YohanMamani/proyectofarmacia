<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administrar usuarios

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar usuarios</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
      <?php
if ($_SESSION["perfil"] == "Administrador") {
    echo '<button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">

          <i class="fa fa-user-plus"></i> Agregar usuario

        </button>';
}
?>

      </div>

      <div class="box-body">

       <table class="table table-striped dt-responsive tablas" width="100%">

        <thead class="thdark">

         <tr>

           <th style="width:10px">#</th>
           <th>DNI</th>
           <th>Nombre</th>
           <th>Usuario</th>
           <th>Foto</th>
           <th>Perfil</th>
           <th>Estado</th>
           <th>Turno</th>
           <th>Último login</th>
           <th>Acciones</th>

         </tr>

        </thead>

        <tbody>

        <?php

$item  = null;
$valor = null;

$usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

foreach ($usuarios as $key => $value) {

    echo ' <tr>
                  <td>' . ($key + 1) . '</td>
                  <td>' . $value["dni"] . '</td>
                  <td>' . $value["nombre"] . '</td>
                  <td>' . $value["usuario"] . '</td>';
    if ($value["foto"] != "") {

        echo '<td><img src="' . $value["foto"] . '" class="img-thumbnail" width="40px"></td>';

    } else {

        echo '<td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px"></td>';

    }
    echo '<td>' . $value["perfil"] . '</td>';
    if ($_SESSION["perfil"] == "Administrador") {
        if ($value["estado"] != 0) {

            echo '<td><button class="btn btn-success btn-xs btnActivar" idUsuario="' . $value["dni"] . '" estadoUsuario="0">Activado</button></td>';

        } else {

            echo '<td><button class="btn btn-danger btn-xs btnActivar" idUsuario="' . $value["dni"] . '" estadoUsuario="1">Desactivado</button></td>';

        }
    } else {
        if ($value["estado"] != 0) {

            echo '<td><button class="btn btn-success btn-xs btnActivar" idUsuario="' . $value["dni"] . '" estadoUsuario="0" disabled>Activado</button></td>';

        } else {

            echo '<td><button class="btn btn-danger btn-xs btnActivar" idUsuario="' . $value["dni"] . '" estadoUsuario="1" disabled>Desactivado</button></td>';

        }
    }

    echo '<td>' . $value["turno"] . '</td>';

    echo '<td>' . $value["ultimo_login"] . '</td>

                  <td>

                    <div class="btn-group">';

    if ($_SESSION["perfil"] == "Administrador") {

        echo ' <button class="btn btn-warning btnEditarUsuario" idUsuario="' . $value["dni"] . '" data-toggle="modal" data-target="#modalEditarUsuario"><i class="fa fa-pencil"></i></button>


                         <button class="btn btn-danger btnEliminarUsuario" idUsuario="' . $value["dni"] . '" usuario="' . $value["usuario"] . '"><i class="fa fa-times"></i></button>';

    }

    echo '


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
MODAL AGREGAR USUARIO
======================================-->

<div id="modalAgregarUsuario" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#111111; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar usuario</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL DNI -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-vcard"></i></span>

                <input type="number" class="form-control input-lg" name="nuevoDNI" id="nuevoDNI" placeholder="Ingresar DNI" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar nombre" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL USUARIO -->

             <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user-circle"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoUsuario" placeholder="Ingresar usuario" id="nuevoUsuario" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA CONTRASEÑA -->

             <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-lock"></i></span>

                <input type="password" class="form-control input-lg" name="nuevoPassword" placeholder="Ingresar contraseña" required>

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-users"></i></span>

                <select class="form-control input-lg" name="nuevoPerfil">

                  <option value="">Selecionar perfil</option>

                  <option value="Administrador">Administrador</option>

                  <option value="Vendedor">Vendedor</option>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR SU TURNO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-clock"></i></span>

                <select class="form-control input-lg" name="nuevoTurno">

                  <option value="">Seleccionar Turno</option>

                  <option value="Mañana">Mañana</option>

                  <option value="Tarde">Tarde</option>

                </select>

              </div>

            </div>

             <!-- ENTRADA PARA SUBIR FOTO -->

            <div class="form-group">

              <div class="panel">SUBIR FOTO</div>

              <input type="file" class="nuevaFoto" name="nuevaFoto">

              <p class="help-block">Peso máximo de la foto 2MB</p>

              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar usuario</button>

        </div>

        <?php

$crearUsuario = new ControladorUsuarios();
$crearUsuario->ctrCrearUsuario();

?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR USUARIO
======================================-->

<div id="modalEditarUsuario" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar usuario</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL DNI -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-vcard"></i></span>

                <input type="number" class="form-control input-lg" id="editarDNI" name="editarDNI" placeholder="Nuevo DNI" value=""  required>

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" value="" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL USUARIO -->

             <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user-circle"></i></span>

                <input type="text" class="form-control input-lg" id="editarUsuario" name="editarUsuario" value="" readonly required>

              </div>

            </div>

            <!-- ENTRADA PARA LA CONTRASEÑA -->

             <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-lock"></i></span>

                <input type="password" class="form-control input-lg" name="editarPassword" placeholder="Escriba la nueva contraseña" required>

                <input type="hidden" id="passwordActual" name="passwordActual" required>

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-users"></i></span>

                <select class="form-control input-lg" name="editarPerfil">

                  <option value="" id="editarPerfil"></option>

                  <option value="Administrador">Administrador</option>

                  <option value="Vendedor">Vendedor</option>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR SU TURNO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-clock"></i></span>

                <select class="form-control input-lg" name="editarTurno">

                  <option value="" id="editarTurno"></option>

                  <option value="Mañana">Mañana</option>

                  <option value="Tarde">Tarde</option>

                </select>

              </div>

            </div>
            <!-- ENTRADA PARA SUBIR FOTO -->

            <div class="form-group">

              <div class="panel">SUBIR FOTO</div>

              <input type="file" class="nuevaFoto" name="editarFoto">

              <p class="help-block">Peso máximo de la foto 2MB</p>

              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarEditar" width="100px">

              <input type="hidden" name="fotoActual" id="fotoActual">

            </div>


          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Modificar usuario</button>

        </div>

     <?php

$editarUsuario = new ControladorUsuarios();
$editarUsuario->ctrEditarUsuario();

?>

      </form>

    </div>

  </div>

</div>

<?php

$borrarUsuario = new ControladorUsuarios();
$borrarUsuario->ctrBorrarUsuario();

?>