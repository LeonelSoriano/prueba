<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 07/01/15
 * Time: 02:58 PM
 */

header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

include_once('../../db.php');

include_once('../../clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();


include("../../db.php");
include_once('../../clases/LayoutForm.php');

$layout = new LayoutForm('Módulo de Inventario | Reporte Articulos');

$layout->get_header();

$typo_inventario_form = '';

$result=mysql_query("SELECT * FROM min_tipo_inventario");
$index = 0;
while($test = mysql_fetch_array($result)){

    $codigo = $test['codigo'];
    $tipo = $test['tipo'];


    $typo_inventario_form .=
    '
            <label style="width: 100px">'.$tipo.'</label>

    <input type="checkbox" style="margin-right:15%;margin-top: 8px" type="radio" name="tipo" id="compra" value="compra" name="checkbox_'.$codigo.'" value="1" checked>



';

    $index += 1;
    if($index > 1){
        $typo_inventario_form .= "<br/>";
        $index = 0;
    }

}



$layout->set_form(

    <<<EOT
    <form method="post" accept-charset="UTF-8" name="gerencia"  id="contact-form">
    <div class="formLayout">
    <fieldset>

$typo_inventario_form

<br/>
<label > Filtrado </label>
 <select name="filtrado" id="filtrado">
<option value="todo">Todo</option>
<option value="sin">Sin Saldo</option>
<option value="con">Con Saldo</option>
</select>

<br/><br/>
<input type="submit" value="Generar Reporte" name="submit">
<a href="../../min_menu.php"><input type="button" value="Atras"></a>

    </div>
    </fieldset>
    </form>
EOT

);

$layout->get_footer();
mysql_close($conn);