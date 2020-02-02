<?php

$item  = null;
$valor = null;
$orden = "id";

$ventas = ControladorVentas::ctrSumaTotalVentas();
$egreso = ControladorFinanzas::ctrSumaTotalEgresos();

$juegos      = ControladorJuegos::ctrMostrarJuegos($item, $valor);
$totalJuegos = count($juegos);

$clientes      = ControladorClientes::ctrMostrarClientes($item, $valor);
$totalClientes = count($clientes);

$productos      = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);
$totalProductos = count($productos);

?>



<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-aqua">

    <div class="inner">

      <h3>S/.<?php echo number_format($ventas["total"] - $egreso["egreso"], 2); ?></h3>

      <p>Ingresos</p>

    </div>

    <div class="icon">

      S/.

    </div>

    <a href="finanzas" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>

<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-green">

    <div class="inner">

      <h3><?php echo number_format($totalJuegos); ?></h3>

      <p>Juegos</p>

    </div>

    <div class="icon">

      <i class="ion ion-clipboard"></i>

    </div>

    <a href="juegos" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>

<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-yellow">

    <div class="inner">

      <h3><?php echo number_format($totalClientes); ?></h3>

      <p>Clientes</p>

    </div>

    <div class="icon">

      <i class="ion ion-person-add"></i>

    </div>

    <a href="clientes" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>

<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-red">

    <div class="inner">

      <h3><?php echo number_format($totalProductos); ?></h3>

      <p>Productos</p>

    </div>

    <div class="icon">

      <i class="ion ion-ios-cart"></i>

    </div>

    <a href="productos" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>