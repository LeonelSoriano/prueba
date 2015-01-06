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

    <!-- / END -->

</head>
<body class="flickr-com">

<!--<p><a href="mrh_menu.html" class="main-site">Principal</a></p>-->

<!--<h1><img src="images/flickr.com/icon.png" alt="flickr" />Módulo de Recursos Humanos | Listado de Turnos</h1>-->

<!-- Beginning of compulsory code below -->

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
                            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Inventario | Empresa</strong></h1>
                            <br/><br/>
                            <table border=none class="tablas-nuevas">

                                <tr id="tmp">
                                    <th style="text-align: center">Código</th>
                                    <th style="text-align: center">Nombre</th>
                                    <th style="text-align: center">Tipo de Medida</th>
                                    <th style="text-align: center">Cantidad</th>
                                    <th></th>

                                </tr>
                                <tr>
                                    <?php
                                    include("../../db.php");

                                    $result=mysql_query("SELECT
    *
FROM
    prc_semielaborados
	INNER JOIN min_productos_servicios
	ON min_productos_servicios.codigo = prc_semielaborados.codigo_producto
WHERE
    prc_semielaborados.desactivo = 'n'
	AND min_productos_servicios.inventario = '11'
	");

                                    while($test = mysql_fetch_array($result)){

                                        $id = $test['codigo'];
                                        $cantidad = $test['codigo'];
                                        $codigo_producto = $test['codigo_producto'];


                                        $sql2 = "SELECT * FROM min_productos_servicios WHERE codigo =$codigo_producto ";
                                        $result2=mysql_query($sql2);

                                        $test2 = mysql_fetch_array($result2);

                                        $nombre_codigo = $test2['codigo_alias'];
                                        $nombre = $test2['nombre'];

                                        $codigo_unidad = $test2['mco_unidad'];

                                        $sql2 = "SELECT * FROM mco_unidad WHERE codigo='$codigo_unidad'";
                                        $result2=mysql_query($sql2);

                                        $test2 = mysql_fetch_array($result2);

                                        $nombre_unidad = $test2['descripcion'];



                                        echo "<tr align='center'>";
                                        echo"<td style='text-align: left'><font color='black'>". $nombre_codigo . "</font></td>";
                                        echo"<td style='text-align: left'><font color='black'>". $nombre . "</font></td>";
                                        echo"<td style='text-align: left'><font color='black'>". $nombre_unidad. "</font></td>";
                                        echo"<td style='text-align: right'><font color='black'>". $cantidad. "</font></td>";
//                                        echo"<td><font color='black'>". $test['correo']. "</font></td>";


                                        echo"<td> <a href ='semielaborados_del.php?codigo=$id'>Eliminar</a></td>";
                                        echo "</tr>";
                                    }
                                    mysql_close($conn);
                                    ?>
                                </tr>

                            </table>
                            <br/>
                            <a href="semielaborados.php"><input type="button" value="Atras"></a>
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

</body>
</html>