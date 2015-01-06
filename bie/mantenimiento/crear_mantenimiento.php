<?php

header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

require_once('../../db.php');



if(isset($_POST['submit'])){

    require_once('../../clases/Validate.php');
    require_once('../../clases/funciones.php');

    $validation = array(

        array('nombre' => 'nombre_mantenimiento',
            'requerida' => true),

        array('nombre' => 'tipo_medida',
            'requerida' => true,
            'regla' => 'number'),

        array('nombre' => 'tipo_bien',
            'requerida' => true,
            'regla' => 'number'),

    );



    $validated = new Validate($validation,$_POST);
    $validated->validate();

    if(!$validated->getIsError()){

        $nombre_mantenimiento = $_POST['nombre_mantenimiento'];
        $tipo_medida = $_POST['tipo_medida'];
        $tipo_bien = $_POST['tipo_bien'];
        $periodicidad = $_POST['periodicidad'];

        $sql = "INSERT INTO bie_mantenimiento(nombre,codigo_tipo_medida,codigo_tipo_bien,periodicidad)
            VALUES('$nombre_mantenimiento','$tipo_medida','$tipo_bien','$periodicidad')";

        mysql_query($sql) or die('error agregar bie_mantenimiento  '.mysql_error());

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
    <link href="../../css/helper.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="../../css/stylesheet.css" rel="stylesheet" type="text/css" />
    <script src="../../js/jquery-1.10.2.js"></script>

<!--    <script type="text/javascript">-->
<!---->
<!--        $(function() {-->
<!---->
<!--            $("#buscar_bien").click(function() {-->
<!--                var win = window.open("buscar_bien.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90 ");-->
<!--                win.focus();-->
<!--            });-->
<!---->
<!--        });-->
<!---->
<!--    </script>-->

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
                            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Inventario | Empresa</strong></h1>
                            <br/>
                            <TABLE BORDER="0" CELLSPACING="10" >
<!--                                <tr>-->
<!--                                    <td><label>Nombre Bien</label></td>-->
<!--                                    <td>-->
<!--                                        <input type="text" name="nombre_bien"  disabled>-->
<!--                                        <input type="button" name="buscar_bien" id="buscar_bien" value="Buscar"/>-->
<!--                                    </td>-->
<!--                                    <input type="hidden" name="codigo_bien_hi" id="codigo_bien_hi"/>-->
<!--                                    <input type="hidden" name="codigo_bien_tipo_hi" id="codigo_bien_tipo_hi"/>-->
<!--                                </tr>-->

                                <tr>
                                    <td>
                                        <label>Nombre Mantenimiento</label>
                                    </td>
                                    <td>
                                        <input name="nombre_mantenimiento"  type="text"/>
                                    </td>
                                </tr>


                                <tr>
                                    <td><label for="">Unidad de Medida</label>
                                    <td>
                                        <select name="tipo_medida" >
                                            <?php
                                                $sql = "SELECT * FROM bie_unidad_medida";
                                                $result=mysql_query($sql);

                                                while($test = mysql_fetch_array($result))
                                                {
                                                    $nombre_unidad = $test['nombre'];
                                                    $id = $test['codigo'];
                                                   echo("<option value='". $id ."'>" . $nombre_unidad . "</option>");
                                                }
                                            ?>
                                        </select>
                                    </td>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label>Periodicidad</label>
                                    </td>
                                    <td>
                                        <input name="periodicidad"  type="text"/>
                                    </td>
                                </tr>

                                <!-- leonel -->

                                <tr>
                                    <td>
                                        <label>Tipo de Bien</label>
                                    </td>
                                    <td>
                                        <select name="tipo_bien" >
                                            <?php
                                            $sql = "SELECT * FROM bie_tipo_bien";
                                            $result=mysql_query($sql);

                                            while($test = mysql_fetch_array($result))
                                            {
                                                $tipo_unidad = $test['nombre'];
                                                $id = $test['codigo'];
                                                echo("<option value='". $id ."'>" . $tipo_unidad . "</option>");
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>



                            </TABLE>

                            <br/>
                            <table>
                                <tr>
                                    <td><input type="submit" value="Guardar datos" name="submit"></td>
                                    <td><a href="ver_mantenimiento.php"><input type="button" value="Ver datos"></a> </td>
                                    <td><a href="../../bie_menu.php"><input type="button" value="Atras"></a> </td>

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