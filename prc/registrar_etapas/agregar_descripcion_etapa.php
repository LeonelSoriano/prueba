<?php

header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

include("../../db.php");
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>SICAP | Sistema Integral de Costos</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="author" content="Tomas Bagdanavicius, http://www.lwis.net/free-css-drop-down-menu/" />
    <meta name="keywords" content=" css, dropdowns, dropdown menu, drop-down, menu, navigation, nav, horizontal, vertical left-to-right, vertical right-to-left, horizontal linear, horizontal upwards, cross browser, internet explorer, ie, firefox, safari, opera, browser, lwis" />
    <meta name="description" content="Clean, standards-friendly, modular framework for dropdown menus" />
    <link href="../../css/helper.css" media="screen" rel="stylesheet" type="text/css" />

    <script src="../../js/jquery-1.10.2.js"></script>
    <script src="../../js/jquery-ui-1.10.4.custom.js"></script>
    <link href="../../css/stylesheet.css" rel="stylesheet" type="text/css" />


    <!-- Beginning of compulsory code below -->

    <script type="text/javascript">

        function isNumber(n) {
            n = n.replace(',','.');
            return !isNaN(parseFloat(n)) && isFinite(n);
        }


        $(function() {


            $( "#buscar" ).click(function() {
                var ventana_nueva = window.open("buscar_articulo_etapas.php", "nuevo","directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=700,left=200,top=90 ");
                ventana_nueva.focus();

            });



            $("#guardar").click(function(){

                if($("#articulo_nombre").val() != "" && $("#cantidad_estandar").val() != "" &&
                   $("#codigo_articulo_hi").val() != "" && isNumber($("#cantidad_estandar").val())){

                    var coidgo_articulo = $("#codigo_articulo_hi").val();
                    var cantidad = $("#cantidad_estandar").val();
                    var codigo_producto = $('#codigo_producto_hi').val();
                    var codigo_etapa = $('#codigo_etapa_hi').val();

                    var parametros = { codigo_articulo :  coidgo_articulo, cantidad: cantidad, codigo_etapa: codigo_etapa,
                        codigo_producto: codigo_producto};

                    $.ajax({
                        data:  parametros,
                        url:   'get_detalle_etapa.php',
                        type:  'post',
                        beforeSend: function () {
                            $("#resultado").html('<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +
                                '<img src="../../images/ajax-loader.gif" alt="Ajax Cargando" height="42" width="42">');
                        },
                        success:  function (response) {
                            $("#tabla_resultado").html(response);
                        }
                    });



                }
            });



            var codigo_producto = $('#codigo_producto_hi').val();
            var codigo_etapa = $('#codigo_etapa_hi').val();

            var parametros = { codigo_etapa: codigo_etapa,
                codigo_producto: codigo_producto};


            $.ajax({
                data:  parametros,
                url:   'get_detalle_etapa.php',
                type:  'post',
                beforeSend: function () {
                    $("#resultado").html('<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +
                        '<img src="../../images/ajax-loader.gif" alt="Ajax Cargando" height="42" width="42">');
                },
                success:  function (response) {
                    $("#tabla_resultado").html(response);
                }
            });

        });

    </script>

</head>


<body class="flickr-com">
<!--<p><a href="mrh_menu.html" class="main-site">Principal</a></p>-->
<!--<h1><img src="images/seleccion_sicap_archivos/image002.jpg" alt="flickr" />Módulo de Recursos Humanos | Cargo</h1>-->
<!-- Beginning of compulsory code below -->

<form method="post" accept-charset="UTF-8" name="agregar">

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

                            <br/><br/>
                            <table BORDER="0" CELLSPACING="6" WIDTH="380">
                                <tr>
                                    <td><label >Nombre Artículo</label></td>
                                    <td style="width: 155px"><input type="text" name="articulo_nombre" placeholder="articulo" id="articulo_nombre" disabled></td>
                                    <td><input type="button" value="Buscar" id="buscar"></td>
                                    <input type="hidden" id="codigo_hi"/>

                                </tr>
                                <tr>
                                    <td><label >Cantidad Estandar</label></td>
                                    <td><input type="text" id="cantidad_estandar" name="cantidad_estandar"/></td>
                                    <td><input id="guardar" type="button" value="Guardar"/></td>
                                </tr>


                                <input type="hidden" id="codigo_articulo_hi"/>
                                <input type="hidden" id="codigo_producto_hi" value="<?php echo($_GET['codigo_producto']); ?>"/>
                                <input type="hidden" id="codigo_etapa_hi" value="<?php echo($_GET['id']); ?>"/>


                                <table style="text-align: center;width: 80%" border=none class="tablas-nuevas" id="tabla_resultado">

<!--                                TODO hacer que se vea la tabla al entrar-->


                            <table>

                            </table>


                            <br/>
                            <table>
                                <tr>
                                    <td><a href="detalles_etapa.php"><input type="button" value="Atras"></a> </td>

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



<!--  guardado este codigo q lo colocare en configuracino -->
<?php

/*<label>Tipo de Empresa</label><br/>
    <div style="margin-left: 135px">


       <?php
       $result = mysql_query("SET NAMES utf8");
        $result=mysql_query("SELECT tipo FROM min_tipo_empresa");
        while($test = mysql_fetch_array($result)){

            echo "<p><input type='checkbox' name='tipo[]' value='". utf8_encode($test['tipo']) . "'/>&nbsp;&nbsp;&nbsp;&nbsp;" .utf8_encode($test['tipo']) ."</p>";

        }

*/
?>

