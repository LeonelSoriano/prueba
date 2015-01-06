<?php

include_once('clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>SICAP | Sistema Integral de Costos</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="author" content="Tomas Bagdanavicius, http://www.lwis.net/free-css-drop-down-menu/" />
    <meta name="keywords" content=" css, dropdowns, dropdown menu, drop-down, menu, navigation, nav, horizontal, vertical left-to-right, vertical right-to-left, horizontal linear, horizontal upwards, cross browser, internet explorer, ie, firefox, safari, opera, browser, lwis" />
    <meta name="description" content="Clean, standards-friendly, modular framework for dropdown menus" />
    <link href="css/helper.css" media="screen" rel="stylesheet" type="text/css" />
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
                        <h1><img src="images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Producción </strong></h1>
                        <ul id="nav" class="dropdown dropdown-horizontal">
                            <li><span class="dir">Datos Básicos</span>
                                <ul>
                                    <li><a href="./prc/registrar_semielaborados/semielaborados.php">Registar Semi Elavorado Para Producto</a></li>
                                    <li><a href="./prc/registrar_elaborados/elaborados.php">Ingresar Productos  Elavorados</a></li>
                                    <li><a href="./prc/registrar_etapas/producto_etapa.php">Ingresar Etapas</a></li>
                                    <li><a href="./prc/registrar_etapas/detalles_etapa.php">Detalles Etapas</a></li>
                                    <li><a href="./prc/orden_trabajo/crear_orden_trabajo.php" >Crear Orden de Trabajo </a></li>
                                    <li><a href="./prc/agregar_articulos/nuevo_semielaborado.php">Agregar Nuevo Producto Semi Elavorado</a></li>
                                    <li><a href="./prc/agregar_articulos/nuevo_elaborado.php">Productos Terminados</a></li>
                                    <li><a href="./prc/agregar_trabajador_orden/agregar_trabajador_orden.php">Agregar Trabajador a Orden</a></li>
                                    <li><a href="./prc/orden_trabajo/ver_detalles_orden_trabajo.php">Reporte de Etapas</a></li>
                                    <li><a href="./prc/orden_trabajo/ver_horas_orden_trabajo.php">Reporte de Horas/Trabajador</a></li>
                                    <li><a href="./prc/cerrar_orden/cerrar_orden.php">Cerrar Orden</a></li>
                                    <!--<li><a href="./min/cliente/cliente.php">Cliente</a></li>-->


                                </ul>
                            </li>
                            <li><span class="dir">Procesos</span>
                                <ul>
                                    <li><a href="./min/uso_consumo/uso_consumo.php">Uso/Consumo</a></li>
                                    <li><a href="./min/valoracion/valoracion.php?paso=0">Valoración</a></li>
                                    <li><a href="min/requisicion_etapa/requisicion_etapa.php">Requisición Orden</a></li>
                                </ul>
                            </li>
                            <li><span class="dir">Reporte</span>
                                <ul>

                                    <li>    <a href="prc/reporte/pre_reporte_proceso.php" > Reporte Procesos</a> </li>
                                    <li>    <a href="prc/reporte/pre_reporte_mano_obra.php" > Reporte Mano de Obra</a> </li>
                                    <li>    <a href="prc/reporte/pre_reporte_costo_primo.php" > Reporte Costo Primo</a> </li>
                                    <li>    <a href="prc/reporte/pre_Reporte_materiales_usados.php" > Reporte de Materiales Usadaos</a> </li>
                                    <li>    <a href="prc/reporte/pre_reporte_tarjeta_estandar.php" > Tarjeta de Lista Estandar</a> </li>
                                    <li>    <a href="prc/reporte/pre_reporte_materiales.php" > Reporte de Materiales</a> </li>
                                    <li>    <a href="prc/reporte/pre_reporte_mano_obra.php" > Reporte de Mano de Obra por Orden de Producción</a> </li>
                                    <li>    <a href="prc/reporte/pre_reporte_estructura_costo.php" >Reporte Estructura de Costo</a> </li>

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
        <table width="983" border="0">
            <tr>
                <td width="601">&nbsp;</td>
                <td width="364"><p>Producción:</p>
                    <p></p>

            </tr>
        </table>
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
