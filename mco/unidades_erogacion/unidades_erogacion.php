<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 10/12/14
 * Time: 09:33 AM
 */

ini_set('display_errors', 'On');
ini_set('display_errors', 1);

include_once('../../clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

?>

<?php

require_once ('../../db.php');
$error =  true;



if (isset($_POST['submit'])) {


    require_once('../../clases/Validate.php');

    $nombre = $_POST['nombre'];
    $sigla = $_POST['sigla'];


    $sql = "SELECT count(*) as count FROM mco_unidad_erogacion WHERE nombre='$nombre'";
    $result=mysql_query($sql);
    $test = mysql_fetch_array($result);
    $count = $test['count'];

    if($count != '0'){
        send_error_redirect(true, "Unidad Ya Existente");
        die;
    }


    $str = json_decode($_POST['post_array'], true);
    $cantidad1 = count($str);

    $fake_POST = array();


    for ($i = 1; $i < $cantidad1; $i++) {

        $tmp_json = json_encode($str[$i], JSON_UNESCAPED_UNICODE);


        $Cantidad = json_decode($tmp_json)->{'Cantidad'};
        $codigo_departamento = json_decode($tmp_json)->{'codigo_departamento'};


        $fake_POST['Cantidad'] = $Cantidad;
        $fake_POST['codigo_departamento'] = $codigo_departamento;
        $fake_POST['nombre'] = $_POST['nombre'];

        $validation = array(

            array(
                'nombre' => 'nombre',
                'requerida' => true,
            ),

            array('nombre' => 'codigo_departamento',
                'requerida' => true,
                'regla' => 'number'),

            array('nombre' => 'Cantidad',
                'requerida' => true,
                'regla' => 'float',
                'tipo' => ',')

        );


        $validated = new Validate($validation, $fake_POST);
        $validated->validate();

        if ($validated->getIsError()) {
            send_error_redirect(true, "Hay Errores en la Información del formulario");
            die;

        }



    }


    $sql = "INSERT INTO mco_unidad_erogacion(nombre,sigla)
    VALUES('$nombre','$sigla') ";

    $result = mysql_query($sql);


    $ref_id = mysql_insert_id();

    for ($i = 1; $i < $cantidad1; $i++) {


        $tmp_json = json_encode($str[$i], JSON_UNESCAPED_UNICODE);

        $Cantidad = json_decode($tmp_json)->{'Cantidad'};
        $codigo_departamento = json_decode($tmp_json)->{'codigo_departamento'};


        $sql = "INSERT INTO mco_unidad_erogacion_detalle(codigo_unidad_erogacion,
        cantidad,codigo_departamento)
        VALUES ('$ref_id','$Cantidad','$codigo_departamento')";

        $result = mysql_query($sql)or die('mco_unidad_erogacion_detalle. '.mysql_error());;

    }

        send_error_redirect(false,'Datos Guardados Exitosamente');
        die;

}

?>


<!DOCTYPE html>
<html>
<head lang="es">
    <title>SICAP | Sistema Integral de Costos</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="../../css/helper.css" media="screen" rel="stylesheet" type="text/css" />
    <script src="../../js/htmlDatePicker.js" type="text/javascript"></script>
    <link href="../../css/htmlDatePicker.css" rel="stylesheet">
    <link href="../../css/stylesheet.css" rel="stylesheet" type="text/css" />
    <link href="../../css/ui-lightness/jquery-ui-1.10.4.custom.css" rel="stylesheet">
    <script src="../../js/jquery-1.10.2.js"></script>
    <script src="../../js/jquery-ui-1.10.4.custom.js"></script>
    <link href="../../js/jquery-ui-1.11.0.custom/jquery-ui.css" rel="stylesheet">
    <script src="../../js/jquery-ui-1.11.0.custom/jquery-ui.js"></script>

    <!-- Beginning of compulsory code below -->
    <link href="/sicap/css/dropdown/dropdown.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="/sicap/css/dropdown/themes/flickr.com/default.ultimate.css" media="screen" rel="stylesheet" type="text/css" />
    <!-- / END -->


    <style type="text/css">
        .formLayout
        {
            /*background-color: #f3f3f3;*/
            /*border: solid 1px #a1a1a1;*/
            /*padding: 10px;*/

        }

        .formLayout label
        {
            display: block;
            width: 100px;
            float: left;
            margin-bottom: 15px;
        }

        .formLayout input{
            display: block;

            float: left;
            margin-bottom: 15px;
        }

        .formLayout label
        {

            padding-right: 20px;
            padding-top: 2px;
        }

        br
        {
            clear: left;
        }

        /*jquery ui*/

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


    </style>


    <script>

        function resetForms() {
            for (var i = 0; i < document.forms.length; i++) {
                document.forms[i].reset();
            }
        }

        $(function(){

            //resetForms();

            var head_exsit = false;

            $("#agregar").click(function() {

                if(!head_exsit){
                    $('#tabla_articulos ').after('<br/><br/>' +
                    '<table border=none class="tablas-nuevas" id="tabla">' +
                    '  <tr  style="text-align: center">' +
                    '<th>Departamento</th>' +
                    '<th>Cantidad</th>' +
                    '<th>Eliminar</th>' +


                    '<th style="display: none">codigo_departamento</th>' +
                    '<th style="display: none">codigo_unidad</th>' +

                    '</tr>' +
                    '</table>');
                    head_exsit = true;
                }


                if($("#departamento").val() != '' && $("#cantidad").val() != ''){

                    var departamento = $("#departamento").val();
                    var cantidad = $("#cantidad").val();


//                    var nombre_unidad = $("#unidad option:selected").text();

                    var codigo_unidad = $("#unidad").val();

                    var departamento_hi = $("#departamento_hi").val();


                    $('#tabla tr:last').after("<tr>" +
                    "<td  style='text-align: left; '> <label style='font-size: 10px;'> " +departamento + " </label> </td> " +
                    "<td  style='text-align: right'> <label style='font-size: 10px'>"+ cantidad+"</label> </td> " +
                    "<td> <ul  id='icons' class='ui-widget ui-helper-clearfix'> <li   class='ui-state-default ui-corner-all' title='.ui-icon-check'><span  class='ui-icon ui-icon-check'></span></li> </ul></td>" +
                    "<td style='display: none'> <label >"+ departamento_hi +"</label> </td> " +


                    "</tr>");


                    $("#departamento").val('');
                    $("#cantidad").val('');
                    $("#departamento_hi").val();


                    $('.ui-widget').click(function() {
                        $(this).parent().parent().remove(); //Deleting TD element
                    });

                }

            });




            $( '#departamento_buscar' ).click(function() {
                var win = window.open('departamento_buscar.php', 'nuevo', 'directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90 ');
                win.focus();
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

<form method="post" name="nueva_erogacion" enctype="multipart/form-data" id="form">
    <div id="body_bottom_bgd">
        <div id="">
            <div align="justify" id="right_col" >

                <div id="header">
                </div>
                <div id="">
                    <div id="firefoxbug"><!-- firefoxbug -->
                        <!-- <div id="blue_line"></div>-->
                        <div class="dynamicContent" align="left">
                            <!-- <h1>Inicio</h1>-->
                            <!--<p><a href="seleccion_sicap.html" class="main-site">Principal</a></p>-->
                            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong> Módulo Confoguración | Base de Distribución</strong></h1>

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
                            <TABLE BORDER="0" CELLSPACING="4" WIDTH="500">

                                <TR>
                                    <TD><label>Nombre</label></TD>
                                    <TD><p><input type="text" name="nombre" size="20"></p></TD>
                                </TR>

                                <TR>
                                    <TD><label>Sigla(Opcional)</label></TD>
                                    <TD><p><input type="text" name="sigla" size="20"></p></TD>
                                </TR>


                                <tr>
                                    <td>
                                        <label>Departamento</label>
                                    </td>
                                    <td>
                                        <input type='text' name='departamento' id='departamento' disabled/>
                                    </td>
                                    <td>
                                        <input type='button' name='departamento_buscar' id='departamento_buscar' value='Buscar'/>

                                    </td>
                                </tr>
                                <input type='hidden' name='departamento_hi' id='departamento_hi' value=''/><br/>

                                <tr>
                                    <td>
                                        <label > Cantidad </label>
                                    </td>
                                    <td>
                                        <input type='text' name='cantidad' id='cantidad'/>
                                    </td>

                                    <td>
                                        <input type='button' value='Agregar' id='agregar'/><br/>
                                    </td>
                                </tr>


                                <input type="hidden" value="" id="post_array" name="post_array"/>

                            </TABLE>
                            <br/>
                            <div id='tabla_articulos' ></div>
                            <br/>
                            <table>
                                <tr>
                                    <td>
                                        <input type="submit" value="Guardar datos" name="submit">
                                    </td>
                                    <td>
                                        <a href="unidades_erogacion_ver.php"><input type="button" value="Ver Datos"></a>
                                    </td>


                                    <td>
                                        <a href="../../mco_menu.php"><input type="button" value="Atras"></a>
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
