<?php
//echo(date("Y-n-j")  );
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors', 'On');
ini_set('display_errors', 1);
require_once('../../db.php');
require_once('../../clases/Validate.php');
require_once('../../clases/funciones.php');


//foreach($_POST as $key => $value)
//    echo $key."=".$value .'<br/><br/>';

if (isset($_POST['submit'])) {


    $str = json_decode($_POST['post_array'], true);
    $cantidad1 = count($str);

    $fake_POST = array();

    for ($i = 1; $i < $cantidad1; $i++) {

        $tmp_json = json_encode($str[$i], JSON_UNESCAPED_UNICODE);
        //$codigo_articulo = json_decode($tmp_json)->{'codigo_articulo'};
        $codigo_articulo = json_decode($tmp_json)->{'codigo_articulo'};
        $cantidad = json_decode($tmp_json)->{'Cantidad'};
        $precio = json_decode($tmp_json)->{'Precio'};
        $codigo_buscar_etapa_hi = json_decode($tmp_json)->{'codigo_buscar_etapa_hi'};
        $codigo_producto_hi = json_decode($tmp_json)->{'codigo_producto_hi'};

        $cantidad_despacho = json_decode($tmp_json)->{'Cantidad'};


        $fake_POST['codigo_articulo'] = $codigo_articulo;
        $fake_POST['cantidad'] = $cantidad;
        $fake_POST['precio'] = $precio;
        $fake_POST['codigo_buscar_etapa_hi'] = $codigo_buscar_etapa_hi;
        $fake_POST['codigo_producto_hi'] = $codigo_producto_hi;
        $existencia_articulo = json_decode($tmp_json)->{'existencia'};

        $validation = array(


            array('nombre' => 'codigo_articulo',
                'requerida' => true,
                'regla' => 'number'),


            array('nombre' => 'codigo_buscar_etapa_hi',
                'requerida' => true,
                'regla' => 'number'),


            array('nombre' => 'codigo_producto_hi',
                'requerida' => true,
                'regla' => 'number'),


            array('nombre' => 'cantidad',
                'requerida' => true,
                'regla' => 'float',
                'tipo' => ','),

            array('nombre' => 'precio',
                'requerida' => true,
                'regla' => 'float',
                'tipo' => ','),

        );

        $validated = new Validate($validation, $fake_POST);
        $validated->validate();

        if ($validated->getIsError()) {
            send_error_redirect(true, "Hay Errores en la Información del formulario");
            die;

        }


        $suma = $existencia_articulo - $cantidad_despacho;


        if ($suma < 0) {

//        echo('<div id="error_app"><marquee scrolldelay="120">Esta operación no es realizable gracias a flata de inventario</marquee></div>');


//             // mensaje
            $mensaje = "

                              <h1 >Reporte</h1>
                              <table>
                                <tr>
                                  <th>Encargado de Almacen </th><th>Departamento Solicitante </th><th>Persona que Recibe  </th><th>Articulo </th><th>Existencia de Articulo </th><th>Cantidad Despacho </th>
                                </tr>
                                <tr>
                                  <td style='text-align: center'>$codigo_encargado_almacen</td><td style='text-align: center'>$codigo_solicitante</td><td style='text-align: center'>$codigo_persona_recibe</td><td style='text-align: center'>$codigo_articulo</td><td style='text-align: center'>$existencia_articulo</td><td style='text-align: center'>$cantidad_despacho</td>
                                </tr>
                              </table>

                            ";


            include("../../PHPMailer-master/class.phpmailer.php");
            include("../../PHPMailer-master/class.smtp.php");

            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->SMTPDebug = 0;//2 para pruebas
            $mail->Host = 'smtp.gmail.com';

            $mail->Port = 587;

            $mail->SMTPSecure = 'tls';
            $mail->SMTPAuth = true;
            $mail->Username = "sicapservices@gmail.com";
            $mail->Password = "master123*";

            $mail->SetFrom('sicapservices@gmail.com', 'Sistema de reportes');

            $mail->AddReplyTo('sicapservices@gmail.com', 'El de la réplica');

            $mail->AddAddress('sicapservices@gmail.com', 'El Destinatario');


            $mail->Body = $mensaje;
            $mail->isHTML(true);
            $mail->Subject = 'Sistema de reporte ';

            $mail->AltBody = 'This is a plain-text message body';

            //Enviamos el correo
            if (!$mail->Send()) {
                echo "Error: " . $mail->ErrorInfo;
            } else {
                // echo "Enviado!";
            }

            send_error_redirect(true, "No puedes Facturar Menos de lo que Hay en Inventarios");
            die;
        }

    }

    for ($i = 1; $i < $cantidad1; $i++) {

        $tmp_json = json_encode($str[$i], JSON_UNESCAPED_UNICODE);
        //$codigo_articulo = json_decode($tmp_json)->{'codigo_articulo'};


        $cantidad_despacho = json_decode($tmp_json)->{'Cantidad'};
        $codigo_solicitante = $_POST['codigo_solicitante'];
        $codigo_encargado_almacen = $_POST['codigo_encargado_almacen'];
        $codigo_persona_recibe = $_POST['codigo_persona_recibe'];
        $codigo_articulo = json_decode($tmp_json)->{'codigo_articulo'};

        $existencia_articulo = json_decode($tmp_json)->{'existencia'};
        $cantidad_final = json_decode($tmp_json)->{'cantidad_final'};
        $codigo_etapa = json_decode($tmp_json)->{'codigo_buscar_etapa_hi'};
        $promedio_actual = json_decode($tmp_json)->{'Precio'};



        /*movi esta lvaloracion aca para poder meterla en la de uso consumo*/
        $sql = "SELECT * FROM min_valoracion_produccion WHERE codigo_producto='$codigo_articulo'";


        $result = mysql_query($sql);

        $test = mysql_fetch_array($result);

        if (!$result) {
            die("Error: Data not found.. min_valoracion");
        }

        $valoracion_unidades = $test['unidades'];
        $valoracion_costo_total = $test['costo_total'];
        $promedio_actual = $test['promedio_actual'];


        $fecha_actual = fecha_sicap();

        $sql = "INSERT INTO min_uso_consumo (codigo_encargado_almacen,codigo_orden_produccion,
                                  codigo_persona_recibe,cod_articulo,existencia_antes,cantidad_despacho,
                                  existencia_final,fecha_uso,codigo_etapa,costo_articulo,costo_real)
                            VALUES ('$codigo_encargado_almacen','$codigo_solicitante','$codigo_persona_recibe',
                              '$codigo_articulo','$existencia_articulo','$cantidad_despacho','$cantidad_final',
                                '$fecha_actual','$codigo_etapa','$promedio_actual',".($promedio_actual*$cantidad_despacho).")";

        mysql_query($sql) or die('No se pudo guardar la información. ' . mysql_error());

        //$sql = "UPDATE min_productos_servicios SET existencia='$cantidad_final' WHERE codigo ='$codigo_articulo'";

        //mysql_query($sql) or die('No se pudo guardar la información. ' . mysql_error());


        /*actualizo la valoracion*/
        /*
                                $sql = "SELECT * FROM min_valoracion WHERE  codigo_producto='$codigo_articulo'";


                                $result = mysql_query($sql);

                                $test = mysql_fetch_array($result);

                                if (!$result)
                                {
                                    die("Error: Data not found.. de unudades");
                                }


                                $valoracion_unidades = $test['unidades'];
                                $valoracion_costo_total = $test['costo_total'];

                                $valoracion_costo_promedio =  $valoracion_costo_total / $valoracion_unidades;


                                $nueva_valoracion_unidades = $valoracion_unidades - $cantidad_despacho;

                                $nueva_valoracion_costo_total = $valoracion_costo_total - $valoracion_costo_promedio;



                                $sql = "UPDATE min_valoracion SET unidades='$nueva_valoracion_unidades',costo_total='$nueva_valoracion_costo_total'  WHERE codigo_producto='$codigo_articulo'";


                                mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());*/
        /* valoracion */




        $nueva_valoracion_unidades = 0;
        $sub_total_costo_total = 0;
        $nueva_valoracion_costo_total = 0;



        if(($valoracion_unidades - $cantidad_despacho) > 0){
            $nueva_valoracion_unidades = $valoracion_unidades - $cantidad_despacho;
            $sub_total_costo_total = $cantidad_despacho * $promedio_actual;
            $nueva_valoracion_costo_total = $valoracion_costo_total - $sub_total_costo_total;

        }


        $sql = "UPDATE min_valoracion_produccion SET unidades='$nueva_valoracion_unidades',costo_total='$nueva_valoracion_costo_total'
           WHERE codigo_producto='$codigo_articulo'";


        mysql_query($sql) or die('No se pudo guardar la información. ' . mysql_error());


        require_once('../../clases/funciones.php');
        $fecha = fecha_sicap();
        $sql = "INSERT INTO min_valoracion_produccion_historico
( codigo_producto, unidades, costo_total, promedio_actual,fecha )
VALUES('$codigo_articulo', '$nueva_valoracion_unidades', '$nueva_valoracion_costo_total', '$promedio_actual', '$fecha');
";
        $result = mysql_query($sql) or die('No se pudo guardar la información. valoraciones_historico '.mysql_error());




    }//for
    send_error_redirect(false, "Datos Guardados Correctamente");
    die;


}

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
<title>SICAP | Sistema Integral de Costos</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="author" content="Tomas Bagdanavicius, http://www.lwis.net/free-css-drop-down-menu/" />
<meta name="keywords" content=" css, dropdowns, dropdown menu, drop-down, menu, navigation, nav, horizontal, vertical left-to-right, vertical right-to-left, horizontal linear, horizontal upwards, cross browser, internet explorer, ie, firefox, safari, opera, browser, lwis" />
<meta name="description" content="Clean, standards-friendly, modular framework for dropdown menus" />
<link href="../../css/helper.css" media="screen" rel="stylesheet" type="text/css" />
<script src="../../js/htmlDatePicker.js" type="text/javascript"></script>
<link href="../../css/htmlDatePicker.css" rel="stylesheet">
<link href="../../css/stylesheet.css" rel="stylesheet" type="text/css" />
<link href="../../css/ui-lightness/jquery-ui-1.10.4.custom.css" rel="stylesheet">
<script src="../../js/jquery-1.10.2.js"></script>
<script src="../../js/jquery-ui-1.10.4.custom.js"></script>
<link href="../../js/jquery-ui-1.11.0.custom/jquery-ui.css" rel="stylesheet">
<script src="../../js/jquery-ui-1.11.0.custom/jquery-ui.js"></script>
<script src="../../js/clasesVarias.js"></script>
<script>
    $(function() {
        $( "#datepicker1" ).datepicker({ dateFormat: 'yy-mm-dd' });

        var myDate = new Date();
        var mes = 0
        if(myDate.getMonth()<10){
            mes = myDate.getMonth() + 1;
            mes = '0' + mes;
        }else{
            mes = myDate.getMonth() + 1;
        }
        var prettyDate =(myDate.getFullYear()  + '-' +mes) + '-' + myDate.getDate() ;
        $("#datepicker1").val(prettyDate);

    });
</script>
<!-- Beginning of compulsory code below -->
<link href="/sicap/css/dropdown/dropdown.css" media="screen" rel="stylesheet" type="text/css" />
<link href="/sicap/css/dropdown/themes/flickr.com/default.ultimate.css" media="screen" rel="stylesheet" type="text/css" />
<!-- / END -->
<style>

    .demoHeaders {
        margin-top: 2em;
    }
    #dialog-link {
        padding: .4em 1em .4em 20px;
        text-decoration: none;
        position: relative;
    }
    #dialog-link span.ui-icon {
        margin: 0 5px 0 0;
        position: absolute;
        left: .2em;
        top: 50%;
        margin-top: -8px;
    }
    #icons {
        margin: 0;
        padding: 0;
    }
    #icons li {
        margin: 2px;
        position: relative;
        padding: 4px 0;
        cursor: pointer;
        float: left;
        list-style: none;
    }
    #icons span.ui-icon {
        float: left;
        margin: 0 4px;
    }
    .fakewindowcontain .ui-widget-overlay {
        position: absolute;
    }


</style>


<script type="text/javascript">

    $(function() {



        var head_exsit = false;




        $("#agregar").click(function() {

            if(!head_exsit){
                $('#tabla_articulos ').after('<br/><br/>' +
                '<table border=none class="tablas-nuevas" id="tabla">' +
                '  <tr  style="text-align: center">' +
                '<th>Articulo</th>' +
                '<th>Precio</th>' +
                '<th>Cantidad</th>' +
                '<th>Precio Total</th> <th>Eliminar</th>' +


                '<th style="display: none">codigo_articulo</th>' +
                '<th style="display: none">codigo_buscar_etapa_hi</th>' +
                '<th style="display: none">codigo_producto_hi</th>' +
                '<th style="display: none">existencia</th>' +
                '<th style="display: none">cantidad_final</th>' +
                '</tr>' +
                '</table>');
                head_exsit = true;
            }


            if($("#codigo_articulo").val() != '' ){
                var codigo_articulo = $("#codigo_articulo").val();
                var nombre_articulo = $("#articulo").val();
                var cantidad_despacho = $("#cantidad_despacho").val();
                var existencia_articulo = $("#existencia_articulo").val();
                var cantidad_final = $("#cantidad_final").val();

                var codigo_buscar_etapa_hi = $("#codigo_buscar_etapa_hi").val();
                var precio = $("#precio_hi").val();
                var codigo_producto_hi = $("#codigo_producto_hi").val();

                $('#tabla tr:last').after("<tr>" +
                "<td  style='text-align: left'> <label style='font-size: 14px;'> " +nombre_articulo + " </label> </td> " +
                "<td  style='text-align: left'> <label style='font-size: 14px'>"+((Math.round(precio*100)/100).toString()).replace('.',',')+"</label> </td> " +
                "<td  style='text-align: left'> <label style='font-size: 14px'>"+ ((Math.round(cantidad_despacho*100)/100).toString()).replace('.',',')+"</label> </td> " +
                "<td  style='text-align: left'> <label style='font-size: 14px'>"+ ((Math.round((cantidad_despacho*precio)*100)/100).toString()).replace('.',',')+"</label> </td> " +
                "<td> <ul  id='icons' class='ui-widget ui-helper-clearfix'> <li class='ui-state-default ui-corner-all' title='.ui-icon-check'><span class='ui-icon ui-icon-check'></span></li> </ul></td>" +
                "<td style='display: none'> <label >"+ codigo_articulo +"</label> </td> " +
                "<td style='display: none'> <label >"+ codigo_buscar_etapa_hi +"</label> </td> " +
                "<td style='display: none'> <label >"+ codigo_producto_hi +"</label> </td> " +
                "<td style='display: none'> <label >"+ existencia_articulo +"</label> </td> " +
                "<td style='display: none'> <label >"+ cantidad_final +"</label> </td> " +


                "</tr>");


                $('#nombre_articulo').val('');
                $("#codigo_articulo").val('');
                $("#articulo").val('');
                $("#cantidad_despacho").val('');
                $("#cantidad_final").val('');
                $("#existencia_articulo").val('');
                $("#precio_hi").val('');


                $('.ui-widget').click(function() {
                    $(this).parent().parent().remove(); //Deleting TD element
                });

            }

        });




        var sumComa = new SumComa();

        $( "#buscar_solicitante" ).click(function() {
            var win = window.open("orden_produccion.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90 ");
            win.focus();
        });


        $( "#buscar_encargado_almacen" ).click(function() {
            var win = window.open("empleados_ver.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90 ");
            win.focus();
        });



        $( "#buscar_persona_recibe" ).click(function() {
            var win = window.open("recibe_ver.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90 ");
            win.focus();
        });


        $( "#buscar_articulo" ).click(function() {

            var id = $("#codigo_producto_hi").val();
            var id_etapa = $("#codigo_buscar_etapa_hi").val();
            var win = window.open("articulo_ver.php?id="+id+"&etapa="+id_etapa, "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90");
            win.focus();
        });

        $( "#buscar_etapa" ).click(function() {

            var id = $("#codigo_producto_hi").val();
            var win = window.open("etapa_produccion.php?id="+id, "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90");
            win.focus();
        });


        $( "#cantidad_despacho" ).bind('keyup keydown mouseup change focus',function(e){
            //existencia_articulo cantidad_despacho cantidad_final
            //sumComa.add();

            sumComa.add($( "#existencia_articulo" ).val());
            sumComa.add( "-"+ $( "#cantidad_despacho" ).val());
            $( "#cantidad_final" ).val(sumComa.getSum());


        });



        $('#form').submit(function() {
            //$( "#existencia_articulo_hi" ).val(  $( "#existencia_articulo" ).val());
            //$( "#cantidad_final_hi" ).val(  $( "#cantidad_final" ).val());


            var columns = $('#tabla tr th').map(function() {  return $(this).text();
            });

            var tableObject = $('#tabla  tr').map(function(i) {    var row = {};  $(this).find('td').each(function(i) {      var rowName = columns[i];    row[rowName] = $(this).text();
            });return row;   }).get();


            var json_tabla= JSON.stringify(tableObject);



            $("#post_array").val(json_tabla);
            $("#post_array").serializeArray();


            return true; // return false to cancel form action
        });



    });
</script>

</head>
<body class="flickr-com">



<!--<p><a href="mrh_menu.html" class="main-site">Principal</a></p>-->
<!--<h1><img src="images/seleccion_sicap_archivos/image002.jpg" alt="flickr" />Módulo de Recursos Humanos | Cargo</h1>-->
<!-- Beginning of compulsory code below -->

<form method="post" name="uso_consumo" id="form">
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
                            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Producción | Uso-Consumo</strong></h1>

                            <!-- Beginning of compulsory code below -->
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
                            <TABLE BORDER="0" CELLSPACING="4" WIDTH="500" id="tabla_articulos">


                                <TR>
                                    <TD width="173"><label>Encargado de Almacén</label></TD>
                                    <TD width="94">
                                        <input type="text" name="encargado_almacen" id="encargado_almacen" size="20"  disabled></TD>
                                    <TD>
                                        <!--<input type="submit" value="Buscar" name="submit">-->
                                        <input type="button" name="buscar_encargado_almacen" id="buscar_encargado_almacen" value="Buscar" >
                                    </TD>
                                </TR>


                                <TR>
                                    <TD width="173"><label>Orden de Producción</label></TD>
                                    <TD width="94">
                                        <input type="text" name="orden_produccion" id="orden_produccion" size="20"  disabled></TD>
                                    <TD>
                                        <!--<input type="submit" value="Buscar" name="submit">-->
                                        <input type="button" name="buscar_solicitante" id="buscar_solicitante" value="Buscar" >
                                    </TD>
                                </TR>

                                <TR>
                                    <TD width="173"><label>Etapa</label></TD>
                                    <TD width="94">
                                        <input type="text" name="etapa_produccion" id="etapa_produccion" size="20"  disabled></TD>
                                    <TD>
                                        <!--<input type="submit" value="Buscar" name="submit">-->
                                        <input type="button" name="buscar_etapa" id="buscar_etapa" value="Buscar" disabled>
                                    </TD>
                                </TR>


                                <TR>
                                    <TD width="173"><label>Persona que Recibe </label></TD>
                                    <TD width="94">
                                        <input type="text" name="persona_recibe" id="persona_recibe" size="20"  disabled></TD>
                                    <TD>
                                        <!--<input type="submit" value="Buscar" name="submit">-->
                                        <input type="button" name="buscar_persona_recibe" id="buscar_persona_recibe" value="Buscar" >
                                    </TD>
                                </TR>


                                <TR>
                                    <TD width="173"><label>Artículo</label></TD>
                                    <TD width="94">
                                        <input type="text" name="articulo" id="articulo" size="20"  disabled></TD>
                                    <TD>
                                        <!--<input type="submit" value="Buscar" name="submit">-->
                                        <input type="button" name="buscar_articulo" id="buscar_articulo" value="Buscar" disabled>
                                    </TD>
                                </TR>


                                <TR>
                                    <TD><label>Existencia de Artículo</label></TD>
                                    <TD><p><input type="text" name="existencia_articulo" id="existencia_articulo"  size="20" disabled></p></TD>
                                </TR>
                                <TR>
                                    <TD><label>Cantidad Despacho</label></TD>
                                    <TD><p><input type="text" name="cantidad_despacho" id="cantidad_despacho"></p></TD>
                                </TR>

                                <TR>
                                    <TD><label>Cantidad Final</label></TD>
                                    <TD><p><input type="text" name="cantidad_final" id="cantidad_final" disabled></p></TD>
                                </TR>


                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <input type="button" value="Agregar" id="agregar"/>
                                    </td>
                                </tr>


                                <input type="hidden" name="codigo_solicitante" id="codigo_solicitante" value=""/>
                                <input type="hidden" name="codigo_encargado_almacen" id="codigo_encargado_almacen" value=""/>
                                <input type="hidden" name="codigo_persona_recibe" id="codigo_persona_recibe" value=""/>
                                <input type="hidden" name="codigo_articulo" id="codigo_articulo" value=""/>
                                <input type="hidden" name="existencia_articulo_hi" id="existencia_articulo_hi" value=""/>
                                <input type="hidden" name="cantidad_final_hi" id="cantidad_final_hi" value=""/>
                                <input type="hidden" name="value_buscar_articulo_hi" id="value_buscar_articulo_hi" value=""/>
                                <input type="hidden" name="codigo_buscar_etapa_hi" id="codigo_buscar_etapa_hi" value=""/>
                                <input type="hidden" name="codigo_producto_hi" id="codigo_producto_hi" value=""/>
                                <input type="hidden" name="codigo_detalle_hi" id="codigo_detalle_hi" value=""/>
                                <input type="hidden" value="" id="post_array" name="post_array"/>
                                <input type="hidden" value="" id="precio_hi" name="precio_hi"/>

                            </TABLE>


                            <br/><br/>

                            <table>
                                <tr>
                                    <td>
                                        <input id="enviar" type="submit" value="Guardar datos" name="submit">
                                    </td>
                                    <td>
                                        <a href="../uso_consumo/uso_consumo_ver.php"><input type="button" value="Ver datos"></a>
                                    </td>
                                    <td>
                                        <a href="../../prc_menu.php"><input type="button" value="Atras"></a>
                                    </td>
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