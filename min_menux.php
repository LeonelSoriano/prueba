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


</head>

<body class="flickr-com">
    <div id="body_bottom_bgd">
        <div id="">

                <div align="justify" id="right_col" >
                    <div id="header">
                    </div>
                        <div id="">
                            <div id="firefoxbug"><!-- firefoxbug -->
                               <!-- <div id="blue_line"></div>-->
                                <div class="dynamicContent" align="left">
                                  <!--  <h1>Inicio</h1>-->
    <!--<p><a href="seleccion_sicap.php" class="main-site">Principal</a></p>-->
    <h1><img src="images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Inventario </strong></h1>
    <ul id="nav" class="dropdown dropdown-horizontal">
            <li><span class="dir">Datos Básicos</span>
		<ul>
                        <li><a href="./min/inventario/inventario.php">Inventario</a></li>
                        <li><a href="./min/compras/compras.php">Compras</a></li>
                        <li><a href="./min/venta/venta.php">Venta</a></li>
                        <li><a href="./min/empresa/empresa.php">Empresa</a></li>
                        <li><a href="./min/cliente/cliente.php">Cliente</a></li>
                        <li><a href="./min/inventario/inventario_ver.php">Ver Inventario</a></li>
                        <li><a href="./min/venta/cobro.php">Combro de Venta</a></li>
                        <li><a href="./min/tmp/requisicion.php">Requisición</a></li>
                        <li><a href="./min/inventario/actualizar_no_inventariable.php?paso=0">Actualizar no Inventariable</a></li>
                        <li><a href="./min/inventario/desincorporar.php">Desincorporar de Inventario</a></li>

		</ul>
            </li>
            <li><span class="dir">Procesos</span>
		<ul>
			<!--<li><a href="">Opción</a></li>-->
            <li><a href="./min/valoracion/valoracion.php">Valoración</a></li>
		</ul>
            </li>
            <li><span class="dir">Reportes</span>


				<ul>
					<li><a href="./min/reporte/pre_reporte_articulo">Reporte de Articulo</a></li>
					<li><a href="./min/reporte/pre_reporte_historico_producto.php">Historial Productos</a></li>
					<li><a href="./min/reporte/reporte_proveedor.php">Reporte Proveedor</a></li>

				</ul>
			</li>

        </li>
        <li><span class="dir">Importar</span>
            <ul>
                <li><a href="./min/importe/importar_inventario.php">Importar Inventario</a></li>

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
                    <td width="364"><p>Inventarios:</p>
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
