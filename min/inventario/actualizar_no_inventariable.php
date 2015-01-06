<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 07/11/14
 * Time: 01:32 PM
 */


include_once("../../clases/Paginador.php");
header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);


include("../../db.php");
include_once("../../clases/funciones.php");

if (isset($_POST['id']) && isset($_POST['value'])){
    require_once ('../../clases/Validate.php');

    $validation = array(

        array('nombre' => 'id',
            'requerida' => true,
            'regla' => 'number'),

        array('nombre' => 'value',
            'requerida' => false,
            'regla' => 'float',
            'tipo' => ','),

    );

    $validated = new Validate($validation,$_POST);
    $validated->validate();

    if(!$validated->getIsError()){

        $value = str_replace(',','.',$_POST['value']);
        $id = $_POST['id'];

        $fecha_actual = fecha_sicap();


        $sql = "UPDATE min_valoracion
SET  unidades='1', costo_total='$value', promedio_actual='$value'
WHERE codigo_producto='$id';
";

        mysql_query($sql) or die('No se pudo guardar la información. valoracion '.mysql_error());

        $sql = "INSERT INTO min_valoracion_historico
( codigo_producto, unidades, costo_total, promedio_actual, fecha)
VALUES( $id, '1', '$value', '$value', '$fecha_actual');
";

       mysql_query($sql) or die('No se pudo guardar la información. '.mysql_error());




        $current_url = explode("?", $_SERVER['REQUEST_URI']);

        $primer_parametro = 'paso=' . $_GET['paso'];

        header('Location: '.$current_url[0].'?'.$primer_parametro.'&error=false&msg=Datos Guardados Correctamente');
        die;

    }else{
        $current_url = explode("?", $_SERVER['REQUEST_URI']);

        $primer_parametro = 'paso=' . $_GET['paso'];

        header('Location: '.$current_url[0].'?'.$primer_parametro.'&error=true&msg=Debes Solo Ingeresar Valores Numericos con Coma');
        die;
    }

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
    <script src="../../js/jquery-1.10.2.js"></script>
    <!-- / END -->


    <script type="text/javascript">

        $(function() {


//post-link
            $(".hola").on('click', function(event) {



                var id = $(this).attr('id');
                var valor = $("#valor" +id ).val();

                event.preventDefault();
                    $('body').append($('<form/>', {
                        id: 'form',
                        method: 'POST',
                        action: '#'
                    }));

                    $('#form').append($('<input/>', {
                        type: 'hidden',
                        name: 'id',
                        value: id
                    }));

                    $('#form').append($('<input/>', {
                        type: 'hidden',
                        name: 'value',
                        value: valor
                    }));

                    $('#form').submit();

                    return false;
                });



        })//jquery


    </script>

</head>
<body class="flickr-com">

<!--<p><a href="mrh_menu.html" class="main-site">Principal</a></p>-->

<!--<h1><img src="images/flickr.com/icon.png" alt="flickr" />Módulo de Recursos Humanos | Listado de Turnos</h1>-->

<!-- Beginning of compulsory code below -->

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
                            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de de Inventarios | Actualizar no Inventariables</strong></h1>
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

                            <?php



                            $a = new Paginador("min_productos_servicios",$_GET['paso'],'Where min_productos_servicios.inventario = 12');
                            $a->print_sql_foot();
                            ?>
                            <br/>
                            <br/>
                            <table border=none class="tablas-nuevas">

                                <tr style="text-align: center">
                                    <th style="min-width: 250px">Nombre</th>

                                    <th>Valor</th>

                                    <th></th>

                                </tr>

                                <?php


                                $result=mysql_query("SELECT
        min_productos_servicios.codigo as codigo,
        min_productos_servicios.nombre as nombre,
        min_productos_servicios.fecha_adquisicion as fecha_adquisicion,
        min_productos_servicios.ubicacion as ubicacion,
        min_productos_servicios.observacion as observacion,
        min_tipo_inventario.tipo as tipo,
        mco_unidad.descripcion as descripcion,
        mco_unidad.sigla as sigla,
	min_valoracion.promedio_actual as precio
    FROM
        min_productos_servicios
            INNER JOIN
        min_tipo_inventario ON min_productos_servicios.inventario = min_tipo_inventario.codigo
            INNER JOIN
        mco_unidad ON mco_unidad.codigo = min_productos_servicios.mco_unidad
        	INNER JOIN
	min_valoracion ON min_valoracion.codigo_producto = min_productos_servicios.codigo
        WHERE min_productos_servicios.eliminado = 'no' AND min_productos_servicios.inventario = 12
        ORDER BY min_productos_servicios.nombre " . $a->print_sql_limit()
                                );

                                while($test = mysql_fetch_array($result))
                                {


                                    $id = $test['codigo'];
                                    $precio = $test['precio'];

                                    $sql2 = "SELECT  max(min_valoracion_historico.fecha) as fecha FROM min_valoracion_historico WHERE codigo_producto = '$id'";
                                    $result2=mysql_query($sql2);

                                    $test2 = mysql_fetch_array($result2);
                                    $fecha = $test2['fecha'];

                                    $fecha_actual = fecha_sicap();

                                    $b =  dateDiff($fecha,$fecha_actual );


                                    echo "<tr align='center'>";
                                    //echo"<td><font color='black'>" .$test['codigo']."</font></td>";

                                    if($b > 15){

                                        echo"<td style='background-color: #dc4241' ><font color='black'>". utf8_multiplataforma($test['nombre']) ."</font></td>";

                                        echo "<td style='background-color: #dc4241'>  <input type='text' id='valor" .$id."' value='". formatear_ve($precio) ."'/>  </td>";
                                        echo"<td style='background-color: #c83c3b'> <a href ='#' class='hola' id='$id'>Actualizar</a> </td>";
                                    }else{
                                        echo"<td  ><font color='black'>". utf8_multiplataforma($test['nombre']) ."</font></td>";

                                        echo "<td >  <input type='text' id='valor" .$id."' value='". str_replace('.','',formatear_ve($precio))  ."'/>  </td>";
                                        echo"<td > <a href ='#' class='hola' id='$id'>Actualizar</a> </td>";
                                    }
                                    echo "</tr>";
                                }



                                mysql_close($conn);

                                ?>

                            </table>
                            <br/>


                            <?php $a->print_sql_foot(); ?>
                            <br/><br/><br/>
                            <a href="../../min_menu.php"><input type="button" value="Atras"></a>
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
