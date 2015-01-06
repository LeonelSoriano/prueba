<?php

header("Content-Type: text/html;charset=utf-8");
include_once("../../clases/funciones.php");
include_once("../../clases/Validate.php");
include_once("../../db.php");


ini_set('display_errors', 'On');
ini_set('display_errors', 1);

?>


<?php

    if(isset($_GET['codigo'])){

        $codigo = $_GET['codigo'];

        $sql = "SELECT * FROM prc_orden_trabajo WHERE codigo ='$codigo' ";

        $result=mysql_query($sql);

        $test = mysql_fetch_array($result);

        $produccion_planificada = $test['produccion_planificada'];

        $orden_trabajo = $test['codigo_alias'];

        $codigo_producto = $test['codigo_producto'];


        $sql = "SELECT * FROM min_productos_servicios WHERE codigo = '$codigo_producto'";

        $result=mysql_query($sql);

        $test = mysql_fetch_array($result);

        $nombre_producto = $test['nombre'];


    }else{


    // redirrecion es directorio actual
        $host  = $_SERVER['HTTP_HOST'];
        $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

        $extra = 'ver_ordenes_trabajo.php';

        header("Location: http://$host$uri/$extra");


    }

?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>SICAP | Sistema Integral de Costos</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="author" content="Tomas Bagdanavicius, http://www.lwis.net/free-css-drop-down-menu/" />
    <meta name="keywords" content=" css, dropdowns, dropdown menu, drop-down, menu, navigation, nav, horizontal, vertical left-to-right, vertical right-to-left, horizontal linear, horizontal upwards, cross browser, internet explorer, ie, firefox, safari, opera, browser, lwis" />
    <meta name="description" content="Clean, standards-friendly, modular framework for dropdown menus" />
    <link href="../../css/helper.css" media="screen" rel="stylesheet" type="text/css" />

    <script src="../../js/jquery-1.10.2.js"></script>
    <script src="../../js/jquery-ui-1.10.4.custom.js"></script>
    <link href="../../css/stylesheet.css" rel="stylesheet" type="text/css" />


    <!-- Beginning of compulsory code below -->

    <script type="text/javascript">

        function isNumber(n) {
            n = n.replace(',','.');
            return !isNaN(parseFloat(n)) && isFinite(n);
        }


        $(function() {


            $( "#buscar" ).click(function() {
                var ventana_nueva = window.open("buscar_articulos.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=700, height=600 ,left=600,top=90");
                ventana_nueva.focus();

            });

            $("#guardar").click(function(){

            });



        });

    </script>

</head>


<body class="flickr-com">
<!--<p><a href="mrh_menu.html" class="main-site">Principal</a></p>-->
<!--<h1><img src="images/seleccion_sicap_archivos/image002.jpg" alt="flickr" />Módulo de Recursos Humanos | Cargo</h1>-->
<!-- Beginning of compulsory code below -->

<form method="post" accept-charset="UTF-8" name="agregar">

    <div id="body_bottom_bgd">
        <div id=""> <!--<img src="images/Logo_Inventario.png"/>-->
            <!--</div>-->                <!-- Menu -->
            <!--  ?php include 'include/nav.php'; ?>-->
            <div align="justify" id="right_col" >

                <?php

                if(isset($_POST['submit'])){


                    $codigo_articulo = $_POST['codigo_articulo_hi'];
                    $produccion_planificada = $_POST['cantidad_estandar'];
                    $fecha_actual = fecha_sicap();
                    $orden_trabajo = $_POST['orden_trabajo'];


                    $validations = array(
                        array('nombre' => 'codigo_articulo_hi',
                            'requerida' => true),


                        array('nombre' => 'cantidad_estandar',
                            'error' => 'cantidad',
                            'regla' => 'float',
                            'nombre_salida' => 'Cantidad Estandar',
                            'tipo' => ',',
                            'requerida' => true),
                    );

                    $validated = new Validate($validations,$_POST);
                    $validated->validate();

                    if(!$validated->getIsError()){

                        $sql = "UPDATE prc_orden_trabajo SET codigo_producto = '$codigo_articulo',produccion_planificada = '$produccion_planificada',
                            fecha_inicio='$fecha_actual',codigo_alias='$orden_trabajo' WHERE codigo='$codigo' ";

                        $result = mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());


                        // redirrecion es directorio actual
                        $host  = $_SERVER['HTTP_HOST'];
                        $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

                        $extra = 'ver_ordenes_trabajo.php';

                        header("Location: http://$host$uri/$extra");


                    }else{
                        echo("hubo errores al guardar");
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
                            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Inventario | Empresa</strong></h1>

                            <br/><br/>
                            <table BORDER="0" CELLSPACING="6" WIDTH="380">

                                <tr>
                                    <td><label >Nombre Artículo</label></td>
                                    <td style="width: 155px"><input type="text" name="articulo_nombre" placeholder="articulo" id="articulo_nombre" value="<?php echo($nombre_producto)?>" disabled></td>
                                    <td><input type="button" value="Buscar" id="buscar"></td>
                                    <input type="hidden" name="codigo_articulo_hi" value="<?php echo($codigo_producto); ?>"/>

                                </tr>


                                <tr>
                                    <td><label >Orden de Trabajo</label></td>
                                    <td style="width: 155px"><input type="text" name="orden_trabajo"  id="orden_trabajo" value="<?php echo($orden_trabajo); ?>"></td>

                                </tr>



                                <tr>
                                    <td><label >Producción Planificada</label></td>
                                    <td><input type="text" id="cantidad_estandar" name="cantidad_estandar" value="<?php echo($produccion_planificada); ?>"/></td>

                                </tr>


                                <tr>
                                    <td><br/><br/><br/></td>
                                    <td></td>
                                    <td><input id="guardar" name="submit" type="submit" value="Guardar"/></td>
                                </tr>


                                <table>
                                    <tr>
                                        <td><a href="../../prc_menu.php"><input type="button" value="Atras"></a> </td>
                                        <td><a href="ver_ordenes_trabajo.php"><input type="button" value="Ver Ordenes Activas"></a> </td>


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



<?php

mysql_close($conn);

?>