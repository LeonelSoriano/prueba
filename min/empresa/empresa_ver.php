<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 08/01/15
 * Time: 02:33 PM
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

$layout = new LayoutForm('Módulo de Inventario | Proveedor Ver');



$layout->append_to_header(
    <<<EOT

EOT
);

$layout->get_header();


$table_form = '';

$result=mysql_query("SELECT * FROM min_empresa");
while($test = mysql_fetch_array($result)){

    $id = $test['codigo'];

    $table_form .=  "<tr align='center'>";
    $table_form .= "<td><font color='black'>". $test['codigo_alias']. "</font></td>";
    $table_form .= "<td><font color='black'>". $test['rif']. "</font></td>";
    $table_form .= "<td><font color='black'>". $test['descripcion']. "</font></td>";
    $table_form .= "<td><font color='black'>". $test['correo']. "</font></td>";
    $table_form .= "<td><font color='black'>". $test['direccion']. "</font></td>";
    $table_form .= "<td><font color='black'>". $test['telefono']. "</font></td>";


    $table_form .= "<td> <a href ='empresa_mod.php?codigo=$id'>Modificar</a></td>";
    $table_form .=  "</tr>";
}


$layout->set_form(

    <<<EOT
 
     <form method="post" accept-charset="UTF-8"   id="contact-form">
    <div class="formLayout">
    <fieldset>
 
 <table border=none class="tablas-nuevas">

<tr id="tmp">
    <th >Nombre</th>
    <th>Código</th>
    <th>Descripción</th>
    <th>Correo Eectrónico</th>
    <th>Dirección</th>
    <th>Teléfono</th>
    <th></th>
</tr>
<tr>
$table_form

    </tr>

</table>

<br/>
<br/>

 <a href="empresa.php"><input type="button" value="Atras"></a>


     </div>
    </fieldset>
    </form>
EOT

);

$layout->get_footer();
mysql_close($conn);