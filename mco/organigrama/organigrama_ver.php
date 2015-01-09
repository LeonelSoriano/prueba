<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 08/01/15
 * Time: 09:27 AM
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

$layout = new LayoutForm('Módulo de Configuración | Organigrama Ver');



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


$table_from = '';

include("../../db.php");
$result=mysql_query("SELECT * FROM mco_organigrama");
while($test = mysql_fetch_array($result))
{
    //  calculos de horas
    $id = $test['codigo'];
    $table_from .= "<tr align='center'>";
    //echo"<td><font color='black'>" .$test['codigo']."</font></td>";
    //echo"<td><font color='black'>" .$test['codigo_alias']."</font></td>";
    $table_from .= "<td><font color='black'>". $test['descripcion']."</font></td>";
    $table_from .= "<td><font color='black'>". $test['nombre_depende']."</font></td>";
    $table_from .= "<td> <a href ='organigrama_mod.php?codigo=$id'>Modificar</a></td>";
    $table_from .= "<td> <a href ='organigrama_del.php?codigo=$id'><center>Borrar</center></a></td>";
    $table_from .= "</tr>";
}


$layout->set_form(

    <<<EOT
 
     <form method="post" accept-charset="UTF-8"   id="contact-form">
    <div class="formLayout">
    <fieldset>



  <table border=none class="tablas-nuevas" style="margin-left: 0px">
  <tr style="text-align: center">
    <th>Nombre</th>
    <th>Depende</th>
    <th>Modificar</th>
    <th>Eliminar</th>
    </tr>
 $table_from
</table>

 <br/>
 <a href="configurar_organigrama.php"><input type="button" value="Atras">
 
     </div>
    </fieldset>
    </form>
EOT

);

$layout->get_footer();
mysql_close($conn);