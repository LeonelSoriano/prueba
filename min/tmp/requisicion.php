
<?php
//echo(date("Y-n-j")  );
header('Content-Type: text/html; charset=UTF-8');
require_once ('../../db.php');


//foreach($_POST as $key => $value)
//    echo $key."=".$value .'<br/><br/>';


//print_r($_POST);

if (isset($_POST['submit'])){
    //var_dump($_POST);die;
    $cantidad_despacho = $_POST['cantidad_despacho'];
    //$codigo_solicitante = $_POST['codigo_solicitante'];
    $codigo_encargado_almacen = $_POST['codigo_encargado_almacen'];
    $codigo_persona_recibe = $_POST['codigo_persona_recibe'];
    $codigo_articulo = $_POST['codigo_articulo'];
    $existencia_articulo = $_POST['existencia_articulo_hi'];
    $cantidad_final = $_POST['cantidad_final_hi'];
    $fecha_requisicion = $_POST['fecha_requisicion'];
    $precio = $_POST['precio'];

    $requicicion_especial = 'no';



//    if(is_numeric($existencia_articulo) and is_numeric($cantidad_despacho)){
//
//        $suma = $existencia_articulo - $cantidad_despacho;
//
//        if($suma < 0){
//
//            echo('<div id="error_app"><marquee scrolldelay="120">Esta operación no es realizable gracias a flata de inventario</marquee></div>');
//
//
//            // mensaje
//            $mensaje = "
//
//                              <h1 >Reporte</h1>
//                              <table>
//                                <tr>
//                                  <th>Encargado de Almacen </th><th>Departamento Solicitante </th><th>Persona que Recibe  </th><th>Articulo </th><th>Existencia de Articulo </th><th>Cantidad Despacho </th>
//                                </tr>
//                                <tr>
//                                  <td style='text-align: center'>$codigo_encargado_almacen</td><td style='text-align: center'>$codigo_solicitante</td><td style='text-align: center'>$codigo_persona_recibe</td><td style='text-align: center'>$codigo_articulo</td><td style='text-align: center'>$existencia_articulo</td><td style='text-align: center'>$cantidad_despacho</td>
//                                </tr>
//                              </table>
//
//                            ";
//
//
//
//            include("../../PHPMailer-master/class.phpmailer.php");
//            include("../../PHPMailer-master/class.smtp.php");
//
//            $mail = new PHPMailer();
//            $mail->isSMTP();
//            $mail->SMTPDebug  = 0;//2 para pruebas
//            $mail->Host  = 'smtp.gmail.com';
//
//            $mail->Port       = 587;
//
//            $mail->SMTPSecure = 'tls';
//            $mail->SMTPAuth   = true;
//            $mail->Username   = "leonelsoriano3@gmail.com";
//            $mail->Password   = "19elmarxista1";
//
//            $mail->SetFrom('sicapservices@gmail.com', 'Sistema de reportes');
//
//            $mail->AddReplyTo('sicapservices@gmail.com','El de la réplica');
//
//            $mail->AddAddress('sicapservices@gmail.com', 'El Destinatario');
//
//
//            $mail->Body = $mensaje;
//            $mail->isHTML(true);
//            $mail->Subject = 'Sistema de reporte ';
//
//            $mail->AltBody = 'This is a plain-text message body';
//
//            //Enviamos el correo
//            if(!$mail->Send()) {
//                echo "Error: " . $mail->ErrorInfo;
//            } else {
//                // echo "Enviado!";
//            }
//
//
//
//        }else{

    $str = json_decode($_POST['post_array'], true);
    $cantidad1 =  count($str);


    $fecha_requisicion = $_POST['fecha_requisicion'];
    $codigo_encargado_almacen = $_POST['codigo_encargado_almacen'];
    $codigo_persona_recibe = $_POST['codigo_persona_recibe'];
    $codigo_requisicion = $_POST['codigo_requisicion'];
    $beneficiario_hi = $_POST['beneficiario_hi'];



    for($i=1; $i < $cantidad1 ; $i++){
        $tmp_json =  json_encode($str[$i],JSON_UNESCAPED_UNICODE);
        //echo(json_decode($tmp_json)->{'ID'});
        //echo(json_decode($tmp_json)->{'Uso'});



        $precio = str_replace(',','.', json_decode($tmp_json)->{'Precio'});
        $cantidad = str_replace(',','.',json_decode($tmp_json)->{'Cantidad'});
        $precio_total = str_replace(',','.',json_decode($tmp_json)->{'Precio Total'});
        $periocidad = json_decode($tmp_json)->{'periocidad_hi'};
        $codigo_articulo = json_decode($tmp_json)->{'codigo_articulo'};

        $periocidad_result = 0;

        if($periocidad == 1){
            $periocidad_result = '1';
        }else if($periocidad == 2){
            $periocidad_result = '2';
        }else if($periocidad == 3){
            $periocidad_result = '3';
        }else if($periocidad == 4){
            $periocidad_result = '4';
        }else if($periocidad == 5){
            $periocidad_result = '6';
        }else if($periocidad == 6){
            $periocidad_result = '12';
        }


        $sql = "SELECT * FROM min_valoracion  WHERE codigo_producto ='$codigo_articulo' ";


        $result=mysql_query($sql);
        $test = mysql_fetch_array($result);
        $unidades = $test['unidades'];

        $cantidad_final = $unidades - $cantidad;

        $promedio_actual = $test['promedio_actual'];


        $sql = "INSERT INTO min_requisicion(codigo_encargado_almacen,codigo_persona_recibe,codigo_articulo,cantidad_despacho,existencia_final,
                                                fecha_uso,valor_unidad,periocidad,codigo_Alias,beneficiario)
                       VALUES('$codigo_encargado_almacen','$codigo_persona_recibe','$codigo_articulo','$cantidad','$cantidad_final','$fecha_requisicion','$precio','$periocidad_result','$codigo_requisicion','$beneficiario_hi')";

        mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());
//
        $sql = "UPDATE min_valoracion SET unidades='$cantidad_final',costo_total='".($promedio_actual*$cantidad_final)."' WHERE codigo_producto ='$codigo_articulo'";

        mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());


        require_once('../../clases/funciones.php');
        $fecha = fecha_sicap();
        $sql = "INSERT INTO min_valoracion_historico
( codigo_producto, unidades, costo_total, promedio_actual,fecha ,eliminado)
VALUES('$codigo_articulo', '$cantidad_final', '".($promedio_actual*$cantidad_final)."', '$promedio_actual', '$fecha');
";
        $result = mysql_query($sql) or die('No se pudo guardar la información. valoraciones_historico '.mysql_error());



    }

//            $fecha_actual = $fecha_requisicion;







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
//
//            $sql = "SELECT * FROM min_valoracion WHERE  codigo_producto='$codigo_articulo'";
//
//            $result = mysql_query($sql);
//
//            $test = mysql_fetch_array($result);
//
//            if (!$result)
//            {
//                die("Error: Data not found.. min_valoracion");
//            }
//
//            $valoracion_unidades = $test['unidades'];
//            $valoracion_costo_total = $test['costo_total'];
//            $promedio_actual = $test['promedio_actual'];
//
//            $nueva_valoracion_unidades = $valoracion_unidades - $cantidad_despacho;
//
//            $sub_total_costo_total = $cantidad_despacho*$promedio_actual;
//            $nueva_valoracion_costo_total = $valoracion_costo_total - $sub_total_costo_total;
//
//            $sql = "UPDATE min_valoracion SET unidades='$nueva_valoracion_unidades',costo_total='$nueva_valoracion_costo_total'  WHERE codigo_producto='$codigo_articulo'";
//
//
//            mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());


            echo('<div id="done_app"><marquee scrolldelay="100">Operación Realizada Exitosamente</marquee></div>');

        //}

//    }else{
//        echo("Comprueba los campos");
//    }

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

    <style media="screen" type="text/css">


    </style>


    <script type="text/javascript">

        $(function() {


            var agregar_espacios = true;

            var  head_exist = false;

            $("#agregar").click(function() {

//
//                if (agregar_espacios && $('#nombre_articulo').val() != ""
//                    && $('#cantidad').val() != '') {


                if(!head_exist){
                    $('#tabla_articulos ').after('<br/><br/>' +
                    '<table border=none class="tablas-nuevas" id="tabla">' +
                    '  <tr  style="text-align: center">' +
                    '<th>Articulo</th>' +
                    '<th>Precio</th>' +
                    '<th>Cantidad</th>' +
                    '<th>Precio Total</th>' +
                    '<th>Periocidad</th>' +

                    '<th style="display: none">periocidad_hi</th>' +
                    '<th style="display: none">codigo_articulo</th>' +
                    '</tr>' +
                    '</table>');
                    head_exist = true;
                }

//                <tr>
//                <td>
//                <label>Periocidad</label>
//                </td>
//                <td>
//                <select name="periocidad" id="periocidad">
//
//                <option value="1" >Mensual</option>
//                <option value="2">Bimestral</option>
//                <option value="3">Trimestral</option>
//                <option value="4">Cuatrmestral</option>
//                <option value="5" selected>Semestral</option>
//                <option value="6">Anual</option>
//                </select>
//                </td>
//                </tr>
                if($('#articulo').val() != '' && $('#precio').val() != '' &&
                $('#cantidad_despacho').val() != ''){


                    var articulo = $('#articulo').val();
                    var codigo_articulo = $('#codigo_articulo').val();
                    var precio = $('#precio').val();
                    var cantidad = $('#cantidad_despacho').val();
                    var precio_total = $('#precio').val() * $('#cantidad_despacho').val();

                    var periocidad = $('#periocidad').val();

                    var periocidad_text = $("#periocidad option[value='"+periocidad+"']").text();

                    $('#tabla tr:last').after("<tr>" +
                    "<td style='text-align: left'> <label style='font-size: 14px;'> " +articulo + " </label> </td> " +
                    "<td style='text-align: left'> <label style='font-size: 14px'>"+((Math.round(precio*100)/100).toString()).replace('.',',')+"</label> </td> " +
                    "<td style='text-align: left'> <label style='font-size: 14px'>"+cantidad+"</label> </td> " +
                    "<td style='text-align: left'> <label style='font-size: 14px'>"+ ((Math.round(precio_total*100)/100).toString()).replace('.',',')+"</label> </td> " +
                         "<td style='text-align: left'> <label style='font-size: 14px;'> " +periocidad_text + " </label> </td> " +
                    "<td style='display: none'> <label style='font-size: 14px'>"+ periocidad +"</label> </td> " +
                    "<td style='display: none'> <label style='font-size: 14px'>"+ codigo_articulo +"</label> </td> " +
                    "</tr>");

                    $('#articulo').val('');
                    $('#precio').val('');
                    $('#cantidad_despacho').val('');
                    $('#existencia_articulo').val('');

                }




                agregar_espacios = false;
//                }
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
                var win = window.open("articulo_ver.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90");
                win.focus();
            });



            $( "#buscar_departamento" ).click(function() {
                var win = window.open("buscar_departamento.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90");
                win.focus();
            });

            $( "#buscar_beneficiario" ).click(function() {
                var win = window.open("beneficiario.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90");
                win.focus();
            });


            $( "#cantidad_despacho" ).bind('keyup keydown mouseup change focus',function(e){
                //existencia_articulo cantidad_despacho cantidad_final
                //sumComa.add();

//                sumComa.add($( "#existencia_articulo" ).val());
//                sumComa.add( "-"+ $( "#cantidad_despacho" ).val());
//                $( "#cantidad_final" ).val(sumComa.getSum());


            });

            $('#form').submit(function() {
                //$( "#costo_total_hi" ).val(  $( "#costo_total" ).val());



                var columns = $('#tabla tr th').map(function() {  return $(this).text();
                });

                var tableObject = $('#tabla  tr').map(function(i) {    var row = {};  $(this).find('td').each(function(i) {      var rowName = columns[i];    row[rowName] = $(this).text();
                });return row;   }).get();


                var json_tabla= JSON.stringify(tableObject);



                $("#post_array").val(json_tabla);
                $("#post_array").serializeArray();

                return true; // return false to cancel form action
            });

//            $('#form').submit(function() {
//                $( "#existencia_articulo_hi" ).val(  $( "#existencia_articulo" ).val());
//                $( "#cantidad_final_hi" ).val(  $( "#cantidad_final" ).val());
//
//                return true; // return false to cancel form action
//            });

            $( "#datepicker2" ).datepicker({ dateFormat: 'yy-mm-dd',changeYear: true, yearRange: "-100:+0" });
            var myDate = new Date();
            var mes = 0
            if(myDate.getMonth()<9){
                mes = myDate.getMonth() +1;
                mes = '0' + mes;
            }else{
                mes = myDate.getMonth() + 1;
            }
            var prettyDate =(myDate.getFullYear()  + '-' +mes) + '-' + myDate.getDate() ;
            $("#datepicker2").val(prettyDate);


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
            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Producción | Requisicion</strong></h1>

            <!-- Beginning of compulsory code below -->
            <br/><br/>
            <TABLE BORDER="0" CELLSPACING="4" WIDTH="500" id="tabla_articulos">


                <TR>
                    <TD><label>Codigo de Requisición</label></TD>
                    <TD><p><input type="text" name="codigo_requisicion" id="codigo_requisicion"  size="20"></p></TD>
                </TR>



                <tr>
                    <td>
                        <label >Fecha de Requisición</label>
                    </td>
                    <td>
                        <p>
                            <input type="text" id="datepicker2" name="fecha_requisicion">
                        </p>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Periocidad</label>
                    </td>
                    <td>
                        <select name="periocidad" id="periocidad">

                            <option value="1" >Mensual</option>
                            <option value="2">Bimestral</option>
                            <option value="3">Trimestral</option>
                            <option value="4">Cuatrmestral</option>
                            <option value="5" selected>Semestral</option>
                            <option value="6">Anual</option>
                        </select>
                    </td>
                </tr>



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
                    <TD width="173"><label>Persona que Recibe </label></TD>
                    <TD width="94">
                        <input type="text" name="persona_recibe" id="persona_recibe" size="20"  disabled></TD>
                    <TD>
                        <!--<input type="submit" value="Buscar" name="submit">-->
                        <input type="button" name="buscar_persona_recibe" id="buscar_persona_recibe" value="Buscar" >
                    </TD>
                </TR>


                <TR>
                    <TD width="173"><label>Beneficiario </label></TD>
                    <TD width="94">
                        <input type="text" name="beneficiario" id="beneficiario" size="20"  disabled></TD>
                    <TD>
                        <!--<input type="submit" value="Buscar" name="submit">-->
                        <input type="button" name="buscar_beneficiario" id="buscar_beneficiario" value="Buscar" >
                    </TD>
                </TR>


                <TR>
                    <TD width="173"><label>Departamento Solicitante </label></TD>
                    <TD width="94">
                        <input type="text" name="descripcion" id="descripcion" size="20"  disabled></TD>
                    <TD>
                        <!--<input type="submit" value="Buscar" name="submit">-->
                        <input type="button" name="buscar_departamento" id="buscar_departamento" value="Buscar" >
                    </TD>
                </TR>


                <TR>
                    <TD width="173"><label>Artículo</label></TD>
                    <TD width="94">
                        <input type="text" name="articulo" id="articulo" size="20"  disabled></TD>
                    <TD>
                        <!--<input type="submit" value="Buscar" name="submit">-->
                        <input type="button" name="buscar_articulo" id="buscar_articulo" value="Buscar" >
                    </TD>
                </TR>


<!--                <TR>-->
<!--                    <TD><label>Existencia de Artículo</label></TD>-->
<!--                    <TD><p><input type="text" name="existencia_articulo" id="existencia_articulo"  size="20" disabled></p></TD>-->
<!--                </TR>-->




                <TR>
                    <TD><label>Cantidad Despacho</label></TD>
                    <TD><p><input type="text" name="cantidad_despacho" id="cantidad_despacho"></p></TD>
                </TR>


                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <input type="button" value="Agregar" id="agregar"/>
                    </td>
                </tr>

<!--                <TR>-->
<!--                    <TD><label>Cantidad Final</label></TD>-->
<!--                    <TD><p><input type="text" name="cantidad_final" id="cantidad_final" disabled></p></TD>-->
<!--                </TR>-->

<!--                <TR>-->
<!--                    <TD><label>Requisición de Entrada</label></TD>-->
<!--                    <TD><p><input type="checkbox" name="requicicion_especial" id="requicicion_especial" ></p></TD>-->
<!--                </TR>-->



                <input type="hidden" name="codigo_solicitante" id="codigo_solicitante" value=""/>
                <input type="hidden" name="codigo_encargado_almacen" id="codigo_encargado_almacen" value=""/>
                <input type="hidden" name="codigo_persona_recibe" id="codigo_persona_recibe" value=""/>
                <input type="hidden" name="precio" id="precio" value=""/>
                <input type="hidden" name="codigo_articulo" id="codigo_articulo" value=""/>
                <input type="hidden" name="existencia_articulo_hi" id="existencia_articulo_hi" value=""/>
                <input type="hidden" name="cantidad_final_hi" id="cantidad_final_hi" value=""/>
                <input type="hidden" name="beneficiario_hi" id="beneficiario_hi" value=""/>
                <input type="hidden" name="descripcion_hi" id="descripcion_hi" value=""/>
                <input type="hidden" value="" id="post_array" name="post_array"/>

            </TABLE>
            <br/><br/>
            <table>
                <tr>
                    <td>
                        <input id="enviar" type="submit" value="Guardar datos" name="submit">
                    </td>
                    <td>
                        <a href="uso_consumo_ver.php"><input type="button" value="Ver datos"></a>
                    </td>
                    <td>
                        <a href="../../min_menu.php"><input type="button" value="Atras"></a>
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
