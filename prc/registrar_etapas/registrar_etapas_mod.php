<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 25/11/14
 * Time: 08:40 AM
 */
?>


<?php

header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);

require_once('../../db.php');


if(isset($_POST['submit'])){


    require_once('../../clases/Validate.php');
    require_once('../../clases/funciones.php');


    $validation = array(

        array('nombre' => 'tiempo',
            'requerida' => true,
            'regla' => 'float',
            'tipo' => ','),

        array('nombre' => 'id',
            'requerida' => true,
            'regla' => 'number')


    );



    $validated = new Validate($validation,$_POST);
    $validated->validate();

    if(!$validated->getIsError()){


        $id = $_POST['id'];
        $tiempo = $_POST['tiempo'];
        $tiempo = str_replace(',','.',$tiempo);


        $hora_convertida = $tiempo/60;


        $sql = "UPDATE prc_etapas
SET
horas_estandar = '$hora_convertida'
WHERE codigo = '$id'";

        mysql_query($sql) or die('error agregar prc_etapas  '.mysql_error());

        $current_url = explode("?", $_SERVER['REQUEST_URI']);

        $primer_parametro = explode("&",$current_url[1]);
        header('Location: '.$current_url[0].'?'.$primer_parametro[0].'&error=false&msg=Datos Guardados Exitosamente');

        die;

    }else if($validated->getIsError()){

        $current_url = explode("?", $_SERVER['REQUEST_URI']);

        $primer_parametro = explode("&",$current_url[1]);

        header('Location: '.$current_url[0].'?'.$primer_parametro[0].'&error=true&msg=Hay Errores en la Información del formulario');
        die;
    }
}



if(isset($_GET['codigo'])){

    $id = $_GET['codigo'];

    $sql = "SELECT
    min_productos_servicios.nombre as nombre,
	prc_etapas.horas_estandar as horas,
	mno_gerencia.descripcion as gerencia
FROM
    prc_etapas
        INNER JOIN
    min_productos_servicios ON min_productos_servicios.codigo = prc_etapas.codigo_producto
        INNER JOIN
    mno_gerencia ON mno_gerencia.codigo = prc_etapas.codigo_departamento
    WHERE prc_etapas.codigo = '$id'";

    $result = mysql_query($sql);

    $test = mysql_fetch_array($result);


    $nombre = $test['nombre'];


    $horas = $test['horas'];

    $hora_convertida = $horas*60;

    $hora_convertida = str_replace('.',',',$hora_convertida);


    $gerencia = $test['gerencia'];



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
                            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Producción | Modificar Horas Estardar</strong></h1>
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
                                    <td><label > <?php echo($nombre   . ' Etapa ' . $gerencia);  ?> </label></td>
                                </tr>


                                <tr>
                                    <td>
                                        <label>Tiempo Estandar(Minutos)</label>
                                    </td>
                                    <td>
                                        <input name="tiempo"  type="text" value="<?php echo($hora_convertida);  ?>"/>
                                    </td>
                                </tr>

                                <!-- leonel -->

                                <input type="hidden" name="id" value="<?php echo($id); ?>"/>


                            </TABLE>

                            <br/>
                            <table>
                                <tr>
                                    <td><input type="submit" value="Guardar datos" name="submit"></td>
                                    <td><a href="./producto_etapa.php"><input type="button" value="Atras"></a> </td>

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