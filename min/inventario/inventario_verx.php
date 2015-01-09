<?php
header("Content-Type: text/html;charset=utf-8");
include("../../db.php");
require_once("../../clases/funciones.php");

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


    <script src="../../js/jquery-1.10.2.js"></script>
    <script src="../../js/jquery-ui-1.10.4.custom.js"></script>


    <!-- / END -->

    <script>

        $(function(){


            var codigo = "";

            $("#inventario").bind("change",function(){
                var optionSelected = $("option:selected", this);
                var valueSelected = this.value;
                codigo = valueSelected;

                var parametros = { codigo : codigo };

                $.ajax({
                    data:  parametros,
                    url:   "ajax_ver_inventarios.php",
                    type:  "post",
                    beforeSend: function () {
                        $("#resultado").html("<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" +
                            '<img src="../../images/ajax-loader.gif" alt="Ajax Cargando" height="42" width="42">");
                    },
                    success:  function (response) {

                        $("#tabla_nueva").html(response);
                    }
                });


            });

        });


    </script>


</head>
<body class="flickr-com">

<form method="post" name="inventario_ver">

    <div id="body_bottom_bgd">
        <div id=""> <!--<img src="images/Logo_Inventario.png"/>-->
            <!--</div>-->                <!-- Menu -->
            <!--  ?php include 'include/nav.php'; ?>-->
            <div align="justify" id="right_col" style="width: 80%">
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
                            <p style="margin-left: 40px">
                                <label>Tipo de Inventario</label>

                                        <select id="inventario">
                                            <option>Total Inventario</option>
                                            <?php
                                            $result=mysql_query("SELECT tipo FROM min_tipo_inventario");
                                            while($test = mysql_fetch_array($result)){

                                                echo"<option>". $test['tipo']."</option>";
                                            }

                                            ?>
                                        </select>
                            </p>


                            <br/><br/>
                            <table border=none class="tablas-nuevas" id="tabla_nueva">

                                <tr style="text-align: center">
                                    <th >Código</th>

                                    <th>Nombre de Artículo</th>


                                    <th>Fecha Adquisicion</th>
                                    <th>Ubicación</th>
                                    <th>Tipo de Inventario</th>
                                    <th>Unidad de Medida</th>

                                    <th>Existencia Actual (Unidades)</th>
                                    <th> Valor Unidad </th>
                                    <th>Existencia Actual (Bs)</th>
                                    <th></th>

                                </tr>

                                <tr>
                                    <?php
                                        $result=mysql_query("SELECT * FROM min_productos_servicios ORDER BY nombre");
                                    $acum_costo_total = 0;
                                    while($test = mysql_fetch_array($result))
                                    {
                                        $id = $test['codigo'];


                                        $codigo_alias = $test['codigo_alias'];
                                        $nombre_articulo = $test['nombre'];

                                        $fecha_adquisicion = $test['fecha_adquisicion'];
                                        $ubicacion = $test['ubicacion'];
                                        $inventario = $test['inventario'];
                                        $mco_unidad = $test['mco_unidad'];




                                        $sql2 ="SELECT tipo FROM min_tipo_inventario where codigo='" . $inventario . "'";
                                        $result2 = mysql_query($sql2);
                                        $test2 = mysql_fetch_array($result2);
                                        if (!$result2)
                                        {
                                            die("Error: Data not found.. de tipo inventario");
                                        }
                                        $nombre_inventario = $test2['tipo'];



                                        $sql2 ="SELECT descripcion FROM mco_unidad where codigo='" . $mco_unidad . "'";
                                        $result2 = mysql_query($sql2);
                                        $test2 = mysql_fetch_array($result2);
                                        if (!$result2)
                                        {
                                            die("Error: Data not found.. de tipo unidad");
                                        }
                                        $nombre_unidad = $test2['descripcion'];



                                        $sql2 ="SELECT * FROM min_valoracion where codigo_producto='" . $id . "'";
                                        $result2 = mysql_query($sql2);
                                        $test2 = mysql_fetch_array($result2);
                                        if (!$result2)
                                        {
                                            die("Error: Data not found.. de tipo unidad");
                                        }
                                        $cantidad_existente = $test2['unidades'];
                                        $costo_total = $test2['costo_total'];
                                        $costo_unidad = $test2['promedio_actual'];
                                        $acum_costo_total +=$costo_total;


                                        echo"<td><font color='black'>". $codigo_alias . "</font></td>";
                                        echo"<td><font color='black'>". $nombre_articulo . "</font></td>";

                                        echo"<td><font color='black'>". $fecha_adquisicion. "</font></td>";
                                        echo"<td><font color='black'>". $ubicacion. "</font></td>";
                                        echo"<td><font color='black'>".$nombre_inventario . "</font></td>";
                                        echo"<td><font color='black'>".$nombre_unidad . "</font></td>";
                                        echo"<td style='text-align: right'><font color='black'>".formatear_ve($cantidad_existente) . "</font></td>";
                                        echo"<td style='text-align: right'><font color='black'>".formatear_ve($costo_unidad) . "</font></td>";
                                        echo"<td style='text-align: right'><font color='black'>".formatear_ve($costo_total) . "</font></td>";


                                        echo"<td> <a href ='inventario_mod.php?codigo=$id'>Modificar</a>";

                                        echo "</tr>";

                                    }
                                    echo"<td><font color='black'>Total</font></td>";
                                    echo"<td><font color='black'></font></td>";

                                    echo"<td><font color='black'></font></td>";
                                    echo"<td><font color='black'></font></td>";
                                    echo"<td><font color='black'></font></td>";
                                    echo"<td><font color='black'></font></td>";
                                    echo"<td><font color='black'></font></td>";
                                    echo"<td><font color='black'></font></td>";


                                    echo"<td><font color='black'>".formatear_ve($acum_costo_total) . "</font></td>";
                                    echo"<td><font color='black'></font></td>";


                                    ?>
                                </tr>


                            </table>
                            <br/><br/><br/>
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