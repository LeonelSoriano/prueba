<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 06/01/15
 * Time: 02:33 PM
 */

header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

include_once('../../clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

include("../../db.php");
include_once('../../clases/LayoutForm.php');

$layout = new LayoutForm('Módulo de Nómina | Deaprtamentos Ver');


$layout->append_to_header(
    <<<EOT
 <script>
    $(function() {
        $( "#datepicker1" ).datepicker({ dateFormat: 'yy-mm-dd' });
        $( "#datepicker2" ).datepicker({ dateFormat: 'yy-mm-dd' });
        $( "#datepicker3" ).datepicker({ dateFormat: 'yy-mm-dd' });
    });
</script>
EOT
 );

$layout->get_header();


$table_form = '';
$result=mysql_query("SELECT * FROM mno_gerencia");
while($test = mysql_fetch_array($result))
{
    //  calculos de horas
    $id = $test['codigo'];
    $table_form .= "<tr align='center'>";
    //echo"<td><font color='black'>" .$test['codigo']."</font></td>";
    $table_form .= "<td><font color='black'>". $test['codigo']. "</font></td>";
    $table_form .= "<td><font color='black'>" .$test['codigoalias']."</font></td>";
    $table_form .= "<td><font color='black'>". $test['descripcion']."</font></td>";
    $table_form .= "<td> <a href ='gerencia_mod.php?codigo=$id'>Modificar</a>";
    $table_form .= "<td> <a href ='gerencia_del.php?codigo=$id'><center>Borrar</center></a>";
   // $table_form .= "<td> <a href ='/sicap/mno/unidadadm/unidadadm.php?codigo=$id'><center>Unid. Adm.</center></a>";
    $table_form .= "</tr>";
}


$layout->set_form(
    <<<EOT

    <div class="formLayout">
    <fieldset>

        <table border=none class="tablas-nuevas">
    <tr>
        <th>Id</th>
        <th>Gerencia</th>
        <th>Descripción</th>
        <th>Modificar</th>
        <th>Eliminar</th>

    </tr>

    $table_form

    </table>
<br/>
<a href="gerencia.php"><input type="button" value="Atras">
        </div>
    </fieldset>

EOT

);

$layout->get_footer();

