<?php

header("Content-Type: text/html;charset=utf-8");
setlocale(LC_CTYPE, 'es_VE.UTF-8');
include_once("../../clases/funciones.php");
include_once("../../clases/Validate.php");
include_once("../../db.php");


ini_set('display_errors', 'On');
ini_set('display_errors', 1);


if(isset($_POST['submit'])){

    $codigo_articulo = $_POST['codigo_articulo_hi'];
    $produccion_planificada = $_POST['cantidad_estandar'];
    $fecha_actual = fecha_sicap();
    $orden_trabajo = strtoupper($_POST['orden_trabajo']);


    $sql = "SELECT count(*) as total FROM prc_orden_trabajo WHERE prc_orden_trabajo.codigo_alias = '$orden_trabajo'";


    $result = mysql_query($sql);

    $test = mysql_fetch_array($result);

    $total = $test['total'];

    if($total != '0'){
        send_error_redirect(true,"Orden ya Existe");die;
    }



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


        $sql = "INSERT INTO prc_orden_trabajo(codigo_producto,produccion_planificada,fecha_inicio,codigo_alias)
                              VALUES ('$codigo_articulo','$produccion_planificada','$fecha_actual','$orden_trabajo')";

        $result = mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());

        $id_orden =  mysql_insert_id();



        $sql = "SELECT * FROM prc_etapas where codigo_producto='$codigo_articulo' AND desactivo = 'n'";

        $result=mysql_query($sql);

        while($test = mysql_fetch_array($result)){

            $codigo_producto = $test['codigo_producto'];
            $codigo_departamento = $test['codigo_departamento'];




            $sql2 = "INSERT INTO prc_orden_trabajo_etapas(codigo_orden_trabajo,codigo_producto,codigo_departamento)
                                    VALUES('$id_orden','$codigo_producto','$codigo_departamento')";


            $result2 = mysql_query($sql2) or die('a. '.mysql_error());

        }



        $sql = "SELECT * FROM prc_detalle_etapa where codigo_producto='$codigo_articulo'";

        $result=mysql_query($sql);

        while($test = mysql_fetch_array($result)){

            $cantidad_estandar = $test['cantidad_estandar'];

            $codigo_etapa = $test['codigo_etapa'];

            $codigo_producto_detalle = $test['codigo_producto_detalle'];

            $codigo_producto = $test['codigo_producto'];





            $fecha = fecha_sicap();
            $fecha = explode('-',$fecha);
            $fecha_sql = $fecha[0] . '-' . $fecha[1];

            $sql3 = "SELECT * FROM min_valoracion_backup WHERE min_valoracion_backup.codigo_producto = '$codigo_producto_detalle' AND min_valoracion_backup.fecha like '".$fecha_sql."%'";
//echo($sql3);

            $result3=mysql_query($sql3);
            $test3 = mysql_fetch_array($result3);
            $promedio_actual = $test3['promedio_actual'];

            $sql2 = "INSERT INTO prc_orden_trabajo_detalle_etapa
                                    (codigo_orden_trabajo,cantidad_estandar,codigo_etapa,codigo_producto_detalle,
                                    codigo_producto,valor_standar)
                                    VALUES('$id_orden','$cantidad_estandar','$codigo_etapa','$codigo_producto_detalle',
                                    '$codigo_producto','$promedio_actual')";

            $result2 = mysql_query($sql2) or die('b. '.mysql_error());
        }

        send_error_redirect(false,'Datos Guardados Exitosamente');
        die;

    }else{
        send_error_redirect(true,"Hay Errores en la Información del formulario");die;
    }


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



//            var parametros = { codigo_articulo :  coidgo_articulo, cantidad: cantidad, codigo_etapa: codigo_etapa,
//                codigo_producto: codigo_producto};
//
//            $.ajax({
//                data:  parametros,
//                url:   'get_detalle_etapa.php',
//                type:  'post',
//                beforeSend: function () {
//                    $("#resultado").html('<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' +
//                        '<img src="../../images/ajax-loader.gif" alt="Ajax Cargando" height="42" width="42">');
//                },
//                success:  function (response) {
//                    $("#tabla_resultado").html(response);
//                }
//            });


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



                <div id="header">
                </div>

                <div id="">
                    <div id="firefoxbug"><!-- firefoxbug -->
                        <!-- <div id="blue_line"></div>-->
                        <div class="dynamicContent" align="left">
                            <!--  <h1>Inicio</h1>-->
                            <!--<p><a href="seleccion_sicap.html" class="main-site">Principal</a></p>-->
                            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Producción | Crear Orden</strong></h1>

                            <br/>

                            <?php

                            if(isset($_GET['msg'])){
                                $error =  $_GET['error'];

                                $msg = $_GET['msg'];

                                if($error == 'true'){
                                    echo('<div id="error_app"><marquee scrolldelay="100">'.$msg.'</marquee></div>');
                                }else if($error == 'false'){
                                    echo('<div id="done_app"><marquee scrolldelay="100">'.$msg.'</marquee></div>');

                                }

                            }

                            ?>




                            <br/>
                            <table BORDER="0" CELLSPACING="6" WIDTH="380">

                                <tr>
                                    <td><label >Nombre Artículo</label></td>
                                    <td style="width: 155px"><input type="text" name="articulo_nombre" placeholder="articulo" id="articulo_nombre" disabled></td>
                                    <td><input type="button" value="Buscar" id="buscar"></td>
                                    <input type="hidden" name="codigo_articulo_hi"/>

                                </tr>


                                <tr>
                                    <td><label >Orden de Trabajo</label></td>
                                    <td style="width: 155px"><input type="text" name="orden_trabajo"  id="orden_trabajo" ></td>

                                </tr>



                                <tr>
                                    <td><label >Producción Planificada</label></td>
                                    <td><input type="text" id="cantidad_estandar" name="cantidad_estandar"/></td>

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





