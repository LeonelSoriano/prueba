<?php

include_once('clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
    <title>SICAP | Sistema Integral de Costos</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="css/helper.css" media="screen" rel="stylesheet" type="text/css" />
    <meta name="author" content="Leonel Soriano leonelsoriano3@gmail.com" />
    <link href="css/dropdown/dropdown.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="css/dropdown/themes/flickr.com/default.ultimate.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="./css/stylesheet.css" rel="stylesheet" type="text/css" />
    <!-- Beginning of compulsory code below -->
    <!-- / END -->
</head>

<body class="flickr-com">
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
                        <!--<p><a href="seleccion_sicap.php" class="main-site">Principal</a></p>-->
                        <h1><img src="images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Bienes y Propiedades </strong></h1>
                        <ul id="nav" class="dropdown dropdown-horizontal">
                            <li><span class="dir">Datos Básicos</span>
                                <ul>
                                    <li><a href="./bie/bienes/agregar_bienes.php">Agregar Bienes</a></li>
                                    <li><a href="./bie/bienes/bienes_ver.php">Ver Bienes</a></li>
                                    <li><a href="./bie/asignaciones/asignar_bien.php">Asignar Bienes</a></li>
                                    <li><a href="./bie/rutas/crear_ruta.php">Crear Rutas</a></li>
                                    <li><a href="./bie/mantenimiento/crear_mantenimiento.php">Crear Mantenimiento</a></li>
                                    <li><a href="./bie/realizar_mantenimiento/realizar_mantenimiento.php">Realizar Mantenimiento</a></li>
                                    <li><a href="./bie/reviciones_diarias_maquinaria_vehiculo/vehiculo.php">Revicion Diaria Vehículo</a></li>
                                    <li><a href="./bie/cuadro/cuadro.php">Información de Mantenimiento</a></li>
                                    <li><a href="./bie/uso_mensual/uso_mensual.php">Uso Mensual</a></li>
                                </ul>
                            </li>
                            <li><span class="dir">Procesos</span>
                                <ul>
                                    <li><a href="">Opción</a></li>
                                </ul>
                            </li>
                            <li><span class="dir">Reportes</span>

                                <ul>
                                    <li><a href="./bie/reporte/pre_reporte_activos">Reporte de Activos</a></li>

                                </ul>

                            </li>



                            <li><span class="dir">Importar</span>

                                <ul>
                                    <li><a href="./bie/importar/importar_bienes.php">Importar Bienes</a></li>

                                </ul>

                            </li>




                            <li><a href="seleccion_sicap.php">Atras</a></li>
                        </ul>
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

        <p>&nbsp;	</p>
        <p>
            <!--end right_col-->
        </p>
        <p>&nbsp; </p>
        <div class="clearboth"></div>
    </div>
    <div align="center" class="pie">SICAP 2014</div>
</div>
<!-- Beginning of compulsory code below -->
<!-- / END -->
</body>
</html>
