<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 05/12/14
 * Time: 10:11 AM
 */

header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

require_once('../../db.php');



if(isset($_POST['submit'])){


    require_once('../../clases/Validate.php');
    require_once('../../clases/funciones.php');


    $validation = array(

        array('nombre' => 'unidad',
            'requerida' => true,
            'regla' => 'float',
            'tipo' => ','),

        array('nombre' => 'codigo_bien_hi',
            'requerida' => true,
            'regla' => 'number'),

    );


    $validated = new Validate($validation,$_POST);
    $validated->validate();


    if(!$validated->getIsError()){


        $anhio = $_POST['anhio'];
        $mes = $_POST['mes'];
        $codigo_bien_hi = $_POST['codigo_bien_hi'];
        $unidad = $_POST['unidad'];
        $tipo_bien_hi = $_POST['tipo_bien_hi'];

        $currentDayOfMonth = date('d');

        $fecha =  $anhio. '-' . $mes . '-' . '01';


        $sql = "INSERT INTO bie_unidades_depreciacion
          (tipo_bien,unidades,codigo_bien,fecha)
          VALUES
          ('$tipo_bien_hi','$unidad','$codigo_bien_hi','$fecha')";


        mysql_query($sql) or die('error agregar revicion de vehiculo'.mysql_error());

        send_error_redirect(false,'Datos Guardados Correctamente');
        die;

    }else if($validated->getIsError()){

        send_error_redirect(true,'Error en la Información de Formulario');
    }
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

    <script type="text/javascript">

        $(function() {

            $("#buscar_articulo").click(function() {
                var win = window.open("buscar_articulo.php", "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=900, height=600,left=200,top=90 ");
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
                            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Inventario | Empresa</strong></h1>
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
                            <TABLE BORDER="0" CELLSPACING="10" >


                                <tr>

                                   <label>Año</label>


                                        <select name='anhio' id="anhio" >
                                            <?php $anhio = date('Y');

                                            for($i = 0 ; $i < 20; $i++){
                                                if(($anhio -$i) == $anhio){
                                                    echo('<option value="'.($anhio -$i).'"selected>'.($anhio -$i).'</option>');
                                                }else{
                                                    echo('<option value="'.($anhio -$i).'">'.($anhio -$i).'</option>');
                                                }

                                            }

                                            ?>
                                        </select>



                                   <label>Mes</label>

                                    <select name='mes' id='mes' >

                                        <?php

                                        $mes = date('n');

                                        if($mes == 1){
                                            echo(" <option value='01' selected>Enero</option>");
                                        }else{
                                            echo(" <option value='01' >Enero</option>");
                                        }
                                        if($mes == 2){
                                            echo(" <option value='02' selected>Febrero</option>");
                                        }else{
                                            echo(" <option value='02' >Febrero</option>");
                                        }
                                        if($mes == 3){
                                            echo(" <option value='03' selected>Marzo</option>");
                                        }else{
                                            echo(" <option value='03' >Marzo</option>");
                                        }
                                        if($mes == 4){
                                            echo(" <option value='04' selected>Abril</option>");
                                        }else{
                                            echo(" <option value='04' >Abril</option>");
                                        }
                                        if($mes == 5){
                                            echo(" <option value='05' selected>Mayo</option>");
                                        }else{
                                            echo(" <option value='05' >Mayo</option>");
                                        }
                                        if($mes == 6){
                                            echo(" <option value='06' selected>Junio</option>");
                                        }else{
                                            echo(" <option value='06' >Junio</option>");
                                        }
                                        if($mes == 7){
                                            echo(" <option value='07' selected>Julio</option>");
                                        }else{
                                            echo(" <option value='07' >Julio</option>");
                                        }
                                        if($mes == 8){
                                            echo(" <option value='08' selected>Agosto</option>");
                                        }else{
                                            echo(" <option value='08' >Agosto</option>");
                                        }
                                        if($mes == 9){
                                            echo(" <option value='09' selected>Septiembre</option>");
                                        }else{
                                            echo(" <option value='09' >Septiembre</option>");
                                        }
                                        if($mes == 10){
                                            echo(" <option value='10' selected>Octubre</option>");
                                        }else{
                                            echo(" <option value='10' >Octubre</option>");
                                        }
                                        if($mes == 11){
                                            echo(" <option value='11' selected>Noviembre</option>");
                                        }else{
                                            echo(" <option value='11' >Noviembre</option>");
                                        }
                                        if($mes == 12){
                                            echo(" <option value='12' selected>Diciembre</option>");
                                        }else{
                                            echo(" <option value='12' >Diciembre</option>");
                                        }
                                        ?>

                                    </select>
                                </tr>


                                <tr>
                                    <td><label>Artículo</label></td>
                                    <td>
                                        <input type="text" name="nombre_articulo"  disabled>
                                        <input type="button" name="buscar_articulo" id="buscar_articulo" value="Buscar"/>

                                    </td>
                                    <input type="hidden" name="codigo_bien_hi" id="codigo_bien_hi"/>
                                    <input type="hidden" name="tipo_bien_hi" id="tipo_bien_hi"/>
                                </tr>


                                <tr>
                                    <td>
                                        <label id="valor">Unidades</label>
                                    </td>
                                    <td>
                                        <input id="unidades" name="unidad" type="text"/>
                                    </td>
                                </tr>

                                <!-- leonel -->


                            </TABLE>

                            <br/>
                            <table>
                                <tr>
                                    <td><input type="submit" value="Guardar datos" name="submit"></td>
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