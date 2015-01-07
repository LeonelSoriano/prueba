<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 06/01/15
 * Time: 09:22 AM
 */


include_once('clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

include("db.php");
include_once('./clases/LayoutForm.php');


$layout = new LayoutForm('Módulo de Recursos Humanos | Tipo de Turno','.');

$id =$_REQUEST['codigo'];

$result = mysql_query("SELECT * FROM mrh_tipoturno WHERE codigo  = '$id'");
//echo $result;
//exit;
$test = mysql_fetch_array($result);
if (!$result)
{
    die("Error: Data not found..");
}


$descripcion=$test['descripcion'];
$horainicio=$test['horainicio'];
$horafin=$test['horafin'];
$horasemanales=$test['horasemanales'];

if(isset($_POST['submit']))
{

    $descripcion=$_POST['descripcion'];
    $horainicio=$_POST['horainicio'];
    $horafin=$_POST['horafin'];
    $horasemanales=$_POST['horasemanales'];

    $sql = "update mrh_tipoturno set descripcion='$descripcion',horainicio='$horainicio',horafin='$horafin',horasemanales='$horasemanales'
                 where codigo = '$id'";
    //echo $sql;
    //exit;
    mysql_query($sql)

    or die(mysql_error());

    echo "<script type='text/javascript'>";
    echo "    alert('Registro Modificado');";
    echo "</script>";
    header("Location: tipoturno_ver.php");
}


$layout->get_header();


$layout->set_form(

    '
 <div class="formLayout">
    <label>Descripción</label>
    <input type="text" name="descripcion" id="descripcion" value="'.$descripcion.'">
    <br/>
    <label>Hora de Inicio</label>
    <input type="text" name="horainicio" id="horainicio"  value="'.$horainicio.'">
    <br/>
    <label>Horas Semanales</label>
    <input type="text" name="horasemanales" id="horasemanales"  value="'.$horasemanales.'">
    <br/>
    <br/>
    <input type="submit" value="Guardar datos" name="submit">
    <a href="tipoturno_ver.php"><input type="button" value="Ver datos">
    <a href="mrh_menu.php"><input type="button" value="Atras">
 <div/>
    '
);

$layout->get_footer();