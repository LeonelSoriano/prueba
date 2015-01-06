<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 05/01/15
 * Time: 04:25 AM
 */

header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

include_once('../../clases/LayoutForm.php');
include_once('../../db.php');
include_once("../../clases/Paginador.php");

$layout = new LayoutForm('Módulo de Inventario | Productos y Servicios ');

$layout->append_to_header('



');

$layout->get_header();




$paso = '';

include("../../db.php");
include_once("../../clases/funciones.php");


$a = new Paginador("min_productos_servicios",$_GET['paso']);



$body = "";
$result=mysql_query("SELECT
        min_productos_servicios.codigo as codigo,
        min_productos_servicios.nombre as nombre,
        min_productos_servicios.fecha_adquisicion as fecha_adquisicion,
        min_productos_servicios.ubicacion as ubicacion,
        min_productos_servicios.observacion as observacion,
        min_tipo_inventario.tipo as tipo,
        mco_unidad.descripcion as descripcion,
        mco_unidad.sigla as sigla
    FROM
        min_productos_servicios
            INNER JOIN
        min_tipo_inventario ON min_productos_servicios.inventario = min_tipo_inventario.codigo
            INNER JOIN
        mco_unidad ON mco_unidad.codigo = min_productos_servicios.mco_unidad
        WHERE min_productos_servicios.eliminado = 'no'
        ORDER BY min_productos_servicios.nombre " . $a->print_sql_limit()
);

while($test = mysql_fetch_array($result))
{

    $id = $test['codigo'];

    $body .= "<tr align='center'>";
    //echo"<td><font color='black'>" .$test['codigo']."</font></td>";
    $body .= "<td><font color='black'>". ($test['nombre']) ."</font></td>";
    $body .= "<td><font color='black'>". ($test['fecha_adquisicion']) ."</font></td>";
    $body .= "<td><font color='black'>". ($test['ubicacion']) ."</font></td>";
    $body .= "<td><font color='black'>". ($test['tipo']) ."</font></td>";
    $body .= "<td><font color='black'>". ($test['descripcion']) ."(".utf8_multiplataforma($test['sigla']) .")"."</font></td>";

    $body .= "<td> <a href ='articulo_mod2.php?codigo=$id'>Modificar</a>";
    $body .= "<td> <a href ='articulo_del2.php?id=$id'>Borrar</a>";
    $body .= "</tr>";
}



mysql_close($conn);



$layout->set_form(

    $a->print_sql_foot().
    '
<br/><br/>
<form id="contact-form" method="post" enctype="multipart/form-data">
<div class="formLayout">
 <table border=none class="tablas-nuevas">

        <tr style="text-align: center">
            <th style="min-width: 250px">Nombre</th>
            <th>Fecha Registro</th>
            <th>Ubicación</th>
            <th>Inventario</th>
            <th>Unidad Producción</th>
            <th></th>
            <th></th>
        </tr>

'.$body.'
    </table>
    <br/>

    '.$a->print_sql_foot().'

    </div></from> <a href="inventario.php"><input type="button" value="Atras"></a>'


);


$layout->get_footer();