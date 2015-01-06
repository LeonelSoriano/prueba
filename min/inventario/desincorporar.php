<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 11/11/14
 * Time: 03:39 PM
 */

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

        $articulo= json_decode($tmp_json)->{'Articulo'};
        $precio = json_decode($tmp_json)->{'Precio'};
        $cantidad = json_decode($tmp_json)->{'Cantidad'};
        $precio_total = json_decode($tmp_json)->{'Precio Total'};
        $codigo_producto_hi = json_decode($tmp_json)->{'codigo_producto_hi'};

        $existencia = json_decode($tmp_json)->{'existencia'};
        $cantidad_final = json_decode($tmp_json)->{'cantidad_final'};
        $observacion = json_decode($tmp_json)->{'observacion'};
        $retiro = json_decode($tmp_json)->{'retiro'};


        $fake_POST['codigo_producto_hi'] = $codigo_producto_hi;
        $fake_POST['cantidad'] = $cantidad;
        $fake_POST['precio'] = $precio;


        $validation = array(


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


        $suma = $existencia - $retiro;


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

        $articulo= json_decode($tmp_json)->{'Articulo'};
        $precio = json_decode($tmp_json)->{'Precio'};
        $cantidad = json_decode($tmp_json)->{'Cantidad'};
        $precio_total = json_decode($tmp_json)->{'Precio Total'};
        $codigo_producto_hi = json_decode($tmp_json)->{'codigo_producto_hi'};

        $existencia = json_decode($tmp_json)->{'existencia'};
        $cantidad_final = json_decode($tmp_json)->{'cantidad_final'};
        $observacion = json_decode($tmp_json)->{'observacion'};
        $retiro = json_decode($tmp_json)->{'retiro'};


        $fake_POST['codigo_producto_hi'] = $codigo_producto_hi;
        $fake_POST['cantidad'] = $cantidad;
        $fake_POST['precio'] = $precio;



        $sql = "SELECT * FROM min_valoracion WHERE min_valoracion.codigo_producto = '$codigo_producto_hi'";

        $result = mysql_query($sql);

        $test = mysql_fetch_array($result);



        $real_unidades = $test['unidades'];
        $real_precio = $test['promedio_actual'];
        $real_costo_total = $test['costo_total'];


        $fecha_actual = fecha_sicap();

        $sql = "INSERT INTO min_desincorporacion(codigo_producto,cantidad,costo,valor_unitario,fecha,comentario,retiro)
        values ('$codigo_producto_hi','$cantidad','".($cantidad*$real_precio)."','$real_costo_total','$fecha_actual',
        '$observacion','$retiro')";

        $result = mysql_query($sql) or die('No se pudo guardar la información. desincorporar'.mysql_error());


        $update_unidades = $real_unidades  - $cantidad;

        $update_costo = $real_costo_total - ($cantidad*$real_precio) ;


        $sql =  "UPDATE min_valoracion SET
            unidades='$update_unidades', costo_total='$update_costo'
            WHERE codigo_producto='$codigo_producto_hi'";

        $result = mysql_query($sql) or die('No se pudo guardar la información. min_valloracion'.mysql_error());

        $sql = "INSERT INTO min_valoracion_historico(codigo_producto,unidades,costo_total,promedio_actual,fecha)
        values ('$codigo_producto_hi','$update_unidades','$update_costo','$real_precio','$fecha_actual')";


        $result = mysql_query($sql) or die('No se pudo guardar la información. min_valoracion_historico'.mysql_error());



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



<script type="text/javascript">

    $(function() {



        var head_exsit = false;



        //observacion/retiro
        $("#agregar").click(function() {

            if(!head_exsit){
                $('#tabla_articulos ').after('<br/><br/>' +
                '<table border=none class="tablas-nuevas" id="tabla">' +
                '  <tr  style="text-align: center">' +
                '<th>Articulo</th>' +
                '<th>Precio</th>' +
                '<th>Cantidad</th>' +
                '<th>Precio Total</th> <th>Eliminar</th>' +


                '<th style="display: none">codigo_producto_hi</th>' +
                '<th style="display: none">existencia</th>' +
                '<th style="display: none">cantidad_final</th>' +
                '<th style="display: none">observacion</th>' +
                '<th style="display: none">retiro</th>' +
                '</tr>' +
                '</table>');
                head_exsit = true;
            }


            if($("#codigo_producto_hi").val() != '' ){
                var nombre_articulo = $("#producto").val();
                var cantidad_despacho = $("#cantidad_despacho").val();
                var existencia_articulo = $("#existencia_articulo").val();
                var cantidad_final = $("#cantidad_final").val();
                var observacion = $("#observacion").val();
                var retiro = $("#retiro").val();



                var precio = $("#precio_hi").val();
                var codigo_producto_hi = $("#codigo_producto_hi").val();

                $('#tabla tr:last').after("<tr>" +
                "<td  style='text-align: left'> <label style='font-size: 14px;'> " +nombre_articulo + " </label> </td> " +
                "<td  style='text-align: left'> <label style='font-size: 14px'>"+((Math.round(precio*100)/100).toString()).replace('.',',')+"</label> </td> " +
                "<td  style='text-align: left'> <label style='font-size: 14px'>"+ ((Math.round(cantidad_despacho*100)/100).toString()).replace('.',',')+"</label> </td> " +
                "<td  style='text-align: left'> <label style='font-size: 14px'>"+ ((Math.round((cantidad_despacho*precio)*100)/100).toString()).replace('.',',')+"</label> </td> " +
                "<td> <ul  id='icons' class='ui-widget ui-helper-clearfix'> <li class='ui-state-default ui-corner-all' title='.ui-icon-check'><span class='ui-icon ui-icon-check'></span></li> </ul></td>" +
                "<td style='display: none'> <label >"+ codigo_producto_hi +"</label> </td> " +
                "<td style='display: none'> <label >"+ existencia_articulo +"</label> </td> " +
                "<td style='display: none'> <label >"+ cantidad_final +"</label> </td> " +
                "<td style='display: none'> <label >"+ observacion +"</label> </td> " +
                "<td style='display: none'> <label >"+ retiro +"</label> </td> " +


                "</tr>");


                $('#nombre_articulo').val('');
                $("#codigo_articulo").val('');
                $("#producto").val('');
                $("#cantidad_despacho").val('');
                $("#cantidad_final").val('');
                $("#existencia_articulo").val('');
                $("#precio_hi").val('');
                $("#observacion").val('');


                $('.ui-widget').click(function() {
                    $(this).parent().parent().remove(); //Deleting TD element
                });

            }

        });




        var sumComa = new SumComa();



        $( "#buscar_empleado_ver" ).click(function() {
            var win = window.open("empleados_ver.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90 ");
            win.focus();
        });


        $( "#buscar_producto" ).click(function() {

            var win = window.open("producto_ver.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90");
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

alert("hola");
            var columns = $('#tabla tr th').map(function() {  return $(this).text();
            });

            var tableObject = $('#tabla  tr').map(function(i) {    var row = {};  $(this).find('td').each(function(i) {      var rowName = columns[i];    row[rowName] = $(this).text();
            });return row;   }).get();


            var json_tabla= JSON.stringify(tableObject);



            $("#post_array").val(json_tabla);
            $("#post_array").serializeArray();


            return false; // return false to cancel form action
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
                            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Inventaríos | Retiro</strong></h1>

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
                                    <TD width="173"><label>Persona que lo Desincorpora </label></TD>
                                    <TD width="94">
                                        <input type="text" name="empleado_ver" id="empleado_ver" size="20"  disabled></TD>
                                    <TD>
                                        <!--<input type="submit" value="Buscar" name="submit">-->
                                        <input type="button" name="buscar_empleado_ver" id="buscar_empleado_ver" value="Buscar" >
                                    </TD>
                                </TR>




                                <TR>
                                    <TD width="173"><label>Producto</label></TD>
                                    <TD width="94">
                                        <input type="text" name="producto" id="producto" size="20"  disabled></TD>
                                    <TD>
                                        <!--<input type="submit" value="Buscar" name="submit">-->
                                        <input type="button" name="buscar_producto" id="buscar_producto" value="Buscar" >
                                    </TD>
                                </TR>

                                <TR>
                                    <TD><label>Existencia de Artículo</label></TD>
                                    <TD><p><input type="text" name="existencia_articulo" id="existencia_articulo"  size="20" disabled></p></TD>
                                </TR>


                                <TR>
                                    <TD><label>Cantidad de Retiro</label></TD>
                                    <TD><p><input type="text" name="cantidad_despacho" id="cantidad_despacho"></p></TD>
                                </TR>

                                <TR>
                                    <TD><label>Cantidad Final</label></TD>
                                    <TD><p><input type="text" name="cantidad_final" id="cantidad_final" disabled></p></TD>
                                </TR>


                                <tr>
                                    <td><label >Tipo de Retiro</label></td>
                                    <td>
                                        <select name="retiro" id="retiro">
                                            <option value="obsolesencia">Obsolesencia</option>
                                            <option value="deterioro">Deterioro</option>
                                            <option value="dañado">Dañado</option>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td><label for="observacion">Observación</label></td>
                                    <td><textarea name="observacion" id="observacion" cols="24" rows="6"></textarea></td>
                                </tr>


                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <input type="button" value="Agregar" id="agregar"/>
                                    </td>
                                </tr>



                                <input type="hidden" id="codigo_empleado_hi" name="codigo_empleado_hi" value=""/>
                                <input type="hidden" id="codigo_producto_hi" name="codigo_producto_hi" value=""/>
                                <input type="hidden" id="precio_hi" name="precio_hi" value=""/>
                                <input type="hidden" name="value_buscar_articulo_hi" id="value_buscar_articulo_hi" value=""/>

                                <input type="hidden" value="" id="post_array" name="post_array"/>

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