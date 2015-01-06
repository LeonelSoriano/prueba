<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 05/01/15
 * Time: 02:15 PM
 */

include_once('clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

include("db.php");
include_once('./clases/LayoutForm.php');


require("db.php");
$id =$_REQUEST['codigo'];
$cedulaempleado =$_REQUEST['cedula'];
//        echo $id;
//        echo "-";
//        echo $cedulaempleado;

$result = mysql_query("SELECT * FROM mrh_empleado WHERE cedula  = '$cedulaempleado'");
$test = mysql_fetch_array($result);
if (!$result)
{
    die("Error: Data not found..");
}

$primernombreempleado = $test['primernombre'];
$primerapellidoempleado = $test['primerapellido'];

$result = mysql_query("SELECT * FROM mrh_carga WHERE codigo  = '$id'");
$test = mysql_fetch_array($result);
if (!$result)
{
    die("Error: Data not found..");
}

$cedula = $test['cedula'];
$primernombre = $test['primernombre'];
$segundonombre = $test['segundonombre'];
$primerapellido=$test['primerapellido'];
$segundoapellido=$test['segundoapellido'];
$fechanacimiento=$test['fechanacimiento'];
$parentesco=$test['parentesco'];

switch ($parentesco) {
    case "P":
        $descparentesco = "Padre";
        break;
    case "M":
        $descparentesco = "Madre";
        break;
    case "H":
        $descparentesco = "Hijo(a)";
        break;
    case "C":
        $descparentesco = "Conyugue";
        break;
}


$estudios=$test['estudios'];

switch ($estudios) {
    case "G":
        $descestudios = "Guarderia";
        break;
    case "P":
        $descestudios = "Primaria";
        break;
    case "S":
        $descestudios = "Secundaria";
        break;
    case "U":
        $descestudios= "Superior";
        break;
}



// modificacion de la carga familiar
if(isset($_POST['submit']))
{
    include("db.php");
    $cedulaempleado=$_POST['cedulaempleado'];
    $cedula=$_POST['cedula'];
    $primernombre=$_POST['primernombre'];
    $segundonombre=$_POST['segundonombre'];
    $primerapellido=$_POST['primerapellido'];
    $segundoapellido=$_POST['segundoapellido'];
    $fechanacimiento=$_POST['fechanacimiento'];
    $parentesco=$_POST['parentesco'];
    $estudios=$_POST['estudios'];

    $sql = "update mrh_carga set
                    cedula='$cedula',
                        primernombre='$primernombre',
                            segundonombre='$segundonombre',
                                primerapellido='$primerapellido',
                                    segundoapellido='$segundoapellido',
                                        fechanacimiento='$fechanacimiento',
                                            parentesco='$parentesco',
                                                estudios='$estudios'
                                                    where
                                                        codigo  = '$id'";
    //echo $sql;
    //exit;
    mysql_query($sql) or die(mysql_error());

    echo "<script type='text/javascript'>";
    echo "    alert('Registro Modificado');";
    echo "</script>";

    header ("Location: carga_ver.php?codigo=$cedulaempleado");
}



$layout = new LayoutForm('Módulo de Recursos Humanos | Cargo Modificar','.');


$layout->get_header();


$layout->set_form(

    '
<form id="contact-form" method="post" enctype="multipart/form-data">
<div class="formLayout">
<fieldset>


</fieldset>
</div>
</form>

'
);

$layout->get_foot();