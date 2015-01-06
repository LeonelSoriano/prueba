<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html >
<head>
    <title>SICAP | Sistema Integral de Costos</title>
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
                            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Bienes | Rutas Ver</strong></h1>
                            <br/><br/>
                            <table border=none class="tablas-nuevas" style="text-align: center">

                                <tr id="tmp">
                                    <th>Nombre de Origen</th>
                                    <th>Nombre de Llegada</th>
                                    <th>Distancia (Km.)</th>

                                    <th></th>


                                </tr>
                                <tr>
                                    <?php
                                    include("../../db.php");
                                    $result=mysql_query("SELECT * FROM bie_rutas WHERE eliminado = 'n'");
                                    while($test = mysql_fetch_array($result)){

                                        $id = $test['codigo'];
                                        $origen_codigo_google = $test['origen_codigo_google'];
                                        $distancia = $test['distancia'];
                                        $llegada_codigo_google = $test['llegada_codigo_google'];

                                        $nombre_completo = $primer_nombre . ' ' . $segundo_nombre . ' ' . $apellido;

                                        echo "<tr align='center'>";
                                        echo"<td><font color='black'>". $origen_codigo_google . "</font></td>";
                                        echo"<td><font color='black'>". $llegada_codigo_google. "</font></td>";
                                        echo"<td><font color='black'>". $distancia. "</font></td>";

                                        echo"<td> <a href ='ruta_del.php?id=$id'>Borrar</a></td>";
                                        echo "</tr>";
                                    }
                                    mysql_close($conn);
                                    ?>
                                </tr>

                            </table>
                            <br/>
                            <a href="./crear_ruta.php"><input type="button" value="Atras"></a>
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