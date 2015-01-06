<?php

require_once ('../../db.php');
?>


    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
    <head>
        <title>SICAP | Sistema Integral de Costos</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="../../css/helper.css" media="screen" rel="stylesheet" type="text/css" />
        <script src="../../js/htmlDatePicker.js" type="text/javascript"></script>
        <link href="../../css/htmlDatePicker.css" rel="stylesheet">
        <!-- Beginning of compulsory code below -->
        <link href="../sicap/css/dropdown/dropdown.css" media="screen" rel="stylesheet" type="text/css" />
        <link href="../sicap/css/dropdown/themes/flickr.com/default.ultimate.css" media="screen" rel="stylesheet" type="text/css" />
        <link href="../../css/stylesheet.css" rel="stylesheet" type="text/css" />
        <script src="../../js/jquery-1.10.2.js"></script>
        <script src="../../js/jquery-ui-1.10.4.custom.js"></script>
        <script>
            $(function() {

                $('#buscar_articulo').click(function(){

                    var win = window.open("buscar_articulo.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90 ");
                    win.focus();
                });



                $('#form').submit(function() {
                    $( "#articulo_hi" ).val(  $( "#nombre_articulo" ).val());



                    return true; // return false to cancel form action
                });
            });

        </script>


        <!-- Beginning of compulsory code below -->

    </head>


    <body class="flickr-com">
    <!--<p><a href="mrh_menu.html" class="main-site">Principal</a></p>-->
    <!--<h1><img src="images/seleccion_sicap_archivos/image002.jpg" alt="flickr" />Módulo de Recursos Humanos | Cargo</h1>-->
    <!-- Beginning of compulsory code below -->

    <form method="get" accept-charset="UTF-8" action="registrar_etapas.php" name="producto_etapa" id="form">

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
                                <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Producción | registrar Artículo</strong></h1>
                                <br/><br/>
                                <TABLE BORDER="0" CELLSPACING="4" WIDTH="380" id="tabla_articulos">
                                    <tr>
                                        <td><label>Nombre</label></td>
                                        <TD><p><input type="text" name="articulo"  size="20" id="nombre_articulo" disabled/></p></TD>
                                        <td><input type="button" value="buscar" id="buscar_articulo" name="buscar_articulo"/></td>
                                    </tr>

                                    <tr >
                                        <td><input type="submit" value="Registrar" name="submit"/></td>
                                    </tr>

                                    <input type="hidden" name="id_articulo" id="id_articulo"/>
<!--                                    <input type="hidden" name="codigo_articulo" id="codigo_articulo"/>-->
<!--                                    //<input type="hidden" name="inventario_nombre" id="inventario_nombre"/>-->
<!--                                    <input type="hidden" name="articulo_hi" id="articulo_hi"/>-->

                                </TABLE>


                                <br/>
                                <table>
                                    <tr>
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