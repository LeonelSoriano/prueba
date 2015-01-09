<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 02/12/14
 * Time: 08:35 AM
 */

header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

require_once('../../db.php');


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
    <title>SICAP | Sistema Integral de Costos</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="author" content="Leonel Soriano leonelsoriano3@gmail.com" />
    <link href="../../css/helper.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="../../css/stylesheet.css" rel="stylesheet" type="text/css" />
    <script src="../../js/jquery-1.10.2.js"></script>

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

</head>


<body class="flickr-com">


<form method="post" accept-charset="UTF-8" name="formulario" action="reporte_costo_empleado.php">

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


                            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Recursos Humanos | Reporte Costo Empleado</strong></h1>
                            <br/>
                            <TABLE BORDER="0" CELLSPACING="10" >



                                <TR class="fecha">
                                    <TD><label>Fecha</label></TD>
                                    <TD>
                                        <select name='anhio' id='anhio' >

                                            <?php $anhio = date('Y');
                                            $anhio_presente = $anhio;
                                            $anhio = $anhio - 10;

                                            for($i = $anhio ; $i < $anhio+12 ;$i++){

                                                if($i == $anhio_presente){
                                                    echo('<option value="'.($i).'"selected>'.($i).'</option>');

                                                }else{
                                                    echo('<option value="'.($i).'">'.($i).'</option>');
                                                }
                                            }

                                            ?>
                                        </select>


                                        <select name='mes' id='mes' >

                                            <?php

                                            $mes = date('n');

                                            if($mes - 1 <= 0){
                                                $mes = 12;
                                            }else{
                                                $mes -= 1;
                                            }

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
                                <TR>

                                <tr>
                                    <td><label>Empledo</label></td>
                                    <td>
                                        <input type="text" name="nombre_empleado"  disabled>
                                        <input type="button" name="buscar_empleado" id="buscar_empleado" value="Buscar"/>

                                    </td>
                                    <input type="hidden" name="cedulaempleado" id="cedulaempleado" value="*"/>
                                </tr>


                                <!-- leonel -->


                            </TABLE>

                            <br/>
                            <label class="total"> Total </label> <input style="margin-right: 10px" type="checkbox" class="total" name="total" checked/>
                            <label class="semana_1" > Semana 1 </label> <input style="margin-right: 10px" type="checkbox" class="semana_1"  name="semana_1" checked/>
                            <label class="semana_2"> Semana 2 </label> <input style="margin-right: 10px" type="checkbox" class="semana_2"  name="semana_2" checked/>
                            <label class="semana_3"> Semana 3 </label> <input style="margin-right: 10px" type="checkbox" class="semana_3" name="semana_3" checked/>
                            <label class="semana_4"> Semana 4 </label> <input style="margin-right: 10px" type="checkbox" class="semana_4" name="semana_4" checked/>
                            <label class="semana_5"> Semana 5 </label> <input style="margin-right: 10px" type="checkbox" id="semana" class="semana_5" name="semana_5"  checked/>
                            <br/>
                            <br/>


                            <br/>
                            <table>
                                <tr>
                                    <td><input type="submit" value="Generar Reporte" name="submit" ></td>
                                    <td><a href="../../prc_menu.php"><input type="button" value="Atras"></a> </td>

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



