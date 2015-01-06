<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html >
<head>
    <title>SICAP | Sistema Integral de Costos</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="author" content="Tomas Bagdanavicius, http://www.lwis.net/free-css-drop-down-menu/" />
    <meta name="keywords" content=" css, dropdowns, dropdown menu, drop-down, menu, navigation, nav, horizontal, vertical left-to-right, vertical right-to-left, horizontal linear, horizontal upwards, cross browser, internet explorer, ie, firefox, safari, opera, browser, lwis" />
    <meta name="description" content="Clean, standards-friendly, modular framework for dropdown menus" />
    <link href="../../css/helper.css" media="screen" rel="stylesheet" type="text/css" />
    <script src="../../js/htmlDatePicker.js" type="text/javascript"></script>

    <link href="../../css/stylesheet.css" rel="stylesheet" type="text/css" />

    <link href="../../js/jquery-ui-1.11.0.custom/jquery-ui.css" rel="stylesheet">

    <script src="../../js/jquery-ui-1.11.0.custom/external/jquery/jquery.js"></script>

    <script src="../../js/jquery-ui-1.11.0.custom/jquery-ui.js"></script>

    <script type="text/javascript">

        $(function() {

//            $( "#dialog" ).dialog({ buttons: [ { text: "Ok", click: function() { $( this ).dialog( "close" ); } },
//                { text: "NO", click: function() { $( this ).dialog( "close" ); } }] });
        });
    </script>

    <!-- / END -->

</head>
<body class="flickr-com">



<form method="post">

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
                            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Producción | Ver Ordenes de Producción</strong></h1>
                            <br/><br/>
                            <table border=none class="tablas-nuevas">

                                <tr id="tmp">
                                    <th>Produco</th>
                                    <th>Orden de Trabajo</th>
                                    <th>Produccion Planificada</th>
                                    <th>Fecha de Inicio</th>
                                    <th></th>

                                    <th></th>
                                    <!--                                    <th>Correo Eectrónico</th>-->

                                </tr>
                                <tr>
                                    <?php
                                    include("../../db.php");

                                    $result=mysql_query("SELECT * FROM prc_orden_trabajo WHERE fecha_culminacion = 'n' AND eliminada = 'n'");

                                    while($test = mysql_fetch_array($result)){

                                        $id = $test['codigo'];

                                        $codigo_producto = $test['codigo_producto'];

                                        $produccion_planificada = $test['produccion_planificada'];

                                        $fecha_inicio = $test['fecha_inicio'];

                                        $orden_trabajo = $test['codigo_alias'];


                                        $sql2 = "SELECT * FROM min_productos_servicios WHERE codigo = '$codigo_producto'";
                                        $result2=mysql_query($sql2);
                                        $test2 = mysql_fetch_array($result2);

                                        $nombre_producto = $test2['nombre'];



                                        echo "<tr align='center'>";
                                        echo"<td><font color='black'>". utf8_decode($nombre_producto) . "</font></td>";
                                        echo"<td><font color='black'>". utf8_decode($orden_trabajo) . "</font></td>";
                                        echo"<td><font color='black'>". $produccion_planificada . "</font></td>";
                                        echo"<td><font color='black'>". $fecha_inicio. "</font></td>";


                                        echo"<td> <a href ='orden_trabajo_mod.php?codigo=$id'>Modificar</a></td>";
                                        echo"<td> <a href ='orden_trabajo_del.php?codigo=$id' id='alert_button'>Eliminar</a></td>";
                                        echo "</tr>";
                                    }
                                    mysql_close($conn);
                                    ?>
                                </tr>

                            </table>
                            <br/>
                            <a href="crear_orden_trabajo.php"><input type="button" value="Atras"></a>
                            <p></p>
                        </div>
                    </div><!--end firefoxbug-->
                </div><!--end left_bgd-->

            </div>
            <p>
                <!--end right_col-->

            </p>
            <p>&nbsp; </p>
            <div class="clearboth"></div>
        </div>
        <div align="center" class="pie">SICAP 2014</div>
    </div>

    <!-- / END -->

</form>

<!--<div id="dialog" title="Basic dialog">-->
<!--    <p>Estas seguro de Eliminar al orden</p>-->
<!--</div>-->


</body>
</html>