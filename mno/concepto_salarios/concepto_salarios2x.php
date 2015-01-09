<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 01/10/14
 * Time: 09:32 AM
 */
include("../../db.php");
?>

<?php

header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

require_once('../../db.php');
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





?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>SICAP | Sistema Integral de Costos</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="author" content="Leonel Soriano leonelsoriano3@gmail.com" />
    <link href="/sicap/css/helper.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="/sicap/css/stylesheet.css" rel="stylesheet" type="text/css" />
    <script src="/sicap/js/jquery-1.10.2.js"></script>

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

<!--    <style>-->
<!--        input {color: #d1ccc6-->
<!--        }-->
<!--        select{color: #d1ccc6-->
<!--        }-->
<!---->
<!--    </style>-->

</head>


<body class="flickr-com">


<form method="post" accept-charset="UTF-8" name="formulario">

    <div id="body_bottom_bgd">
        <div id=""> <!--<img src="images/Logo_Inventario.png"/>-->
            <!--</div>-->                <!-- Menu -->
            <!--  ?php include 'include/nav.php'; ?>-->
            <div align="justify" id="right_col" >

                <div id="header">
                </div>

                <div id="">
                    <div id="firefoxbug"><!-- firefoxbug -->
                        <!-- <div id="blue_line"></div>-->
                        <div class="dynamicContent" align="left">
                            <!--  <h1>Inicio</h1>-->
                            <!--<p><a href="seleccion_sicap.html" class="main-site">Principal</a></p>-->
                            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Recursos Humanos | Empresa</strong></h1>
                            <br/>

                            <?php

                            if(isset($_GET['msg'])){
                                $error =  $_GET['error'];

                                $msg = $_GET['msg'];

                                if($error == 'true'){
                                    echo('<div id="error_app"><marquee scrolldelay="100">'.$msg.'</marquee></div>');
                                }else if($error == 'false'){
                                    echo('<div id="done_app"><marquee scrolldelay="100">'.$msg.'</marquee></div>');

                                }

                            }

                            ?>

                            <br/>

                            <TABLE BORDER="0" CELLSPACING="10" >


                                <TR>
                                    <TD><label>Cédula de Empleado</label></TD>
                                    <td> <input type="text" name="cedula"  disabled></td><td><input type="button" name="buscar_empleado" id="buscar_empleado" value="Buscar"/>
                                    </TD>

                                    <input type="hidden" name="codigo_empleado_hi" id="codigo_empleado_hi"/>
                                    <input type="hidden" name="cedula_hi" id="cedula_hi"/>
                                </TR>




                                <TD><label>Año</label></TD>
                                <TD>
                                    <select name='anhio' id="anhio" >

                                        <?php $anhio = date('Y');
                                        echo('<option value="'.($anhio -3).'">'.($anhio -3).'</option>');
                                        echo('<option value="'.($anhio -2).'">'.($anhio -2).'</option>');
                                        echo('<option value="'.($anhio -1).'">'.($anhio -1).'</option>');
                                        echo('<option value="'.($anhio).'"selected>'.($anhio).'</option>');
                                        echo('<option value="'.($anhio + 1).'">'.($anhio + 1).'</option>');
                                        ?>
                                    </select>
                                </TD>



                                <TR>
                                    <TD><label>Mes</label></TD>
                                    <TD>
                                        <select name='mes' id='mes' >

                                            <?php

                                            $mes = date('n');

                                            if($mes == 1){
                                                echo(" <option value='1' selected>Enero</option>");
                                            }else{
                                                echo(" <option value='1' >Enero</option>");
                                            }
                                            if($mes == 2){
                                                echo(" <option value='2' selected>Febrero</option>");
                                            }else{
                                                echo(" <option value='2' >Febrero</option>");
                                            }
                                            if($mes == 3){
                                                echo(" <option value='3' selected>Marzo</option>");
                                            }else{
                                                echo(" <option value='3' >Marzo</option>");
                                            }
                                            if($mes == 4){
                                                echo(" <option value='4' selected>Abril</option>");
                                            }else{
                                                echo(" <option value='4' >Abril</option>");
                                            }
                                            if($mes == 5){
                                                echo(" <option value='5' selected>Mayo</option>");
                                            }else{
                                                echo(" <option value='5' >Mayo</option>");
                                            }
                                            if($mes == 6){
                                                echo(" <option value='6' selected>Junio</option>");
                                            }else{
                                                echo(" <option value='6' >Junio</option>");
                                            }
                                            if($mes == 7){
                                                echo(" <option value='7' selected>Julio</option>");
                                            }else{
                                                echo(" <option value='7' >Julio</option>");
                                            }
                                            if($mes == 8){
                                                echo(" <option value='8' selected>Agosto</option>");
                                            }else{
                                                echo(" <option value='8' >Agosto</option>");
                                            }
                                            if($mes == 9){
                                                echo(" <option value='9' selected>Septiembre</option>");
                                            }else{
                                                echo(" <option value='9' >Septiembre</option>");
                                            }
                                            if($mes == 10){
                                                echo(" <option value='10' selected>Octubre</option>");
                                            }else{
                                                echo(" <option value='10' >Octubre</option>");
                                            }
                                            if($mes == 11){
                                                echo(" <option value='11' selected>Noviembre</option>");
                                            }else{
                                                echo(" <option value='11' >Noviembre</option>");
                                            }
                                            if($mes == 12){
                                                echo(" <option value='12' selected>Diciembre</option>");
                                            }else{
                                                echo(" <option value='12' >Diciembre</option>");
                                            }

                                            ?>

                                        </select>
                                    </TD>


                                <TR style="display: none">
                                    <TD><label>Pago Anual?</label></TD>
                                    <td> <input type="checkbox" name="semana_mensual" id="semana_mensual"  checked></td>
                                    </TD>

                                </TR>

                                <!-- leonel -->


                            </TABLE>
                            <div id="respuesta">

                            </div>
                            <br/>
                            <table>
                                <tr>
                                    <td><input type="submit" value="Guardar datos" name="submit"></td>
                                    <td><a href="vehiculo_ver.php"><input type="button" value="Ver datos"></a> </td>
                                    <td><a href="../../mno_menu.html"><input type="button" value="Atras"></a> </td>

                                </tr>
                            </table>
                            <!-- / END -->
                            <p></p>
                        </div>
                    </div><!--end firefoxbug-->
                </div><!--end left_bgd-->

            </div>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>
                <!--end right_col-->
            </p>
            <p>&nbsp; </p>
            <div class="clearboth"></div>
        </div>
        <div align="center" class="pie">SICAP 2014</div>
    </div>




</form>

</body>
</html>