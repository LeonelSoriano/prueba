<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 06/01/15
 * Time: 02:46 PM
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
include_once("../../db.php");

if (isset($_POST['submit']))
{

    include_once("../../clases/Validate.php");
    include_once("../../clases/funciones.php");




    $codigo_alias = $_POST['codigoalias'];
    $descripcion = $_POST['descripcion'];
//    $tipo_unidad = $_POST['tipo_unidad'];
    $dependiente = $_POST['dependiente_hi'];
    $id = $_POST['id'];

    $etapa = 'no';
    if(isset($_POST['etapa'])){
        $etapa = 'si';
    }

    $dependiente_nombre_hi = $_POST['dependiente_nombre_hi'];


    $validation = array(

        array('nombre' => 'descripcion',
            'requerida' => true),

        /*
                array('nombre' => 'tipo_unidad',
                    'requerida' => true,
                    'regla' => 'number' ),*/

        array('nombre' => 'dependiente_hi',
            'requerida' => true,
            'regla' => 'number')

    );


    $validated = new Validate($validation,$_POST);
    $validated->validate();


//
//    $sql = "INSERT INTO min_cliente(codigo_alias,rif,telefono,direccion,correo)
//        VALUES ('$codigoalias','$rif','$telefono','$direccion','$correo')";



    if(!$validated->getIsError()){

        $sql = "SELECT profundidad FROM mno_gerencia WHERE codigo = '$dependiente'";
        $result=mysql_query($sql);
        $test = mysql_fetch_array($result);

        $profundidad = $test['profundidad'] + 1;
        $unidad_admnistrativa = $_POST['unidad'] ;


        $sql = "UPDATE mno_gerencia SET codigoalias='$codigo_alias',
                  descripcion='$descripcion',codigo_depende='$dependiente',etapa='$etapa',
                  profundidad='$profundidad',nombre_depende='$dependiente_nombre_hi',
                  unidad_administrativa='$unidad_admnistrativa' WHERE codigo ='$id'";



        mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());
        $guardado = 1;

        $current_url = explode("?", $_SERVER['REQUEST_URI']);

        $primer_parametro = explode("&",$current_url[1]);
        header('Location: '.$current_url[0].'?'.$primer_parametro[0].'&error=false&msg=Datos Guardados Exitosamente');

    }else{
        $guardado = 2;
        $current_url = explode("?", $_SERVER['REQUEST_URI']);

        $primer_parametro = explode("&",$current_url[1]);

        header('Location: '.$current_url[0].'?'.$primer_parametro[0].'&error=true&msg=Hay Errores en la Información del formulario');
        die;
    }

}



if(isset($_GET['codigo'])){

    $codigo = $_GET['codigo'];

    $sql2 = "SELECT * FROM mno_gerencia WHERE codigo=$codigo";

    $result2=mysql_query($sql2);

    $test = mysql_fetch_array($result2);


    $codigo = $test['codigo'];
    $codigo_alias = $test['codigoalias'];
    $descripcion = $test['descripcion'];
    $codigo_depende = $test['codigo_depende'];
    $etapa = $test['etapa'];
    $profundidad = $test['profundidad'];
    $nombre_depende = $test['nombre_depende'];
    $unidad_admnistrativa = $test['unidad_administrativa'];


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

$check_frm = '';
if($etapa == 'si'){$check_frm = 'checked';}

$productiva_form = '';
if($unidad_admnistrativa == 'productiva'){ $productiva_form = 'selected';}

$operativa_venta_from = '';
if($unidad_admnistrativa == 'operativa_venta'){ $operativa_venta_from = 'selected';}

$operativa_administrativo_from = '';
if($unidad_admnistrativa == 'operativa_administrativo'){ $operativa_administrativo = 'selected';}

$unidad_admnistrativa_from = '';
if($unidad_admnistrativa == 'apoyo'){ $unidad_admnistrativa_from = 'selected';}

$layout->set_form(

    <<<EOT
    <form method="post" accept-charset="UTF-8" name="gerencia"  id="contact-form">
    <div class="formLayout">
    <fieldset>


<label>Código</label>
<input type="text" name="codigoalias" id="codigoalias" value="$codigo_alias">
<br/>

<label>Descripción</label>
<input type="text" name="descripcion" id="descripcion" value="$descripcion">
<br/>

<label>Dependiente</label>
<input type="text" name="dependiente" id="dependiente" disabled value="$nombre_depende">
<input type="button" name="buscar_dependiente" id="buscar_dependiente" value="Buscar" >
<br/>

<label>Es Etapa?</label>
<input type="checkbox" name="etapa" $check_frm/><label style="float: left"><span></span></label>
<br/>

<label>Unidad Administrativa</label>

<select name="unidad" id="unidad">
    <option value="productiva" $productiva_form>Productiva</option>
    <option value="operativa_venta" $operativa_venta_from>Operativa(Venta)</option>
    <option value="operativa_administrativo" $operativa_administrativo_from>Operativa(Administrativo)</option>
    <option value="apoyo" $unidad_admnistrativa_from>Apoyo</option>
</select>
<br/>

        <input type="hidden" name="dependiente_hi"  id="dependiente_hi" value="$codigo"/>
        <input type="hidden" name="dependiente_nombre_hi"  id="dependiente_nombre_hi" value="$codigo_depende"/>
        <input type="hidden" name="dependiente_nombre_hi"  id="dependiente_nombre_hi" value="$nombre_depende"/>


<input type="submit" value="Guardar datos" name="submit">
<a href="gerencia_ver.php"><input type="button" value="Ver datos">
<a href="../../mno_menu2.php"><input type="button" value="Atras">


    </div>
    </fieldset>
    </form>
EOT

);

$layout->get_footer();

