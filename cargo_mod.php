<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 05/01/15
 * Time: 02:20 PM
 */

header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

include_once('clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();


include_once('./clases/LayoutForm.php');


require("db.php");
$id =$_REQUEST['codigo'];

$layout = new LayoutForm('Módulo de Recursos Humanos | Cargo Modificar','.');


$result = mysql_query("SELECT * FROM mrh_cargo WHERE codigo  = '$id'");
//echo $result;
//exit;
$test = mysql_fetch_array($result);
if (!$result)
{
    die("Error: Data not found..");
}

$codigoalias=$test['codigoalias'];
$descripcion=$test['descripcion'];
$tipo_cargo = $test['tipo_cargo'];
$tipo_cargo_opcion = $test['tipo_cargo_opcion'];


if(isset($_POST['submit']))
{

    include_once("./clases/funciones.php");
    include_once("./clases/Validate.php");



    $validation = array(

        array('nombre' => 'codigoalias',
            'requerida' => true,
        ),

        array('nombre' => 'descripcion',
            'requerida' => true,
        ),


    );


    $validated = new Validate($validation,$_POST);
    $validated->validate();

    if(!$validated->getIsError()){


        $codigoalias=$_POST['codigoalias'];
        $descripcion=$_POST['descripcion'];
        $tipo_cargo =$_POST['tipo_cargo'];
        $tipo_cargo_opcion=$_POST['tipo_cargo_opcion'];

        $sql = "update mrh_cargo set codigoalias='$codigoalias',descripcion='$descripcion',
            tipo_cargo = '$tipo_cargo',tipo_cargo_opcion='$tipo_cargo_opcion'
             where codigo = '$id'";

        //echo $sql;
        //exit;
        mysql_query($sql)

        or die(mysql_error());

        $current_url = explode("?", $_SERVER['REQUEST_URI']);

        $primer_parametro = explode("&",$current_url[1]);
        header('Location: '.$current_url[0].'?'.$primer_parametro[0].'&error=false&msg=Datos Guardados Exitosamente');

        die;


    }else if($validated->getIsError()){

        $current_url = explode("?", $_SERVER['REQUEST_URI']);

        $primer_parametro = explode("&",$current_url[1]);

        header('Location: '.$current_url[0].'?'.$primer_parametro[0].'&error=true&msg=Hay Errores en la Información del formulario');
        die;
    }



}

$layout->append_to_header("
    <script type='text/javascript'>

        $(function() {

            $('#tipo_cargo').bind('change',function() {

                var tipo_cargo = $('#tipo_cargo').val();

                if (tipo_cargo == 'produccion') {

                    $('#tipo_cargo_opcion').html(' <option value=". '"'  ."  directa". '"'  .">Directa</option> <option >Indirecta</option>');
                } else if(tipo_cargo == 'operativo'){
                    $('#tipo_cargo_opcion').html(' <option value=". '"'  ."administracion". '"'  .">Administración</option> <option >Venta</option>');

                }


            });

        });


    </script>

 ");

$layout->get_header();

$cargo_pro = '';
$cargo_ope = '';

if($tipo_cargo == 'produccion'){$cargo_pro = "selected";}
if($tipo_cargo == 'operativo'){$cargo_ope = "selected";}



$segundo_select = '';


if($tipo_cargo == 'produccion'){
    if($tipo_cargo_opcion == 'directa'){
        $segundo_select .= "<option value='directa' selected>Directa</option> <option value='indirecta'>Indirecta</option>";
    }else{
        $segundo_select .= "<option value='directa'>Directa</option> <option value='indirecta' selected>Indirecta</option>";
    }

}else{
    if($tipo_cargo_opcion == 'administrativo'){
        $segundo_select .="<option value='directa'  selected>Directa</option> <option value='indirecta'>Indirecta</option>";
    }else{
        $segundo_select .= "<option value='produccion' selected>Directa </option> <option value='indirecta' selected>Indirecta</option>";
    }

}


$layout->set_form(
    '
    <form id="contact-form" method="post" enctype="multipart/form-data">
    <div class="formLayout">
<label>Código</label>
<input type="text" name="codigoalias" id="codigoalias" size="20" value="'.$codigoalias.'">
<br/>
<label>Descripción</label>
<input type="text" name="descripcion" id="descripcion" size="20" value="'.$descripcion.'">
<br/>
<label >Tipo Cargo</label>
<select id="tipo_cargo" name="tipo_cargo" id="">
  <option value="produccion" '.$cargo_pro.'>Producción</option>
                <option value="operativo" '.$cargo_ope.'>Operativo</option>
</select>
<br/>
<label></label>
<select name="tipo_cargo_opcion" id="tipo_cargo_opcion">
'.$segundo_select.'
  </select>

  <br/>
  <input type="submit" name="submit" value="Guardar datos" >
<a href="cargo_ver.php"><input type="button" value="Ver datos"></a>

    <fieldset>
    </div>
    </from>

 ');

$layout->get_footer();