<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 06/01/15
 * Time: 09:02 AM
 */

include_once('clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

include("db.php");
include_once('./clases/LayoutForm.php');

$layout = new LayoutForm('Módulo de Recursos Humanos | Tipo de Turno','.');


// Rutina para Guardar información
if (isset($_POST['submit']))
{
    include 'db.php';
    $descripcion=$_POST['descripcion'];
    $horainicio=$_POST['horainicio'];
    $horafin=$_POST['horafin'];
    $horasemanales=$_POST['horasemanales'];

    $sql = "insert into mrh_tipoturno(descripcion,horainicio,horafin,horasemanales)
                                                      values('$descripcion','$horainicio','$horafin','$horasemanales')";
    //echo $sql;
    //exit;
    mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());

    echo "<script type='text/javascript'>";
    echo "    alert('Registro Almacenado');";
    echo "</script>";
}



$layout->get_header();


$layout->set_form('

 <form id="contact-form" method="post" enctype="multipart/form-data">
    <div class="formLayout">
    <fieldset>

<label>Descripción</label>
<input type="text" name="descripcion" id="descripcion">
<br/>

<label>Hora de Inicio</label>
<input type="text" name="horainicio" id="horainicio" >
<br/>

<label>Hora de Fin</label>
<input type="text" name="horafin" id="horafin" >
<br/>

<label>Horas Semanales</label>
<input type="text" name="horasemanales" id="horasemanales" >
<br/>

<input type="submit" value="Guardar datos" name="submit">
<a href="tipoturno_ver.php"><input type="button" value="Ver datos">
<a href="mrh_menu.php"><input type="button" value="Atras">



</fieldset>
</div>
</form>

');


$layout->get_footer();