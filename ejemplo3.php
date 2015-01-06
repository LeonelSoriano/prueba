<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
    <title>SICAP | Sistema Integral de Costos</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="author" content="Tomas Bagdanavicius, http://www.lwis.net/free-css-drop-down-menu/" />
    <meta name="keywords" content=" css, dropdowns, dropdown menu, drop-down, menu, navigation, nav, horizontal, vertical left-to-right, vertical right-to-left, horizontal linear, horizontal upwards, cross browser, internet explorer, ie, firefox, safari, opera, browser, lwis" />
    <meta name="description" content="Clean, standards-friendly, modular framework for dropdown menus" />
    <link href="../../css/helper.css" media="screen" rel="stylesheet" type="text/css" />
    <script src="../../js/htmlDatePicker.js" type="text/javascript"></script>
    <link href="../../css/htmlDatePicker.css" rel="stylesheet">
    <link href="../../css/stylesheet.css" rel="stylesheet" type="text/css" />
    <link href="../../css/ui-lightness/jquery-ui-1.10.4.custom.css" rel="stylesheet">
    <script src="../../js/jquery-1.10.2.js"></script>
    <script src="../../js/jquery-ui-1.10.4.custom.js"></script>
    <script src="../../js/clasesVarias.js"></script>

    <script src="./js/jquery-handsontable/dist/jquery.handsontable.js"></script>
    <link rel="stylesheet" media="screen" href="./js/jquery-handsontable/dist/jquery.handsontable.full.css">
    <link rel="stylesheet" media="screen" href="./js/jquery-handsontable/demo/css/samples.css">

    <!-- Beginning of compulsory code below -->
    <link href="/sicap/css/dropdown/dropdown.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="/sicap/css/dropdown/themes/flickr.com/default.ultimate.css" media="screen" rel="stylesheet" type="text/css" />
    <!-- / END -->

    <style media="screen" type="text/css">


    </style>


    <script type="text/javascript">

    $(function() {

        var data = [
            ["Sueldos y Salarios", "Mensual", "Semana 1", "Semana 2", "Semana 3", "Semana 4","Semana 5"],
            ["Sueldo Base", 0, 0, 0, 0, 0,0],
            ["Bonos Fijos", 0, 0, 0, 0, 0,0],
            ["Bono Nocturno", 0, 0, 0, 0, 0,0],
            ["Diferencia de Salario", 0, 0, 0, 0, 0,0],
            ["Horas Extras Diurnas ", 0, 0, 0, 0, 0,0],
            ["Horas Extras Nocturnas", 0, 0, 0, 0, 0,0],
            ["Cestaticket", 0, 0, 0, 0, 0,0],
            ["Cestaticket Adicional", 0, 0, 0, 0, 0,0],
            ["Dias Feriados", 0, 0, 0, 0, 0,0],
            ["Total Sueldos y Salarios", 0, 0, 0, 0, 0,0],
            ["Bonos", "", "", "", "", "",""],
            ["Años de Servicio", 0, 0, 0, 0, 0,0],
            ["Bonos", 0, 0, 0, 0, 0,0],
            ["Antigüedad", 0, 0, 0, 0, 0,0],
            ["Productividad", 0, 0, 0, 0, 0,0],
            ["Profesionalizacion", 0, 0, 0, 0, 0,0],
            ["Responsabilidad", 0, 0, 0, 0, 0,0],
            ["Unidades Producidas", 0, 0, 0, 0, 0,0],
            ["Total Bonos", 0, 0, 0, 0, 0,0],
            ["Primas", "", "", "", "", "",""],
            ["Prima por Hijos", 0, 0, 0, 0, 0,0],
            ["Prima por Hogar", 0, 0, 0, 0, 0,0],
            ["Prima por Matrimonio", 0, 0, 0, 0, 0,0],
            ["Prima por Nacimiento", 0, 0, 0, 0, 0,0],
            ["Prima por Vehiculo", 0, 0, 0, 0, 0,0],
            ["Total Prima", 0, 0, 0, 0, 0,0],
            ["Comisiones", "", "", "", "", "",""],
            ["Ventas Totales", 0, 0, 0, 0, 0,0],
            ["Ventas a  Crédito", 0, 0, 0, 0, 0,0],
            ["Colectivo", 0, 0, 0, 0, 0,0],
            ["Cobranza", 0, 0, 0, 0, 0,0],
            ["Total Comisiones", 0, 0, 0, 0, 0,0],
            ["Aportes", "", "", "", "", "",""],
            ["Seguro Social", 0, 0, 0, 0, 0,0],
            ["Perdida Involuntaria de Empleo", 0, 0, 0, 0, 0,0],
            ["Banavih", 0, 0, 0, 0, 0,0],
            ["Inces", 0, 0, 0, 0, 0,0],
            ["Cuota Sindical", 0, 0, 0, 0, 0,0],
            ["Ley del Deporte", 0, 0, 0, 0, 0,0],
            ["Ciencia y Tecnólogia ", 0, 0, 0, 0, 0,0],
            ["Total Aportes", 0, 0, 0, 0, 0,0],
            ["Apartados", "", "", "", "", "",""],
            ["Utilidades", 0, 0, 0, 0, 0,0],
            ["Aguinaldo", 0, 0, 0, 0, 0,0],
            ["Bono Vacacional", 0, 0, 0, 0, 0,0],
            ["Bono Post Vacional", 0, 0, 0, 0, 0,0],
            ["Vacaciones", 0, 0, 0, 0, 0,0],
            ["Prestaciones Sociales", 0, 0, 0, 0, 0,0],
            ["Intereses Prestaciones Sociales", 0, 0, 0, 0, 0,0],
            ["Total Apartados", 0, 0, 0, 0, 0,0],
            ["Otros Benficios", "", "", "", "", "",""],
            ["Beca de Trabajador", 0, 0, 0, 0, 0,0],
            ["Becas Hijos", 0, 0, 0, 0, 0,0],
            ["Asistencia Médica", 0, 0, 0, 0, 0,0],
            ["Juguetes", 0, 0, 0, 0, 0,0],
            ["Guarderia", 0, 0, 0, 0, 0,0],
            ["Dotacion de Uniforme", 0, 0, 0, 0, 0,0],
            ["Caja de Ahorro", 0, 0, 0, 0, 0,0],
            ["Día del Niño", 0, 0, 0, 0, 0,0],
            ["Fiesta Fin de Año Trabajadores", 0, 0, 0, 0, 0,0],
            ["Fiesta Fin de Año Niños", 0, 0, 0, 0, 0,0],
            ["Obsequio Fin de Año", 0, 0, 0, 0, 0,0],
            ["Utiles Escolares", 0, 0, 0, 0, 0,0],
            ["Total Otros Beneficios", 0, 0, 0, 0, 0,0],
            ["", "", "", "", "", "",""],
            ["Total Costo Empleado(s)", 0, 0, 0, 0, 0,0],
            ["Total Carga Laboral %", 0, 0, 0, 0, 0,0],
            ["Total Carga Laboral Veces", 0, 0, 0, 0, 0,0],
            ["Costo Hora Hombre Efectivo", 0, 0, 0, 0, 0,0],
            ["Costo Hora Hombre Pagado", 0, 0, 0, 0, 0,0],


        ];


        var grisRenderer = function (instance, td, row, col, prop, value, cellProperties) {
            Handsontable.renderers.TextRenderer.apply(this, arguments);
            $(td).css({
                background: '#CCCCFF'
            });
        };

        var gris2Renderer = function (instance, td, row, col, prop, value, cellProperties) {
            Handsontable.renderers.TextRenderer.apply(this, arguments);
            $(td).css({
                background: '#ABABEE'
            });
        };


        var totalRenderer = function (instance, td, row, col, prop, value, cellProperties) {
            Handsontable.renderers.TextRenderer.apply(this, arguments);
            $(td).css('font-weight','bold')
        };

        var amarilloRenderer = function (instance, td, row, col, prop, value, cellProperties) {
            Handsontable.renderers.TextRenderer.apply(this, arguments);
            $(td).css({
                background: '#FFF733'
            });
        };

        $('#handsontable').handsontable({
            data: data,
            minSpareRows: 1,
            readOnly: true,
            fillHandle: false,
            columnSorting: true,
            currentRowClassName: 'currentRow',
            currentColClassName: 'currentCol',
            cells: function (row, col, prop) {
                if (row === 0 && col === 0) {
                    this.renderer = grisRenderer;
                }
                if (row === 0 && col === 1) {
                    this.renderer = gris2Renderer;
                }
                if (row === 0 && col === 2) {
                    this.renderer = gris2Renderer;
                }
                if (row === 10 && col === 20) {
                    this.renderer = gris2Renderer;
                }
                if (row === 0 && col === 3) {
                    this.renderer = gris2Renderer;
                }
                if (row === 0 && col === 4) {
                    this.renderer = gris2Renderer;
                }
                if (row === 0 && col === 5) {
                    this.renderer = gris2Renderer;
                }
                if (row === 0 && col === 6) {
                    this.renderer = gris2Renderer;
                }
                if (row === 10 && col === 0) {
                    this.renderer = totalRenderer;
                }
                if (row === 11 && col === 0) {
                    this.renderer = grisRenderer;
                }
                if (row === 11 && col === 1) {
                    this.renderer = amarilloRenderer;
                }
                if (row === 11 && col === 2) {
                    this.renderer = amarilloRenderer;
                }
                if (row === 11 && col === 3) {
                    this.renderer = amarilloRenderer;
                }
                if (row === 11 && col === 4) {
                    this.renderer = amarilloRenderer;
                }
                if (row === 11 && col === 5) {
                    this.renderer = amarilloRenderer;
                }
                if (row === 11 && col === 6) {
                    this.renderer = amarilloRenderer;
                }
                if (row === 19 && col === 0) {
                    this.renderer = totalRenderer;
                }
                if (row === 20 && col === 0) {
                    this.renderer = grisRenderer;
                }
                if (row === 20 && col === 1) {
                    this.renderer = amarilloRenderer;
                }
                if (row === 20 && col === 2) {
                    this.renderer = amarilloRenderer;
                }
                if (row === 20 && col === 3) {
                    this.renderer = amarilloRenderer;
                }
                if (row === 20 && col === 4) {
                    this.renderer = amarilloRenderer;
                }
                if (row === 20 && col === 5) {
                    this.renderer = amarilloRenderer;
                }
                if (row === 20 && col === 6) {
                    this.renderer = amarilloRenderer;
                }
                if (row === 26 && col === 0) {
                    this.renderer = totalRenderer;
                }
                if (row === 27 && col === 0) {
                    this.renderer = grisRenderer;
                }
                if (row === 27 && col === 1) {
                    this.renderer = amarilloRenderer;
                }
                if (row === 27 && col === 2) {
                    this.renderer = amarilloRenderer;
                }
                if (row === 27 && col === 3) {
                    this.renderer = amarilloRenderer;
                }
                if (row === 27 && col === 4) {
                    this.renderer = amarilloRenderer;
                }
                if (row === 27 && col === 5) {
                    this.renderer = amarilloRenderer;
                }
                if (row === 27 && col === 6) {
                    this.renderer = amarilloRenderer;
                }
                if (row === 32 && col === 0) {
                    this.renderer = totalRenderer;
                }
                if (row === 33 && col === 0) {
                    this.renderer = grisRenderer;
                }
                if (row === 33 && col === 1) {
                    this.renderer = amarilloRenderer;
                }
                if (row === 33 && col === 2) {
                    this.renderer = amarilloRenderer;
                }
                if (row === 33 && col === 3) {
                    this.renderer = amarilloRenderer;
                }
                if (row === 33 && col === 4) {
                    this.renderer = amarilloRenderer;
                }
                if (row === 33 && col === 5) {
                    this.renderer = amarilloRenderer;
                }
                if (row === 33 && col === 6) {
                    this.renderer = amarilloRenderer;
                }
                if (row === 41 && col === 0) {
                    this.renderer = totalRenderer;
                }
                if (row === 42 && col === 0) {
                    this.renderer = grisRenderer;
                }
                if (row === 42 && col === 1) {
                    this.renderer = amarilloRenderer;
                }
                if (row === 42 && col === 2) {
                    this.renderer = amarilloRenderer;
                }
                if (row === 42 && col === 3) {
                    this.renderer = amarilloRenderer;
                }
                if (row === 42 && col === 4) {
                    this.renderer = amarilloRenderer;
                }
                if (row === 42 && col === 5) {
                    this.renderer = amarilloRenderer;
                }
                if (row === 42 && col === 6) {
                    this.renderer = amarilloRenderer;
                }
                if (row === 50 && col === 0) {
                    this.renderer = totalRenderer;
                }
                if (row === 51 && col === 0) {
                    this.renderer = grisRenderer;
                }
                if (row === 51 && col === 1) {
                    this.renderer = amarilloRenderer;
                }
                if (row === 51 && col === 2) {
                    this.renderer = amarilloRenderer;
                }
                if (row === 51 && col === 3) {
                    this.renderer = amarilloRenderer;
                }
                if (row === 51 && col === 4) {
                    this.renderer = amarilloRenderer;
                }
                if (row === 51 && col === 5) {
                    this.renderer = amarilloRenderer;
                }
                if (row === 51 && col === 6) {
                    this.renderer = amarilloRenderer;
                }
                if (row === 64 && col === 0) {
                    this.renderer = totalRenderer;
                }

                if (row === 66 && col === 0) {
                    this.renderer = totalRenderer;
                }
                if (row === 67 && col === 0) {
                    this.renderer = totalRenderer;
                }
                if (row === 68 && col === 0) {
                    this.renderer = totalRenderer;
                }
                if (row === 69 && col === 0) {
                    this.renderer = totalRenderer;
                }
                if (row === 70 && col === 0) {
                    this.renderer = totalRenderer;
                }


            }
        });


//            function bindDumpButton() {
//                $('body').on('click', 'button[name=dump]', function () {
//                    var dump = $(this).data('dump');
//                    var $container = $(dump);
//                    console.log('data of ' + dump, $container.handsontable('getData'));
//                });
//            }
//            bindDumpButton();

    });
    </script>

</head>
<body class="flickr-com">


<form method="post" name="uso_consumo" id="form">
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
                            <h1><img src="../../images/seleccion_sicap_archivos/image002.jpg" alt="flickr" /><strong>                Módulo de Almacén | Uso-Consumo</strong></h1>

                            <!-- Beginning of compulsory code below -->
                            <br/><br/>
                            <TABLE BORDER="0" CELLSPACING="4" WIDTH="500">

                                <?php

                                include_once("Claseejemplo.php");

                                $a = new Claseejemplo();
                                //$a->print_colores();

                                //                $var = [];
                                //
                                //                $var['sueldo']['dis'] = array(3,3,3);
                                //
                                //                $var['sueldo']['tres'] = array(2,2,2);
                                //
                                //
                                //                $var['presta']['tres'] = array(2,5,2);
                                //
                                //                foreach($var as $key => $value){
                                //
                                //                    foreach($value as $key2 => $value2){
                                //                        echo( $key.'->'.$key2  . '</br>');
                                //                        print_r($value2);
                                //                    }
                                //                }

                                ?>


                                <div class="handsontable" id="handsontable"></div>



                            </TABLE>

                            <table>
                                <tr>
                                    <td>
                                        <input id="enviar" type="submit" value="Guardar datos" name="submit">
                                    </td>
                                    <td>
                                        <a href="uso_consumo_ver.php"><input type="button" value="Ver datos"></a>
                                    </td>
                                    <td>
                                        <a href="../../min_menu.html"><input type="button" value="Atras"></a>
                                    </td>
                                </tr>
                            </table>
                            <!-- / END -->
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
            <p>&nbsp;</p>
            <p>
                <!--end right_col-->
            </p>
            <p>&nbsp; </p>
            <div class="clearboth"></div>

        </div>
        <div align="center" class="pie">SICAP 2014</div>
    </div>


</form>


</body>
</html>



