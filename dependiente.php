<?php

include_once('clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

?>

<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 13/10/14
 * Time: 08:33 AM
 */
?>

<?php

header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

require_once('db.php');



if(isset($_POST['submit'])) {

    require_once('./clases/Validate.php');
    require_once('./clases/funciones.php');

    $validation = array(

        array('buscar_empleado_hi' => 'filtro',
            'requerida' => true,
            'regla' => 'number'),

        array('nombre' => 'buscar_empleado_depende_hi',
            'requerida' => true,
            'regla' => 'number')

    );

    $validated = new Validate($validation,$_POST);
    $validated->validate();

    if(!$validated->getIsError()){

        $buscar_empleado_hi = $_POST['buscar_empleado_hi'];
        $buscar_empleado_depende_hi = $_POST['buscar_empleado_depende_hi'];

        $sql = "INSERT  INTO mrh_empleado_depende (codigo_trabajador,codigo_depende)
          VALUES('$buscar_empleado_hi','$buscar_empleado_depende_hi')";

        mysql_query($sql) or die('error mrh_empleado_depende'.mysql_error());

        send_error_redirect(false);
        die;
    }else if($validated->getIsError()){
        send_error_redirect(true);
    }


}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
    <title>SICAP | Sistema Integral de Costos</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="author" content="Leonel Soriano leonelsoriano3@gmail.com" />
    <link href="./css/helper.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="./css/stylesheet.css" rel="stylesheet" type="text/css" />
    <script src="./js/jquery-1.10.2.js"></script>

    <script type="text/javascript">

        $(function() {

            $("#buscar_empleado").click(function() {
                var win = window.open("dependiente_buscar_empleado.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90 ");
                win.focus();
            });

            $("#buscar_empleado_depende").click(function() {
                var win = window.open("dependiente_buscar_empleado_depende.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90 ");
                win.focus();
            });

        });

    </script>

</head>


<body class="flickr-com">


<form method="post" accept-charset="UTF-8" name="formulario">

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
                            <h1><img src="./images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Recursos Humanos | Dependiente</strong></h1>
                            <br/>
                            <TABLE BORDER="0" CELLSPACING="10" >

                                <tr>
                                    <td><label>Empleado</label></td>
                                    <td>
                                        <input type="text" name="nombre_empleado"  disabled>
                                        <input type="button" name="buscar_empleado" id="buscar_empleado" value="Buscar"/>

                                    </td>
                                    <input type="hidden" name="buscar_empleado_hi" id="buscar_empleado_hi"/>
                                </tr>

                                <tr>
                                    <td><label>Empleado Depende</label></td>
                                    <td>
                                        <input type="text" name="nombre_empleado_depende"  disabled>
                                        <input type="button" name="buscar_empleado_depende" id="buscar_empleado_depende" value="Buscar"/>

                                    </td>
                                    <input type="hidden" name="buscar_empleado_depende_hi" id="buscar_empleado_depende_hi"/>
                                </tr>


                                <!-- leonel -->


                            </TABLE>

                            <br/>
                            <table>
                                <tr>
                                    <td><input type="submit" value="Guardar datos" name="submit"></td>
                                    <td><a href="empleado_depende_ver.php"><input type="button" value="Ver datos"></a> </td>
                                    <td><a href="mrh_menu.php"><input type="button" value="Atras"></a> </td>

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