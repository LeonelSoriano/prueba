<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 08/01/15
 * Time: 11:40 AM
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

$layout = new LayoutForm('Módulo de Configuración | Reabrir Orden');



$layout->append_to_header(
    <<<EOT

EOT
);

$layout->get_header();


$layout->set_form(

    <<<EOT
 
     <form  method="post" accept-charset="UTF-8" name="formulario" action="inventario.php" id="contact-form">
    <div class="formLayout">
    <fieldset>


 <label for="opciones">Total Inventario</label>
  <input type="radio" style="margin-right:15%;margin-top: 8px" type="radio" name="opciones" value="total_inventario" checked>
    <br/>
<br/>

<input type="submit" value="Generar Indicador" name="submit" >
<a href="../../ind_menu.php"><input type="button" value="Atras"></a>

     </div>
    </fieldset>
    </form>
EOT

);

$layout->get_footer();
mysql_close($conn);