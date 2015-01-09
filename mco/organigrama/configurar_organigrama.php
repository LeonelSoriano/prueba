<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 08/01/15
 * Time: 09:22 AM
 */
 
 header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

include_once('../../db.php');

include_once('../../clases/Seguridad.php');



$a = new Seguridad();

$a->chekear_session();


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

        $sql = "INSERT INTO  mco_organigrama(codigo_alias,descripcion,codigo_depende,profundidad,nombre_depende)
                VALUES ('$codigo_alias','$descripcion','$dependiente','$profundidad','$dependiente_nombre_hi')";

        mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());
        $guardado = 1;

        send_error_redirect(false,'Datos Guardados Exitosamente');
        die;

    }else{
        $guardado = 2;
        send_error_redirect(true,"Hay Errores en la Información del formulario");die;
    }



}

include_once('../../clases/LayoutForm.php');

$layout = new LayoutForm('Módulo de Configuración | Configurar Organigrama');



$layout->append_to_header(
    <<<EOT
    <script>
        $(function() {

            $( "#buscar_dependiente" ).click(function() {
                var win = window.open("dependiente.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90");
                win.focus();
            });

        });
    </script>
EOT
);

$layout->get_header();


$layout->set_form(

    <<<EOT
 
     <form  method="post" name="gerencia"   id="contact-form">
    <div class="formLayout">
    <fieldset>

 <label>Código</label>
 <input type="text" name="codigoalias" id="codigoalias" >
 <br/>

 <label>Descripción</label>
 <input type="text" name="descripcion" id="descripcion" />
 <br/>

 <label>Dependiente</label>
 <input type="text" name="dependiente" id="dependiente" size="21"  disabled>
 <input type="button" name="buscar_dependiente" id="buscar_dependiente" value="Buscar" >
 <br/>

  <input type="hidden" name="dependiente_hi"  id="dependiente_hi"/>
<input type="hidden" name="dependiente_nombre_hi"  id="dependiente_nombre_hi"/>
<br/>
<input type="submit" value="Guardar datos" name="submit">
<a href="organigrama_ver.php"><input type="button" value="Ver datos">
<a href="/sicap/mco_menu.php"><input type="button" value="Atras">
 
     </div>
    </fieldset>
    </form>
EOT

);

$layout->get_footer();
mysql_close($conn);