<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 27/10/14
 * Time: 12:04 PM
 */
?>

<?php
ini_set('display_errors', 'On');
ini_set('display_errors', 1);
include_once("../../clases/funciones.php");
include_once("../../db.php");

$guardado = 0;

if (isset($_POST['submit']))
{

    include_once("../../clases/Validate.php");




    $codigo_alias = $_POST['codigoalias'];
    $descripcion = $_POST['descripcion'];
//    $tipo_unidad = $_POST['tipo_unidad'];
    $dependiente = $_POST['dependiente_hi'];

    $id = $_POST['id'];

    $dependiente_nombre_hi = $_POST['dependiente_nombre_hi'];


    $validation = array(

        array('nombre' => 'descripcion',
            'requerida' => true),

        /*
                array('nombre' => 'tipo_unidad',
                    'requerida' => true,
                    'regla' => 'number' ),*/

        array('nombre' => 'dependiente_hi',
            'requerida' => true,
            'regla' => 'number')

    );


    $validated = new Validate($validation,$_POST);
    $validated->validate();


//
//    $sql = "INSERT INTO min_cliente(codigo_alias,rif,telefono,direccion,correo)
//        VALUES ('$codigoalias','$rif','$telefono','$direccion','$correo')";



    if(!$validated->getIsError()){

        $sql = "SELECT profundidad FROM mno_gerencia WHERE codigo = '$dependiente'";
        $result=mysql_query($sql);
        $test = mysql_fetch_array($result);

        $profundidad = $test['profundidad'] + 1;


        $sql = "UPDATE mco_organigrama SET codigo_alias='$codigo_alias',descripcion='$descripcion',
              codigo_depende='$dependiente',profundidad='$profundidad',nombre_depende='$dependiente_nombre_hi'
              WHERE codigo='$id'";

        mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());
        $guardado = 1;

        $current_url = explode("?", $_SERVER['REQUEST_URI']);

        $primer_parametro = explode("&",$current_url[1]);
        header('Location: '.$current_url[0].'?'.$primer_parametro[0].'&error=false&msg=Datos Guardados Exitosamente');

        die;



        die;

    }else{
        $guardado = 2;


        $current_url = explode("?", $_SERVER['REQUEST_URI']);

        $primer_parametro = explode("&",$current_url[1]);

        header('Location: '.$current_url[0].'?'.$primer_parametro[0].'&error=true&msg=Hay Errores en la Información del formulario');
        die;
    }



}


if(isset($_GET['codigo'])){


    $codigo = $_GET['codigo'];

    $sql = "SELECT * FROM mco_organigrama WHERE codigo = '$codigo'";

    $result=mysql_query($sql);

    $test = mysql_fetch_array($result);

    $codigo_alias = $test['codigo_alias'];
    $descripcion = $test['descripcion'];
    $codigo_depende = $test['codigo_depende'];
    $nombre_depende = $test['nombre_depende'];


}


?>





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
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
    <link rel="stylesheet" href="/sicap/resources/demos/style.css">

    <script>
        $(function() {

            $( "#buscar_dependiente" ).click(function() {
                var win = window.open("dependiente.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90");
                win.focus();
            });

        });
    </script>
    <!-- Beginning of compulsory code below -->

    <link href="/sicap/css/dropdown/dropdown.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="/sicap/css/dropdown/themes/flickr.com/default.ultimate.css" media="screen" rel="stylesheet" type="text/css" />

    <!-- / END -->

</head>
<body class="flickr-com">

<p>&nbsp;</p>
<!-- Beginning of compulsory code below -->

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

                        <h1><img src="/sicap/images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Nómina | Gerencia</strong></h1>


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


                        <form method="post" name="gerencia">
                            <TABLE BORDER="0" CELLSPACING="4" WIDTH="500">

                                <TR>
                                    <TD><label>Código</label></TD>
                                    <TD><p><input type="text" name="codigoalias" id="codigoalias" size="21" value="<?php echo(utf8_multiplataforma($codigo_alias)); ?>"></p></TD>
                                </TR>
                                <TR>
                                    <TD><label>Descripción</label></TD>
                                    <TD><p><input type="text" name="descripcion" id="descripcion" size="21" value="<?php echo(utf8_multiplataforma($descripcion)); ?>"></p></TD>
                                </TR>


                                <TR>
                                    <TD width="173"><label>Dependiente</label></TD>
                                    <TD width="94">
                                        <input type="text" name="dependiente" id="dependiente" size="21"  value="<?php echo(utf8_multiplataforma($nombre_depende)); ?>" disabled></TD>
                                    <TD>
                                        &nbsp;
                                        <input type="button" name="buscar_dependiente" id="buscar_dependiente" value="Buscar" >
                                    </TD>
                                </TR>

                                <tr></tr>
                                <tr></tr>
                                <tr></tr>
                                <!--        <tr >-->
                                <!--            <td><label for="">Tipo de Unidad</label></td>-->
                                <!--            <td><select name="tipo_unidad" id="tipo_unidad"  style="font-size: 16px">-->
                                <!--                    <option value="0">Unidad Direccion</option>-->
                                <!--                    <option value="1">Unidad de Consultoria</option>-->
                                <!--                    <option value="2">Unidad de Control</option>-->
                                <!--                    <option value="3">Unidad de Apoyo</option>-->
                                <!--                    <option value="4">Unidad de Asesoria</option>-->
                                <!--                    <option value="5">Unidad de Linea</option>-->
                                <!--                </select></td>-->
                                <!--        </tr>-->

                                <input type="hidden" value="<?php echo($codigo); ?>" name="id"/>
                                <input type="hidden" name="dependiente_hi"  id="dependiente_hi" value="<?php echo(utf8_multiplataforma($codigo_depende)); ?>"/>
                                <input type="hidden" name="dependiente_nombre_hi"  id="dependiente_nombre_hi" value="<?php echo(utf8_multiplataforma($nombre_depende)); ?>"/>

                            </TABLE>
                            <br/>
                            <table>
                                <tr>
                                    <td><input type="submit" value="Guardar datos" name="submit"></td>
                                    <td><a href="organigrama_ver.php"><input type="button" value="Ver datos"></a></td>
                                    <td><a href="/sicap/mco_menu.html"><input type="button" value="Atras"></a></td>
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




</body>
</html>
