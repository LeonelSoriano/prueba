<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 07/01/15
 * Time: 03:55 PM
 */

header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

include_once('../../db.php');

include_once('../../clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();


$id =$_REQUEST['codigo'];

$result = mysql_query("SELECT * FROM min_cliente WHERE codigo  = '$id'");

$test = mysql_fetch_array($result);
if (!$result)
{
    die("Error: Data not found..");
}

$codigoalias = $test['codigo_alias'];
$rif = $test['rif'];
$telefono = $test['telefono'];
$direccion = $test['direccion'];
$correo = $test['correo'];



if (isset($_POST['submit'])){
    $codigoalias = $_POST['codigoalias'];
    $rif = $_POST['rif'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];

    $sql = "UPDATE min_cliente SET codigo_alias='$codigoalias',rif='$rif',telefono='$telefono',correo='$correo',direccion='$direccion'  WHERE codigo ='$id'";


    mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());

}



include("../../db.php");
include_once('../../clases/LayoutForm.php');

$layout = new LayoutForm(' Módulo de Inventario | Empresa');


$layout->append_to_header(
    <<<EOF
    <script>
        $(function() {
            $( "#datepicker1" ).datepicker({ dateFormat: 'yy-mm-dd' });
            $( "#datepicker2" ).datepicker({ dateFormat: 'yy-mm-dd' });
            $( "#datepicker3" ).datepicker({ dateFormat: 'yy-mm-dd' });
        });
    </script>
EOF
);

$layout->get_header();


$layout->set_form(

    <<<EOT
    <form method="post" accept-charset="UTF-8" name="gerencia"  id="contact-form">
    <div class="formLayout">
    <fieldset>

    <label>Nombre</label>
    <input type="text" name="codigoalias"  value="$codigoalias"/>
    <br/>

    <label>RIF o Cedula de Identidad</label>
    <input type="text" name="rif"  value="$rif"/>
    <br/>

    <label >Correo Eectrónico</label>
    <input type="text" name="correo"  size="20" value="$correo"/>
    <br/>

    <label >Teléfono</label>
    <input type="text" name="telefono" value="$telefono"/>
    <br/>

    <label>Dirección</label>
    <textarea rows="5" cols="49" name="direccion">$direccion</textarea>
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