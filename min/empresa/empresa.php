<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 08/01/15
 * Time: 02:27 PM
 */
 
 header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

include_once('../../db.php');

include_once('../../clases/Seguridad.php');



$a = new Seguridad();

$a->chekear_session();


//POST

include_once('../../clases/LayoutForm.php');

$layout = new LayoutForm('Módulo de Inventario | Proveedor');



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
    <input type="text" name="codigoalias" />
    <br/>

    <label>Código</label>
    <input type="text" name="rif" />
    <br/>

    <label>Descripción</label>
    <textarea rows="6" cols="49" name="descripcion"></textarea>
    <br/>

    <label >Correo Eectrónico</label>
    <input type="text" name="correo" />
    <br/>

    <label >Dirección</label>
    <input type="text" name="direccion"/>
    <br/>


    <label >Teléfono</label>
    <input type="text" name="telefono"/>
    <br/>
    <br/>

 <input type="submit" value="Guardar datos" name="submit">
 <a href="empresa_ver.php"><input type="button" value="Ver datos"></a>
 <a href="../../min_menu.php"><input type="button" value="Atras"></a>
 
     </div>
    </fieldset>
    </form>
EOT

);

$layout->get_footer();
mysql_close($conn);