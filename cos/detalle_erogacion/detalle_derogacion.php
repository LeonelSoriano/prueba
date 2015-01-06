<?php

header("Content-Type: text/html;charset=utf-8");
include_once("../../clases/funciones.php");
include_once("../../clases/Validate.php");
include_once("../../db.php");


ini_set('display_errors', 'On');
ini_set('display_errors', 1);


if(isset($_POST['submit'])){

    $codigo_erogacion = $_POST['codigo_erogacion_hi'];
    $fecha_actual = $_POST['fecha'];
    $cuenta_contable = $_POST['cuenta_contable'];
    $costo = $_POST['costo'];


    $validations = array(
        array('nombre' => 'codigo_erogacion_hi',
            'requerida' => true),

        array('nombre' => 'cuenta_contable',
            'requerida' => true),

        array('nombre' => 'costo',
            'error' => 'costo',
            'regla' => 'float',
            'nombre_salida' => 'costo',
            'tipo' => ',',
            'requerida' => true)
    );

    $validated = new Validate($validations,$_POST);
    $validated->validate();


    if(!$validated->getIsError()){


        $sql = "INSERT INTO cos_detalle_erogaciones(cuenta_contable,codigo_erogacion,
            fecha,costo)
            VALUES('$cuenta_contable','$codigo_erogacion','$fecha_actual','$costo')";


        $result = mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());

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
    <link href="../../css/ui-lightness/jquery-ui-1.10.4.custom.css" rel="stylesheet">
    <script src="../../js/jquery-1.10.2.js"></script>
    <script src="../../js/jquery-ui-1.10.4.custom.js"></script>
    <link href="../../css/stylesheet.css" rel="stylesheet" type="text/css" />



    <script type="text/javascript">

        function isNumber(n) {
            n = n.replace(',','.');
            return !isNaN(parseFloat(n)) && isFinite(n);
        }


        $(function() {
            $( "#datepicker1" ).datepicker({ dateFormat: 'yy-mm-dd',changeYear: true, yearRange: "-100:+0"});

            $( "#buscar_departamento" ).click(function() {
                var ventana_nueva = window.open("buscar_departamento.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90 ");
                ventana_nueva.focus();

            });

            $( "#buscar_erogacion" ).click(function() {
                var ventana_nueva = window.open("buscar_erogacion.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90 ");
                ventana_nueva.focus();

            });



        });

    </script>

</head>


<body class="flickr-com">
<!--<p><a href="mrh_menu.html" class="main-site">Principal</a></p>-->
<!--<h1><img src="images/seleccion_sicap_archivos/image002.jpg" alt="flickr" />Módulo de Recursos Humanos | Cargo</h1>-->
<!-- Beginning of compulsory code below -->

<form method="post" accept-charset="UTF-8" name="detalle_erogacion">

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
                            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>    Módulo Costos y Gastos | Procesar Erogacion</strong></h1>

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
                                    <td><label >Nombre de Erogación</label></td>
                                    <td style="width: 155px"><input type="text" name="erogacion_nombre" placeholder="Erogacion" id="articulo_nombre" disabled></td>
                                    <td><input type="button" value="Buscar" id="buscar_erogacion"></td>
                                    <input type="hidden" name="codigo_erogacion_hi"/>
                                </tr>


                                <TD><label>Fecha</label></TD>
                                <TD><p><input type="text" id="datepicker1" name="fecha"></p></TD>

                                <tr>
                                    <td><label >Código Cuenta Contable</label></td>
                                    <td style="width: 155px"><input type="text" name="cuenta_contable"  id="cuenta_contable" ></td>
                                </tr>


                                <tr>
                                    <td><label >Costo</label></td>
                                    <td><input type="text" id="costo" name="costo"/></td>
                                </tr>
                                <tr></tr><tr></tr>
                                <table>
                                    <tr>
                                        <td><input type="submit" value="Guardar datos" name="submit"></td>
                                        <td><a href="erogacion_ver.php"><input type="button" value="Ver Derogaciones"></a> </td>
                                        <td><a href="../../cos_menu.php"><input type="button" value="Atras"></a> </td>

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