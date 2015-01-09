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
            <div align="justify" id="right_col"  style="width: 90%">
                <div id="header">
                </div>
                <div id="">
                    <div id="firefoxbug" ><!-- firefoxbug -->
                        <!-- <div id="blue_line"></div>-->
                        <div class="dynamicContent" align="left" >
                            <!--  <h1>Inicio</h1>-->
                            <!--<p><a href="seleccion_sicap.html" class="main-site">Principal</a></p>-->
                            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Inventario | Productos y servicios</strong></h1>
                            <br/><br/>
                            <table border=none class="tablas-nuevas">

                                <tr>
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Proveedor</th>
                                    <th>Fecha de Compra</th>
                                    <th>Cantidad</th>
                                    <th>Gastos Varios</th>
                                    <th>Monto de Factura</th>
                                    <th>Costo Total</th>

                                </tr>
                                <?php
                                include("../../db.php");
                                $result=mysql_query("SELECT * FROM min_compra WHERE devolucion ='n' order by codigo ");

                                while($test = mysql_fetch_array($result))
                                {
                                    //  calculos de horas
                                    $id = $test['codigo'];
                                    $codigo_articulo = $test['codigo_articulo'];
                                    $codigo_proveedor = $test['codigo_proveedor'];
                                    $fecha_compra = $test['fecha_compra'];


                                    $cantidad = $test['cantidad'];
                                    $gastos_varios = $test['gastos_varios'];
                                    $monto_factura = $test['monto_factura'];

                                    $costo_total = $test['costo_total'];

                                    $result2=mysql_query("SELECT nombre FROM min_productos_servicios where codigo = $codigo_articulo");

                                    $test2 = mysql_fetch_array($result2);
                                    $nombre_producto = $test2['nombre'];



                                    echo "<tr align='center'>";
                                    echo"<td><font color='black'>" .$id."</font></td>";
                                    echo"<td><font color='black'>". $codigo_articulo . "</font></td>";
                                    echo"<td><font color='black'>". $nombre_producto . "</font></td>";
                                    echo"<td><font color='black'>". $fecha_compra . "</font></td>";
                                    echo"<td><font color='black'>". $cantidad.  "</font></td>";
                                    echo"<td><font color='black'>". $gastos_varios.  "</font></td>";
                                    echo"<td><font color='black'>". $monto_factura.  "</font></td>";
                                    echo"<td><font color='black'>". $costo_total .  "</font></td>";
                                    echo '<td>  <a href="compra_devolucion_confirmar.php?id='.$id.'"> Devolución </a> </td>';
                                    echo "</tr>";
                                }
                                mysql_close($conn);
                                ?>

                            </table>
                            <br/><br/><br/>
                            <a href="compras.php"><input type="button" value="Atras"></a>
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