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
    <h1><img src="images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Nómina </strong></h1>
    <ul id="nav" class="dropdown dropdown-horizontal">
        <li><span class="dir">Básicos</span>
		<ul>
                        <li><a href="./mno/gerencia/gerencia.php">Gerencia</a></li>
                        <!--<li><a href="./mno/constante/constante.php">Constantes General</a></li>-->
                        <!--<li><a href="./mno/concepto/concepto.php">Conceptos General</a></li>-->
                        <!--<li><a href="./mno/montoconstante/montoconstante.php">Monto Constantes General</a></li>-->
                        <!--<li><a href="./mno/formulaconcepto/formulaconcepto.php">Formula Conceptos General</a></li>-->
                        <!--<li><a href="./mno/comisiones_ventas/comisiones_ventas.php">Comisiones de Ventas</a></li>-->
                        <!--<li><a href="./mno/comisiones_cobranzas/comisiones_cobranzas.php">Comisiones de Cobranzas</a></li>-->
                        <!--<li><a href="./mno/proceso_empleados/proceso_empleados.php">Asignación de Empleado</a></li>-->


		</ul>
        </li>

            <li><span class="dir">Procesos de Empleados</span>
		<ul>
						<!--<li><a href="./mno/beneficio_hijos/beneficio_hijos.php">Beneficios Hijos</a></li>-->
						<!--<li><a href="./mno/beneficio_periodicos/beneficio_periodicos.php">Beneficios Periodicos</a></li>-->


                        <li><a href="./mno/concepto_bonos_fijos/concepto_bonos_fijos.php">Bonos Fijos</a></li>
            <li><a href="./mno/concepto_bonos/concepto_bonos.php">Bonos</a></li>
            <li><a href="./mno/concepto_primas/concepto_primas.php">Primas</a></li>
            <li><a href="./mno/concepto_comisiones/concepto_comisiones.php">Comisiones</a></li>



                        <li><a href="./mno/concepto_aportes/concepto_aportes.php">Aportes</a></li>
                        <li><a href="./mno/concepto_apartados/concepto_apartados.php">Apartados</a></li>
                        <li><a href="./mno/concepto_otros/concepto_otros.php">Otros Beneficios Laborales</a></li>
                        <li><a href="./mno/concepto_empleados/concepto_empleados.php">Conceptos por Empleado</a></li>
                        <li><a href="./mno/carga_laboral/carga_laboral.php">Carga Laboral</a></li>
		</ul>
            </li>
            <li>
                <span class="dir">Opciones de Proceso</span>
		<ul>
                       <li><a href="./mno/importar_datos/importar_datos.php">Importar Datos</a></li>
                        <li><a href="./mno/copiar_concepto_empleados/copiar_concepto_empleados.php">Copiar Conceptos entre Empleados</a></li>
                        <li><a href="./mno/copiar_concepto_periodicos/copiar_concepto_periodicos.php">Copiar Conceptos Periodicos</a></li>

		</ul>
        </li>

        </li>
        <li><span class="dir">Reporte</span>
            <ul>

                <li><a href="./mno/reporte/reporte_salario.php">Reporte Salarios</a></li>
                <li><a href="./mno/reporte/pre_reporte_costo_empleado.php">Reporte Costo Empleado</a></li>


            </ul>
        </li>

        <li>
            <span class="dir">Importar</span>
            <ul>
                <li><a href="./mno/importar/importar_sueldo.php">Importar Datos</a></li>

            </ul>
        </li>
            <li><a href="seleccion_sicap.php">Atras</a>
            </li>
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
