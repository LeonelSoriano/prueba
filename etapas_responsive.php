<?php

include_once('clases/Seguridad.php');

$a = new Seguridad();

$a->chekear_session();

?>

<?php
/**
 * Created by PhpStorm.
 * User: leonel
 * Date: 27/10/14
 * Time: 02:37 PM
 */
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title></title>
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
    <script src="./js/jquery-1.10.2.js"></script>
    <script src="./lib/Jssor/js/jssor.js"></script>
    <script type="text/javascript" src="./lib/Jssor/js/jssor.slider.js"></script>

    <!--[if lt IE 7]>
    <div style=' clear: both; text-align:center; position: relative;'>
        <a href="http://www.microsoft.com/windows/internet-explorer/default.aspx?ocid=ie6_countdown_bannercode"><img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0"  alt="" /></a>
    </div>
    <![endif]-->
    <!--[if lt IE 9]>
    <script type="text/javascript" src="js/html5.js"></script>
    <link rel="stylesheet" href="css/ie.css" type="text/css" media="screen">


    <![endif]-->



    <style type="text/css">
        #page1 header {min-height:1px; }
        #mis_iconos {min-height:1px; }


        .captionOrange, .captionBlack
        {
            color: #fff;
            font-size: 20px;
            line-height: 30px;
            text-align: center;
            border-radius: 4px;
        }
        .captionOrange
        {
            background: #EB5100;
            background-color: rgba(235, 81, 0, 0.6);
        }
        .captionBlack
        {
            font-size:16px;
            background: #000;
            background-color: rgba(0, 0, 0, 0.4);
        }
        a.captionOrange, A.captionOrange:active, A.captionOrange:visited
        {
            color: #ffffff;
            text-decoration: none;
        }
        a.captionOrange:hover
        {
            color: #eb5100;
            text-decoration: underline;
            background-color: #eeeeee;
            background-color: rgba(238, 238, 238, 0.7);
        }
        .bricon
        {
            background: url(../img/browser-icons.png);
        }


    </style>



    <script>
//        jQuery(document).ready(function ($) {
//            var options = { $AutoPlay: true };
//            var jssor_slider1 = new $JssorSlider$('slider1_container', options);
//        });


        $(function(){
            //Reference http://www.jssor.com/development/slider-with-caption-jquery.html
            //Reference http://www.jssor.com/development/reference-ui-definition.html#captiondefinition
            //Reference http://www.jssor.com/development/tool-caption-transition-viewer.html

            var _CaptionTransitions = [
                //CLIP|LR
                {$Duration: 900, $Clip: 3, $Easing: $JssorEasing$.$EaseInOutCubic },
                //CLIP|TB
                {$Duration: 900, $Clip: 12, $Easing: $JssorEasing$.$EaseInOutCubic },

                //ZMF|10
                {$Duration: 600, $Zoom: 11, $Easing: { $Zoom: $JssorEasing$.$EaseInExpo, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2 },

                //ZML|R
                {$Duration: 600, x: -0.6, $Zoom: 11, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Zoom: $JssorEasing$.$EaseInCubic }, $Opacity: 2 },
                //ZML|B
                {$Duration: 600, y: -0.6, $Zoom: 11, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Zoom: $JssorEasing$.$EaseInCubic }, $Opacity: 2 },

                //ZMS|B
                {$Duration: 700, y: -0.6, $Zoom: 1, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Zoom: $JssorEasing$.$EaseInCubic }, $Opacity: 2 },

                //RTT|10
                {$Duration: 700, $Zoom: 11, $Rotate: 1, $Easing: { $Zoom: $JssorEasing$.$EaseInExpo, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInExpo }, $Opacity: 2, $Round: { $Rotate: 0.8} },

                //RTTL|R
                {$Duration: 700, x: -0.6, $Zoom: 11, $Rotate: 1, $Easing: { $Left: $JssorEasing$.$EaseInCubic, $Zoom: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInCubic }, $Opacity: 2, $Round: { $Rotate: 0.8} },
                //RTTL|B
                {$Duration: 700, y: -0.6, $Zoom: 11, $Rotate: 1, $Easing: { $Top: $JssorEasing$.$EaseInCubic, $Zoom: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInCubic }, $Opacity: 2, $Round: { $Rotate: 0.8} },

                //RTTS|R
                {$Duration: 700, x: -0.6, $Zoom: 1, $Rotate: 1, $Easing: { $Left: $JssorEasing$.$EaseInQuad, $Zoom: $JssorEasing$.$EaseInQuad, $Rotate: $JssorEasing$.$EaseInQuad, $Opacity: $JssorEasing$.$EaseOutQuad }, $Opacity: 2, $Round: { $Rotate: 1.2} },
                //RTTS|B
                {$Duration: 700, y: -0.6, $Zoom: 1, $Rotate: 1, $Easing: { $Top: $JssorEasing$.$EaseInQuad, $Zoom: $JssorEasing$.$EaseInQuad, $Rotate: $JssorEasing$.$EaseInQuad, $Opacity: $JssorEasing$.$EaseOutQuad }, $Opacity: 2, $Round: { $Rotate: 1.2} },

                //R|IB
                {$Duration: 900, x: -0.6, $Easing: { $Left: $JssorEasing$.$EaseInOutBack }, $Opacity: 2 },
                //B|IB
                {$Duration: 900, y: -0.6, $Easing: { $Top: $JssorEasing$.$EaseInOutBack }, $Opacity: 2 },

            ];

            var options = {
                $AutoPlay: true,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
                $AutoPlaySteps: 1,                                  //[Optional] Steps to go for each navigation request (this options applys only when slideshow disabled), the default value is 1
                $AutoPlayInterval: 4000,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
                $PauseOnHover: 1,                               //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, 4 freeze for desktop, 8 freeze for touch device, 12 freeze for desktop and touch device, default value is 1

                $ArrowKeyNavigation: true,   			            //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
                $SlideDuration: 500,                                //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
                $MinDragOffsetToSlide: 20,                          //[Optional] Minimum drag offset to trigger slide , default value is 20
                //$SlideWidth: 600,                                 //[Optional] Width of every slide in pixels, default value is width of 'slides' container
                //$SlideHeight: 300,                                //[Optional] Height of every slide in pixels, default value is height of 'slides' container
                $SlideSpacing: 0, 					                //[Optional] Space between each slide in pixels, default value is 0
                $DisplayPieces: 1,                                  //[Optional] Number of pieces to display (the slideshow would be disabled if the value is set to greater than 1), the default value is 1
                $ParkingPosition: 0,                                //[Optional] The offset position to park slide (this options applys only when slideshow disabled), default value is 0.
                $UISearchMode: 1,                                   //[Optional] The way (0 parellel, 1 recursive, default value is 1) to search UI components (slides container, loading screen, navigator container, arrow navigator container, thumbnail navigator container etc).
                $PlayOrientation: 1,                                //[Optional] Orientation to play slide (for auto play, navigation), 1 horizental, 2 vertical, 5 horizental reverse, 6 vertical reverse, default value is 1
                $DragOrientation: 3,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)

                $CaptionSliderOptions: {                            //[Optional] Options which specifies how to animate caption
                    $Class: $JssorCaptionSlider$,                   //[Required] Class to create instance to animate caption
                    $CaptionTransitions: _CaptionTransitions,       //[Required] An array of caption transitions to play caption, see caption transition section at jssor slideshow transition builder
                    $PlayInMode: 1,                                 //[Optional] 0 None (no play), 1 Chain (goes after main slide), 3 Chain Flatten (goes after main slide and flatten all caption animations), default value is 1
                    $PlayOutMode: 3                                 //[Optional] 0 None (no play), 1 Chain (goes before main slide), 3 Chain Flatten (goes before main slide and flatten all caption animations), default value is 1
                },

                $BulletNavigatorOptions: {                                //[Optional] Options to specify and enable navigator or not
                    $Class: $JssorBulletNavigator$,                       //[Required] Class to create navigator instance
                    $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                    $AutoCenter: 0,                                 //[Optional] Auto center navigator in parent container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                    $Steps: 1,                                      //[Optional] Steps to go for each navigation request, default value is 1
                    $Lanes: 1,                                      //[Optional] Specify lanes to arrange items, default value is 1
                    $SpacingX: 10,                                   //[Optional] Horizontal space between each item in pixel, default value is 0
                    $SpacingY: 10,                                   //[Optional] Vertical space between each item in pixel, default value is 0
                    $Orientation: 1                                 //[Optional] The orientation of the navigator, 1 horizontal, 2 vertical, default value is 1
                },

                $ArrowNavigatorOptions: {
                    $Class: $JssorArrowNavigator$,              //[Requried] Class to create arrow navigator instance
                    $ChanceToShow: 1,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                    $AutoCenter: 2,                                 //[Optional] Auto center arrows in parent container, 0 No, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                    $Steps: 1                                       //[Optional] Steps to go for each navigation request, default value is 1
                }
            };
            var jssor_slider1 = new $JssorSlider$("slider1_container", options);
            //responsive code begin
            //you can remove responsive code if you don't want the slider scales while window resizes
            function ScaleSlider() {
                var parentWidth = jssor_slider1.$Elmt.parentNode.clientWidth;
                if (parentWidth)
                    jssor_slider1.$ScaleWidth(Math.min(parentWidth + 100, 900));
                else
                    window.setTimeout(ScaleSlider, 40);
            }

            ScaleSlider();

            if (!navigator.userAgent.match(/(iPhone|iPod|iPad|BlackBerry|IEMobile)/)) {
                $(window).bind('resize', ScaleSlider);
            }


            //if (navigator.userAgent.match(/(iPhone|iPod|iPad)/)) {
            //    $(window).bind("orientationchange", ScaleSlider);
            //}
            //responsive code end

        });

    </script>

</head>
<body id="page1">
<div class="bg">
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
                                <h1 id="header_nombre" style="display: table;margin-bottom: 12px"><a href="seleccion_sicap.php"><img src="images/index.png" title="zSpaSalon" style="max-height: 130px"/></a>
                                    <div id="header_nombre_span" style=" display: table-cell;
vertical-align: middle;">

                                        Reporte Etapas
                                    </div> </h1>

<!---->
<!--                                <div id="slider1_container" style="position: relative; top: 0px; left: 0px; width: 600px; height: 300px;">-->
<!--                                    <!-- Slides Container -->-->
<!--                                    <div u="slides" style="cursor: move; position: absolute; overflow: hidden; left: 0px; top: 0px; width: 600px; height: 300px;">-->
<!--                                        <div><img u="image" src="lib/Jssor/img/a01.png" /></div>-->
<!--                                        <div><img u="image" src="lib/Jssor/img/a01.png" /></div>-->
<!--                                    </div>-->
<!--                                </div>-->



                                <div id="slider1_container" style="position: relative; top: 0px; left: 0px; width: 600px; height: 300px; overflow: hidden; ">

                                    <!-- Loading Screen -->
                                    <div u="loading" style="position: absolute; top: 0px; left: 0px;">
                                        <div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;
                background-color: #000000; top: 0px; left: 0px;width: 100%;height:100%;">
                                        </div>
                                        <div style="position: absolute; display: block; background: url(./lib/Jssor/img/loading.gif) no-repeat center center;
                top: 0px; left: 0px;width: 100%;height:100%;">
                                        </div>
                                    </div>

                                    <!-- Slides Container -->
                                    <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 600px; height: 300px; overflow: hidden;">
                                        <div>
                                            <img u="image" src="./lib/Jssor/img/photography/002.jpg" />
                                            <div u=caption t="*" class="captionOrange"  style="position:absolute; left:20px; top: 30px; width:300px; height:30px;">
                                                Etapa uno
                                            </div>
                                        </div>
                                        <div>
                                            <img u="image" src="./lib/Jssor/img/photography/003.jpg" />
                                            <div u=caption t="*" class="captionOrange"  style="position:absolute; left:20px; top: 30px; width:300px; height:30px;">
                                                Etapa dos
                                            </div>
                                        </div>
                                        <div>
                                            <img u="image" src="./lib/Jssor/img/photography/004.jpg" />
                                            <div u=caption t="*" class="captionOrange"  style="position:absolute; left:20px; top: 30px; width:300px; height:30px;">
                                                Etapa tres
                                            </div>
                                        </div>
                                        <div>
                                            <img u="image" src="./lib/Jssor/img/photography/005.jpg" />
                                            <div u=caption t="*" class="captionOrange"  style="position:absolute; left:20px; top: 30px; width:300px; height:30px;">
                                                Etapa Cuatro
                                            </div>
                                        </div>
                                        <div>
                                            <img u="image" src="./lib/Jssor/img/photography/006.jpg" />
                                            <div u=caption t="*" class="captionOrange"  style="position:absolute; left:20px; top: 30px; width:300px; height:30px;">
                                                Etapa Cinco
                                            </div>
                                        </div>
                                        <div>
                                            <img u="image" src="./lib/Jssor/img/photography/007.jpg" />
                                            <div u=caption t="*" class="captionOrange"  style="position:absolute; left:20px; top: 30px; width:300px; height:30px;">
                                                Etapa seis
                                            </div>
                                        </div>
                                        <div>
                                            <img u="image" src="./lib/Jssor/img/photography/008.jpg" />
                                            <div u=caption t="*" class="captionOrange"  style="position:absolute; left:20px; top: 30px; width:300px; height:30px;">
                                                Etapa Ocho
                                            </div>
                                        </div>
                                        <div>
                                            <img u="image" src="./lib/Jssor/img/photography/009.jpg" />
                                            <div u=caption t="*" class="captionOrange"  style="position:absolute; left:20px; top: 30px; width:300px; height:30px;">
                                                Etapa Nueve
                                            </div>
                                        </div>
                                        <div>
                                            <img u="image" src="./lib/Jssor/img/photography/010.jpg" />
                                            <div u=caption t="*" class="captionOrange"  style="position:absolute; left:20px; top: 30px; width:300px; height:30px;">
                                                Etapa diez
                                            </div>
                                        </div>
                                        <div>
                                            <img u="image" src="./lib/Jssor/img/photography/011.jpg" />
                                            <div u=caption t="*" class="captionOrange"  style="position:absolute; left:20px; top: 30px; width:300px; height:30px;">
                                                etapa unce
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Bullet Navigator Skin Begin -->
                                    <!-- jssor slider bullet navigator skin 01 -->
                                    <style>
                                        /*
                                        .jssorb01 div           (normal)
                                        .jssorb01 div:hover     (normal mouseover)
                                        .jssorb01 .av           (active)
                                        .jssorb01 .av:hover     (active mouseover)
                                        .jssorb01 .dn           (mousedown)
                                        */
                                        .jssorb01 div, .jssorb01 div:hover, .jssorb01 .av {
                                            filter: alpha(opacity=70);
                                            opacity: .7;
                                            overflow: hidden;
                                            cursor: pointer;
                                            border: #000 1px solid;
                                        }

                                        .jssorb01 div {
                                            background-color: gray;
                                        }

                                        .jssorb01 div:hover, .jssorb01 .av:hover {
                                            background-color: #d3d3d3;
                                        }

                                        .jssorb01 .av {
                                            background-color: #fff;
                                        }

                                        .jssorb01 .dn, .jssorb01 .dn:hover {
                                            background-color: #555555;
                                        }
                                    </style>
                                    <!-- bullet navigator container -->
                                    <div u="navigator" class="jssorb01" style="position: absolute; bottom: 16px; right: 10px;">
                                        <!-- bullet navigator item prototype -->
                                        <div u="prototype" style="POSITION: absolute; WIDTH: 12px; HEIGHT: 12px;"></div>
                                    </div>
                                    <!-- Bullet Navigator Skin End -->

                                    <!-- Arrow Navigator Skin Begin -->
                                    <style>
                                        /* jssor slider arrow navigator skin 02 css */
                                        /*
                                        .jssora02l              (normal)
                                        .jssora02r              (normal)
                                        .jssora02l:hover        (normal mouseover)
                                        .jssora02r:hover        (normal mouseover)
                                        .jssora02ldn            (mousedown)
                                        .jssora02rdn            (mousedown)
                                        */
                                        .jssora02l, .jssora02r, .jssora02ldn, .jssora02rdn
                                        {
                                            position: absolute;
                                            cursor: pointer;
                                            display: block;
                                            background: url(./lib/Jssor/img/a02.png) no-repeat;
                                            overflow:hidden;
                                        }
                                        .jssora02l { background-position: -3px -33px; }
                                        .jssora02r { background-position: -63px -33px; }
                                        .jssora02l:hover { background-position: -123px -33px; }
                                        .jssora02r:hover { background-position: -183px -33px; }
                                        .jssora02ldn { background-position: -243px -33px; }
                                        .jssora02rdn { background-position: -303px -33px; }
                                    </style>
                                    <!-- Arrow Left -->
        <span u="arrowleft" class="jssora02l" style="width: 55px; height: 55px; top: 123px; left: 8px;">
        </span>
                                    <!-- Arrow Right -->
        <span u="arrowright" class="jssora02r" style="width: 55px; height: 55px; top: 123px; right: 8px">
        </span>
                                    <!-- Arrow Navigator Skin End -->
                                    <a style="display: none" href="http://www.jssor.com">slideshow</a>
                                </div>


                                <div  >


<!--                                    <div  id="icon_1"><img src="./images/1.jpg" title="Seguridad" style="height: 100px"/> <div>Seguridad</div></div>-->
<!---->
<!--                                    <div  id="icon_2"><a href="mrh_menu.html"><img src="./images/2.jpg" title="recursos humanos" style="height: 100px"/> </a><div>Recursos Humanos</div></div>-->
<!---->
<!--                                    <div  id="icon_3"><img src="./images/3.jpg" title="contabilidad" style="height: 100px"/> <div>Contabilidad</div></div>-->
<!---->
<!--                                    <div  id="icon_4"><img src="./images/4.jpg" title="produccion y servicio" style="height: 100px"/> <div>Producción/Servicio</div></div>-->
<!---->
<!--                                    <div  id="icon_5"><a href="bie_menu.html"><img src="./images/5.jpg" title="Seguridad" style="height: 100px"/></a> <div>Bienes y Propiedades</div></div>-->
<!---->
<!--                                    <div  id="icon_6"><a href="min_menu.html"><img src="./images/6.jpg" title="Inventarios" style="height: 100px"/></a> <div>Inventarios</div></div>-->
<!---->
<!--                                    <div  id="icon_7"><a href="prc_menu.html"><img src="./images/7.jpg" title="Inventarios" style="height: 100px"/></a> <div>Procesos</div></div>-->
<!---->
<!--                                    <div  id="icon_8"><img src="./images/8.jpg" title="Inventarios" style="height: 100px"/> <div>Indicadores de Gestión</div></div>-->
<!---->
<!--                                    <div  id="icon_9"><img src="./images/9.jpg" title="Inventarios" style="height: 100px"/> <div>Presupuesto</div></div>-->
<!---->
<!--                                    <div  id="icon_10"><img src="./images/10.jpg" title="Inventarios" style="height: 100px"/> <div>Costos y Gastos</div></div>-->
<!---->
<!--                                    <div  id="icon_11"><a href="cos_menu.html"><img src="./images/11.jpg" title="Inventarios" style="height: 100px"/></a> <div>Costos y Precio de Bienes y Servicios</div></div>-->
<!---->
<!--                                    <div  id="icon_12"><img src="./images/12.jpg" title="Inventarios" style="height: 110px"/> <div>Reportes</div></div>-->
<!---->
<!--                                    <div  id="icon_13"><img src="./images/13.jpg" title="Inventarios" style="height: 110px"/> <div>Gráficos</div></div>-->
<!---->
<!--                                    <div  id="icon_14"><a href="mco_menu.html"><img src="./images/14.jpg" title="Inventarios" style="height: 110px"/> <div>Configuración</div></div>-->
<!---->
<!--                                    <div  id="icon_15"><a  href="mno_menu2.html"><img src="./images/15.jpg" title="Inventarios" style="height: 110px"/></a> <div>Nomina</div></div>-->
<!---->
<!---->
<!--                                </div>-->
<!---->
<!---->
<!--                            </div>  </div>-->
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
<!--    <div class="main">-->
<!--        <div class="zerogrid">-->
<!--            <div class="row">-->
<!--                <div class="col-1-1 border-bot" ></div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->


    <section id="content">
<!--        <div class="main">-->
<!--            <div class="zerogrid">-->
<!--                <div class="row">-->
<!--                    <article class="col-1-5"><div class="wrap-col">-->

<!--                            <h3>Bondades del Sistema</h3>-->
<!--                            <ul class="list-1">-->
<!--                                <!--<time class="tdate-1" datetime="2011-08-22"><a href="#">22.08.2011</a></time>-->
<!--                                <li>Conocer costos en forma inmediata que pueden ser: unitarios, por actividades, por horas-hombre, entre otros. </li>-->
<!--                                <!--<time class="tdate-1" datetime="2011-08-17"><a href="#">17.08.2011</a></time>-->
<!--                                <li>Generar reportes para toma de decisiones.</li>-->
<!--                                <!--<time class="tdate-1" datetime="2011-08-09"><a href="#">09.08.2011</a></time>-->
<!--                                <li>Analizar variaciones de costos. </li>-->
<!--                                <li>Verificar indicadores de gestión.</li>-->
<!--                                <li>Realizar presupuestos.</li>-->
<!--                                <li>Calcular el punto de equilibrio.</li>-->
<!--                                <li>Generar Estructuras de Costos.</li>-->
<!--                                <li>Trabajo en línea.</li> -->
<!--                            </ul> -->
<!--                        </div></article> -->

<!--                    <article class="col-2-4"><div class="wrap-col">-->
<!--                            <div class="indent-left">-->
<!--                                <h2 style="text-align: center">Gestion</h2>-->
<!--                                <div class="wrapper  indent-bot">-->
<!--                                    <div class="col-3-5">-->
<!--                                        <figure class="img-indent border"><img src="images/page1-img1.png" height="50px"  width="98%" alt="" /></figure>-->
<!--                                    </div>-->
<!--                                    <div class="col-2-5 extra-wrap">-->
<!--                                        <h4>¿Que se Entiende por Gestion?</h4>-->
<!--                                    </div>-->
<!--                                    Es el conjunto de trámites que se llevan a cabo para resolver un asunto o concretar un proyecto. La gestión es también la dirección o administración de una compañía o de un negocio.-->
<!--                                </div>-->
<!--         -->
<!--                            </div></article>-->

<!--                    <article class="col-1-4"><div class="wrap-col">-->
<!--                            <h3>Marco Legal</h3>-->
<!--                            <div class="wrapper indent-bot2">-->
<!--                                <div class="numb first">1</div>-->
<!--                                <div class="extra-wrap">-->
<!--                                    <strong class="text-1"><a href="./pdf/LIVSS.pdf">Ley del Seguro Social</a></strong>-->
<!---->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="wrapper indent-bot2">-->
<!--                                <div class="numb second">2</div>-->
<!--                                <div class="extra-wrap">-->
<!--                                    <strong class="text-1"><a href="./pdf/LOPJ.pdf">Ley Orgánica de Precios Justos</a></strong>-->
<!--                                </div>-->
<!--                            </div>-->
<!---->
<!--                            <div class="wrapper indent-bot2">-->
<!--                                <div class="numb third">3</div>-->
<!--                                <div class="extra-wrap">-->
<!--                                    <strong class="text-1"><a href="./pdf/LVH.pdf">Ley del Régimen Prestacional de Vivienda y Hábitat</a></strong>-->
<!--                                </div>-->
<!--                            </div>-->
<!---->
<!--                            <div class="wrapper">-->
<!--                                <div class="numb cuatro">4</div>-->
<!--                                <div class="extra-wrap">-->
<!--                                    <strong class="text-1"><a href="./pdf/LOTTT.pdf">Ley Orgánica del Trabajo, Los Trabajadores y Las Trabajadoras</a></strong>-->
<!--                                </div>-->
<!--                            </div>-->
<!---->
<!--                        </div></article>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
    </section>
</div>

<!-- aside -->
<!--<aside>-->
<!--    <div class="main">-->
<!--        <div class="zerogrid">-->
<!--            <div class="row">-->
<!---->
<!--                <article class="col-3-3"><div class="wrap-col">-->
<!--                        <div class="indent-left3">-->
<!--                            <h4 >IMPORTANCIA DE LOS COSTOS</h4>-->
<!--                            &nbsp;&nbsp;Es importante ya que podemos conocer los costos relacionados con la elaboración de un bien o servicio, ayuda a tomar decisiones de carácter administrativo y/o financieros, tales como:-->
<!--                            <br/>-->
<!--                            <p> &nbsp;&nbsp; <span style="font-weight: bold">Si fabricamos o compramos.</span> Algunas veces una empresa requiere de ciertos productos para fabricar: por ejemplo: para fabricar Mesas de Plástico requieren de plástico, el fabricante de la mesa tendrá que decidir que es más favorable procesar el plástico o comprarlo ya procesado, esto será de acuerdo al costo en que incurriría al fabricarlos y-->
<!--                                el precio que tendría que pagar al comprarlos ya elaborados.</p>-->
<!---->
<!--                            <p>&nbsp;&nbsp; <span style="font-weight:bold"> Expandir y hasta donde la Producción y Ventas.</span> Esto se debe analizar tomando como punto de partida los costos fijos debido a que una reducción en la producción no da como resultado una disminución en ellos un aumento tampoco dará como resultado un aumento en los costos fijos.</p>-->
<!--                            <p><span style="font-weight:bold">Fijar precios a los productos.</span>  La contabilidad de costos nos proporciona información acerca de los costos de los materiales, mano de obra, gastos de fábrica, gastos de administración y gastos de venta, a partir de lo cual se fijaran precios de venta que proporcionen al negocio cierta ganancia.</p>-->
<!--                            <p>&nbsp;&nbsp;<span style="font-weight:bold">Importancia de tener un Sistema Integral de Costo:</span> Es importante señalar que las organizaciones deben crear estrategia de negocios que permitan prepararse para los cambios inevitables del entorno, manejando información en tiempo real y oportuna para la mejor toma de decisiones, en cuanto a la competitividad de la misma y su vez adaptándose a las exigencias tanto del mercado como las del marco regulatorio que rigen las empresas.</p>-->
<!---->
<!--                        </div>-->
<!--                    </div></article>-->
<!---->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</aside>-->

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
<script type="text/javascript"> Cufon.now(); </script>
</body>
</html>
