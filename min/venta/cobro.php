<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 12/10/14
 * Time: 11:12 AM
 */
header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);
require_once('../../db.php');

if(isset($_POST['submit'])){

    require_once('../../clases/Validate.php');
    require_once('../../clases/funciones.php');

    $codigo_venta_hi = $_POST['codigo_venta_hi'];
    $codigo_vendedor = $_POST['codigo_vendedor'];
    $fecha_cobro = $_POST['fecha_cobro'];

    $sql = "UPDATE  min_ventas SET
          cobrado = '$fecha_cobro', codigo_cobrador = '$codigo_vendedor'
          WHERE codigo = $codigo_venta_hi";

    mysql_query($sql) or die('error al actualizar base de datos'.mysql_error());

    send_error_redirect(false);
    die;

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>SICAP | Sistema Integral de Costos</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="author" content="Leonel Soriano leonelsoriano3@gmail.com" />
    <link href="../../css/helper.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="../../css/stylesheet.css" rel="stylesheet" type="text/css" />
    <script src="../../js/jquery-1.10.2.js"></script>
    <script src="../../js/jquery-ui-1.10.4.custom.js"></script>
    <link href="../../css/ui-lightness/jquery-ui-1.10.4.custom.css" rel="stylesheet">

    <script type="text/javascript">

    $(function() {

        $("#buscar_venta").click(function() {
            var win = window.open("buscar_venta.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90 ");
            win.focus();
        });

        $( "#buscar_vendedor" ).click(function() {
            var win = window.open("vendedor_buscar.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=780, height=600,left=270,top=100");
            win.focus();
        });

        $( "#datepicker1" ).datepicker({ dateFormat: 'yy-mm-dd',changeYear: true, yearRange: "-100:+0"});
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
                <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Inventario | Cobro</strong></h1>
                <br/>
                <TABLE BORDER="0" CELLSPACING="10" >

                    <tr>
                        <td><label>Venta</label></td>
                        <td>
                            <input type="text" name="nombre_venta"  disabled>

                            <input type="button" name="buscar_venta" id="buscar_venta" value="Buscar"/>

                        </td>
                        <input type="hidden" name="codigo_venta_hi" id="codigo_venta_hi"/>
                    </tr>


                    <tr>
                        <td><label>Nombre de Vendedor</label></td>
                        <td>
                            <input type="text" name="nombre_vendedor" id="nombre_vendedor"  disabled>

                            <input type="button" name="buscar_vendedor" id="buscar_vendedor" value="Buscar"/>

                        </td>
                        <input type="hidden" name="codigo_vendedor" id="codigo_vendedor"/>
                        <input type="hidden" name="id_vendedor" id="id_vendedor"/>
                    </tr>


                    <TD class="firefox"><label>Fecha Cobro</label></TD>
                    <TD><p><input type="text" id="datepicker1" name="fecha_cobro"></p></TD>
                    <!-- leonel -->

                </TABLE>

                <br/>
                <table>
                    <tr>
                        <td><input type="submit" value="Guardar datos" name="submit"></td>
                        <td><a href="../../min_menu.php"><input type="button" value="Atras"></a> </td>

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