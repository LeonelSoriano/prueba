<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 07/01/15
 * Time: 03:39 PM
 */

header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

include_once('../../db.php');

include_once('../../clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();


if (isset($_POST['submit'])){

    $codigoalias = $_POST['codigoalias'];
    $rif = $_POST['rif'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];


    $sql = "INSERT INTO min_cliente(codigo_alias,rif,telefono,direccion,correo)
        VALUES ('$codigoalias','$rif','$telefono','$direccion','$correo')";

    mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());

    send_error_redirect(false,'La Orden fue Reabierta Satisfactoriamente');
    die;

}


include("../../db.php");
include_once('../../clases/LayoutForm.php');

$layout = new LayoutForm('Módulo de Inventario | Proveedores');


$layout->get_header();

$layout->set_form(

    <<<EOT
    <form method="post" accept-charset="UTF-8"  id="contact-form">
    <div class="formLayout">
    <fieldset>

        <label>Nombre</label>
        <input type="text" name="codigoalias" />
        <br/>

        <label>RIF o Cedula de Identidad</label>
        <input type="text" name="rif" />
        <br/>

        <label >Correo Eectrónico</label>
        <input type="text" name="correo" />
        <br/>

        <label >Teléfono</label>
        <input type="text" name="telefono"/>
        <br/>

        <label>Dirección</label>
        <textarea rows="5" cols="49" name="direccion"></textarea>
        <br/>
<br/>
        <input type="submit" value="Guardar datos" name="submit">
        <a href="cliente_ver.php"><input type="button" value="Ver datos"></a>
        <a href="../../min_menu.php"><input type="button" value="Atras"></a>


    </div>
    </fieldset>
    </form>
EOT

);

$layout->get_footer();
mysql_close($conn);