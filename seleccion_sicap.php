<?php

include_once('clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <title>SICAP | Sistema Integral de Costos</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="css/reset.css" type="text/css" media="screen">
	<link rel="stylesheet" href="css/style_new.css" type="text/css" media="screen">
	<link rel="stylesheet" href="css/zerogrid.css" type="text/css" media="all">
	<link rel="stylesheet" href="css/responsive.css" type="text/css" media="all">


    <!--<link rel="stylesheet" media="screen" href="http://openfontlibrary.org/face/dancing" rel="stylesheet" type="text/css"/>-->
    <script src="js/jquery-1.6.2.min.js" type="text/javascript"></script>
	<script src="js/cufon-yui.js" type="text/javascript"></script>
	<script src="js/cufon-replace.js" type="text/javascript"></script>
	<script src="js/Vegur_300.font.js" type="text/javascript"></script>
	<script src="js/Vegur_400.font.js" type="text/javascript"></script> 
	<script src="js/FF-cash.js" type="text/javascript"></script>	   
	<script type="text/javascript" src="js/css3-mediaqueries.js"></script>
	<!--[if lt IE 7]>
		<div style=' clear: both; text-align:center; position: relative;'>
			<a href="http://www.microsoft.com/windows/internet-explorer/default.aspx?ocid=ie6_countdown_bannercode"><img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0"  alt="" /></a>
		</div>
	<![endif]-->
	<!--[if lt IE 9]>
   		<script type="text/javascript" src="js/html5.js"></script>
		<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen">
	<![endif]-->
</head>
<body id="page1" class="bg">
	<div >
<!-- header -->
		<header>
			<div class="menu-row">
				<div class="main">
					<div class="zerogrid">
						<div class="row">
							<div class="col-full"><div class="wrap-col" style="margin-top: 70px;">
								<!--<nav class="wrapper">
									<ul class="menu">
										<li><a class="active" href="index.html">About us</a></li>
										<li><a href="services.html">Services</a></li>
										<li><a href="therapies.html">Therapies</a></li>
										<li><a href="staff.html">Our Staff</a></li>
										<li class="last-item"><a href="contacts.html">Contacts</a></li>
									</ul>
								</nav> -->
								<h1 id="header_nombre" style="display: table;margin-bottom: 12px"><a href="index.html"><img src="images/index.png" title="zSpaSalon" style="max-height: 130px"/></a>
                                   <div id="header_nombre_span" style=" display: table-cell;
vertical-align: middle;">

                                Bienvenido al SICAP <br/>Menú Principal
                            </div> <a href="index.html"><img src="images/index2.png" title="zSpaSalon" style="max-height: 130px;float:right;"/></a></h1>

								<div id="mis_iconos" >

                                    <div  id="icon_1"><a href="seg_menu.php"> <img src="./images/1.jpg" title="Seguridad"  style="height: 100px"/> </a><div>Seguridad</div></div>

                                    <div  id="icon_2"><a href="mrh_menu.php"><img src="./images/2.jpg" title="Recursos Humanos" style="height: 100px"/> </a><div>Recursos Humanos</div></div>

                                    <div  id="icon_3"><img src="./images/3.jpg" title="Contabilidad" style="height: 100px"/> <div>Contabilidad</div></div>

                                    <div  id="icon_4"><img src="./images/4.jpg" title="Producción/Servicio" style="height: 100px"/> <div>Producción/Servicio</div></div>

                                    <div  id="icon_5"><a href="bie_menu.php"><img src="./images/5.jpg" title="Bienes y Propiedades" style="height: 100px"/></a> <div>Bienes y Propiedades</div></div>

                                    <div  id="icon_6"><a href="min_menu.php"><img src="./images/6.jpg" title="Inventarios" style="height: 100px"/></a> <div>Inventarios</div></div>

                                    <div  id="icon_7"><a href="prc_menu.php"><img src="./images/7.jpg" title="Procesos" style="height: 100px"/></a> <div>Procesos</div></div>

                                    <div  id="icon_8"><a href="indicador_menu.php"><img src="./images/8.jpg" title="Indicadores de Gestión" style="height: 100px"/></a> <div>Indicadores de Gestión</div></div>

                                    <div  id="icon_9"><img src="./images/9.jpg" title="Presupuesto" style="height: 100px"/> <div>Presupuesto</div></div>

                                    <div  id="icon_10"><img src="./images/10.jpg" title="Costos y Gastos" style="height: 100px"/> <div>Costos y Gastos</div></div>

                                    <div  id="icon_11"><a href="cos_menu.php"><img src="./images/11.jpg" title="Costos y Precio de Bienes y Servicios" style="height: 100px"/></a> <div>Costos y Precio de Bienes y Servicios</div></div>

                                    <div  id="icon_12"><img src="./images/12.jpg" title="Reportes" style="height: 110px"/> <div>Reportes</div></div>

                                    <div  id="icon_13"><a href="gra_menu.php"><img src="./images/13.jpg" title="Gráficos" style="height: 110px"/> <div>Gráficos</div></a></div>

                                    <div  id="icon_14"><a href="mco_menu.php"><img src="./images/14.jpg" title="Configuración" style="height: 110px"/> <div>Configuración</div></div>

                                    <div  id="icon_15"><a  href="mno_menu2.php"><img src="./images/15.jpg" title="Nomina" style="height: 110px"/></a> <div>Nomina</div></div>


								</div>


							</div>  </div>
						</div>


                        <div style='width: 70%;margin-left: 10%;margin-top: 40px;margin-bottom: 20px'><marquee ><p  align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;'><span style='font-size:1.2em;color: #0DC2CE;font-weight: bold'> SICAP 
  Sistema Integral de Costos  La solución más eficaz a sus problemas 
  Desarrollado por Grupo SICAP . Derechos
  Reservados ©.<o:p></o:p></span></p></marquee>

                        </div>
					</div>
				</div>
			</div>
		</header>

<!-- content -->
    <div class="main">
        <div class="zerogrid">
            <div class="row">
                <div class="col-1-1 border-bot" ></div>
            </div>
        </div>
    </div>


		<section id="content">
			<div class="main">
				<div class="zerogrid">
					<div class="row">
						<article class="col-1-5"><div class="wrap-col">

							<h3>Bondades del Sistema</h3>
                            <ul class="list-1">
							<!--<time class="tdate-1" datetime="2011-08-22"><a href="#">22.08.2011</a></time>-->
							<li>Conocer costos en forma inmediata que pueden ser: unitarios, por actividades, por horas-hombre, entre otros. </li>
							<!--<time class="tdate-1" datetime="2011-08-17"><a href="#">17.08.2011</a></time>-->
                                <li>Generar reportes para toma de decisiones.</li>
							<!--<time class="tdate-1" datetime="2011-08-09"><a href="#">09.08.2011</a></time>-->
                                <li>Analizar variaciones de costos. </li>
                                <li>Verificar indicadores de gestión.</li>
                                <li>Realizar presupuestos.</li>
                                <li>Calcular el punto de equilibrio.</li>
                                <li>Generar Estructuras de Costos.</li>
                                    <li>Trabajo en línea.</li>
                                </ul>
						</div></article>

						<article class="col-2-4"><div class="wrap-col">
							<div class="indent-left">
								<h2 style="text-align: center">Gestion</h2>
								<div class="wrapper  indent-bot">
									<div class="col-3-5">
									<figure class="img-indent border"><img src="images/page1-img1.png" height="50px"  width="98%" alt="" /></figure>
									</div>
									<div class="col-2-5 extra-wrap">
										<h4>¿Que se Entiende por Gestion?</h4>
									</div>
                                    Es el conjunto de trámites que se llevan a cabo para resolver un asunto o concretar un proyecto. La gestión es también la dirección o administración de una compañía o de un negocio.
                                </div>

						</div></article>
						<article class="col-1-4"><div class="wrap-col">
							<h3>Marco Legal</h3>
							<div class="wrapper indent-bot2">
								<div class="numb first">1</div>
								<div class="extra-wrap">
									<strong class="text-1"><a href="./pdf/LIVSS.pdf">Ley del Seguro Social</a></strong>

								</div>
							</div>
							<div class="wrapper indent-bot2">
								<div class="numb second">2</div>
								<div class="extra-wrap">
									<strong class="text-1"><a href="./pdf/LOPJ.pdf">Ley Orgánica de Precios Justos</a></strong>
								</div>
							</div>

                            <div class="wrapper indent-bot2">
                                <div class="numb third">3</div>
                                <div class="extra-wrap">
                                    <strong class="text-1"><a href="./pdf/LVH.pdf">Ley del Régimen Prestacional de Vivienda y Hábitat</a></strong>
                                </div>
                            </div>

							<div class="wrapper">
								<div class="numb cuatro">4</div>
								<div class="extra-wrap">
									<strong class="text-1"><a href="./pdf/LOTTT.pdf">Ley Orgánica del Trabajo, Los Trabajadores y Las Trabajadoras</a></strong>
								</div>
							</div>

						</div></article>
					</div>
				</div>
			</div>
		</section>
	</div>
	
<!-- aside -->

	<aside>
		<div class="main">
			<div class="zerogrid">
				<div class="row">
					<!--<article class="col-1-3"><div class="wrap-col">-->
						<!--<h3 class="p1">Estructura de Costo</h3>-->
						<!--<p class="indent-bot"><strong>Conjunto de métodos,</strong> procedimientos y técnicas que servirán para identificar, clasificar y definir los costos directos e indirectos que intervienen en una actividad económica, las misma poder ser: Costo del Servicio Prestado, Costo de la Mercancía Vendida o Costo de Producción y Venta.-->
                        <!--</p>-->
                            <!--<a class="button" href="#">Read More</a>-->
					<!--</div></article>-->
					<article class="col-full"><div class="wrap-col">
						<div class="indent-left3">
							<h4 >IMPORTANCIA DE LOS COSTOS</h4>
                            &nbsp;&nbsp;Es importante ya que podemos conocer los costos relacionados con la elaboración de un bien o servicio, ayuda a tomar decisiones de carácter administrativo y/o financieros, tales como:
                            <br/>
                            <p> &nbsp;&nbsp; <span style="font-weight: bold">Si fabricamos o compramos.</span> Algunas veces una empresa requiere de ciertos productos para fabricar: por ejemplo: para fabricar Mesas de Plástico requieren de plástico, el fabricante de la mesa tendrá que decidir que es más favorable procesar el plástico o comprarlo ya procesado, esto será de acuerdo al costo en que incurriría al fabricarlos y
                                el precio que tendría que pagar al comprarlos ya elaborados.</p>

                            <p>&nbsp;&nbsp; <span style="font-weight:bold"> Expandir y hasta donde la Producción y Ventas.</span> Esto se debe analizar tomando como punto de partida los costos fijos debido a que una reducción en la producción no da como resultado una disminución en ellos un aumento tampoco dará como resultado un aumento en los costos fijos.</p>
                            <p><span style="font-weight:bold">Fijar precios a los productos.</span>  La contabilidad de costos nos proporciona información acerca de los costos de los materiales, mano de obra, gastos de fábrica, gastos de administración y gastos de venta, a partir de lo cual se fijaran precios de venta que proporcionen al negocio cierta ganancia.</p>
                            <p>&nbsp;&nbsp;<span style="font-weight:bold">Importancia de tener un Sistema Integral de Costo:</span> Es importante señalar que las organizaciones deben crear estrategia de negocios que permitan prepararse para los cambios inevitables del entorno, manejando información en tiempo real y oportuna para la mejor toma de decisiones, en cuanto a la competitividad de la misma y su vez adaptándose a las exigencias tanto del mercado como las del marco regulatorio que rigen las empresas.</p>

                        </div>
					</div></article>

				</div>
			</div>
		</div>
	</aside>

<!-- footer -->
	<footer>
		<div class="main">
			<div class="zerogrid" id="mi_footer">


                <div class="zerogrid">
                    <div class="row" id="mi-footer">
                        <article class="col-1-2"><div class="wrap-col">

                            <p class="indent-bot">
                                <span class="letra-verde"> Gupo SICAP</span> Barquisimeto Estado Lara 2014 <br/>
                                Avenida Vargas Esquina Carera 24 Cámara de comercio segundo piso oficina numero 4

                        </div></article>
                        <article class="col-1-2"><div class="wrap-col">
                            <div class="indent-left3">

                                <p class="indent-bot"> Teléfonos: (0251)233 3367 <br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    &nbsp;(0412)641 5861</p>


                            </div>
                        </div></article>

                    </div>
                </div>


            </div>
			</div>
	</footer>

</body>
</html>
