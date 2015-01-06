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
<meta name="author" content="leonelsoriano3@gmail.com" />
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
    <h1><img src="images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Configuración </strong></h1>
    <ul id="nav" class="dropdown dropdown-horizontal">

            <li><span class="dir">Datos Básicos</span>

                <ul>
                    <li><a href="./" class="dir">mrh - Módulo de Recursos Humanos</a>
				<ul>
					<li><a href="importarempleado.php">Importar Empleado</a></li>
				</ul>
			</li>
			<li><a href="./" class="dir">mno - Módulo de Nómina</a>
				<ul>
					<li><a href="./mco/montoconstante/montoconstante.php">Constantes</a></li>
                    <li><a href="./mco/formulaconcepto/formulaconcepto.php">Conceptos</a></li>
				</ul>
			</li>
                    <li><a href="./mco/backup_mensual/backup_mensual.php">Cierre Mensual</a></li>
                    <li><a href="./mco/configuracion/configuracion_general_empresa.php">Configuración General</a></li>
                    <li><a href="./mco/tabuladores/tabulador_atiguedad.php">Tabulador de Antigüedad</a></li>
                    <li><a href="./mco/tabuladores/tabulador_anhio_servicio.php">Tabulador Años de Servicio</a></li>
                    <li><a href="./mco/bono/bono.php">Bonos</a></li>
                    <li><a href="./mco/variables_de_sistema/variables.php">Variables</a></li>
                    <li><a href="./mco/efectuar_requisicion/efectuar_requisicion.php">Efectuar Requisición</a></li>
                    <li><a href="./mco/bono/bono_variable.php">Bono Variable</a></li>
                    <li><a href="./mco/organigrama/configurar_organigrama.php">Configurar Organigrama</a></li>
                    <li><a href="./mco/organigrama/und_organigrama.php">Ver Organigrama</a></li>
                    <li><a href="./und_organigrama.php"> Diagrama de Producción </a></li>
                    <li><a href="./mco/reabrir_orden/reabrir_orden.php"> Reabrir Orden </a></li>
                    <li><a href="./mco/unidades_erogacion/unidades_erogacion.php"> Unidades Erogación </a></li>
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
