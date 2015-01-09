<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 08/01/15
 * Time: 09:47 AM
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

$layout = new LayoutForm('Módulo de Recursos Humanos | Reporte Costo Empleado');



$layout->append_to_header(
    <<<EOT
   <script type="text/javascript">

        function getMondays(anhio,mes) {
            var mes_ = mes -1;
            var d = new Date(anhio,mes_,01),
                month = d.getMonth(),
                mondays = [];

            d.setDate(1);

            // Get the first Monday in the month
            while (d.getDay() !== 1) {
                d.setDate(d.getDate() + 1);
            }

            // Get all the other Mondays in the month
            while (d.getMonth() === month) {
                mondays.push(new Date(d.getTime()));
                d.setDate(d.getDate() + 7);
            }

            return mondays;
        }


        $(function() {

            var mes = $('#mes').val();
            var anhio = $('#anhio').val();


            var numero_lunes =  getMondays(anhio,mes).length;

            if(numero_lunes == 4){

                $( ".semana_5" ).hide();
            }else if(numero_lunes == 5){

                $( ".semana_5" ).show();
            }


            $("#buscar_empleado").click(function() {
                var win = window.open("buscar_empleado.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90 ");
                win.focus();
            });


            $('#mes').bind('change',function(){

                mes = $('#mes').val();

                var numero_lunes =  getMondays(anhio,mes).length;

                if(numero_lunes == 4){

                    $( ".semana_5" ).hide(600);
                    $('#semana').prop('checked', false);
                }else if(numero_lunes == 5){

                    $( ".semana_5" ).show(600);
                    $('#semana').prop('checked', true);


                }

            });

            $('#anhio').bind('change',function(){

                anhio = $('#anhio').val();

                var numero_lunes =  getMondays(anhio,mes).length;

                if(numero_lunes == 4){

                    $( ".semana_5" ).hide(600);
                }else if(numero_lunes == 5){

                    $( ".semana_5" ).show(600);
                }

            });

        });

    </script>
EOT
);

$layout->get_header();


$anhio_form = '';

$anhio = date('Y');
$anhio_presente = $anhio;
$anhio = $anhio - 10;

for($i = $anhio ; $i < $anhio+12 ;$i++){

    if($i == $anhio_presente){
        $anhio_form .= '<option value="'.($i).'"selected>'.($i).'</option>';

    }else{
        $anhio_form .= '<option value="'.($i).'">'.($i).'</option>';
    }
}


$mes_from = '';

$mes = date('n');

if($mes - 1 <= 0){
    $mes = 12;
}else{
    $mes -= 1;
}

if($mes == 1){
    $mes_from .= " <option value='1' selected>Enero</option>";
}else{
    $mes_from .= " <option value='1' >Enero</option>";
}
if($mes == 2){
    $mes_from .= " <option value='2' selected>Febrero</option>";
}else{
    $mes_from .= " <option value='2' >Febrero</option>";
}
if($mes == 3){
    $mes_from .= " <option value='3' selected>Marzo</option>";
}else{
    $mes_from .= " <option value='3' >Marzo</option>";
}
if($mes == 4){
    $mes_from .= " <option value='4' selected>Abril</option>";
}else{
    $mes_from .= " <option value='4' >Abril</option>";
}
if($mes == 5){
    $mes_from .= " <option value='5' selected>Mayo</option>";
}else{
    $mes_from .= " <option value='5' >Mayo</option>";
}
if($mes == 6){
    $mes_from .= " <option value='6' selected>Junio</option>";
}else{
    $mes_from .= " <option value='6' >Junio</option>";
}
if($mes == 7){
    $mes_from .= " <option value='7' selected>Julio</option>";
}else{
    $mes_from .= " <option value='7' >Julio</option>";
}
if($mes == 8){
    $mes_from .= " <option value='8' selected>Agosto</option>";
}else{
    $mes_from .= " <option value='8' >Agosto</option>";
}
if($mes == 9){
    $mes_from .= " <option value='9' selected>Septiembre</option>";
}else{
    $mes_from .= " <option value='9' >Septiembre</option>";
}
if($mes == 10){
    $mes_from .= " <option value='10' selected>Octubre</option>";
}else{
    $mes_from .= " <option value='10' >Octubre</option>";
}
if($mes == 11){
    $mes_from .= " <option value='11' selected>Noviembre</option>";
}else{
    $mes_from .= " <option value='11' >Noviembre</option>";
}
if($mes == 12){
    $mes_from .= " <option value='12' selected>Diciembre</option>";
}else{
    $mes_from .= " <option value='12' >Diciembre</option>";
}



$layout->set_form(

    <<<EOT
 
     <form method="post" accept-charset="UTF-8" name="formulario" action="reporte_costo_empleado.php"  id="contact-form">
    <div class="formLayout">
    <fieldset>

 <label>Fecha</label>
 <select name='anhio' id='anhio' >
$anhio_form
</select>

<select name='mes' id='mes' >
 $mes_from
 <select/>

 <br/>
 <br/>

 <label>Empledo</label>
  <input type="text" name="nombre_empleado"  disabled>
   <input type="button" name="buscar_empleado" id="buscar_empleado" value="Buscar"/>
   <input type="hidden" name="cedulaempleado" id="cedulaempleado" value="*"/>
   <br/>

  <label class="total"> Total </label>
   <input type="checkbox" style="margin-right:15%;margin-top: 8px"    class="total" name="total">
<br/>

 <label class="semana_1" > Semana 1 </label>
 <input  type="checkbox" style="margin-left:-90px;margin-right:15%;margin-top: 8px" class="semana_1"  name="semana_1" checked/>

 <label class="semana_2" > Semana 2 </label>
 <input  type="checkbox" style="margin-left:-90px;margin-right:10%;margin-top: 8px" class="semana_2"  name="semana_2" checked/>
<br/>

 <label class="semana_3" > Semana 3 </label>
 <input  type="checkbox" style="margin-left:-90px;margin-right:10%;margin-top: 8px" class="semana_3"  name="semana_3" checked/>

  <label class="semana_4" > Semana 4 </label>
 <input  type="checkbox" style="margin-left:-90px;margin-right:10%;margin-top: 8px" class="semana_4"  name="semana_4" checked/>

<br/>

  <label class="semana_5" > Semana 5 </label>
 <input  type="checkbox" style="margin-left:-90px;margin-right:10%;margin-top: 8px" class="semana_5"  name="semana_5" checked/>

<br/>

<input type="submit" value="Generar Reporte" name="submit" >
<a href="../../mno_menu2.php"><input type="button" value="Atras"></a>

     </div>
    </fieldset>
    </form>
EOT

);

$layout->get_footer();
mysql_close($conn);