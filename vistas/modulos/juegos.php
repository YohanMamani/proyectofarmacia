<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar juegos
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Juegos</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarJuego">
          
        <i class="fa fa-plus"></i> Agregar juego

        </button>

      </div>

      <div class="box-body">
        
       <table class="table  table-striped dt-responsive tablas" width="100%">
         
        <thead class="thdark">
         
         <tr>
           
           <th style="width:5%">#</th>
           <th style="width: 80%">Juego</th>
           <th style="width: 10%">Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          $juegos = ControladorJuegos::ctrMostrarJuegos($item, $valor);

          foreach ($juegos as $key => $value) {
           
            echo ' <tr>

                    <td>'.($key+1).'</td>

                    <td class="text-uppercase">'.$value["juego"].'</td>

                    <td>

                      <div class="btn-group" style="float:right">
                          
                        <button class="btn btn-warning btnEditarJuego" idJuego="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarJuego"><i class="fa fa-pencil"></i></button>

                        <button class="btn btn-danger btnEliminarJuego" idJuego="'.$value["id"].'"><i class="fa fa-times"></i></button>

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
MODAL AGREGAR JUEGO
======================================-->

<div id="modalAgregarJuego" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar juego</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoJuego" placeholder="Ingresar juego" required>

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar juego</button>

        </div>

        <?php

          $crearJuego = new ControladorJuegos();
          $crearJuego -> ctrCrearJuego();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR JUEGO
======================================-->

<div id="modalEditarJuego" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar juego</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="editarJuego" id="editarJuego" required>

                 <input type="hidden"  name="idJuego" id="idJuego" required>

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

          $editarJuego = new ControladorJuegos();
          $editarJuego -> ctrEditarJuego();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrarJuego = new ControladorJuegos();
  $borrarJuego -> ctrBorrarJuego();

?>