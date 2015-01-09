<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 08/01/15
 * Time: 10:25 AM
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

$layout = new LayoutForm('Módulo de Nomina | Reporte');



$layout->append_to_header(
    <<<EOT
 <script type="text/javascript">

        $(function() {

            $("#buscar_empleado").click(function() {
                var win = window.open("buscar_empleado.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90 ");
                win.focus();
            });

        });


        $(function() {

            $("#buscar_departamento").click(function() {
                var win = window.open("buscar_departamento.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90 ");
                win.focus();
            });

        });

    </script>
EOT
);

$layout->get_header();

$mes_from = '';

$mes = date('n');

if($mes == 1){
    $mes_from .= (" <option value='1' selected>Enero</option>");
}else{
    $mes_from .= (" <option value='1' >Enero</option>");
}
if($mes == 2){
    $mes_from .= (" <option value='2' selected>Febrero</option>");
}else{
    $mes_from .= (" <option value='2' >Febrero</option>");
}
if($mes == 3){
    $mes_from .= (" <option value='3' selected>Marzo</option>");
}else{
    $mes_from .= (" <option value='3' >Marzo</option>");
}
if($mes == 4){
    $mes_from .= (" <option value='4' selected>Abril</option>");
}else{
    $mes_from .= (" <option value='4' >Abril</option>");
}
if($mes == 5){
    $mes_from .= (" <option value='5' selected>Mayo</option>");
}else{
    $mes_from .= (" <option value='5' >Mayo</option>");
}
if($mes == 6){
    $mes_from .= (" <option value='6' selected>Junio</option>");
}else{
    $mes_from .= (" <option value='6' >Junio</option>");
}
if($mes == 7){
    $mes_from .= (" <option value='7' selected>Julio</option>");
}else{
    $mes_from .= (" <option value='7' >Julio</option>");
}
if($mes == 8){
    $mes_from .= (" <option value='8' selected>Agosto</option>");
}else{
    $mes_from .= (" <option value='8' >Agosto</option>");
}
if($mes == 9){
    $mes_from .= (" <option value='9' selected>Septiembre</option>");
}else{
    $mes_from .= (" <option value='9' >Septiembre</option>");
}
if($mes == 10){
    $mes_from .= (" <option value='10' selected>Octubre</option>");
}else{
    $mes_from .= (" <option value='10' >Octubre</option>");
}
if($mes == 11){
    $mes_from .= (" <option value='11' selected>Noviembre</option>");
}else{
    $mes_from .= (" <option value='11' >Noviembre</option>");
}
if($mes == 12){
    $mes_from .= (" <option value='12' selected>Diciembre</option>");
}else{
    $mes_from .= (" <option value='12' >Diciembre</option>");
}


$anhio_from = '';
$anhio = date('Y');
$anhio_from .= ('<option value="'.($anhio -12).'">'.($anhio -12).'</option>');
$anhio_from .= ('<option value="'.($anhio -11).'">'.($anhio -11).'</option>');
$anhio_from .= ('<option value="'.($anhio -10).'">'.($anhio -10).'</option>');
$anhio_from .= ('<option value="'.($anhio -9).'">'.($anhio -9).'</option>');
$anhio_from .= ('<option value="'.($anhio -8).'">'.($anhio -8).'</option>');
$anhio_from .= ('<option value="'.($anhio -7).'">'.($anhio -7).'</option>');
$anhio_from .= ('<option value="'.($anhio -6).'">'.($anhio -6).'</option>');
$anhio_from .= ('<option value="'.($anhio -5).'">'.($anhio -5).'</option>');
$anhio_from .= ('<option value="'.($anhio -4).'">'.($anhio -4).'</option>');
$anhio_from .= ('<option value="'.($anhio -3).'">'.($anhio -3).'</option>');
$anhio_from .= ('<option value="'.($anhio -2).'">'.($anhio -2).'</option>');
$anhio_from .= ('<option value="'.($anhio -1).'">'.($anhio -1).'</option>');
$anhio_from .= ('<option value="'.($anhio).'"selected>'.($anhio).'</option>');
$anhio_from .= ('<option value="'.($anhio + 1).'">'.($anhio + 1).'</option>');




$layout->set_form(

    <<<EOT
 
     <form  method="post" accept-charset="UTF-8" name="formulario" action="./reporte_costo_departamento.php"   id="contact-form">
    <div class="formLayout">
    <fieldset>
 
 <label>Departamento</label>
 <input type="text" name="nombre_departamento"  disabled>
  <input type="button" name="buscar_departamento" id="buscar_departamento" value="Buscar"/>
  <input type="hidden" name="codigo_departamento_hi" id="codigo_departamento_hi"/>
  <br/>
  
  <label>Mes</label>
  <select name='mes' id='mes' >
 $mes_from
 </select>
 <br/>
 
 <label>Año</label>
 <select name='anhio' id='codigoanhio' >
 $anhio_from
  </select>
  <br/>
<br/>
  <input type="submit" value="Generar Reporte" name="submit">
  <a href="../../mno_menu2.php"><input type="button" value="Atras"></a>
 
 
     </div>
    </fieldset>
    </form>
EOT

);

$layout->get_footer();
mysql_close($conn);