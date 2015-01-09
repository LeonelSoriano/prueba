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
<link href="../../css/htmlDatePicker.css" rel="stylesheet">
<link href="../../css/stylesheet.css" rel="stylesheet" type="text/css" />
<link href="../../css/ui-lightness/jquery-ui-1.10.4.custom.css" rel="stylesheet">
<script src="../../js/jquery-1.10.2.js"></script>
<script src="../../js/jquery-ui-1.10.4.custom.js"></script>
<script src="../../js/clasesVarias.js"></script>
<script>

</script>
<!-- Beginning of compulsory code below -->
<link href="/sicap/css/dropdown/dropdown.css" media="screen" rel="stylesheet" type="text/css" />
<link href="/sicap/css/dropdown/themes/flickr.com/default.ultimate.css" media="screen" rel="stylesheet" type="text/css" />
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
                            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>Módulo de Inventario | Valoración</strong></h1>
                            <br/>


                            <?php

                            include("../../db.php");
                            include_once("../../clases/funciones.php");
                            include_once("../../clases/Paginador.php");

                            $a = new Paginador("min_productos_servicios",$_GET['paso']);
                            $a->print_sql_foot();

                            ?>

                            <br/>
                            <br/>
                            <!-- acabavan los filtros -->
                            <table border=none class="tablas-nuevas">

                                <tr>
                                    <th style="text-align: center">Nombre</th>
                                    <th style="text-align: center">Unidades</th>

                                    <th style="text-align: center">Costo total</th>
                                    <th style="text-align: center">Costo Unitario</th>

                                    <th></th>
                                </tr>
                                <?php


                                $result=mysql_query("SELECT
    min_productos_servicios.codigo as codigo_producto,
	min_valoracion.unidades as unidades,
	min_valoracion.costo_total as costo_total,
	min_valoracion.promedio_actual as promedio_actual,
	min_productos_servicios.nombre as nombre
FROM
    min_productos_servicios
        INNER JOIN
    min_valoracion ON min_valoracion.codigo_producto = min_productos_servicios.codigo
ORDER BY min_productos_servicios.nombre "  . $a->print_sql_limit());
                                while($test = mysql_fetch_array($result))
                                {

                                    $codigo_producto = $test['codigo_producto'];
                                    $unidades = $test['unidades'];
                                    $costo_total = $test['costo_total'];
                                    $promedio_actual = $test['promedio_actual'];

                                    $nombe_producto = $test['nombre'];

                                    echo "<tr align='center'>";
                                    echo"<td>" . $nombe_producto."</td>";
                                    echo"<td style='text-align: right'>" .formatear_ve($unidades)."</td>";
                                    echo"<td style='text-align: right' >" .formatear_ve($costo_total)."</td>";
                                    echo"<td style='text-align: right'>" . formatear_ve($promedio_actual)."</td>";
                                    echo"<td> <a href ='ponderado.php?codigo=$codigo_producto'>Ponderado</a></td>";

                                    echo "</tr>";
                                }
                                mysql_close($conn);
                                ?>

                            </table>
                            <br/>
                            <?php

                            $a->print_sql_foot();
                            ?>

                            <br/><br/>
                            <a href="../../min_menu.php"><input type="button" value="Atras"></a>
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
