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
    <h1><img src="images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Recursos Humanos </strong></h1>
    <ul id="nav" class="dropdown dropdown-horizontal">
            <li><span class="dir">Datos Básicos</span>
		<ul>

                        <!--<li><a href="configuracion.php">Configuracion</a></li>-->	
                        <!--<li><a href="departamento.php">Departamento</a></li>-->

			<!--<li><a href="gerencia.php">Gerencia</a></li>-->
			<!--<li><a href="jornada.php">Jornada</a></li>-->

		</ul>
            </li>
            <li><span class="dir">Procesos</span>
		<ul>

                        <li><a href="analisisxempleado.php">Analisis por Empleado</a></li>
		</ul>
            </li>

        </li>
        <li><span class="dir">Importar</span>
            <ul>
                <li><a href="importar_empleado.php">Importar Empleados</a></li>
                <li><a href="importar_turnoXempleado.php">Importar Turno por Empleado</a></li>
                <li><a href="importar_carga_familar.php">Importar Carga Familar</a></li>

            </ul>
        </li>



            <li><span class="dir">Reportes</span>
		<ul>
			<li><a href="#" class="dir">Reportes de Turnos</a>
				<ul>
					<li><a href="./reporte_horarios.php">Reporte de Horarios</a></li>
					<li><a href="./reporte_empleados.php">Reporte de Empleados</a></li>
					<li><a href="./pre_reporte_horario_persona.php">Reporte de Horario Trabajodor</a></li>
					<li><a href="./pre_reporte_horario_departamento.php">Reporte de Horario por Departamento</a></li>
					<li><a href="./pre_reporte_departamento_horario_empleado.php">Reporte de Horarios por Departamentos </a></li>
					<li><a href="./reporte_cargo.php">Reporte de Cargos </a></li>

				</ul>
			</li>

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
                    <td width="364"><p>Recursos Humanos:</p>
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
