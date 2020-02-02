<?php

$ventas = ControladorVentas::ctrSumaTotalVentas();
$egreso = ControladorFinanzas::ctrSumaTotalEgresos();

?>

<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Control de Egresos

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Control de Ingresos</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <div class="box box-success">

          <div class="form-group">

          <h2> Caja: S/. <?php echo number_format($ventas["total"] - $egreso["egreso"], 2); ?></h2>

          </div>

         </div>

      </div>


    <div class="box-header with-border">

      <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarEgreso">

       <i class="fa fa-plus"></i> Agregar Egreso

      </button>

    </div>


    <div class="box-body">

      <table class="table  table-striped dt-responsive tablas" width="100%">

        <thead class="thdark">

          <tr>

            <th style="width:10px">#</th>
            <th>Descripción</th>
            <th>Monto</th>
            <th>Agregado</th>
            <th>Acciones</th>

          </tr>

        </thead>

        <tbody>

        <?php

$item  = null;
$valor = null;

$finanzas = ControladorFinanzas::ctrMostrarFinanzas($item, $valor);

foreach ($finanzas as $key => $value) {

    echo '<tr>

                    <td>' . ($key + 1) . '</td>

                    <td class="text-uppercase">' . $value["descripcion"] . '</td>

                    <td>' . $value["egreso"] . '</td>

                    <td>' . $value["fecha"] . '</td>


                    <td>

                      <div class="btn-group">

                        <button class="btn btn-warning btnEditarEgreso" data-toggle="modal" data-target="#modalEditarEgreso" idEgreso="' . $value["id"] . '"><i class="fa fa-pencil"></i></button>



                        <button class="btn btn-danger btnEliminarEgreso" idEgreso="' . $value["id"] . '"><i class="fa fa-times"></i></button>

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
MODAL AGREGAR EGRESO
======================================-->

<div id="modalAgregarEgreso" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

            <h4 class="modal-title">Agregar Egreso</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA LA DESCRIPCION DEL EGRESO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoDescripcion" placeholder="Ingresar Descripción" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL MONTO DEL EGRESO-->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-money"></i></span>

                <input type="number" class="form-control input-lg" name="nuevoEgreso" placeholder="Ingresar Monto del Egreso" min="0" step="any" required>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar egreso</button>

        </div>

        <?php

$crearEgreso = new ControladorFinanzas();
$crearEgreso->ctrCrearFinanzas();

?>

      </form>

    </div>

  </div>

</div>


<!--=====================================
MODAL EDITAR EGRESO
======================================-->

<div id="modalEditarEgreso" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Egreso</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA LA DESCRIPCION -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input-lg" name="editarDescripcion" id="editarDescripcion" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL EGRESO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-dollar"></i></span>

                <input type="number" class="form-control input-lg" id="editarEgreso" name="editarEgreso" min="0" step="any" required>

                <input type="hidden"  name="idEgreso" id="idEgreso" required>


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

        <?php

$editarEgreso = new ControladorFinanzas();
$editarEgreso->ctrEditarFinanzas();

?>

      </form>

    </div>

  </div>

</div>

<?php

$borrarEgreso = new ControladorFinanzas();
$borrarEgreso->ctrEliminarFinanzas();

?>