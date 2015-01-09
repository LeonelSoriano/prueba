<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 02/10/14
 * Time: 07:41 PM
 */
include("../../db.php");
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
                            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Nómina  | Bonos de Produccion</strong></h1>
                            <br/><br/>
                            <table border=none class="tablas-nuevas">

                                <tr id="tmp" style="text-align: center">
                                    <th>Nombre</th>
                                    <th>Valor</th>
                                    <th>Tipo de Pago</th>
                                    <th>Periocidad</th>

                                    <th></th>
                                    <th></th>

                                </tr>
                                <tr >
                                    <?php




                                    $result=mysql_query("

SELECT
    mno_new_bonos_produccion.codigo as codigo,
    mno_new_bonos_produccion.nombre as nombre,
    mno_new_bonos_produccion.valor as valor,
    mco_forma_pago.nombre as tipo_pago,
    mco_periocidad.nombre as periocidad
FROM
    mno_new_bonos_produccion
        INNER JOIN
    mco_periocidad ON mco_periocidad.codigo = mno_new_bonos_produccion.tipo_periocidad
        INNER JOIN
    mco_forma_pago ON mco_forma_pago.codigo = mno_new_bonos_produccion.tipo_forma_pago
WHERE mno_new_bonos_produccion.eliminado = 'no'
");
                                    while($test = mysql_fetch_array($result)){

                                        $id = $test['codigo'];
                                        $nombre = $test['nombre'];
                                        $valor = $test['valor'];
                                        $tipo_pago = $test['tipo_pago'];
                                        $periocidad = $test['periocidad'];



                                        echo "<tr align='center'>";
                                        echo"<td><font color='black'>". $nombre . "</font></td>";
                                        echo"<td><font color='black'>". $valor. "</font></td>";
                                        echo"<td><font color='black'>". $tipo_pago. "</font></td>";
                                        echo"<td><font color='black'>". $periocidad. "</font></td>";



                                        echo"<td> <a href ='bono_produccion_mod.php?id=$id'>Modificar</a></td>";
                                        echo"<td> <a href ='bono_produccion_del.php?id=$id'>Borrar</a></td>";
                                        echo "</tr>";
                                    }
                                    mysql_close($conn);
                                    ?>
                                </tr>

                            </table>
                            <br/>
                            <a href="./nuevo_bono.php"><input type="button" value="Atras"></a>
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