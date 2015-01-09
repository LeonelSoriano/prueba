<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 28/10/14
 * Time: 01:11 PM
 */
?>

<?php

header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

require_once('../../db.php');



//if(isset($_POST['submit'])){
//
//
//
//
//    $validation = array(
//
//        array('nombre' => 'kilometros',
//            'requerida' => true,
//            'regla' => 'float',
//            'tipo' => ','),
//
//        array('nombre' => 'codigo_bien_hi',
//            'requerida' => true,
//            'regla' => 'number'),
//
//        array('nombre' => 'agua',
//            'requerida' => true,
//            'regla' => 'number'),
//
//        array('nombre' => 'frenos',
//            'requerida' => true,
//            'regla' => 'number'),
//
//        array('nombre' => 'aceite',
//            'requerida' => true,
//            'regla' => 'number'),
//
//        array('nombre' => 'filtro',
//            'requerida' => true,
//            'regla' => 'number'),
//
//        array('nombre' => 'cauchos',
//            'requerida' => true,
//            'regla' => 'number'),
//
//    );
//
//
//    $validated = new Validate($validation,$_POST);
//    $validated->validate();
//
//
//
//    if(!$validated->getIsError()){
//
//        $kilometros = $_POST['kilometros'];
//        $observacion = $_POST['observacion'];
//        $codigo_bien_hi = $_POST['codigo_bien_hi'];
//        $caucho = $_POST['cauchos'];
//        $filtro = $_POST['filtro'];
//        $aceite = $_POST['aceite'];
//        $agua = $_POST['agua'];
//        $frenos = $_POST['frenos'];
//        $fecha_actual = fecha_sicap();
//
//
//
//        $sql = "SELECT kilometros FROM bie_tipo_vehiculo WHERE codigo = '$codigo_bien_hi'";
//
//        $result=mysql_query($sql);
//
//        $test = mysql_fetch_array($result);
//
//        $kilometros_anteror = $test['kilometros'];
//
//        $nuevos_kilometros =$kilometros - $kilometros_anteror ;
//
//
//
//        $sql = "INSERT INTO bie_revicion_diaria_vhiculo
//          (cod_vehiculo,agua,aceite,filtro,caucho,frenos,observacion,fecha,kilometros)
//          VALUES
//          ('$codigo_bien_hi','$agua','$aceite','$filtro','$caucho','$frenos','$observacion','$fecha_actual','$nuevos_kilometros')";
//
//
//
//        mysql_query($sql) or die('error agregar revicion de vehiculo'.mysql_error());
//
//
//
//        $sql = "UPDATE bie_tipo_vehiculo SET kilometros = '$kilometros' WHERE codigo = '$codigo_bien_hi'";
//
//        mysql_query($sql) or die('error actualizar kilometros  '.mysql_error());
//
//        send_error_redirect(false);
//        die;
//
//    }else if($validated->getIsError()){
//
//        send_error_redirect(true);
//    }
//}



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

//            $("#buscar_articulo").click(function() {
//                var win = window.open("buscar_articulo", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90 ");
//                win.focus();
//            });

        });

    </script>

</head>


<body class="flickr-com">


<form method="post" accept-charset="UTF-8" name="formulario" action="reporte_articulo.php">

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
                            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Inventario | Empresa</strong></h1>
                            <br/>
                            <TABLE BORDER="0" CELLSPACING="10" >
<!---->
<!--                                <tr>-->
<!--                                    <td><label>Artículo o Servicio</label></td>-->
<!--                                    <td>-->
<!--                                        <input type="text" name="nombre_articulo"  disabled>-->
<!--                                        <input type="button" name="buscar_articulo" id="buscar_articulo" value="Buscar"/>-->
<!---->
<!--                                    </td>-->
<!--                                    <input type="hidden" name="codigo_articulo_hi" id="codigo_articulo_hi"/>-->
<!--                                </tr>-->



                                <TR>


                                                <?php
//                                                <input type='hidden' name='checkbox_".$codigo."' value='0'>
                                                $result=mysql_query("SELECT * FROM min_tipo_inventario");
                                                while($test = mysql_fetch_array($result)){

                                                    $codigo = $test['codigo'];
                                                    $tipo = $test['tipo'];

                                                    echo("
                                    <tr>
                                        <td>
                                            <label >$tipo</label>
                                        </td>
                                    <td>

                                    <input type='checkbox' name='checkbox_".$codigo."' value='1' checked>
                                    </tr>");
                                                }

                                                ?>

                                </TR>

<tr></tr><tr></tr>
                                <tr>
                                    <td><label > Filtrado </label> </td>
                                    <td>
                                        <select name="filtrado" id="filtrado">
                                            <option value="todo">Todo</option>
                                            <option value="sin">Sin Saldo</option>
                                            <option value="con">Con Saldo</option>
                                        </select>
                                    </td>

                                </tr>

                                <!-- leonel -->


                            </TABLE>

                            <br/>
                            <table>
                                <tr>
                                    <td><input type="submit" value="Generar Reporte" name="submit"></td>
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