<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 06/01/15
 * Time: 09:13 AM
 */

include_once('clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

include("db.php");
include_once('./clases/LayoutForm.php');


$layout = new LayoutForm('Módulo de Recursos Humanos | Cargo Ver','.');


$layout->get_header();



$tabla = '';

$result=mysql_query("SELECT * FROM mrh_tipoturno");
while($test = mysql_fetch_array($result))
{
    //  calculos de horas
    $id = $test['codigo'];
    $tabla .= "<tr align='center'>";

    $tabla .= "<td><font color='black'>" .$test['descripcion']."</font></td>";
    $tabla .= "<td><font color='black'>". $test['horainicio']."</font></td>";
    $tabla .= "<td><font color='black'>". $test['horafin']."</font></td>";
    $tabla .=  "<td><font color='black'>". $test['horasemanales']."</font></td>";
    $tabla .=  "<td> <a href ='tipoturno_mod.php?codigo=$id'>Modificar</a>";
    $tabla .=  "<td> <a href ='tipoturno_del.php?codigo=$id'><center>Borrar</center></a>";
    $tabla .=  "</tr>";
}





$layout->set_form(
    '
    <table border=1 class="tablas-nuevas" style="text-align: center">

    <tr>
        <td>Descripción</td>
        <td>Hora de Inicio</td>
        <td>Hora de Fin</td>
        <td>Horas Semanales</td>
        <td></td>
        <td></td>
    </tr>

    '.$tabla.'


    </table>

    <br/>
<a href="tipoturno.php"><input type="button" value="Atras"></a>


    '
);

$layout->get_footer();