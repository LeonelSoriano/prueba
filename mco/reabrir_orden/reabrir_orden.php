<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 07/01/15
 * Time: 12:36 PM
 */

header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

include_once('../../db.php');

include_once('../../clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();


if(isset($_POST['submit']) && is_numeric($_POST['codigo_orden_hi'])){




    $codigo = $_POST['codigo_orden_hi'];



    $sql = "UPDATE prc_orden_trabajo SET fecha_culminacion='n'
                WHERE codigo='$codigo'";

    mysql_query($sql) or die('error en actualizar prc_orden_trabajo '.mysql_error());


    $sql = "UPDATE prc_orden_trabajo_etapas SET completo='n'
                    WHERE codigo_orden_trabajo='$codigo'";


    mysql_query($sql) or die('error en actualizar prc_orden_trabajo_etapas '.mysql_error());

    send_error_redirect(false,'La Orden fue Reabierta Satisfactoriamente');
    die;

}else{

    //  send_error_redirect(true,"No se Pudo Reabrir la Orden");
    //   die;
}



include_once('../../clases/LayoutForm.php');

$layout = new LayoutForm('Módulo de Configuración | Reabrir Orden');


$layout->append_to_header('
   <script type="text/javascript">

        $(function() {


            var codigo_tipo;

            $("#buscar_orden").click(function() {

                var mes = $("#mes").val();
                var anhio = $("#anhio").val();

                var win = window.open("buscar_orden.php?anhio=" + anhio + "&mes=" + mes, "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90 ");
                win.focus();
            });


        });

    </script>

');

$layout->get_header();


$anhio_from = '';
$anhio = date('Y');
$anhio_presente = $anhio;
$anhio = $anhio - 10;

for($i = $anhio ; $i < $anhio+20 ;$i++){

    if($i == $anhio_presente){
        $anhio_from .= ('<option value="'.($i).'"selected>'.($i).'</option>');

    }else{
        $anhio_from .= ('<option value="'.($i).'">'.($i).'</option>');

    }
}


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
    $mes_from .= ("<option value='5' >Mayo</option>");
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
    $mes_from .= ("<option value='9' >Septiembre</option>");
}
if($mes == 10){
    $mes_from .= (" <option value='10' selected>Octubre</option>");
}else{
    $mes_from .= (" <option value='10' >Octubre</option>");
}
if($mes == 11){
    $mes_from .= (" <option value='11' selected>Noviembre</option>");
}else{
    $mes_from .= ("<option value='11' >Noviembre</option>");
}
if($mes == 12){
    $mes_from .= (" <option value='12' selected>Diciembre</option>");
}else{
    $mes_from .= (" <option value='12' >Diciembre</option>");
}




$layout->set_form(

    <<<EOT
    <form method="post" accept-charset="UTF-8" name="gerencia"  id="contact-form">
    <div class="formLayout">
    <fieldset>


<label>Año</label>
<select name='anhio' id='anhio' >
$anhio_from
</select>
<br/>

<label>Mes</label>
<select name='mes' id='mes' >
$mes_from
</select>
<br/>

<label>Nombre Bien</label>
<input type="text" name="nombre_orden"  disabled>
 <input type="button" name="buscar_orden" id="buscar_orden" value="Buscar"/>
 <input type="hidden" name="codigo_orden_hi" id="codigo_orden_hi"/>
<br/>

<input type="submit" value="Re Abrir Orden" name="submit">
<a href="../../mco_menu.php    "><input type="button" value="Atras"></a>


    </div>
    </fieldset>
    </form>
EOT

);

$layout->get_footer();
mysql_close($conn);