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

        function mitadX(x){
            return screen.width / 2 - x / 2;
        }

        function mitadY(y){
            return screen.width / 2 - y ;
        }



        $(function() {

            var sumComa = new SumComa();

            $( "#datepicker1" ).datepicker({ dateFormat: 'yy-mm-dd' });
            $( "#datepicker2" ).datepicker({ dateFormat: 'yy-mm-dd' });
            var myDate = new Date();
            var mes = 0
            if(myDate.getMonth() < 10){
                mes = '0' + myDate.getMonth();
            }else{
                mes = myDate.getMonth()
            }
            var prettyDate =(myDate.getFullYear()  + '-' +mes) + '-' + myDate.getDate() ;
            $("#datepicker1").val(prettyDate);
            $("#datepicker2").val(prettyDate);





            $( "#buscar_articulo" ).click(function() {
                var win = window.open("venta_buscar_articulo.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=700, height=600,left="+mitadX(600)+",top=100");
                win.focus();
            });



            $( "#buscar_cliente" ).click(function() {
                var win = window.open("venta_buscar_cliente.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=780, height=600,left=270,top=100");
                win.focus();
            });

            $( "#buscar_vendedor" ).click(function() {
                var win = window.open("venta_buscar_vendedor.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=780, height=600,left=270,top=100");
                win.focus();
            });



            $( "#cantidad_unidad" ).bind('keyup keydown mouseup change focus',function(e){

                sumComa.add($( "#costo_unitario").val());
                sumComa.add($( "#cantidad_unidad").val());

                $( "#total_pagar" ).val(sumComa.getMul());

            });


            $('#form').submit(function() {
                $( "#costo_unitario_hi" ).val( $("#costo_unitario").val());
                $( "#existencia_articulo_hi" ).val( $("#existencia_articulo").val());

                return true; // return false to cancel form action
            });


        });
    </script>
    <!-- Beginning of compulsory code below -->
    <link href="/sicap/css/dropdown/dropdown.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="/sicap/css/dropdown/themes/flickr.com/default.ultimate.css" media="screen" rel="stylesheet" type="text/css" />
    <!-- / END -->
</head>
<body class="flickr-com">

<form method="post" name="venta" id="form">
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
            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>Módulo de Inventario | Ventas</strong></h1>

            <!-- Beginning of compulsory code below -->
            <br/><br/>


            <?php
            include("../../db.php");
            if (isset($_POST['submit'])){
//    foreach($_POST as $key => $value)
//        echo $key."=".$value .'<br/><br/>';

                ini_set('display_errors', 'On');
                ini_set('display_errors', 1);

                $id_venta = $_POST['id'];

                $sql = "select * from min_ventas where codigo=$id_venta";

                $result = mysql_query($sql);

                $test = mysql_fetch_array($result);

                if (!$result)
                {
                    die("Error: Data not found.. min_venta");
                }

                $codigo_articulo = $test['codigo_articulo'];
                $cantidad = $test['cantidad'];
                $costo_unidad = $test['costo_unidad'];
                $costo_total = $costo_unidad * $cantidad;


                /*-.--.-.-.*/


                if($test['devolucion'] == 'n'){


                    $fecha_actual = date("Y-n-j");

                    $sql = "UPDATE min_ventas SET devolucion='$fecha_actual'  WHERE codigo ='$id_venta'";


                    mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());


                    //_________________________________

                    $sql = "select * from min_valoracion where codigo_producto='$codigo_articulo'";


                    $result = mysql_query($sql);

                    $test = mysql_fetch_array($result);

                    if (!$result)
                    {
                        die("Error: Data not found.. de unudades");
                    }

                    $valoracion_unidades = $test['unidades'];
                    $valoracion_costo_total_ = $test['costo_total'];
                    $promedio_actual = $test['promedio_actual'];

                    $nueva_valoracion_unidades = $valoracion_unidades + $cantidad;

                    $tmp_costo_total = $promedio_actual * $cantidad;
                    $nueva_valoracion_costo_total = $valoracion_costo_total_ + $tmp_costo_total;



                    $sql = "UPDATE min_valoracion SET unidades='$nueva_valoracion_unidades',costo_total='$nueva_valoracion_costo_total',promedio_actual='".($nueva_valoracion_unidades*$nueva_valoracion_costo_total)."' WHERE codigo ='$codigo_articulo'";


                    mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());

                    require_once('../../clases/funciones.php');
                    $fecha = fecha_sicap();
                    $sql = "INSERT INTO min_valoracion_historico
( codigo_producto, unidades, costo_total, promedio_actual,fecha ,eliminado)
VALUES('$codigo_articulo', '$nueva_valoracion_unidades', '$nueva_valoracion_costo_total', '".($nueva_valoracion_unidades*$nueva_valoracion_costo_total)."', '$fecha');
";
                    $result = mysql_query($sql) or die('No se pudo guardar la información. valoraciones_historico '.mysql_error());

                }


//                /*-.-.-.-..-.-.-.--.-.-*/

            }

            ?>


            <!-- Beginning of compulsory code below -->


            <table border=none class="tablas-nuevas">
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Cliente</th>
                    <th>Fecha de Venta</th>
                    <th>Cantidad</th>
                    <th>Costo Unidad</th>
                    <th>Monto de Venta</th>


                </tr>
                <?php
                include("../../db.php");
                $result=mysql_query("SELECT * FROM min_ventas WHERE devolucion ='n' and codigo =" . $_GET['id']);


                while($test = mysql_fetch_array($result))
                {
                    //  calculos de horas
                    $id = $test['codigo'];
                    $codigo_articulo = $test['codigo_articulo'];
                    $codigo_cliente = $test['codigo_cliente'];
                    $fecha_venta = $test['fecha_venta'];


                    $cantidad = $test['cantidad'];
                    $costo_unidad = $test['costo_unidad'];



                    echo "<tr align='center'>";
                    echo"<td><font color='black'>" .$id."</font></td>";
                    echo"<td><font color='black'>". $codigo_articulo . "</font></td>";
                    echo"<td><font color='black'>". $codigo_cliente . "</font></td>";
                    echo"<td><font color='black'>". $fecha_venta . "</font></td>";
                    echo"<td><font color='black'>". $cantidad.  "</font></td>";
                    echo"<td><font color='black'>". $costo_unidad.  "</font></td>";
                    echo"<td><font color='black'>".($cantidad*$costo_unidad) . "</font></td>";
                    echo "</tr>";
                }
                mysql_close($conn);
                ?>


            </table>



            <!-- / END -->
            <br/><br/>
            <form action="" id="estilo_boton" method="post">
                <input type="hidden" name="id" value="<?php echo($_GET['id'])?>" />
                <table>
                    <tr>
                        <td>
                            <input type="submit" value="Guardar datos" name="submit">
                        </td>
                        <td>
                            <a href="venta_devolucion.php"><input type="button" value="Atras"></a>
                        </td>

                    </tr>
                </table>
                </form>
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
