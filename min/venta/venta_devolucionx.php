<?php
header("Content-Type: text/html;charset=utf-8");

include("../../db.php");

?>


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

<form method="post" name="inventario_ver">

    <div id="body_bottom_bgd">
        <div id=""> <!--<img src="images/Logo_Inventario.png"/>-->
            <!--</div>-->                <!-- Menu -->
            <!--  ?php include 'include/nav.php'; ?>-->
            <div align="justify" id="right_col" style="width: 75% " >
                <div id="header">
                </div>
                <div id="">
                    <div id="firefoxbug"><!-- firefoxbug -->
                        <!-- <div id="blue_line"></div>-->
                        <div class="dynamicContent" align="left">
                            <!--  <h1>Inicio</h1>-->
                            <!--<p><a href="seleccion_sicap.html" class="main-site">Principal</a></p>-->
                            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Inventario | Productos y servicios</strong></h1>

                            <br/><br/>
                                <table border=none class="tablas-nuevas">
                                    <tr>

                                        <th>Código</th>
                                        <th>Producto</th>
                                        <th>Empleado</th>
                                        <th>Fecha venta</th>
                                        <th>Fecha Entrega</th>
                                        <th>Codígo Factura</th>
                                        <th>Cantidad</th>
                                        <th>Costo Unidad</th>


                                    </tr>
                                    <?php
                                    include("../../db.php");
                                    $result=mysql_query("SELECT * FROM min_ventas WHERE devolucion ='n' order by codigo ");

                                    while($test = mysql_fetch_array($result))
                                    {
                                        //  calculos de horas
                                        $id = $test['codigo'];
                                        $codigo_articulo = $test['codigo_articulo'];
                                        $codigo_cliente = $test['codigo_cliente'];
                                        $fecha_venta = $test['fecha_venta'];


                                        $fecha_entrega = $test['fecha_entrega'];
                                        $codigo_factura = $test['codigo_factura'];
                                        $costo_unidad = $test['costo_unidad'];
                                        $cantidad = $test['cantidad'];

                                        $result2=mysql_query("SELECT nombre FROM min_productos_servicios WHERE codigo ='$codigo_articulo'");

                                        $test2 = mysql_fetch_array($result2);
                                        $nombre_articulo =  $test2['nombre'];


                                        echo "<tr align='center'>";
                                        echo"<td><font color='black'>" .$id."</font></td>";
                                        echo"<td><font color='black'>". $nombre_articulo . "</font></td>";
                                        echo"<td><font color='black'>". $codigo_cliente . "</font></td>";
                                        echo"<td><font color='black'>". $fecha_venta . "</font></td>";
                                        echo"<td><font color='black'>". $fecha_entrega.  "</font></td>";
                                        echo"<td><font color='black'>". $codigo_factura.  "</font></td>";
                                        echo"<td><font color='black'>". $cantidad.  "</font></td>";
                                        echo"<td><font color='black'>". $costo_unidad.  "</font></td>";
                                        echo '<td><a href="venta_devolucion_confirmar.php?id='.$id.'">Devolucion</a></td>';
                                        echo "</tr>";
                                    }
                                    mysql_close($conn);
                                    ?>
                                </table>

                                <!-- / END -->
                                <table></table>


                            <br/><br/><br/>
                            <a href="venta.php"><input type="button" value="Atras"></a>
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