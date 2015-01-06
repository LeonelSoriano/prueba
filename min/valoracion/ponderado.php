<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html >
<head>
    <title>SICAPC | Sistema Integral de Costos</title>
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
                            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Inventario | Valoracion Ponderada</strong></h1>
                            <br/><br/><br/>
                            <table style="text-align: center"  border=none class="tablas-nuevas" >

                                <thead>
                                <tr>
                                    <th colspan=1 ">   </th>

                                    <th colspan=3 ">Inventario Inicial</th>
                                    <th colspan=3 ">Compra</th>
                                    <th colspan=3 ">valoracion</th>
                                    <th colspan=3 ">Uso Consumo</th>
                                    <th colspan=3 ">Inventario Final</th>

                                </tr>
                                </thead>
                                <tbody>
                                <tr>

                                    <th>  Fecha  </th>



                                    <th>Unidades</th>
                                    <th>Costo untario</th>
                                    <th>Costo total</th>

                                    <th>Unidades</th>
                                    <th>Costo untario</th>
                                    <th>Costo total</th>


                                    <th>Unidades</th>
                                    <th>Costo untario</th>
                                    <th>Costo total</th>

                                    <th>Unidades</th>
                                    <th>Costo untario</th>
                                    <th>Costo total</th>


                                    <th>Unidades</th>
                                    <th>Costo untario</th>
                                    <th>Costo total</th>

                                </tr>


                                <?php
                               include("../../db.php");
                                $filtro_articulo = $_GET['codigo'];

                                $result=mysql_query("SELECT * FROM min_compra WHERE codigo_articulo ='$filtro_articulo' AND devolucion ='n' ORDER  BY  fecha_compra");



                                /** compra=  descripcion(0)
                                             fecha(key)
                                             unidades(1)
                                             costo total(2)
                                             unidades_venta(3)
                                            */
                                $array_compra ;


                                while($test = mysql_fetch_array($result)){

                                    $id = $test['codigo'];
                                    $id_producto = $test['codigo_articulo'];
                                    $fecha = $test['fecha_compra'];
                                    $cantidad = $test['cantidad'];
                                    $costo_total = $test['costo_total'];

                                    $array_compra[$fecha][2] = $array_compra[$fecha][2] + $costo_total;
                                    $array_compra[$fecha][1] = $array_compra[$fecha][1] + $cantidad;
                                    //echo( $array_compra[$fecha][2] . '</br>');
                                }


                                $result=mysql_query("SELECT * FROM min_ventas WHERE codigo_articulo ='$filtro_articulo' AND devolucion = 'n'");


                                while($test = mysql_fetch_array($result)){
                                    $id = $test['codigo'];
                                    $id_producto = $test['codigo_articulo'];
                                    $fecha = $test['fecha_venta'];
                                    $cantidad =  $test['cantidad'];

                                    $array_compra[$fecha][3] = $array_compra[$fecha][3] + $cantidad;

                                }

                                $result=mysql_query("SELECT * FROM min_uso_consumo WHERE cod_articulo ='$filtro_articulo'");

                                while($test = mysql_fetch_array($result)){

                                    $fecha = $test['fecha_uso'];
                                    $cantidad =  $test['cantidad_despacho'];

                                    $array_compra[$fecha][3] += $array_compra[$fecha][3] + $cantidad;
                                }


                                $result=mysql_query("SELECT * FROM min_requisicion WHERE codigo_articulo ='$filtro_articulo' AND devolucion = 'n'");

                                while($test = mysql_fetch_array($result)){

                                    $fecha = $test['fecha_uso'];

                                    $cantidad =  $test['cantidad_despacho'];

                                    $array_compra[$fecha][3] += $array_compra[$fecha][3] + $cantidad;

                                }






                                $tmp_costo_unitario = 0;
                                $acum_unidades = 0;
                                $acum_total = 0;



                                foreach ($array_compra as $key => $value){
                                    echo "<tr align='center'>";

                                    echo"<td><font color='black'>" . $key ."</font></td>";


                                    echo"<td><font color='black'>" . floor($acum_unidades *100)/100 ."</font></td>";
                                    echo"<td><font color='black'>" . floor($tmp_costo_unitario * 100)/100 ."</font></td>";
                                    echo"<td><font color='black'>" . floor($acum_total*100)/100 ."</font></td>";


                                    $tmp_unitario_compra  = $value[2] / $value[1];

                                    echo"<td><font color='black'>" . floor($value[1]*100)/100 ."</font></td>";
                                    echo"<td><font color='black'>" . floor($tmp_unitario_compra * 100)/100 ."</font></td>";
                                    echo"<td><font color='black'>" . floor($value[2]*100)/100 ."</font></td>";

                                    $acum_unidades += $value[1];
                                    $acum_total += $value[2];


                                    $tmp_costo_unitario = $acum_total / $acum_unidades;
                                    echo"<td><font color='black'>" . floor($acum_unidades *100)/100 ."</font></td>";
                                    echo"<td><font color='black'>" . floor($tmp_costo_unitario*100)/100 ."</font></td>";
                                    echo"<td><font color='black'>" . floor($acum_total*100)/100 ."</font></td>";



                                    echo"<td><font color='black'>" . floor($value[3]*100)/100 ."</font></td>";
                                    if($value[3] != ''){
                                        echo"<td><font color='black'>" . floor($tmp_costo_unitario*100)/100 ."</font></td>";
                                        echo"<td><font color='black'>" . floor(($tmp_costo_unitario * $value[3])*100)/100 ."</font></td>";
                                    }else{
                                        echo"<td>0</td>";
                                        echo"<td>0</td>";
                                    }


                                    $acum_unidades -=$value[3];
                                    $acum_total = $tmp_costo_unitario * $acum_unidades;


                                    echo"<td><font color='black'>" . floor($acum_unidades*100)/100 ."</font></td>";
                                    echo"<td><font color='black'>" . floor($tmp_costo_unitario*100)/100 ."</font></td>";
                                    echo"<td><font color='black'>" . floor($acum_total*100)/100 ."</font></td>";

                                }


                                echo "</tr>";
                                mysql_close($conn);
                                ?>
                                </tbody>
                            </table>
                            <br/><br/>
                            <a href="valoracion.php"><input type="button" value="Atras"></a>
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
