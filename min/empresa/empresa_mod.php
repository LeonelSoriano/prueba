<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 08/01/15
 * Time: 02:38 PM
 */
 
 header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

include_once('../../db.php');

include_once('../../clases/Seguridad.php');



$a = new Seguridad();

$a->chekear_session();


$id =$_REQUEST['codigo'];

$result = mysql_query("SELECT * FROM min_empresa WHERE codigo  = '$id'");

$test = mysql_fetch_array($result);
if (!$result)
{
    die("Error: Data not found..");
}

$codigoalias = $test['codigo_alias'];
$descripcion = $test['descripcion'];
$correo = $test['correo'];
$direccion = $test['direccion'];
$telefono = $test['telefono'];
$rif = $test['rif'];

?>




<?php


if (isset($_POST['submit'])){

    $codigoalias = $_POST['codigoalias'];
    $rif = $_POST['rif'];/*codigo*/
    $descripcion = $_POST['descripcion'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];


    $sql = "UPDATE min_empresa SET codigo_alias='$codigoalias',descripcion='$descripcion',correo='$correo',direccion='$direccion',telefono='$telefono',rif='$rif'  WHERE codigo ='$id'";


    mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());

}




include_once('../../clases/LayoutForm.php');

$layout = new LayoutForm('Módulo de Configuración | Reabrir Orden');



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


$layout->set_form(

    <<<EOT
 
     <form method="post" accept-charset="UTF-8" id="contact-form">
    <div class="formLayout">
    <fieldset>

 <label>Nombre</label>
 <input type="text" name="codigoalias"   value="$codigoalias"/>
 <br/>

 <label>Código</label>
<input type="text" name="rif"  value="$rif"/>
<br/>

<label>Descripción</label>
<textarea rows="4" cols="49" name="descripcion" >$descripcion</textarea>
<br/>

<label >Correo Eectrónico</label>
<input type="text" name="correo"  value="$correo"/>
<br/>

<label >Dirección</label>
<input type="text" name="direccion"  value="$direccion"/>
<br/>

<label >Teléfono</label>
<input type="text" name="telefono"  value="$telefono"/>
<br/>

<input type="submit" value="Guardar datos" name="submit">
<a href="empresa_ver.php"><input type="button" value="Ver datos"></a>
<a href="empresa_ver.php"><input type="button" value="Atras"></a>

 
     </div>
    </fieldset>
    </form>
EOT

);

$layout->get_footer();
mysql_close($conn);