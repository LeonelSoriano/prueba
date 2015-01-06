<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 30/10/14
 * Time: 02:17 PM
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
    <title>SICAP | Sistema Integral de Costos</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <link href="../../css/helper.css" media="screen" rel="stylesheet" type="text/css" />
    <script src="../../js/htmlDatePicker.js" type="text/javascript"></script>
    <link href="../../css/htmlDatePicker.css" rel="stylesheet">
    <link href="../../css/stylesheet.css" rel="stylesheet" type="text/css" />
    <link href="../../css/ui-lightness/jquery-ui-1.10.4.custom.css" rel="stylesheet">
    <script src="../../js/jquery-1.10.2.js"></script>
    <!--    <script src="/js/jquery-ui-1.10.4.custom.min.js"></script>-->


    <script src="./../../js/jquery-handsontable/dist/jquery.handsontable.js"></script>
    <link rel="stylesheet" media="screen" href="./../../js/jquery-handsontable/dist/jquery.handsontable.full.css">
    <link rel="stylesheet" media="screen" href="./../../js/jquery-handsontable/demo/css/samples.css">


    <!-- Beginning of compulsory code below -->
    <link href="/sicap/css/dropdown/dropdown.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="/sicap/css/dropdown/themes/flickr.com/default.ultimate.css" media="screen" rel="stylesheet" type="text/css" />
    <!-- / END -->

    <style media="screen" type="text/css">

        #handsontable table td,
        #handsontable table th{
            font-size: 11px;
            text-align: center;
            padding-left: 3px;
            padding-right: 3px;


        }

        #id_leyenda{
            line-height: 5%;
            padding-left: 40px;
            border-style: solid;
            border-width: 2px;
            border-color: #ABABEE;
            padding-top: 7px;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            width: 75%;

        }

        #id_leyenda h2{
            margin-bottom: 20px;
            margin-left: -15px;

        }

        .leyenda span{
            font-weight: bold;
        }

        #last{
            margin-bottom: 37px;
        }


    </style>


    <script type="text/javascript">
        $(function() {


            //$('#handsontable').css('height',$('#handsontable').height()+200);

            // var ht = $('#handsontable').handsontable('getInstance');


//            $.ajax({ url : url, data : data, success : function () {
//                $container.handsontable('setDataAtCell', 0, 5 , 11 ,'program')
//            });


            // var ht = $('#handsontable').handsontable('getInstance');
            //ht.setDataAtCell(data);

            /* var data = [
             ["", "Kia", "Nissan", "Toyota", "Honda"],
             ["2008", 10, 11, 12, 13],
             ["2009", 20, 11, 14, 13],
             ["2010", 30, 15, 12, 13]
             ];

             $('#handsontable').handsontable("loadData", data);*/
            //  $('#handsontable').handsontable('setDataAtCell', 0, 5 , 'leonel' )



            //unload

            var anhio = $('#anhio').val();
            var mes = $('#mes').val();
            var parametros = { mes : mes,anhio : anhio };


            $.ajax({
                data:  parametros,
                url:   'ajax_orden_fecha_hora.php',
                type:  'post',
                beforeSend: function (x) {
//                        x.overrideMimeType("application/json;charset=UTF-8");
                    $("#resultado").html('<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +
                    '<img src="../../images/ajax-loader.gif" alt="Ajax Cargando" height="42" width="42">');
                },
                success:  function (response) {

                    $("#ordenesajax").html(response);


                    //ORDENES
                    $('#ordenes').bind('change',function(){
                        var optionSelected = $("option:selected", this);
                        var valueSelected = this.value;

                        var seleccionado = this.selectedIndex;


                        var mes = $('#mes').val();
                        var anhio = $('#anhio').val();

                        var parametros = { codigo : valueSelected, anhio : anhio, mes : mes };



                        $.ajax({
                            data:  parametros,
                            url:   'ajax_orden_cuadro_hora.php',
                            type:  'post',
                            beforeSend: function (x) {
                                x.overrideMimeType("application/json;charset=UTF-8");
                                $("#resultado").html('<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +
                                '<img src="../../images/ajax-loader.gif" alt="Ajax Cargando" height="42" width="42">');
                            },
                            success:  function (response) {



                                $("#contenedor-hand").html(response['html']);
                                $("#super").html(response['js']);


                                // $('#handsontable').handsontable("loadData", r);
                            }
                        });//ajax1



                        $.ajax({
                            data:  parametros,
                            url:   'ajax_head_orden.php',
                            type:  'post',
                            beforeSend: function () {
                                $("#resultado").html('<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +
                                '<img src="../../images/ajax-loader.gif" alt="Ajax Cargando" height="42" width="42">');
                            },
                            success:  function (response) {

                                $("#head_orden").html(response);

                            }
                        });//ajax2

                    });//ORDENES

                }
            });//ajax1




            $('#mes').bind('change',function(){

                var optionSelected = $("option:selected", this);
                var valueSelected = this.value;

                var anhio = $('#anhio').val();



                var parametros = { mes : valueSelected,anhio : anhio };



                $.ajax({
                    data:  parametros,
                    url:   'ajax_orden_fecha_hora.php',
                    type:  'post',
                    beforeSend: function (x) {
//                        x.overrideMimeType("application/json;charset=UTF-8");
                        $("#resultado").html('<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +
                        '<img src="../../images/ajax-loader.gif" alt="Ajax Cargando" height="42" width="42">');
                    },
                    success:  function (response) {
                        $("#ordenesajax").html(response);
                        $("#ordenesajax").html(response);


                        //ORDENES
                        $('#ordenes').bind('change',function(){
                            var optionSelected = $("option:selected", this);
                            var valueSelected = this.value;

                            var mes = $('#mes').val();
                            var anhio = $('#anhio').val();

                            var parametros = { codigo : valueSelected, anhio : anhio, mes : mes };



                            $.ajax({
                                data:  parametros,
                                url:   'ajax_orden_cuadro_hora.php',
                                type:  'post',
                                beforeSend: function (x) {
                                    x.overrideMimeType("application/json;charset=UTF-8");
                                    $("#resultado").html('<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +
                                    '<img src="../../images/ajax-loader.gif" alt="Ajax Cargando" height="42" width="42">');
                                },
                                success:  function (response) {



                                    $("#contenedor-hand").html(response['html']);
                                    $("#super").html(response['js']);


                                    // $('#handsontable').handsontable("loadData", r);
                                }
                            });//ajax1




                            $.ajax({
                                data:  parametros,
                                url:   'ajax_head_orden.php',
                                type:  'post',
                                beforeSend: function () {
                                    $("#resultado").html('<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +
                                    '<img src="../../images/ajax-loader.gif" alt="Ajax Cargando" height="42" width="42">');
                                },
                                success:  function (response) {

                                    $("#head_orden").html(response);

                                }
                            });//ajax2

                        });//ORDENES

                    }
                });//ajax1

            });




            $('#anhio').bind('change',function(){

                var optionSelected = $("option:selected", this);
                var valueSelected = this.value;

                var mes = $('#mes').val();



                var parametros = { anhio : valueSelected,mes : mes };

                //alert($('#a').attr('leonel'));

                $.ajax({
                    data:  parametros,
                    url:   'ajax_orden_fecha_hora.php',
                    type:  'post',
                    beforeSend: function (x) {
//                        x.overrideMimeType("application/json;charset=UTF-8");
                        $("#resultado").html('<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +
                        '<img src="../../images/ajax-loader.gif" alt="Ajax Cargando" height="42" width="42">');
                    },
                    success:  function (response) {
                        $("#ordenesajax").html(response);


                        //ORDENES
                        $('#ordenes').bind('change',function(){
                            var optionSelected = $("option:selected", this);
                            var valueSelected = this.value;

                            var seleccionado = this.selectedIndex;

                            var mes = $('#mes').val();
                            var anhio = $('#anhio').val();

                            var parametros = { codigo : valueSelected, anhio : anhio, mes : mes };



                            $.ajax({
                                data:  parametros,
                                url:   'ajax_orden_cuadro_hora.php',
                                type:  'post',
                                beforeSend: function (x) {
                                    x.overrideMimeType("application/json;charset=UTF-8");
                                    $("#resultado").html('<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +
                                    '<img src="../../images/ajax-loader.gif" alt="Ajax Cargando" height="42" width="42">');
                                },
                                success:  function (response) {



                                    $("#contenedor-hand").html(response['html']);
                                    $("#super").html(response['js']);


                                    // $('#handsontable').handsontable("loadData", r);
                                }
                            });//ajax1





                            $.ajax({
                                data:  parametros,
                                url:   'ajax_head_orden.php',
                                type:  'post',
                                beforeSend: function () {
                                    $("#resultado").html('<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +
                                    '<img src="../../images/ajax-loader.gif" alt="Ajax Cargando" height="42" width="42">');
                                },
                                success:  function (response) {

                                    $("#head_orden").html(response);

                                }
                            });//ajax2

                        });//ORDENES

                        }
                });//ajax1

               // var seleccionado = this.selectedIndex;

            });




    </script>

</head>
<body class="flickr-com">

<div style="font-weight: bold" t></div>


<form method="post" name="uso_consumo" id="form">
    <div id="body_bottom_bgd">
        <div id="">

            <div align="justify" id="right_col" >

                <div id="header">
                </div>
                <div id="">
                    <div id="firefoxbug"><!-- firefoxbug -->
                        <!-- <div id="blue_line"></div>-->
                        <div class="dynamicContent" align="left">

                            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Producción | Reporte Horas de trabajo</strong></h1>

                            <!-- Beginning of compulsory code below -->
                            <br/><br/>





                          <label>Año</label>

                                <select name='anhio' id="anhio" >

                                    <?php $anhio = date('Y');
                                    echo('<option value="'.($anhio -3).'">'.($anhio -3).'</option>');
                                    echo('<option value="'.($anhio -2).'">'.($anhio -2).'</option>');
                                    echo('<option value="'.($anhio -1).'">'.($anhio -1).'</option>');
                                    echo('<option value="'.($anhio).'"selected>'.($anhio).'</option>');
                                    echo('<option value="'.($anhio + 1).'">'.($anhio + 1).'</option>');
                                    ?>
                                </select>






                                <label>Mes</label>
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


                                <br/><br/>

                            <label style="font-size: 14px; font-weight: bold;">Numero de Orden &nbsp;&nbsp;&nbsp;</label>


                            <div id="ordenesajax">

<!--                                <select id="ordenes" style="font-size: 1.1em">-->
<!--                                    <option>--------------------</option>-->
<!---->
<!--                                    --><?php
//                                    include_once('../../db.php');
//
//                                    $result=mysql_query("SELECT * FROM prc_orden_trabajo WHERE eliminada = 'n' AND fecha_culminacion <> 'n'");
//                                    while($test = mysql_fetch_array($result)){
//                                        echo ("<option >".$test['codigo_alias']."</option>");
//                                    }
//
//                                    ?>
<!--                                </select>-->


                            </div>







                            <div id="head_orden" style="margin-bottom: 20px"></div>

                            <div id="super" >

                            </div>

                            <div id="contenedor-hand">

                            </div>


                            <div id="id_leyenda">
                                <h2> Leyenda: </h2>
                                <p class="leyenda"> <span>He P/U: </span> Horas Estandar </p>
                                <p class="leyenda"> <span>Ps P/H: </span> Precio Estándar por Hora </p>
                                <p class="leyenda"> <span>Cs P/U: </span> Costo Estándar  por Unidad </p>
                                <p class="leyenda"> <span>Ht: </span> Total Horas Trabajadas </p>
                                <p class="leyenda"> <span>C/U h: </span> Costo Unitario por Hora </p>
                                <p class="leyenda"> <span>CTP: </span> Costo Total Producción </p>
                                <p class="leyenda"> <span>Hr P/U: </span> Horas Reales por Unidad </p>
                                <p class="leyenda"> <span>Cr P/U: </span> Costo Real por Unidad </p>
                                <p class="leyenda"> <span>Var H : </span>Variación Horas</p>
                                <p class="leyenda"> <span>Var C : </span>Variación Costo</p>
                                <p class="leyenda" id="last"> <span>Var T: </span>Variación Total</p>
                            </div>
                            <br/><br/>
                            <table>
                                <tr>
<!--                                    <td>-->
<!--                                        <input id="enviar" type="submit" value="Guardar datos" name="submit">-->
<!--                                    </td>-->
<!--                                    <td>-->
<!--                                        <a href="uso_consumo_ver.php"><input type="button" value="Ver datos"></a>-->
<!--                                    </td>-->
                                    <td>
                                        <a href="../../prc_menu.php"><input type="button" value="Atras"></a>
                                    </td>
                                </tr>
                            </table>
                            <!-- / END -->


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