<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 07/01/15
 * Time: 03:48 PM
 */

header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

include_once('../../db.php');

include_once('../../clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

include("../../db.php");
include_once('../../clases/LayoutForm.php');

$layout = new LayoutForm('Módulo de Inventario | Empresa');

$layout->get_header();


$cliente_form = '';

$result=mysql_query("SELECT * FROM min_cliente");
while($test = mysql_fetch_array($result)){

    $id = $test['codigo'];

    $cliente_form .= "<tr align='center'>";
    $cliente_form .= "<td><font color='black'>". $test['codigo_alias']. "</font></td>";
    $cliente_form .= "<td><font color='black'>". $test['rif']. "</font></td>";
    $cliente_form .= "<td><font color='black'>". $test['telefono']. "</font></td>";
    $cliente_form .= "<td><font color='black'>". $test['direccion']. "</font></td>";
    $cliente_form .= "<td><font color='black'>". $test['correo']. "</font></td>";


    $cliente_form .= "<td> <a href ='cliente_mod.php?codigo=$id'>Modificar</a></td>";
    $cliente_form .= "</tr>";
}



$layout->set_form(

    <<<EOT
    <form method="post" accept-charset="UTF-8" name="gerencia"  id="contact-form">
    <div class="formLayout">
    <fieldset>

<table border=none class="tablas-nuevas">

    <tr id="tmp">
        <th>Nombre</th>
        <th>RIF o Cedula de Identidad</th>
        <th>Teléfono</th>
        <th>Dirección</th>
        <th>Correo Eectrónico</th>

    </tr>
    <tr>

$cliente_form

        </tr>

    </table>

<br/>
<a href="cliente.php"><input type="button" value="Atras"></a>

    </div>
    </fieldset>
    </form>
EOT

);

$layout->get_footer();
mysql_close($conn);