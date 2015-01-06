<?php

header("Content-Type: text/html;charset=utf-8");
include_once("../../clases/funciones.php");
include_once("../../clases/Validate.php");
include_once("../../db.php");


ini_set('display_errors', 'On');
ini_set('display_errors', 1);


$erogacion_nombre = '';
$codigo_erogacion = '';
$codigo_departamento = '';
$codigo_departamento = '';
$nombre_departamento = '';
$cuenta_contable = '';
$costo = '';
$codigo_hi = '';



if(isset($_POST['submit'])){


    $codigo_erogacion = $_POST['codigo_erogacion_hi'];
    $cuenta_contable = $_POST['cuenta_contable'];
    $costo = $_POST['costo'];
    $codigo_hi = $_POST['codigo_hi'];

    $fecha = $_POST['fecha'];


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
            'requerida' => true),
    );

    $validated = new Validate($validations,$_POST);
    $validated->validate();


    if(!$validated->getIsError()){

        $sql = "UPDATE  cos_detalle_erogaciones SET
            cuenta_contable='$cuenta_contable',codigo_erogacion='$codigo_erogacion',
            fecha='$fecha',costo='$costo' WHERE codigo='$codigo_hi'";


        $result = mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());


        $current_url = explode("?", $_SERVER['REQUEST_URI']);

        header('Location: '.$current_url[0].'?'.$current_url[1].'&error=false');
        exit();

    }else{
        $current_url = explode("?", $_SERVER['REQUEST_URI']);

        header('Location: '.$current_url[0].'?'.$current_url[1].'&error=true');
        exit();
    }


}




if(isset($_GET['codigo'])){

    $codigo = $_GET['codigo'];
    $codigo_hi = $codigo;

    $sql = "SELECT cos_erogaciones.nombre as erogacion_nombre,
cos_detalle_erogaciones.codigo_erogacion as codigo_erogacion,
   cos_detalle_erogaciones.cuenta_contable as cuenta_contable,
cos_detalle_erogaciones.fecha as fecha,
    cos_detalle_erogaciones.costo as costo
    FROM cos_detalle_erogaciones
INNER JOIN cos_erogaciones
ON cos_erogaciones.codigo=cos_detalle_erogaciones.codigo_erogacion
WHERE cos_detalle_erogaciones.codigo = '$codigo';";

    $result = mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());

    $test = mysql_fetch_array($result);

    $erogacion_nombre = $test['erogacion_nombre'];
    $codigo_erogacion = $test['codigo_erogacion'];
    $fecha = $test['fecha'];
    $cuenta_contable = $test['cuenta_contable'];
    $costo = $test['costo'];

}


?>




    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <title>SICAP | Sistema Integral de Costos</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="../../css/helper.css" media="screen" rel="stylesheet" type="text/css" />
        <link href="../../css/ui-lightness/jquery-ui-1.10.4.custom.css" rel="stylesheet">

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

                $( "#datepicker1" ).datepicker({ dateFormat: 'yy-mm-dd',changeYear: true, yearRange: "-100:+0"});
                $("#datepicker1").val('<?php echo($fecha); ?>');

                $( "#buscar_departamento" ).click(function() {
                    var ventana_nueva = window.open("buscar_departamento.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=700, height=600 ,left=600,top=90");
                    ventana_nueva.focus();

                });

                $( "#buscar_erogacion" ).click(function() {
                    var ventana_nueva = window.open("buscar_erogacion.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=700, height=600 ,left=600,top=90");
                    ventana_nueva.focus();
                });


            });

        </script>

    </head>


    <body class="flickr-com">

    <form method="post" accept-charset="UTF-8" name="detalle_erogacion">

        <div id="body_bottom_bgd">
            <div id=""> <!--<img src="images/Logo_Inventario.png"/>-->
                <!--</div>-->                <!-- Menu -->
                <!--  ?php include 'include/nav.php'; ?>-->
                <div align="justify" id="right_col" >

                    <?php
                        if ( isset($_GET['error'])){

                            if($_GET['error'] == 'false'){
                                echo('<div id="done_app"><marquee scrolldelay="100">Datos Guardados Correctamente</marquee></div>');
                            }else{
                                echo('<div id="error_app"><marquee scrolldelay="120">Vefifica los Campos</marquee></div>');
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
                                <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>    Módulo Costos y Gastos | Procesar Erogacion</strong></h1>

                                <br/><br/>
                                <table BORDER="0" CELLSPACING="6" WIDTH="380">

                                    <tr>
                                        <td><label >Nombre de Erogación</label></td>
                                        <td style="width: 155px"><input type="text" name="erogacion_nombre"  id="articulo_nombre" value="<?php echo($erogacion_nombre); ?>" disabled></td>
                                        <td><input type="button" value="Buscar" id="buscar_erogacion"></td>
                                        <input type="hidden" name="codigo_erogacion_hi" value="<?php echo($codigo_erogacion); ?>"/>
                                    </tr>

                                    <TD><label>Fecha</label></TD>
                                    <TD><p><input type="text" id="datepicker1" name="fecha" value="<?php echo $fecha?>"></p></TD>

                                    <tr>
                                        <td><label >Código Cuenta Contable</label></td>
                                        <td style="width: 155px"><input type="text" name="cuenta_contable"  id="cuenta_contable" value="<?php echo($cuenta_contable); ?>"></td>
                                    </tr>


                                    <tr>
                                        <td><label >Costo</label></td>
                                        <td><input type="text" id="costo" name="costo" value="<?php echo($costo); ?>"/></td>
                                        <input type="hidden" name="codigo_hi" value="<?php echo($codigo_hi); ?>"/>
                                    </tr>
                                    <tr></tr><tr></tr>
                                    <table>
                                        <tr>
                                            <td><input type="submit" value="Guardar datos" name="submit"></td>
                                            <td><a href="erogacion_ver.php"><input type="button" value="Atras"></a> </td>

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