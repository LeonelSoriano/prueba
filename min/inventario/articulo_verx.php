<?php

include_once("../../clases/Paginador.php");
header("Content-Type: text/html;charset=utf-8");
ini_set('display_errors', 'On');
ini_set('display_errors', 1);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html >
<head>
<title>SICAPC | Sistema Integral de Costos</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="author" content="Tomas Bagdanavicius, http://www.lwis.net/free-css-drop-down-menu/" />
<meta name="keywords" content=" css, dropdowns, dropdown menu, drop-down, menu, navigation, nav, horizontal, vertical left-to-right, vertical right-to-left, horizontal linear, horizontal upwards, cross browser, internet explorer, ie, firefox, safari, opera, browser, lwis" />
<meta name="description" content="Clean, standards-friendly, modular framework for dropdown menus" />
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
            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Recursos Humanos | Cargo</strong></h1>
    <br/><br/>

        <?php

            include("../../db.php");
            include_once("../../clases/funciones.php");


            $a = new Paginador("min_productos_servicios",$_GET['paso']);
            $a->print_sql_foot();
        ?>
     <br/>
    <br/>
    <table border=none class="tablas-nuevas">

        <tr style="text-align: center">
            <th style="min-width: 250px">Nombre</th>
            <th>Fecha Registro</th>
            <th>Ubicación</th>
            <th>Inventario</th>
            <th>Unidad Producción</th>
            <th></th>
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
        mco_unidad.sigla as sigla
    FROM
        min_productos_servicios
            INNER JOIN
        min_tipo_inventario ON min_productos_servicios.inventario = min_tipo_inventario.codigo
            INNER JOIN
        mco_unidad ON mco_unidad.codigo = min_productos_servicios.mco_unidad
        WHERE min_productos_servicios.eliminado = 'no'
        ORDER BY min_productos_servicios.nombre " . $a->print_sql_limit()
    );

            while($test = mysql_fetch_array($result))
                {

                        $id = $test['codigo'];

                        echo "<tr align='center'>";
                        //echo"<td><font color='black'>" .$test['codigo']."</font></td>";
                        echo"<td><font color='black'>". utf8_multiplataforma($test['nombre']) ."</font></td>";
                        echo"<td><font color='black'>". utf8_multiplataforma($test['fecha_adquisicion']) ."</font></td>";
                        echo"<td><font color='black'>". utf8_multiplataforma($test['ubicacion']) ."</font></td>";
                        echo"<td><font color='black'>". utf8_multiplataforma($test['tipo']) ."</font></td>";
                        echo"<td><font color='black'>". utf8_multiplataforma($test['descripcion']) ."(".utf8_multiplataforma($test['sigla']) .")"."</font></td>";

                        echo"<td> <a href ='articulo_mod2.php?codigo=$id'>Modificar</a>";
                        echo"<td> <a href ='articulo_del2.php?id=$id'>Borrar</a>";
                        echo "</tr>";
            }



        mysql_close($conn);

        ?>

    </table>
    <br/>


      <?php $a->print_sql_foot(); ?>
     <br/><br/><br/>
    <a href="inventario.php"><input type="button" value="Atras"></a>
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
