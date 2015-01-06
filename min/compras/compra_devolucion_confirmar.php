<?php
header("Content-Type: text/html;charset=utf-8");

include("../../db.php");

ini_set('display_errors', 'On');
ini_set('display_errors', 1);


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



    <div id="body_bottom_bgd">
        <div id=""> <!--<img src="images/Logo_Inventario.png"/>-->
            <!--</div>-->                <!-- Menu -->
            <!--  ?php include 'include/nav.php'; ?>-->
            <div align="justify" id="right_col" style="width: 85%">


            <?php
            include("../../db.php");
            if (isset($_POST['submit'])){

                $id_compra = $_POST['id'];


                $sql = "select * from min_compra where codigo=$id_compra";


                $result = mysql_query($sql);

                $test = mysql_fetch_array($result);


                if (!$result)
                {
                    die("Error: Data not found.. de unudades");
                }

                $codigo_articulo = $test['codigo_articulo'];

                $cantidad = $test['cantidad'];

                $costo_total = $test['costo_total'];

                if($test['devolucion'] == 'n'){

                   /*-.--.-.-.*/


                       $fecha_actual = date("Y-n-j");

                       $sql = "UPDATE min_compra SET devolucion='$fecha_actual'  WHERE codigo ='$id_compra'";


                       mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());

                    /*-.-.-.-..-.-.-.--.-.-*/


                    $sql = "select * from min_valoracion where codigo_producto='$codigo_articulo'";
                    $result = mysql_query($sql);

                    $test = mysql_fetch_array($result);

                    if (!$result)
                    {
                        die("Error: Data not found.. de unudades");
                    }

                    $valoracion_unidades = $test['unidades'];
                    $valoracion_costo_total_ = $test['costo_total'];

                    $nueva_valoracion_unidades = $valoracion_unidades - $cantidad;

                    $nueva_valoracion_costo_total = $valoracion_costo_total_ - $costo_total;


                    if($nueva_valoracion_unidades == 0 || $nueva_valoracion_costo_total < 0 || $nueva_valoracion_unidades < 0)
                        $nueva_valoracion_promedio_actual = 0;
                    else
                        $nueva_valoracion_promedio_actual = $nueva_valoracion_costo_total / $nueva_valoracion_unidades;



                    $sql = "UPDATE min_valoracion SET unidades='$nueva_valoracion_unidades',costo_total='$nueva_valoracion_costo_total',promedio_actual='$nueva_valoracion_promedio_actual'  WHERE codigo ='$codigo_articulo'";


                    mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());

                    //peps
                    $sql=  "UPDATE min_inventario_cola SET cantidad=0,costo_total =0,costo_unidad=0,usado='d' WHERE id_compra ='$id_compra'";


                    mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());




                    $sql= "UPDATE min_inventario_ueps SET cantidad=0,costo_total =0,costo_unidad=0,usado='d' WHERE id_compra ='$id_compra'";

                    mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());


                    echo('<div id="done_app"><marquee scrolldelay="100">Datos Guardados Correctamente</marquee></div>');

                }else{
                    echo('<div id="error_app"><marquee scrolldelay="120">Producto ya fue devuelto</marquee></div>');

                }

            }

        ?>

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
                                $result=mysql_query("SELECT * FROM min_compra WHERE devolucion ='n' and codigo =" . $_GET['id']);


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


                                    echo "<tr align='center'>";
                                    echo"<td><font color='black'>" .$id."</font></td>";
                                    echo"<td><font color='black'>". $codigo_articulo . "</font></td>";
                                    echo"<td><font color='black'>". $codigo_proveedor . "</font></td>";
                                    echo"<td><font color='black'>". $fecha_compra . "</font></td>";
                                    echo"<td><font color='black'>". $cantidad.  "</font></td>";
                                    echo"<td><font color='black'>". $gastos_varios.  "</font></td>";
                                    echo"<td><font color='black'>". $monto_factura.  "</font></td>";
                                    echo"<td><font color='black'>". $costo_total .  "</font></td>";
                                    echo "</tr>";
                                }
                                mysql_close($conn);
                                ?>



                            </table>
                            <br/><br/>
                            <table>
                            <form action="" id="estilo_boton" method="post">
                                <input type="hidden" name="id" value="<?php echo($_GET['id'])?>" />
                                <table>
                                    <tr>
                                        <td>
                                            <input type="submit" value="Guardar datos" name="submit">&nbsp;
                                        </td>
                                        <td>
                                            <a href="compra_devolucion.php"><input type="button" value="Atras"></a>
                                        </td>


                                    </tr>
                                </table>
                            </form>

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


</body>
</html>