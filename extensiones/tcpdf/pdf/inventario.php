<?php

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";

require_once "../../../controladores/juegos.controlador.php";
require_once "../../../modelos/juegos.modelo.php";

class imprimirInventario
{

    public function traerimpresionInventario()
    {

//TRAEMOS LA INFORMACIÓN DE LOS PRODUCTOS

/*$item = null;

$valor = null;

$productos = ControladorProductos::ctrMostrarProductos($item, $valor);

foreach ($productos as $key => $value) {

$item = "codigo";

$valor = ($key+1);

$productos = ControladorProductos::ctrMostrarProductos($item, $valor);

$codigo = substr($productos["codigo"],0,true);
$descripcion = substr($productos["descripcion"],0,true);
$stock = number_format($productos["stock"],0);
$precio_compra = number_format($productos["precio_compra"],2);
$precio_venta = number_format($productos["precio_venta"],2);

}
 */

        require_once 'tcpdf_include.php';

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $pdf->startPageGroup();

        $pdf->AddPage();

// ---------------------------------------------------------

        $bloque1 = <<<EOF

	<table>

		<tr>

			<td style="width:320px"><img src="images/logo-inv.png"></td>

			<td style="background-color:white; width:220px">

				<div style="font-size:8.5px; text-align:right; line-height:12px;">

					<br>
					SEDE LINCE

					<br>
					Av. Arenales 1737

					<br>
					Teléfono: (01) 4727989

				</div>

			</td>

		</tr>

	</table>

EOF;

        $pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------

        $bloque2 = <<<EOF

	<table>

		<tr>

			<td style="width:540px"><img src="images/back.jpg"></td>

		</tr>

	<table style="font-size:15px; padding:5px 10px">

		<tr>

			<td style="border: 1px solid #666; background-color:white; width:540px; text-align:center">Inventario</td>

		</tr>

	</table>
EOF;

        $pdf->writeHTML($bloque2, false, false, false, false, '');

// ---------------------------------------------------------

        $bloque3 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>

		<td style="border: 1px solid #666; background-color:white; width:80px; text-align:center">Código</td>
		<td style="border: 1px solid #666; background-color:white; width:280px; text-align:center">Producto</td>
		<td style="border: 1px solid #666; background-color:white; width:80px; text-align:center">Cantidad</td>
		<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Fecha</td>

		</tr>

	</table>

EOF;

        $pdf->writeHTML($bloque3, false, false, false, false, '');

// ---------------------------------------------------------

        $item = null;

        $valor = null;

        $productos = ControladorProductos::ctrMostrarProductos($item, $valor);

        foreach ($productos as $key => $value) {

            $bloque4 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
				$value[codigo]
			</td>


			<td style="border: 1px solid #666; color:#333; background-color:white; width:280px; text-align:center">
				$value[descripcion]
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
				$value[stock]
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$value[fecha]
			</td>

		</tr>

	</table>

EOF;

            $pdf->writeHTML($bloque4, false, false, false, false, '');

        }

// --------------------------------------------------------

//SALIDA DEL ARCHIVO
        ob_end_clean();
        $pdf->Output('inventario.pdf');

    }
}

$inventario = new imprimirInventario();
$inventario->traerImpresionInventario();
