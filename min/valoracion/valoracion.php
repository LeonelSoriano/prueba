<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 08/01/15
 * Time: 03:36 PM
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

$layout = new LayoutForm('Módulo de Inventario | Valoración');

include_once("../../clases/funciones.php");
include_once("../../clases/Paginador.php");

$a = new Paginador("min_productos_servicios",$_GET['paso']);



$layout->append_to_header(
    <<<EOT

EOT
);

$layout->get_header();


$table_form = '';

$result=mysql_query("SELECT
    min_productos_servicios.codigo as codigo_producto,
	min_valoracion.unidades as unidades,
	min_valoracion.costo_total as costo_total,
	min_valoracion.promedio_actual as promedio_actual,
	min_productos_servicios.nombre as nombre
FROM
    min_productos_servicios
        INNER JOIN
    min_valoracion ON min_valoracion.codigo_producto = min_productos_servicios.codigo
ORDER BY min_productos_servicios.nombre "  . $a->print_sql_limit());
while($test = mysql_fetch_array($result))
{

    $codigo_producto = $test['codigo_producto'];
    $unidades = $test['unidades'];
    $costo_total = $test['costo_total'];
    $promedio_actual = $test['promedio_actual'];

    $nombe_producto = $test['nombre'];

    $table_form .=  "<tr align='center'>";
    $table_form .= "<td>" . $nombe_producto."</td>";
    $table_form .= "<td style='text-align: right'>" .formatear_ve($unidades)."</td>";
    $table_form .= "<td style='text-align: right' >" .formatear_ve($costo_total)."</td>";
    $table_form .= "<td style='text-align: right'>" . formatear_ve($promedio_actual)."</td>";
    $table_form .= "<td> <a href ='ponderado.php?codigo=$codigo_producto'>Ponderado</a></td>";

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
            <th style="text-align: center">Nombre</th>
            <th style="text-align: center">Unidades</th>

            <th style="text-align: center">Costo total</th>
            <th style="text-align: center">Costo Unitario</th>

            <th></th>
        </tr>
        
        $table_form

        </table>
        <br/>
        <br/>

        {$a->print_sql_foot()}

        <br/>
        <br/>

        <a href="../../min_menu.php"><input type="button" value="Atras"></a>

 
     </div>
    </fieldset>
    </form>
EOT

);

$layout->get_footer();
mysql_close($conn);