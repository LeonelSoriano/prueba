<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 08/01/15
 * Time: 11:23 AM
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

$layout = new LayoutForm('Módulo de Costos y Gastos | Reporte Relación');



$layout->append_to_header(
    <<<EOT

EOT
);

$layout->get_header();


$anhio_from = '';

$anhio = date('Y');
$anhio_presente = $anhio;
$anhio = $anhio - 10;

for($i = $anhio ; $i < $anhio+12 ;$i++){

    if($i == $anhio_presente){
        $anhio_from .= ('<option value="'.($i).'"selected>'.($i).'</option>');

    }else{
        $anhio_from .= ('<option value="'.($i).'">'.($i).'</option>');
    }
}


$mes_form = '';

$mes = date('n');


if($mes == 1){
    $mes_form .= (" <option value='1' selected>Enero</option>");
}else{
    $mes_form .= (" <option value='1' >Enero</option>");
}
if($mes == 2){
    $mes_form .= (" <option value='2' selected>Febrero</option>");
}else{
    $mes_form .= (" <option value='2' >Febrero</option>");
}
if($mes == 3){
    $mes_form .= (" <option value='3' selected>Marzo</option>");
}else{
    $mes_form .= (" <option value='3' >Marzo</option>");
}
if($mes == 4){
    $mes_form .= (" <option value='4' selected>Abril</option>");
}else{
    $mes_form .= (" <option value='4' >Abril</option>");
}
if($mes == 5){
    $mes_form .= (" <option value='5' selected>Mayo</option>");
}else{
    $mes_form .= (" <option value='5' >Mayo</option>");
}
if($mes == 6){
    $mes_form .= (" <option value='6' selected>Junio</option>");
}else{
    $mes_form .= (" <option value='6' >Junio</option>");
}
if($mes == 7){
    $mes_form .= (" <option value='7' selected>Julio</option>");
}else{
    $mes_form .= (" <option value='7' >Julio</option>");
}
if($mes == 8){
    $mes_form .= (" <option value='8' selected>Agosto</option>");
}else{
    $mes_form .= (" <option value='8' >Agosto</option>");
}
if($mes == 9){
    $mes_form .= (" <option value='9' selected>Septiembre</option>");
}else{
    $mes_form .= (" <option value='9' >Septiembre</option>");
}
if($mes == 10){
    $mes_form .= (" <option value='10' selected>Octubre</option>");
}else{
    $mes_form .= (" <option value='10' >Octubre</option>");
}
if($mes == 11){
    $mes_form .= (" <option value='11' selected>Noviembre</option>");
}else{
    $mes_form .= (" <option value='11' >Noviembre</option>");
}
if($mes == 12){
    $mes_form .= (" <option value='12' selected>Diciembre</option>");
}else{
    $mes_form .= (" <option value='12' >Diciembre</option>");
}



$layout->set_form(

    <<<EOT
 
     <form method="post" accept-charset="UTF-8"   id="contact-form">
    <div class="formLayout">
    <fieldset>
 
 <label>Fecha</label>
 
 <select name='anhio' id='anhio' >
 $anhio_from
 </select>
 
 <select name='mes' id='mes' >
 $mes_form
 </select>

 <br/>
 <br/>
 <br/>

 <input type="submit" value="Generar Reporte" name="submit" >
 <a href="../../cos_menu.php"><input type="button" value="Atras"></a>
 
     </div>
    </fieldset>
    </form>
EOT

);

$layout->get_footer();
mysql_close($conn);