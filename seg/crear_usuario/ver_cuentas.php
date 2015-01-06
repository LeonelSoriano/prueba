<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 05/12/14
 * Time: 03:40 PM
 */

header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);


require_once('../../clases/Seguridad.php');
require_once('../../clases/Paginador.php');


$a = new Seguridad();

$a->chekear_session();

if($_SESSION['usuario'] != 'root'){
    $url = "http" . (($_SERVER['SERVER_PORT']==443) ? "s://" : "://") . $_SERVER['HTTP_HOST'] . '/sicap/seg_menu.php';
    header('Location: ' .$url);
}



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html >
<head>
    <title>SICAPC | Sistema Integral de Costos</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="../../css/helper.css" media="screen" rel="stylesheet" type="text/css" />
    <script src="../../js/htmlDatePicker.js" type="text/javascript"></script>
    <link href="../../css/stylesheet.css" rel="stylesheet" type="text/css" />

    <!-- / END -->

</head>
<body class="flickr-com">



<form method="post">

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
                            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Producción | Uso-Consumo Devolución</strong></h1>
                            <br/><br/>

                            <?php

                            include("../../db.php");
                            include_once("../../clases/funciones.php");


                            $a = new Paginador("seg_usuario",$_GET['paso']);
                            $a->print_sql_foot();
                            ?>
                            <br/>
                            <br/>
                            <table border=none class="tablas-nuevas">

                                <tr style="text-align: center">
                                    <th>Nombre</th>
                                    <th>Permiso</th>
                                    <th></th>

                                </tr>

                                <?php


                                $result=mysql_query("SELECT * FROM seg_usuario  WHERE codigo <> 1 " . $a->print_sql_limit()
                                );


                                while($test = mysql_fetch_array($result))
                                {

                                    $id = $test['codigo'];
                                    $nombre = $test['nombre'];
                                    $permiso = $test['permiso'];



                                    echo "<tr align='center'>";
                                    //echo"<td><font color='black'>" .$test['codigo']."</font></td>";
                                    echo"<td><font color='black'>". utf8_multiplataforma($nombre) ."</font></td>";
                                    echo"<td><font color='black'>". utf8_multiplataforma($permiso)."</font></td>";


                                    echo"<td> <a href ='del_cuenta?codigo=$id'>Eliminar</a>";

                                    echo "</tr>";
                                }



                                mysql_close($conn);

                                ?>

                            </table>
                            <br/>


                            <?php $a->print_sql_foot(); ?>
                            <br/><br/><br/>
                            <a href="crear_usuario.php"><input type="button" value="Atras"></a>
                            <p></p>
                        </div>
                    </div><!--end firefoxbug-->
                </div><!--end left_bgd-->

            </div>
            <p>
                <!--end right_col-->
            </p>
            <p>&nbsp; </p>
            <div class="clearboth"></div>
        </div>
        <div align="center" class="pie">SICAP 2014</div>
    </div>


    <!-- / END -->

</form>

</body>
</html>
