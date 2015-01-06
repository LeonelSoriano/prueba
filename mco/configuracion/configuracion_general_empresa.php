<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 29/09/14
 * Time: 09:26 AM
 */


header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

require_once('../../db.php');



if(isset($_POST['submit'])){



    require_once('../../clases/Validate.php');
    require_once('../../clases/funciones.php');

    $validation = array(



    );



    $validated = new Validate($validation,$_POST);
    $validated->validate();



    if(!$validated->getIsError()){



        if(isset($_POST['diferencia_salario'])){
            $sql = "UPDATE configuracion_general  SET valor = 'si' WHERE nombre = 'diferencia_de_salario'";

            mysql_query($sql) or die('error actualizar kilometros  '.mysql_error());
        }else{
            $sql = "UPDATE configuracion_general  SET valor = 'no' WHERE nombre = 'diferencia_de_salario'";

            mysql_query($sql) or die('error actualizar kilometros  '.mysql_error());
        }


        if(isset($_POST['bono_antiguedad'])){
            $sql = "UPDATE configuracion_general  SET valor = 'si' WHERE nombre = 'bono_antiguedad_fijo'";

            mysql_query($sql) or die('error actualizar bono_antiguedad  '.mysql_error());
        }else{
            $sql = "UPDATE configuracion_general  SET valor = 'no' WHERE nombre = 'bono_antiguedad_fijo'";

            mysql_query($sql) or die('error actualizar bono_antiguedad'.mysql_error());
        }


        if(isset($_POST['anhio_servicios'])){
            $sql = "UPDATE configuracion_general  SET valor = 'si' WHERE nombre = 'anhio_servicios_fijo'";

            mysql_query($sql) or die('error actualizar bono_antiguedad  '.mysql_error());
        }else{
            $sql = "UPDATE configuracion_general  SET valor = 'no' WHERE nombre = 'anhio_servicios_fijo'";

            mysql_query($sql) or die('error actualizar bono_antiguedad'.mysql_error());
        }

        send_error_redirect(false);
        die;

    }else if($validated->getIsError()){

        send_error_redirect(true);
    }
}



?>

<?php

    $sql = "SELECT * FROM configuracion_general WHERE nombre='diferencia_de_salario' ";

    $result=mysql_query($sql);

    $test = mysql_fetch_array($result);

    $diferencia_salario = $test['valor'];

    $sql = "SELECT * FROM configuracion_general WHERE nombre='bono_antiguedad_fijo' ";

    $result=mysql_query($sql);

    $test = mysql_fetch_array($result);

    $bono_antiguedad = $test['valor'];


    $sql = "SELECT * FROM configuracion_general WHERE nombre='anhio_servicios_fijo' ";

    $result=mysql_query($sql);

    $test = mysql_fetch_array($result);

    $anhio_servicios = $test['valor'];

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

    <script type="text/javascript">

        $(function() {

            $("#buscar_vehiculo").click(function() {
                var win = window.open("buscar_vehiculo.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90 ");
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
                            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Configuración | Empresa</strong></h1>
                            <br/>
                            <TABLE BORDER="0" CELLSPACING="10" >

                                <tr>
                                    <td><label >Diferencia de Salario</label></td>
                                    <td><input type="checkbox" name="diferencia_salario" <?php if($diferencia_salario == 'si')echo("checked"); ?>/></td>
                                </tr>

                                <tr>
                                    <td><label >Bono Antigüedad es Fijo?</label></td>
                                    <td><input type="checkbox" name="bono_antiguedad" <?php if($bono_antiguedad == 'si')echo("checked"); ?>/></td>
                                </tr>


                                <tr>
                                    <td><label >Años de Servicios es Fijo?</label></td>
                                    <td><input type="checkbox" name="anhio_servicios" <?php if($anhio_servicios == 'si')echo("checked"); ?>/></td>
                                </tr>

                                <!-- leonel -->


                            </TABLE>

                            <br/>
                            <table>
                                <tr>
                                    <td><input type="submit" value="Guardar datos" name="submit"></td>
                                    <td><a href="../../mco_menu.php"><input type="button" value="Atras"></a> </td>

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