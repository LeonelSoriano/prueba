<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 18/09/14
 * Time: 11:59 AM
 */
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html >
<head>
    <title>SICAP | Sistema Integral de Costos</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="author" content="Leonel Soriano leonelsoriano3@gmail.com" />
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
                            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Bienes | Asignación Ver</strong></h1>
                            <br/><br/>
                            <table border=none class="tablas-nuevas" style="text-align: center">


                                <tr>
                                    <?php
                                    include("../../db.php");
                                    $result=mysql_query("SELECT
bie_realizar_mantenimiento.codigo as codigo,
bie_tipo.nombre_bien as nombre_bien,
bie_tipo_bien.nombre as nombre_tipo,
bie_realizar_mantenimiento.codigo_contable as codigo_contable,
bie_realizar_mantenimiento.numero_factura as numero_factura,
bie_realizar_mantenimiento.costo as costo,
bie_realizar_mantenimiento.medida_especial as medida_especial,
bie_realizar_mantenimiento.codigo_bien_tipo as tipo_bien
FROM bie_realizar_mantenimiento
INNER JOIN bie_tipo_bien
ON bie_tipo_bien.codigo = bie_realizar_mantenimiento.codigo_bien_tipo
INNER JOIN (
SELECT bie_tipo_activo_principal.tipo as tipo,bie_tipo_activo_principal.codigo,bie_tipo_activo_principal.nombre_bien FROM bie_tipo_activo_principal

union
SELECT bie_tipo_vehiculo.tipo as tipo,bie_tipo_vehiculo.codigo,bie_tipo_vehiculo.nombre_bien FROM bie_tipo_vehiculo

union
SELECT bie_tipo_basico.tipo as tipo,bie_tipo_basico.codigo,bie_tipo_basico.nombre_bien FROM bie_tipo_basico

union
SELECT bie_tipo_maquinaria.tipo as tipo,bie_tipo_maquinaria.codigo,bie_tipo_maquinaria.nombre_bien FROM bie_tipo_maquinaria

)as bie_tipo
on bie_tipo.codigo = bie_realizar_mantenimiento.codigo_bien AND bie_tipo.tipo = bie_realizar_mantenimiento.codigo_bien_tipo
INNER JOIN bie_mantenimiento
ON bie_mantenimiento.codigo = bie_realizar_mantenimiento.codigo_mantenimiento
WHERE bie_realizar_mantenimiento.eliminado = 'n';");


                                    echo('  <tr id="tmp">
                                    <th>Nombre del Bien</th>
                                    <th>Tipo de Bien</th>
                                    <th>Codigo Contable</th>
                                    <th>Numero de Factura</th>
                                    <th>Costo</th>
                                    <th>Medida Especial</th>
                                    <th></th>
                                    <th></th>
                                </tr>');



                                    while($test = mysql_fetch_array($result)){

                                        $id = $test['codigo'];
                                        $nombre_bien = $test['nombre_bien'];
                                        $nombre_tipo = $test['nombre_tipo'];
                                        $codigo_contable = $test['codigo_contable'];
                                        $numero_factura = $test['numero_factura'];
                                        $costo = $test['costo'];
                                        $medida_especial = $test['medida_especial'];
                                        $tipo_bien = $test['tipo_bien'];


                                        echo "<tr align='center'>";
                                        echo"<td><font color='black'>". $nombre_bien . "</font></td>";
                                        echo"<td><font color='black'>". $nombre_tipo. "</font></td>";
                                        echo"<td><font color='black'>". $codigo_contable. "</font></td>";
                                        echo"<td><font color='black'>". $numero_factura. "</font></td>";
                                        echo"<td><font color='black'>". $costo. "</font></td>";

                                        if($medida_especial != '' && $tipo_bien == '2'){
                                            echo"<td><font color='black'>". $medida_especial. "  Unidades</font></td>";
                                        }else if($medida_especial != '' && $medida_especial == '3'){
                                            echo"<td><font color='black'>". $medida_especial. "  Kmts</font></td>";

                                        }else{
                                            echo"<td><font color='black'>". $medida_especial. "</font></td>";
                                        }



                                        echo"<td> <a href ='mod_realizar_mantenimiento.php?id=$id'>Modificar</a></td>";
                                        echo"<td> <a href ='del_realizar_mantenimiento?id=$id'>Borrar</a></td>";
                                        echo "</tr>";
                                    }
                                    mysql_close($conn);
                                    ?>
                                </tr>

                            </table>
                            <br/>
                            <a href="realizar_mantenimiento.php"><input type="button" value="Atras"></a>
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