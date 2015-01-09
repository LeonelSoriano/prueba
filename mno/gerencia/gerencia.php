<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 06/01/15
 * Time: 02:15 PM
 */
header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);


include_once('../../clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

include("../../db.php");
include_once('../../clases/LayoutForm.php');

$layout = new LayoutForm('Módulo de Nómina | Creación de Deaprtamentos');

$guardado = 0;

if (isset($_POST['submit']))
{

    include_once("../../clases/Validate.php");
    include_once("../../clases/funciones.php");
    include_once("../../db.php");



    $codigo_alias = $_POST['codigoalias'];
    $descripcion = $_POST['descripcion'];
//    $tipo_unidad = $_POST['tipo_unidad'];
    $dependiente = $_POST['dependiente_hi'];

    $etapa = 'no';
    if(isset($_POST['etapa'])){
        $etapa = 'si';
    }

    $dependiente_nombre_hi = $_POST['dependiente_nombre_hi'];


    $validation = array(

        array('nombre' => 'descripcion',
            'requerida' => true),

        array('nombre' => 'dependiente_hi',
            'requerida' => true,
            'regla' => 'number')

    );


    $validated = new Validate($validation,$_POST);
    $validated->validate();


    if(!$validated->getIsError()){

        $sql = "SELECT profundidad FROM mno_gerencia WHERE codigo = '$dependiente'";
        $result=mysql_query($sql);
        $test = mysql_fetch_array($result);

        $profundidad = $test['profundidad'] + 1;
        $unidad_admnistrativa = $test['unidad'] + 1;

        $sql = "INSERT INTO  mno_gerencia(codigoalias,descripcion,codigo_depende,etapa,profundidad,nombre_depende,unidad_administrativa)
                VALUES ('$codigo_alias','$descripcion','$dependiente','$etapa','$profundidad','$dependiente_nombre_hi','$unidad_admnistrativa')";

        mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());
        $guardado = 1;

        send_error_redirect(false,'Datos Guardados Exitosamente');
        die;

    }else{
        $guardado = 2;
        send_error_redirect(true,"Hay Errores en la Información del formulario");die;
    }

}


$layout->append_to_header('
 <script>
    $(function() {

        $( "#buscar_dependiente" ).click(function() {
            var win = window.open("dependiente.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90");
            win.focus();
        });

    });
</script>
 ');


$layout->get_header();


$layout->set_form(

    <<<EOT
    <form method="post" accept-charset="UTF-8" name="gerencia"  id="contact-form">
    <div class="formLayout">
    <fieldset>


<label>Código</label>
<input type="text" name="codigoalias" id="codigoalias" >
<br/>

<label>Descripción</label>
<input type="text" name="descripcion" id="descripcion" >
<br/>

<label>Dependiente</label>
<input type="text" name="dependiente" id="dependiente" disabled>
<input type="button" name="buscar_dependiente" id="buscar_dependiente" value="Buscar" >
<br/>

<label>Es Etapa?</label>
<input type="checkbox" name="etapa"/><label style="float: left"><span></span></label>
<br/>

<label>Unidad Administrativa</label>

<select name="unidad" id="unidad">
    <option value="productiva">Productiva</option>
    <option value="operativa_venta">Operativa(Venta)</option>
    <option value="operativa_administrativo">Operativa(Administrativo)</option>
    <option value="apoyo">Apoyo</option>
</select>
<br/>

        <input type="hidden" name="dependiente_hi"  id="dependiente_hi"/>
        <input type="hidden" name="dependiente_nombre_hi"  id="dependiente_nombre_hi"/>

<input type="submit" value="Guardar datos" name="submit">
<a href="gerencia_ver.php"><input type="button" value="Ver datos">
<a href="../../mno_menu2.php"><input type="button" value="Atras">


    </div>
    </fieldset>
    </form>
EOT

);

$layout->get_footer();

