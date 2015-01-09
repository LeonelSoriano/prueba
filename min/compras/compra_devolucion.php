<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 08/01/15
 * Time: 01:32 PM
 */
 
 header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

include_once('../../db.php');

include_once('../../clases/Seguridad.php');
include_once("../../clases/Paginador.php");


$a = new Seguridad();

$a->chekear_session();


//POST

include_once('../../clases/LayoutForm.php');


$a = new Paginador("min_compra",$_GET['paso']);

$layout = new LayoutForm('Módulo de Inventario | Devolución Compra');



$layout->append_to_header(
    <<<EOT

EOT
);

$layout->get_header();


$table_form = '';

$result=mysql_query("SELECT * FROM min_compra WHERE devolucion ='n' order by codigo ");

while($test = mysql_fetch_array($result))
{
    //  calculos de horas
    $id = $test['codigo'];
    $codigo_articulo = $test['codigo_articulo'];
    $codigo_proveedor = $test['codigo_proveedor'];
    $fecha_compra = $test['fecha_compra'];


    $cantidad = $test['cantidad'];
    $gastos_varios = $test['gastos_varios'];
    $monto_factura = $test['monto_factura'];

    $costo_total = $test['costo_total'];

    $result2=mysql_query("SELECT nombre FROM min_productos_servicios where codigo = $codigo_articulo " . $a->print_sql_limit());

    $test2 = mysql_fetch_array($result2);
    $nombre_producto = $test2['nombre'];



    $table_form .=  "<tr align='center'>";

    $table_form .= "<td><font color='black'>". $nombre_producto . "</font></td>";
    $table_form .= "<td><font color='black'>". " " . "</font></td>";
    $table_form .= "<td><font color='black'>". $fecha_compra . "</font></td>";
    $table_form .= "<td><font color='black'>". $cantidad.  "</font></td>";
    $table_form .= "<td><font color='black'>". $gastos_varios.  "</font></td>";
    $table_form .= "<td><font color='black'>". $monto_factura.  "</font></td>";
    $table_form .= "<td><font color='black'>". $costo_total .  "</font></td>";
    $table_form .=  '<td>  <a href="compra_devolucion_confirmar.php?id='.$id.'"> Devolución </a> </td>';
    $table_form .=  "</tr>";
}


$layout->set_form(

    <<<EOT
 {$a->print_sql_foot()}
 <br/>
 <br/>
     <form method="post" accept-charset="UTF-8"   id="contact-form">
    <div class="formLayout">
    <fieldset>
 
    <table border=none class="tablas-nuevas">

        <tr>

            <th>Nombre</th>
            <th>Proveedor</th>
            <th>Fecha de Compra</th>
            <th>Cantidad</th>
            <th>Gastos Varios</th>
            <th>Monto de Factura</th>
            <th>Costo Total</th>
            <th> </th>

        </tr>
 $table_form

 </table>
 <br/>
 <br/>

  <a href="compras.php"><input type="button" value="Atras"></a>

 
     </div>
    </fieldset>
    </form>
EOT

);

$layout->get_footer();
mysql_close($conn);