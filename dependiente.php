<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 06/01/15
 * Time: 11:30 AM
 */


include_once('clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();


header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

require_once('db.php');
include_once('./clases/LayoutForm.php');


if(isset($_POST['submit'])) {

    require_once('./clases/Validate.php');
    require_once('./clases/funciones.php');

    $validation = array(

        array('buscar_empleado_hi' => 'filtro',
            'requerida' => true,
            'regla' => 'number'),

        array('nombre' => 'buscar_empleado_depende_hi',
            'requerida' => true,
            'regla' => 'number')

    );

    $validated = new Validate($validation,$_POST);
    $validated->validate();

    if(!$validated->getIsError()){

        $buscar_empleado_hi = $_POST['buscar_empleado_hi'];
        $buscar_empleado_depende_hi = $_POST['buscar_empleado_depende_hi'];

        $sql = "INSERT  INTO mrh_empleado_depende (codigo_trabajador,codigo_depende)
          VALUES('$buscar_empleado_hi','$buscar_empleado_depende_hi')";

        mysql_query($sql) or die('error mrh_empleado_depende'.mysql_error());

        send_error_redirect(false);
        die;
    }else if($validated->getIsError()){
        send_error_redirect(true);
    }


}

$layout = new LayoutForm('Módulo de Recursos Humanos | Dependiente','.');

$layout->append_to_header('
    <script type="text/javascript">

        $(function() {

            $("#buscar_empleado").click(function() {
                var win = window.open("dependiente_buscar_empleado.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90 ");
                win.focus();
            });

            $("#buscar_empleado_depende").click(function() {
                var win = window.open("dependiente_buscar_empleado_depende.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90 ");
                win.focus();
            });

        });

    </script>
 ');

$layout->get_header();


$layout->set_form(

    '
  <form id="contact-form" method="post" enctype="multipart/form-data" name="formulario">
            <div class="formLayout">
            <fieldset>

            <label>Empleado</label>
            <input type="text" name="nombre_empleado"  disabled>
            <input type="button" name="buscar_empleado" id="buscar_empleado" value="Buscar"/>
<input type="hidden" name="buscar_empleado_hi" id="buscar_empleado_hi"/>
            <br/>

            <label>Empleado Depende</label>
            <input type="text" name="nombre_empleado_depende"  disabled>
             <input type="button" name="buscar_empleado_depende" id="buscar_empleado_depende" value="Buscar"/>
             <input type="hidden" name="buscar_empleado_depende_hi" id="buscar_empleado_depende_hi"/>
             <br/>

             <br/>
             <input type="submit" value="Guardar datos" name="submit">
             <a href="empleado_depende_ver.php"><input type="button" value="Ver datos"></a>
            <a href="mrh_menu.php"><input type="button" value="Atras"></a>


        </div>

        </fieldset>
    </form>
    '

);

$layout->get_footer();
