<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 08/01/15
 * Time: 03:18 PM
 */
 
 header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

include_once('../../db.php');

include_once('../../clases/Seguridad.php');



$a = new Seguridad();

$a->chekear_session();


//POST

include_once('../../clases/LayoutForm.php');

$layout = new LayoutForm('Módulo de Inventario | Venta Devolución');



$layout->append_to_header(
    <<<EOT

EOT
);

$layout->get_header();


$table_form = '';

$result=mysql_query("SELECT * FROM min_ventas WHERE devolucion ='n' order by codigo ");

while($test = mysql_fetch_array($result))
{
    //  calculos de horas
    $id = $test['codigo'];
    $codigo_articulo = $test['codigo_articulo'];
    $codigo_cliente = $test['codigo_cliente'];
    $fecha_venta = $test['fecha_venta'];


    $fecha_entrega = $test['fecha_entrega'];
    $codigo_factura = $test['codigo_factura'];
    $costo_unidad = $test['costo_unidad'];
    $cantidad = $test['cantidad'];

    $result2=mysql_query("SELECT nombre FROM min_productos_servicios WHERE codigo ='$codigo_articulo'");

    $test2 = mysql_fetch_array($result2);
    $nombre_articulo =  $test2['nombre'];


    $table_form .=  "<tr align='center'>";
    $table_form .= "<td><font color='black'>" .$id."</font></td>";
    $table_form .= "<td><font color='black'>". $nombre_articulo . "</font></td>";
    $table_form .= "<td><font color='black'>". $codigo_cliente . "</font></td>";
    $table_form .= "<td><font color='black'>". $fecha_venta . "</font></td>";
    $table_form .= "<td><font color='black'>". $fecha_entrega.  "</font></td>";
    $table_form .= "<td><font color='black'>". $codigo_factura.  "</font></td>";
    $table_form .= "<td><font color='black'>". $cantidad.  "</font></td>";
    $table_form .= "<td><font color='black'>". $costo_unidad.  "</font></td>";
    $table_form .=  '<td><a href="venta_devolucion_confirmar.php?id='.$id.'">Devolucion</a></td>';
    $table_form .=  "</tr>";
}


$layout->set_form(

    <<<EOT
 
     <form method="post" accept-charset="UTF-8"   id="contact-form">
    <div class="formLayout">
    <fieldset>
 
 
  <table border=none class="tablas-nuevas">
<tr>

    <th>Código</th>
    <th>Producto</th>
    <th>Empleado</th>
    <th>Fecha venta</th>
    <th>Fecha Entrega</th>
    <th>Codígo Factura</th>
    <th>Cantidad</th>
    <th>Costo Unidad</th>


</tr>
 $table_form

  </table>
 
 <br/>
 <br/>

 <a href="venta.php"><input type="button" value="Atras"></a>

     </div>
    </fieldset>
    </form>
EOT

);

$layout->get_footer();
mysql_close($conn);