<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 06/01/15
 * Time: 01:35 PM
 */

include_once('clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

include("db.php");
include_once('./clases/LayoutForm.php');

$layout = new LayoutForm('Módulo de Recursos Humanos | Reporte Horario Departamento','.');



$layout->append_to_header('
    <script type="text/javascript">

        $(function() {

            $("#buscar_departamento").click(function() {
                var win = window.open("buscar_departamento_reporte_horario.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90 ");
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

$sql = "SELECT * FROM mrh_mes";

$result=mysql_query($sql);
$mes_from .= ('<option value="'.'-'.'">'.'-----------'.'</option>');

while($test = mysql_fetch_array($result)){
    $mes_from .= ('<option value="'.$test['codigo'].'">'.$test['descripcion'].'</option>');
}

$layout->set_form(

    <<<EOT
            <form method="post" accept-charset="UTF-8" name="formulario" action="./reporte_horario_departamento.php" id="contact-form">
            <div class="formLayout">
            <fieldset>


                <label>Departamento</label>
                <input type="text" name="departamento"  disabled>
                <input type="button" name="buscar_departamento" id="buscar_departamento" value="Buscar"/>
                <input type="hidden" name="departamento_hi" id="departamento_empleado"/>
                <br/>

                <label>Año</label>

                <select name='anhio' id='codigomes' >

                    $anhio_from

                </select>

                <br/>
                <label >Mes</label>

                <select name="mes" id="">
                    $mes_from
                </select>

<br/>

                <input type="submit" value="Generar Reporte" name="submit" >
                <a href="mrh_menu.php"><input type="button" value="Atras">

                </div>

                </fieldset>
            </form>


EOT

);

$layout->get_footer();