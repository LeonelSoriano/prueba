<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 08/01/15
 * Time: 10:34 AM
 */
 
 header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

include_once('../../db.php');

include_once('../../clases/Seguridad.php');



$a = new Seguridad();

$a->chekear_session();

require_once('../../clases/Validate.php');
require_once('../../clases/funciones.php');


//<option value="1">Quinceal</option>
//                                            <option value="2">Mensual</option>
//                                            <option value="3">Bimestral</option>
//                                            <option value="4">Trimestral</option>
//                                            <option value="5">Cuatrmestral</option>
//                                            <option value="6">Semestral</option>
//                                            <option value="7">Anual</option>


//esto lo divido el resultado y me dara el mensual
function get_periocidad($codigo){
    if($codigo == '0'){
        return 0.5;
    }else if($codigo == '1'){
        return 1;
    }else if($codigo == '2'){
        return 2;
    }else if($codigo == '3'){
        return 3;
    }else if($codigo == '4'){
        return 4;
    }else if($codigo == '5'){
        return 6;
    }else if($codigo == '6'){
        return 12;
    }else if($codigo == '7'){
        /* TODO areglar esto de semana */
        return 0.1;
    }else{
        return 1;
    }

}


if(isset($_POST['submit'])){




    if(isset($_POST['semana_mensual'])){


        $validation = array(

            array('nombre' => 'codigo_empleado_hi',
                'requerida' => true,
                'regla' => 'number'),


            array('nombre' => 'anhio',
                'requerida' => true,
                'regla' => 'number'),

            array('nombre' => 'sueldo_mensual',
                'requerida' => true,
                'regla' => 'float',
                'tipo' => ',' ),

            array('nombre' => 'hora_extra_diurna',
                'requerida' => false,
                'regla' => 'number'),


            array('nombre' => 'hora_extra_nocturna',
                'requerida' => false,
                'regla' => 'number'),

            array('nombre' => 'cesta_ticket',
                'requerida' => true,
                'regla' => 'number'),


        );


        $validated = new Validate($validation,$_POST);
        $validated->validate();


        if(!$validated->getIsError()){

            $codigo_empleado_hi =  $_POST['codigo_empleado_hi'];
            $mes =  $_POST['mes'];
            $anhio =  $_POST['anhio'];





            $sql = "

            SELECT
    count(*) as total
FROM
    mno_new_concepto_empleado
WHERE
    mno_new_concepto_empleado.anhio = '$anhio'
        AND mno_new_concepto_empleado.mes = '$mes'
        AND mno_new_concepto_empleado.codigo_empleado = '$codigo_empleado_hi';
            ";



            $result=mysql_query($sql);

            $test = mysql_fetch_array($result);

            if( $test['total'] != '0' ){


                send_error_redirect(true,"Ya has asignado este Mes");die;
            }


            $sql = "

            SELECT
    count(*) as total
FROM
    mrh_turnoxempleado
WHERE
    mrh_turnoxempleado.anhio = '$anhio'
        AND mrh_turnoxempleado.codigomes = '$mes'
        AND mrh_turnoxempleado.cedulaempleado = '$codigo_empleado_hi' AND mrh_turnoxempleado.eliminado = 'no';

            ";

            $result=mysql_query($sql);

            $test = mysql_fetch_array($result);


            if($test['total'] == '0' ){
                send_error_redirect(true,"Debes asignarle un Turno Primero");die;
            }


            include_once('./divicion1.php');

        }else if($validated->getIsError()  ){

            send_error_redirect(true);
        }

    }else{

        // var_dump($_POST);die;


//        $validation = array(
//
//
//            array('nombre' => 'codigo_empleado_hi',
//                'requerida' => true,
//                'regla' => 'number'),
//
//
//            array('nombre' => 'anhio',
//                'requerida' => true,
//                'regla' => 'number'),
//
//            array('nombre' => 'sueldo_mensual',
//                'requerida' => true,
//                'regla' => 'float',
//                'tipo' => ',' ),
//
//            array('nombre' => 'hora_extra_diurna',
//                'requerida' => false,
//                'regla' => 'number'),
//
//
//            array('nombre' => 'hora_extra_nocturna',
//                'requerida' => false,
//                'regla' => 'number'),
//
//            array('nombre' => 'cesta_ticket',
//                'requerida' => false,
//                'regla' => 'number'),
//
//            array('nombre' => 'dias_feriado',
//                'requerida' => false,
//                'regla' => 'number'),
//
//        );



        $codigo_empleado = $_POST['codigo_empleado_hi'];

        $cedula = $_POST['cedula_hi'];

        $anhio = $_POST['anhio'];

        $mes = $_POST['mes'];

        $numero_lunes = count(getMondays($anhio,$mes));


        $sueldo_semana1  = $_POST['sueldo_semana1'];
        $sueldo_semana2  = $_POST['sueldo_semana2'];
        $sueldo_semana3  = $_POST['sueldo_semana3'];
        $sueldo_semana4  = $_POST['sueldo_semana4'];
        $sueldo_semana5  = '';

        if($numero_lunes == 5){
            $sueldo_semana5 = $_POST['sueldo_semana5'];
        }







        $sql = "SELECT * FROM mrh_empleado WHERE codigo='$codigo_empleado'";

        $result=mysql_query($sql);

        $test = mysql_fetch_array($result);

        $ingreso = $test['fechaingreso'];
        $hoy = fecha_sicap();

        $anhios_trabajo = calculo_entre_anhios($ingreso,$hoy);


        $sql = "SELECT * FROM mco_tabulador_antiguedad";


        $result=mysql_query($sql);

        $valor;

        $bono_antiguedad = 0;

        while($test = mysql_fetch_array($result)){

            if( $anhios_trabajo > $test['paso'] &&  $anhios_trabajo <= $test['referencia']){
                $bono_antiguedad = $test['valor'];
            }

        }

        $sql = "SELECT * FROM mco_tabulador_anhio_servicio";

        $result=mysql_query($sql);

        $bono_anhio_servicios = 0;


        while($test = mysql_fetch_array($result)){

            if( $anhios_trabajo > $test['paso'] &&  $anhios_trabajo <= $test['referencia']){
                $bono_anhio_servicios = $test['valor'];

            }

        }


        //-.-.-.-.-..-.-.-.-..-.-.-.-.-.-..-.-.-.

        $sql = "SELECT * FROM mno_new_concepto_anual WHERE codigo_new_concepto = '11'";

        $result=mysql_query($sql);

        $test = mysql_fetch_array($result);

        $valor = $test['valor'];

        $sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,total,mes,anhio)
                VALUES
                ('$codigo_empleado','11','$valor',
                  '$mes','$anhio')";

        $result=mysql_query($sql)  or die('mno_new_concepto 11'.mysql_error());


        //.-.--.-.-..-.-.--.-.-.-..-..-.--.-.-..


        $sql = "SELECT * FROM mno_new_concepto_anual WHERE codigo_new_concepto = '13'";

        $result=mysql_query($sql);

        $test = mysql_fetch_array($result);

        $valor = $test['valor'];

        $sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,total,mes,anhio)
                VALUES
                ('$codigo_empleado','13','$valor',
                  '$mes','$anhio')";




        $result=mysql_query($sql)  or die('mno_new_concepto 13'.mysql_error());


        //.-.--.-.-..-.-.--.-.-.-..-..-.--.-.-..

        $sql = "SELECT * FROM mno_new_concepto_anual WHERE codigo_new_concepto = '14'";

        $result=mysql_query($sql);

        $test = mysql_fetch_array($result);

        $valor = $test['valor'];

        $sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,total,mes,anhio)
                VALUES
                ('$codigo_empleado','14','$valor',
                  '$mes','$anhio')";

        $result=mysql_query($sql)  or die('mno_new_concepto 14'.mysql_error());


        //.-.--.-.-..-.-.--.-.-.-..-..-.--.-.-..


        $sql = "SELECT * FROM mno_new_concepto_anual WHERE codigo_new_concepto = '15'";

        $result=mysql_query($sql);

        $test = mysql_fetch_array($result);

        $valor = $test['valor'];

        $sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,total,mes,anhio)
                VALUES
                ('$codigo_empleado','15','$valor',
                  '$mes','$anhio')";

        $result=mysql_query($sql)  or die('mno_new_concepto 15'.mysql_error());


        //.-.--.-.-..-.-.--.-.-.-..-..-.--.-.-..



        $sql = "SELECT * FROM mno_new_concepto_anual WHERE codigo_new_concepto = '16'";

        $result=mysql_query($sql);

        $test = mysql_fetch_array($result);

        $valor = $test['valor'];

        $sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,total,mes,anhio)
                VALUES
                ('$codigo_empleado','16','$valor',
                  '$mes','$anhio')";

        $result=mysql_query($sql)  or die('mno_new_concepto 16'.mysql_error());


        //.-.--.-.-..-.-.--.-.-.-..-..-.--.-.-..







        $sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,semana_1,semana_2,
                  semana_3,semana_4,semana_5,mes,anhio)
                VALUES
                ('$codigo_empleado','1','$sueldo_semana1',
                  '$sueldo_semana2','$sueldo_semana3','$sueldo_semana4','$sueldo_semana5',
                  '$mes','$anhio')";


        $result=mysql_query($sql) or die('mno_new_concepto_empleado 1'.mysql_error());



        $exta_diurna_semana1 = $_POST['exta_diurna_semana1'];
        $exta_diurna_semana2 = $_POST['exta_diurna_semana2'];
        $exta_diurna_semana3 = $_POST['exta_diurna_semana3'];
        $exta_diurna_semana4 = $_POST['exta_diurna_semana4'];
        $exta_diurna_semana5 = '';

        if($numero_lunes == 5){
            $exta_diurna_semana5 = $_POST['exta_diurna_semana5'];
        }




        $sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,semana_1,semana_2,semana_3,semana_4,semana_5,mes,anhio)
                VALUES
                ('$codigo_empleado','3','$exta_diurna_semana1',
                '$exta_diurna_semana2','$exta_diurna_semana3',
                '$exta_diurna_semana4','$exta_diurna_semana5',
                  '$mes','$anhio')";


        $result=mysql_query($sql) or die('mno_new_concepto_empleado 3'.mysql_error());



        $exta_nocturna_semana1 = $_POST['exta_nocturna_semana1'];
        $exta_nocturna_semana2 = $_POST['exta_nocturna_semana2'];
        $exta_nocturna_semana3 = $_POST['exta_nocturna_semana3'];
        $exta_nocturna_semana4 = $_POST['exta_nocturna_semana4'];
        $exta_nocturna_semana5 = '';

        if($numero_lunes == 5){
            $exta_nocturna_semana5 = $_POST['exta_nocturna_semana5'];
        }


        $sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,semana_1,semana_2,semana_3,semana_4,semana_5,mes,anhio)
                VALUES
                ('$codigo_empleado','4','$exta_nocturna_semana1',
                '$exta_nocturna_semana2','$exta_nocturna_semana3',
                '$exta_nocturna_semana4','$exta_nocturna_semana5',
                  '$mes','$anhio')";


        $result=mysql_query($sql) or die('mno_new_concepto_empleado 4'.mysql_error());





        $cestastiket1 = $_POST['cestastiket1'];
        $cestastiket2 = $_POST['cestastiket2'];
        $cestastiket3 = $_POST['cestastiket3'];
        $cestastiket4 = $_POST['cestastiket4'];
        $cestastiket5 = '';

        if($numero_lunes == 5){
            $cestastiket5 = $_POST['cestastiket5'];
        }


        $sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,semana_1,semana_2,semana_3,semana_4,semana_5,mes,anhio)
                VALUES
                ('$codigo_empleado','5','$cestastiket1',
                '$cestastiket2','$cestastiket3',
                '$cestastiket4','$cestastiket5',
                  '$mes','$anhio')";


        $result=mysql_query($sql);



        $dias_feriado1 = $_POST['dias_feriado1'];
        $dias_feriado2 = $_POST['dias_feriado2'];
        $dias_feriado3 = $_POST['dias_feriado3'];
        $dias_feriado4 = $_POST['dias_feriado4'];
        $dias_feriado5 = 0;



        if($numero_lunes == 5){
            $dias_feriado5 = $_POST['dias_feriado5'];
        }

        $dias_feriados_trabajados_totales = $dias_feriado1 + $dias_feriado2 + $dias_feriado3 + $dias_feriado4 + $dias_feriado5;

        $sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,semana_1,semana_2,semana_3,semana_4,semana_5,mes,anhio)
                VALUES
                ('$codigo_empleado','6','$dias_feriado1',
                '$dias_feriado2','$dias_feriado3',
                '$dias_feriado4','$dias_feriado5',
                  '$mes','$anhio')";


        $result=mysql_query($sql);



        $sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,total,mes,anhio)
                VALUES
                ('$codigo_empleado','9','$bono_antiguedad',
                  '$mes','$anhio')";

        $result=mysql_query($sql);




        $sql = "INSERT
                INTO mno_new_concepto_empleado
                (codigo_empleado,codigo_concepto,total,mes,anhio)
                VALUES
                ('$codigo_empleado','10','$bono_anhio_servicios',
                  '$mes','$anhio')";



        $result=mysql_query($sql);






        send_error_redirect(false);

    }

}





include_once('../../clases/LayoutForm.php');

$layout = new LayoutForm('Módulo de Nomina | Sueldos');



$layout->append_to_header(
    <<<EOT
   <script type="text/javascript">

        $(function() {

            $( "#buscar_empleado" ).click(function() {
                var win = window.open("buscar_empleado.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90 ");
                win.focus();
            });


            var codigo = "";


            $('#mes').bind('change',function() {
                var optionSelected = $("option:selected", this);
                var valueSelected = this.value;
                var mes = valueSelected;

                var anhio = $("#anhio").val();


                var mensual;


                if($('#semana_mensual').is(':checked')){
                    mensual = 'si';
                }else{
                    mensual = 'no';
                }


                var parametros = { mes : mes,
                                   anhio : anhio,
                                  mensual : mensual};

                $.ajax({
                    data:  parametros,
                    url:   'ajax_form.php',
                    type:  'post',
                    beforeSend: function () {
                        $("#resultado").html('<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +
                        '<img src="../../images/ajax-loader.gif" alt="Ajax Cargando" height="42" width="42">');
                    },
                    success:  function (response) {
                        $("#respuesta").html(response);
                    }
                });


            });


            $('#semana_mensual').change(function(){


                var mes = $('#mes').val();

                var anhio = $("#anhio").val();


                var mensual;


                if($('#semana_mensual').is(':checked')){
                    mensual = 'si';
                }else{
                    mensual = 'no';
                }


                var parametros = { mes : mes,
                    anhio : anhio,
                    mensual : mensual};

                $.ajax({
                    data:  parametros,
                    url:   'ajax_form.php',
                    type:  'post',
                    beforeSend: function () {
                        $("#resultado").html('<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +
                        '<img src="../../images/ajax-loader.gif" alt="Ajax Cargando" height="42" width="42">');
                    },
                    success:  function (response) {
                        $("#respuesta").html(response);
                    }
                });

            });





            var mes = $('#mes').val();

            var anhio = $("#anhio").val();


            var mensual;


            if($('#semana_mensual').is(':checked')){
                mensual = 'si';
            }else{
                mensual = 'no';
            }


            var parametros = { mes : mes,
                anhio : anhio,
                mensual : mensual};

            $.ajax({
                data:  parametros,
                url:   'ajax_form.php',
                type:  'post',
                beforeSend: function () {
                    $("#resultado").html('<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +
                    '<img src="../../images/ajax-loader.gif" alt="Ajax Cargando" height="42" width="42">');
                },
                success:  function (response) {
                    $("#respuesta").html(response);
                }
            });
    

        });

    </script>
EOT
);

$layout->get_header();

$anhio_form = '';
$anhio = date('Y');
$anhio_form .= ('<option value="'.($anhio -3).'">'.($anhio -3).'</option>');
$anhio_form .= ('<option value="'.($anhio -2).'">'.($anhio -2).'</option>');
$anhio_form .= ('<option value="'.($anhio -1).'">'.($anhio -1).'</option>');
$anhio_form .= ('<option value="'.($anhio).'"selected>'.($anhio).'</option>');
$anhio_form .= ('<option value="'.($anhio + 1).'">'.($anhio + 1).'</option>');


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


$layout->set_form(

    <<<EOT
 
     <form method="post" accept-charset="UTF-8" name="formulario"   id="contact-form">
    <div class="formLayout">
    <fieldset>
 
 <label>Cédula de Empleado</label>
 <input type="text" name="cedula"  disabled>
 <input type="button" name="buscar_empleado" id="buscar_empleado" value="Buscar"/>
 <input type="hidden" name="codigo_empleado_hi" id="codigo_empleado_hi"/>
 <input type="hidden" name="cedula_hi" id="cedula_hi"/>
 <br/>
 
 <label>Año</label>
 <select name='anhio' id="anhio" >
 $anhio_form
 </select>
 <br/>
 
 <label>Mes</label>
 <select name='mes' id='mes' >
 $mes_from
 </select>
<br/>

<label style="display: none">Pago Anual?</label>
 <input style="display: none" type="checkbox" name="semana_mensual" id="semana_mensual"  checked>



<div id="respuesta">

</div>
<br/>

<input type="submit" value="Guardar datos" name="submit">
<!--<a href="vehiculo_ver.php"><input type="button" value="Ver datos"></a> -->
<a href="../../mno_menu2.php"><input type="button" value="Atras"></a>

     </div>
    </fieldset>
    </form>
EOT

);

$layout->get_footer();
mysql_close($conn);