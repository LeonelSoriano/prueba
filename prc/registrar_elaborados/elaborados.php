<?php

require_once ('../../db.php');
?>

<?php

if(isset($_POST['submit'])){



    header("Content-Type: text/html;charset=utf-8");
    ini_set('display_errors', 'On');
    ini_set('display_errors', 1);
    include('../../clases/funciones.php');
    include('../../clases/Validate.php');


    $validation = array(

        array('nombre' => 'cantidad',
            'requerida' => true,
            'regla' => 'float',
            'tipo' => ','
        ),

        array('nombre' => 'codigo',
            'requerida' => true,
            'regla' => 'number')


    );

    $validated = new Validate($validation,$_POST);
    $validated->validate();

    if(!$validated->getIsError()){

        $cantidad = str_replace( ',','.', $_POST['cantidad']);
        $codigo = $_POST['codigo'];


        $sql = "SELECT count(*) as total FROM prc_semielaborados WHERE prc_semielaborados.desactivo = 'n' AND prc_semielaborados.codigo_producto = '$codigo'";

        $result=mysql_query($sql);

        $test = mysql_fetch_array($result);

        $total = $test['total'];


        if($total != '0'){
            send_error_redirect(true,"Articulo ya Posee Produccion Mensual");die;
        }

        $sql = "INSERT INTO prc_semielaborados(codigo_producto,cantidad) VALUES ('$codigo','$cantidad')";


        mysql_query($sql) or die('No se pudo guardar la información.  prc_semielaborados'.mysql_error());

        send_error_redirect(false,'Datos Guardados Exitosamente');
        die;


    }else if($validated->getIsError()){

        send_error_redirect(true,"Hay Errores en la Información del formulario");die;
    }

    //  print_r($_POST);
    //echo( $_POST['post_array']);
//    $str = json_decode($_POST['post_array'], true);
//
//    //la posicion 0 es una array vacio que no se debe de tomar en cuenta
//    $cantidad =  count($str);
//
//    for($i=1; $i < $cantidad ; $i++){
//        $tmp_json =  json_encode($str[$i],JSON_UNESCAPED_UNICODE);
//        //echo(json_decode($tmp_json)->{'ID'});
//        //echo(json_decode($tmp_json)->{'Uso'});
//
//
//        $id = json_decode($tmp_json)->{'ID'};
//        $uso = json_decode($tmp_json)->{'Uso'};
//
//        $sql = "INSERT INTO prc_elaborados(codigo_producto,cantidad) VALUES ('$id','$uso')";
//
//        mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());
//
//    }

}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>SICAP | Sistema Integral de Costos</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="../../css/helper.css" media="screen" rel="stylesheet" type="text/css" />
    <script src="../../js/htmlDatePicker.js" type="text/javascript"></script>
    <link href="../../css/htmlDatePicker.css" rel="stylesheet">
    <!-- Beginning of compulsory code below -->
    <link href="/sicap/css/dropdown/dropdown.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="/sicap/css/dropdown/themes/flickr.com/default.ultimate.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="../../css/stylesheet.css" rel="stylesheet" type="text/css" />
    <script src="../../js/jquery-1.10.2.js"></script>
    <script src="../../js/jquery-ui-1.10.4.custom.js"></script>

    <script>
        $(function() {

            var agregar_espacios = true;

            $( "#buscar_articulo" ).click(function() {
                var win = window.open("buscar_articulo.php",  "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90 ");
                win.focus();
            });


//            $("#agregar").click(function(){
//
//
//
//                if(agregar_espacios && $('#nombre_articulo').val() != ""
//                    && $('#cantidad').val() != ''){
//
//                    $('#tabla_articulos ').after('<br/><br/>' +
//                        '<table border=none class="tablas-nuevas" id="tabla">' +
//                        '  <tr >' +
//                        '<th>ID</th>' +
//                        '<th>Código</th>' +
//                        '<th>Nombre</th>' +
//                        '<th>Inventario</th>' +
//                        '<th>Uso</th>' +
//                        '</tr>' +
//                        '</table>');
//                    agregar_espacios = false;
//                }
//
//                if( $('#nombre_articulo').val() != ""
//                    && $('#cantidad').val() != ''){
//                    var codigo_alias = $("#codigo_articulo").val();
//                    var nombre_alias  = $("#nombre_articulo").val();
//                    var inventario_nombre  = $("#inventario_nombre").val();
//                    var cantidad  = $("#cantidad").val();
//                    var codigo  = $("#codigo").val();
//
//
//                    $('#tabla tr:last').after("<tr>" +
//                        "<td> <label style='font-size: 14px'>" + codigo + "</label> </td> " +
//                        "<td> <label style='font-size: 14px'>" + codigo_alias + "</label> </td> " +
//                        "<td> <label style='font-size: 14px'>" + nombre_alias + "</label> </td> " +
//                        "<td> <label style='font-size: 14px'>" + inventario_nombre  + "</label> </td> " +
//                        "<td> <label style='font-size: 14px'>" + cantidad  + "</label> </td> " +
//                        "</tr>");
//
//                    $("#codigo_articulo").val("");
//                    $("#nombre_articulo").val("");
//                    $("#inventario_nombre").val("");
//                    $("#cantidad").val("");
//                    $("#codigo").val("");
//                }
//
//            });


//            $('#form').submit(function() {
//                $( "#costo_total_hi" ).val(  $( "#costo_total" ).val());
//
//
//
//                var columns = $('#tabla tr th').map(function() {  return $(this).text();
//                });
//
//                var tableObject = $('#tabla  tr').map(function(i) {    var row = {};  $(this).find('td').each(function(i) {      var rowName = columns[i];    row[rowName] = $(this).text();
//                });return row;   }).get();
//
//
//                var json_tabla= JSON.stringify(tableObject);
//
//
//
//                $("#post_array").val(json_tabla);
//                $("#post_array").serializeArray();
//
//                return true; // return false to cancel form action
//            });
//
//


        });
    </script>



    <!-- Beginning of compulsory code below -->

</head>


<body class="flickr-com">
<!--<p><a href="mrh_menu.html" class="main-site">Principal</a></p>-->
<!--<h1><img src="images/seleccion_sicap_archivos/image002.jpg" alt="flickr" />Módulo de Recursos Humanos | Cargo</h1>-->
<!-- Beginning of compulsory code below -->

<form method="post" accept-charset="UTF-8" name="semielaborados" id="form">

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
                            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Inventario | Empresa</strong></h1>
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
                            <TABLE BORDER="0" CELLSPACING="4" WIDTH="380" id="tabla_articulos">
                                <tr>
                                    <td><label>Nombre</label></td>
                                    <TD><p><input type="text" name="articulo"  size="20" id="nombre_articulo" disabled/></p></TD>
                                    <td><input type="button" value="buscar" id="buscar_articulo" name="buscar_articulo"/></td>
                                </tr>

                                <tr>
                                    <td><label for="">Cantidad</label>
                                    <td><input  type="text" name="cantidad" id="cantidad"/></td>
                                    </td>
                                </tr>
<!---->
<!--                                <tr >-->
<!--                                    <td><input type="button" value="Agregar" id="agregar"/></td>-->
<!--                                </tr>-->


                                <input type="hidden" id="espacio"/>


                                <input type="hidden" value="" id="nombre_articulo"/>
                                <input  type="hidden" value="" id="codigo_articulo"/>
                                <input name="codigo" type="hidden" value="" id="codigo"/>
                                <input type="hidden" value="" id="inventario_codigo"/>
                                <input type="hidden" value="" id="inventario_nombre" name="inventario_nombre"/>

<!--                                <input type="hidden" value="" id="post_array" name="post_array"/>-->
                            </TABLE>



                            <br/>
                            <table>
                                <tr>
                                    <td><input type="submit" value="Guardar datos" name="submit"></td>
                                    <td><a href="elaborados_ver.php"><input type="button" value="Ver datos"></a> </td>
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




<?php

mysql_close($conn);

?>