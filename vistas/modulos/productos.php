<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administrar productos

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar productos</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProducto">

          <i class="fa fa-user-plus"></i> Agregar producto

        </button>

        <button class="btn btn-primary" data-toggle="modal" data-target="#modalImportarExcel">

        <i class="fa fa-file-excel"></i> Importar Excel

        </button>

        </button>

        <button class="btn btn-primary btnImprimirPDF">

        <i class="fa fa-file-pdf"></i> Exportar PDF

        </button>

      </div>

      <div class="box-body">

       <table class="table  table-striped dt-responsive tablaProductos" width="100%">

        <thead class="thdark">

          <tr>

           <th style="width:10px">#</th>

           <th>Juego</th>
           <th>Código</th>
           <th>Descripción</th>
           <th>Stock</th>
           <th>Precio de compra</th>
           <th>Precio de venta</th>
           <th>Agregado</th>
           <th>Acciones</th>

         </tr>

        </thead>

      <!-- <tbody>

        <?php

$item = null;

$valor = null;

$productos = ControladorProductos::ctrMostrarProductos($item, $valor);

foreach ($productos as $key => $value) {

    echo '<tr>
                  <td>' . ($key + 1) . '</td>';

    $item  = "id";
    $valor = $value["id_juego"];

    $juego = ControladorJuegos::ctrMostrarJuegos($item, $valor);

    echo '<td>' . $juego["juego"] . '</td>

                  <td>' . $value["codigo"] . '</td>
                  <td>' . $value["descripcion"] . '</td>
                  <td>' . $value["stock"] . '</td>
                  <td>' . $value["precio_compra"] . '</td>
                  <td>' . $value["precio_venta"] . '</td>
                  <td>' . $value["fecha"] . '</td>
                  <td>

                    <div class="btn-group">

                      <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>

                      <button class="btn btn-danger"><i class="fa fa-times"></i></button>

                    </div>

                  </td>

                </tr>';

}

?>

        </tbody> -->

       </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL IMPORTAR EXCEL
======================================-->
<div id="modalImportarExcel" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Importar excel</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">
            <div class="form-group">

              <div class="panel">SUBIR ARCHIVO EXCEL</div>

              <input type="file" accept=".xlsx, .xls" class="nuevoExcel" id="nuevoExcel" name="nuevoExcel" required>

              <img src="vistas/img/plantilla/excel.jpg" class="img-thumbnail previsualizar" width="100px">

            </div>
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar producto</button>

        </div>

      </form>

        <?php

$agregarListaProductos = new ControladorProductos();
$agregarListaProductos->ctrAgregarListaProductos();

?>

    </div>

  </div>

</div>

<!--=====================================
MODAL AGREGAR PRODUCTO
======================================-->

<div id="modalAgregarProducto" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar producto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA SELECCIONAR JUEGO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <select class="form-control input-lg" id="nuevoJuego" name="nuevoJuego" required>

                  <option value="">Selecionar juego</option>

                  <?php

$item  = null;
$valor = null;

$juegos = ControladorJuegos::ctrMostrarJuegos($item, $valor);

foreach ($juegos as $key => $value) {

    echo '<option value="' . $value["id"] . '">' . $value["juego"] . '</option>';
}

?>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA EL CÓDIGO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-code"></i></span>

                <input type="text" class="form-control input-lg" id="nuevoCodigo" name="nuevoCodigo"
                  placeholder="Código de tamaño 6 entre números y letras mayúsculas" pattern="(([\d]+[A-Z]+)|[A-Z]+[\d]+$)" maxlength="6"
                >

              </div>

            </div>

            <!-- ENTRADA PARA LA DESCRIPCIÓN -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>

                <input type="text" class="form-control input-lg" 
                name="nuevaDescripcion" placeholder="Ingresar descripción de minimo 10 caracteres" 
                minlength="10"  pattern="[A-Za-z]{10-60}" required>

              </div>

            </div>

            <!-- ENTRADA PARA STOCK -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-check"></i></span>

                <input type="number" class="form-control input-lg" name="nuevoStock" min="1" placeholder="Stock" required>

              </div>

            </div>

            <!-- ENTRADA PARA PRECIO COMPRA -->

            <div class="form-group">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>

                  <input type="number" class="form-control input-lg" id="nuevoPrecioCompra" name="nuevoPrecioCompra" min="0" step="any" placeholder="Precio de compra"
                  onkeypress="minPrecioVenta()" onchange="minPrecioVenta()" required />

                </div>

            </div>

            <!-- ENTRADA PARA PRECIO VENTA -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>

                <input type="number" class="form-control input-lg" id="nuevoPrecioVenta" name="nuevoPrecioVenta"
                  min="0" step="any" placeholder="Precio de venta" required />

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar producto</button>

        </div>

      </form>

        <?php

$crearProducto = new ControladorProductos();
$crearProducto->ctrCrearProducto();

?>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR PRODUCTO
======================================-->

<div id="modalEditarProducto" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#111111; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar producto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA SELECCIONAR JUEGO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <select class="form-control input-lg"  name="editarJuego" readonly required>

                  <option id="editarJuego"></option>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA EL CÓDIGO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-code"></i></span>

                <input type="text" class="form-control input-lg" id="editarCodigo" name="editarCodigo" readonly required>

              </div>

            </div>

            <!-- ENTRADA PARA LA DESCRIPCIÓN -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>

                <input type="text" class="form-control input-lg" id="editarDescripcion" name="editarDescripcion" 
                minlength="10"  pattern="[A-Za-z]{10-60}"  required>

              </div>

            </div>

            <!-- ENTRADA PARA STOCK -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-check"></i></span>

                <input type="number" class="form-control input-lg" id="editarStock" name="editarStock" min="0" required>

              </div>

            </div>

            <!-- ENTRADA PARA PRECIO COMPRA -->

            <div class="form-group">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>

                  <input type="number" class="form-control input-lg" id="editarPrecioCompra" name="editarPrecioCompra" min="0" step="any"
                    onkeypress="minPrecioVenta_()" onchange="minPrecioVenta_()" required>

                </div>

            </div>

            <!-- ENTRADA PARA PRECIO VENTA -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>

                <input type="number" class="form-control input-lg" id="editarPrecioVenta" name="editarPrecioVenta" min="0" step="any" required>

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

$editarProducto = new ControladorProductos();
$editarProducto->ctrEditarProducto();

?>

    </div>

  </div>

</div>

<?php

$eliminarProducto = new ControladorProductos();
$eliminarProducto->ctrEliminarProducto();

?>


<script language="JavaScript">
  function minPrecioVenta(){
    $("#nuevoPrecioVenta").attr({
      "min" : $("#nuevoPrecioCompra").val()
    });
  }


  function minPrecioVenta_(){
    $("#editarPrecioVenta").attr({
      "min" : $("#editarPrecioCompra").val()
    });
  }
</script>