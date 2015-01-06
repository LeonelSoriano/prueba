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
                            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Bienes | Asignación Ver</strong></h1>
                            <br/><br/>
                            <table border=none class="tablas-nuevas">

                                <tr id="tmp">
                                    <th>Nombre del Bien</th>
                                    <th>Nombre Trabajador</th>
                                    <th>Fecha Asignación</th>
                                    <th>Fecha de Culminación</th>
                                    <th></th>
                                    <th></th>

                                </tr>
                                <tr>
                                    <?php
                                    include("../../db.php");
                                    $result=mysql_query("SELECT bie_asignaciones.codigo as codigo, mrh_empleado.primernombre as nombre_empleado_primer,
mrh_empleado.segundonombre as nombre_empleado_segundo, mrh_empleado.primerapellido as nombre_empleado_apellido,
bienes.nombre_bien as nombre_bien, bienes.tipo as tipo, bienes.codigo as codigo_bien,
bie_asignaciones.fecha_asignacion as fecha_asignacion, bie_asignaciones.fecha_culminacion as fecha_culminacion

FROM bie_asignaciones
  INNER JOIN mrh_empleado ON
                            mrh_empleado.codigo = bie_asignaciones.codigo_trabajador

INNER JOIN

  ( (SELECT nombre_bien,tipo,codigo
   FROM bie_tipo_basico WHERE eliminado = 'n')
UNION
(SELECT nombre_bien,tipo,codigo
 FROM bie_tipo_maquinaria WHERE eliminado = 'n')
UNION
(SELECT nombre_bien,tipo,codigo
 FROM bie_tipo_basico WHERE eliminado = 'n')) as bienes

on bie_asignaciones.codigo_bien = bienes.codigo AND bie_asignaciones.codigo_tipo_bien = bienes.tipo

WHERE bie_asignaciones.desasignado = 'n' AND bie_asignaciones.eliminado = 'n'");
                                    while($test = mysql_fetch_array($result)){

                                        $id = $test['codigo'];
                                        $primer_nombre = $test['nombre_empleado_primer'];
                                        $segundo_nombre = $test['nombre_empleado_segundo'];
                                        $apellido = $test['nombre_empleado_apellido'];
                                        $tipo = $test['tipo'];
                                        $nombre_bien = $test['nombre_bien'];
                                        $fecha_asignacion = $test['fecha_asignacion'];
                                        $fecha_culminacion = $test['fecha_culminacion'];

                                        $nombre_completo = $primer_nombre . ' ' . $segundo_nombre . ' ' . $apellido;

                                        echo "<tr align='center'>";
                                        echo"<td><font color='black'>". $nombre_bien . "</font></td>";
                                        echo"<td><font color='black'>". $nombre_completo. "</font></td>";
                                        echo"<td><font color='black'>". $fecha_asignacion. "</font></td>";
                                        echo"<td><font color='black'>". $fecha_culminacion . "</font></td>";



                                        echo"<td> <a href ='asignar_mod.php?id=$id'>Modificar</a></td>";
                                        echo"<td> <a href ='asignar_del.php?id=$id'>Borrar</a></td>";
                                        echo "</tr>";
                                    }
                                    mysql_close($conn);
                                    ?>
                                </tr>

                            </table>
                            <br/>
                            <a href="./asignar_bien.php"><input type="button" value="Atras"></a>
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