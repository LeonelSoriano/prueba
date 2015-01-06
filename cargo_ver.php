<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 05/01/15
 * Time: 02:08 PM
 */

include_once('clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

include("db.php");
include_once('./clases/LayoutForm.php');


$layout = new LayoutForm(' Módulo de Recursos Humanos | Cargo Ver','.');

$layout->get_header();

$table_inside = "";

include("db.php");
include_once('./clases/funciones.php');
$result=mysql_query("SELECT * FROM mrh_cargo");
while($test = mysql_fetch_array($result))
{
    //  calculos de horas
    $id = $test['codigo'];
    $table_inside .= "<tr align='center'>";
    //echo"<td><font color='black'>" .$test['codigo']."</font></td>";
    $table_inside .= "<td><font color='black'>". utf8_multiplataforma($test['codigo']). "</font></td>";
    $table_inside .= "<td><font color='black'>" .utf8_multiplataforma($test['codigoalias'])."</font></td>";
    $table_inside .= "<td><font color='black'>". utf8_multiplataforma($test['descripcion'])."</font></td>";
    $table_inside .= "<td> <a href ='cargo_mod.php?codigo=$id'>Modificar</a>";
    $table_inside .= "<td> <a href ='cargo_del.php?codigo=$id'><center>Borrar</center></a>";
    $table_inside .=  "</tr>";
}



$layout->set_form(

    '
<form id="contact-form" method="post" enctype="multipart/form-data">
<div class="formLayout">
<fieldset>

<table border=1 class="tablas-nuevas">
    <tr>
        <th>Id</th>
        <th>Cargo</th>
        <th>Descripción</th>
        <th></th>
        <th></th>
    </tr>
'.$table_inside.'

</table>

<br/>
<a href="cargo.php"><input type="button" value="Atras"></a>

</fieldset>
</div>
</form>

'
);

$layout->get_footer();